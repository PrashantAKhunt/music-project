<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategories = \App\Models\Category::count();
        $totalVideos = \App\Models\Video::count();
        return view('admin.dashboard.index', compact('totalCategories', 'totalVideos'));
    }
}
