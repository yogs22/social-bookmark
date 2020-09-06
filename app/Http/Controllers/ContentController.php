<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Exports\ContentExport;
use Faker\Factory as Faker;
use Embed\Embed;

class ContentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Content::orderBy('published_at', 'desc')->when(request('q'), function($query) {
            $query->where('content_url', 'like', '%'. request('q') .'%')
                ->orWhere('title', 'like', '%'. request('q') .'%');
        })->paginate();

        return view('contents.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $embed = new Embed();
        $faker = Faker::create('id_ID');

        try {
            $info = $embed->get($request->url);

            $image = $info->image != null
                ? "{$info->image->getScheme()}://{$info->image->getHost()}{$info->image->getPath()}"
                : $faker->imageUrl('1000', '800');

            $description = $info->description ?? $faker->text;
            $title = $info->title ?? $faker->name;

            $content = new Content;
            $content->title = $title;
            $content->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
            $content->description = $description;
            $content->content_url = $request->url;
            $content->image_url = $image;
            $content->published_at = $request->published_at;
            $content->status = 200;
            $content->save();

            return response()->json([
                'status' => 200,
                'payload' => $content
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'payload' => [
                    'title' => 'Error - '.$request->url,
                    'slug' => '',
                    'exception' => $e->getMessage()
                ]
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Content::destroy($id);

        return redirect()->back()->with(['message' => 'Sukses menghapus data']);
    }

    public function download()
    {
        return view('contents.download');
    }

    public function downloadReport(Request $request)
    {
        $contents = Content::orderBy('published_at', 'desc')
            ->when(request('start_date') && request('end_date'), function ($query) {
                return $query->whereBetween('published_at', [request('start_date') . ' 00:00', request('end_date') . ' 23:59']);
            })
            ->when(request('is_active'), function ($query) {
                return $query->active();
            })
            ->get();

        $request = $request->all();

        return \Excel::download(new ContentExport($contents, $request), 'laporan_content.xls');
    }
}
