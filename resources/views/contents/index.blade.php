@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('content.create') }}" class="btn btn-primary mb-3">Tambah Content</a>
                    @if(Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="600px">Title</th>
                                <th>Content URL</th>
                                <th>Status</th>
                                <th width="200px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contents as $content)
                                <tr>
                                    <td>{{ ($contents->currentpage()-1) * $contents ->perpage() + $loop->index + 1 }}</td>
                                    <td>
                                        <a href="{{ route('home.single', $content->slug) }}" target="_blank" rel="noreferrer">
                                            {{ $content->title }}</td>
                                        </a>
                                    <td>
                                        <a href="{{ $content->content_url }}" class="btn btn-primary" target="_blank" rel="noreferrer">
                                            URL
                                        </a>
                                    </td>
                                    <td>{!! $content->status_raw !!}</td>
                                    <td>
                                        <a href="{{ route('content.edit', $content->id) }}" class="btn btn-warning">
                                            Edit
                                        </a>
                                        <button type="submit" name="button" class="btn btn-danger">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $contents->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
