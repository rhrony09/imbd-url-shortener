<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Services\UrlShortenerService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller {
    protected $urlShortenerService;

    /**
     * Constructor
     * 
     * @param UrlShortenerService $urlShortenerService
     */
    public function __construct(UrlShortenerService $urlShortenerService) {
        $this->urlShortenerService = $urlShortenerService;
    }

    /**
     * Show the home page with form
     * 
     * @return \Illuminate\View\View
     */

    /**
     * Show the dashboard with all URLs
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function dashboard() {
        if (in_array(auth()->user()->role_id, [1, 2])) {
            $data = [
                "urls" => Url::latest()->get()
            ];
        } else {
            $data = [
                "urls" => Url::where('user_id', auth()->user()->id)->latest()->get()
            ];
        }

        return view('dashboard.index', $data);
    }

    /**
     * Create a shortened URL
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'original_url' => 'required|url',
            'custom_slug' => 'nullable|alpha_dash|min:3|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $url = $this->urlShortenerService->createShortUrl(
                $request->original_url,
                $request->custom_slug
            );

            return redirect()->back()
                ->with('success', 'URL shortened successfully!')
                ->with('url', $url);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Get URL details with analytics
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUrlDetails($id) {
        $url = Url::findOrFail($id);

        // Get the most current click count directly from the database
        $clickCount = DB::table('url_clicks')
            ->where('url_id', $id)
            ->count();

        // Update the URL object with the accurate click count
        $url->clicks = $clickCount;

        // Get clicks data for the last 7 days
        $clicksData = $this->getClicksData($url->id);

        return response()->json([
            'success' => true,
            'url' => $url,
            'clicksData' => $clicksData
        ]);
    }

    /**
     * Delete a URL
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id) {
        try {
            $url = Url::findOrFail($id);
            $url->delete();

            return redirect()->route('dashboard.index')
                ->with('success', 'URL deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.index')
                ->with('error', 'Failed to delete URL: ' . $e->getMessage());
        }
    }

    /**
     * Redirect to original URL
     * 
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect($slug) {
        $originalUrl = $this->urlShortenerService->getOriginalUrl($slug);

        if ($originalUrl) {
            // Track this click in the database
            $this->recordClick($slug);

            return redirect()->away($originalUrl);
        }

        return redirect()->route('index')
            ->with('error', 'URL not found!');
    }

    /**
     * API endpoint to create a shortened URL
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiCreate(Request $request) {
        $validator = Validator::make($request->all(), [
            'original_url' => 'required|url',
            'custom_slug' => 'nullable|alpha_dash|min:3|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $url = $this->urlShortenerService->createShortUrl(
                $request->original_url,
                $request->custom_slug
            );

            return response()->json([
                'success' => true,
                'url' => [
                    'original_url' => $url->original_url,
                    'short_url' => route('redirect', $url->slug),
                    'slug' => $url->slug,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Get dashboard summary statistics
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDashboardStats() {
        // Total URLs
        $totalUrls = Url::count();

        // Total clicks
        $totalClicks = DB::table('url_clicks')->count();

        // Clicks in the last 24 hours
        $clicksLast24h = DB::table('url_clicks')
            ->where('clicked_at', '>=', Carbon::now()->subHours(24))
            ->count();

        // Most clicked URL
        $mostClickedUrl = Url::orderBy('clicks', 'desc')->first();

        return response()->json([
            'success' => true,
            'stats' => [
                'total_urls' => $totalUrls,
                'total_clicks' => $totalClicks,
                'clicks_last_24h' => $clicksLast24h,
                'most_clicked_url' => $mostClickedUrl ? [
                    'slug' => $mostClickedUrl->slug,
                    'original_url' => $mostClickedUrl->original_url,
                    'clicks' => $mostClickedUrl->clicks
                ] : null
            ]
        ]);
    }

    /**
     * Record a click for analytics
     * 
     * @param string $slug
     * @return void
     */
    private function recordClick($slug) {
        // Get the URL record
        $url = Url::where('slug', $slug)->first();

        if (!$url) {
            return;
        }

        // Increment the clicks counter in the urls table for quick access
        $url->increment('clicks');

        // Add detailed click record to the url_clicks table
        DB::table('url_clicks')->insert([
            'url_id' => $url->id,
            'clicked_at' => now(),
            'user_agent' => request()->userAgent(),
            'ip_address' => request()->ip(),
            'referrer' => request()->header('referer'),
        ]);
    }

    /**
     * Get clicks data for chart
     * 
     * @param int $urlId
     * @return array
     */
    private function getClicksData($urlId) {
        $labels = [];
        $data = [];

        // Generate labels for the last 7 days
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('M d');

            // Get actual click count for this day
            $clickCount = DB::table('url_clicks')
                ->where('url_id', $urlId)
                ->whereDate('clicked_at', $date->format('Y-m-d'))
                ->count();

            $data[] = $clickCount;
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
}
