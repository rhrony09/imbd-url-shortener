<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsUpdateRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class SettingsController extends Controller {
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (!in_array(auth()->user()->role->id, [1, 2])) {
                abort(403, 'Unauthorized.');
            } else {
                return $next($request);
            }
        });
    }

    public function index() {
        return view('dashboard.settings.index');
    }

    public function settings_update(SettingsUpdateRequest $request) {
        // Batch update settings
        $settings = [
            'site_name' => $request->site_name,
            'site_tagline' => $request->site_tagline,
            'email' => $request->email,
            'phone' => $request->phone,
            'site_primary_color' => $request->site_primary_color,
            'site_accent_color' => $request->site_accent_color,
            'header_meta_tags' => $request->header_meta_tags,
        ];

        foreach ($settings as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        // Handle file uploads (logo, og_image, favicon)
        $fileFields = [
            'logo' => '/uploads/logos/',
            'og_image' => '/uploads/logos/',
            'favicon' => '/uploads/logos/'
        ];

        foreach ($fileFields as $field => $path) {
            if ($request->hasFile($field)) {
                $image = $request->file($field);
                $setting = Setting::where('key', $field)->first();

                if ($setting) {
                    $oldFile = $path . $setting->value;
                    if (Storage::exists($oldFile)) {
                        Storage::delete($oldFile);
                    }

                    // Process image
                    $imagePath = $path . $setting->value;
                    $img = Image::make($image);

                    if ($field === 'favicon') {
                        $img->fit(90, 90); // Resize only favicon
                    }

                    $img->save(public_path($imagePath));
                }
            }
        }

        session()->flash('success', 'Settings updated successfully!');
        return response()->json(['success' => true]);
    }
}
