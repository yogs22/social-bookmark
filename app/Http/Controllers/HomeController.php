<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $contents = Content::orderBy('published_at', 'desc')->active()->paginate(6);

        return view('home', compact('contents'));
    }

    public function single($slug)
    {
        $content = Content::active()->where('slug', $slug)->first();

        if (empty($content)) {
            abort(404);
        }

        return view('single', compact('content'));
    }
}
