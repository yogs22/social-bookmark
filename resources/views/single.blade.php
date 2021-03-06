@extends('layouts.app')

@section('page_title')
    {{ $content->title }} - {{ config('app.name', 'Laravel') }}
@endsection

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-8 col-12">
            <div class="card">
                <img class="card-img-top" src="{{ $content->image_url }}" alt="Card image cap">
                <div class="card-body">
                    <h1 class="card-title">{{ $content->title }}</h1>
                    <p class="text-muted">
                        {{ $content->published_at_formated }}
                    </p>
                    <p class="card-text">
                        View Content URL <a href="{{ $content->content_url }}">{{ $content->title }}</a>
                    </p>
                    <p class="card-text">
                        {{ $content->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
