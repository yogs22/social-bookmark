<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Category;

class SitemapController extends Controller
{
    public function index()
    {
        $content = Content::latest()->first();

        return response()->view('sitemap.index', compact('content'))->header('Content-Type', 'text/xml');
    }

    public function content()
    {
        $contents = Content::latest()->active()->get();
        return response()->view('sitemap.content', compact('contents'))->header('Content-Type', 'text/xml');
    }
}
