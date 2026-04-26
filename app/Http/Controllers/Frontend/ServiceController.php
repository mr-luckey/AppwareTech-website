<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        
        return view('frontend.services.index', compact('services'));
    }
}
