<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontendController extends Controller {
    public function index() {
        return view('frontend.index');
    }

    public function download() {
        $data = [
            'pageTitle' => 'Download',
        ];
        return view('frontend.download', $data);
    }

    public function terms_of_service() {
        $data = [
            'pageTitle' => 'Terms of Service',
        ];
        return view('frontend.terms-of-service', $data);
    }

    public function privacy_policy() {
        $data = [
            'pageTitle' => 'Privacy Policy',
        ];
        return view('frontend.privacy-policy', $data);
    }
}
