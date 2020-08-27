@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-columns">
        @foreach ($contents as $content)
            <div class="card">
                <img class="card-img-top" src="{{ $content->image_url }}" alt="Card image cap">
                <div class="card-body">
                    <a href="{{ route('home.single', $content->slug) }}">
                        <h5 class="card-title">{{ $content->title }}</h5>
                    </a>
                    <p class="card-text">
                        {{ substr($content->description, 0, 130) . '...' }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {!! $contents->links() !!}
        </div>
    </div>
</div>
@endsection
