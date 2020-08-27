<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $contents = Content::latest()->paginate(6);

        return view('home', compact('contents'));
    }

    public function single($slug)
    {
        $content = Content::where('slug', $slug)->first();

        return view('single', compact('content'));
    }
}
