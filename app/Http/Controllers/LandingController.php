<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SiteContent;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $siteContents = SiteContent::all()->pluck('value', 'key_name');

        return view('landing', compact('siteContents'));
    }
}
