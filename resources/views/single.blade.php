@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-8 col-12">
            <div class="card">
                <img class="card-img-top" src="{{ $content->image_url }}" alt="Card image cap">
                <div class="card-body">
                    <h1 class="card-title">{{ $content->title }}</h1>
                    <p class="card-text">
                        <a href="{{ $content->content_url }}">View Content URL</a>
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
