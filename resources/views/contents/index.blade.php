@extends('layouts.app')

@section('page_title')
    {{ 'Content Management' }} - {{ config('app.name', 'Laravel') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <form method="get">
                                <input type="text" name="q" class="form-control mb-3" placeholder="Cari berdasarkan link, lalu tekan enter" value="{{ request('q') }}">
                            </form>
                        </div>
                        <div class="col-md-7 text-sm-right">
                            <a href="{{ route('content.index') }}" class="btn btn-warning">Refresh</a>
                            <a href="{{ route('content.download') }}" class="btn btn-success">Download</a>
                            <a href="{{ route('content.create') }}" class="btn btn-primary">Tambah Content</a>
                        </div>
                    </div>
                    @if(Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="700px">Title</th>
                                    <th>Tanggal</th>
                                    <th>Content</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contents as $content)
                                    <tr>
                                        <td>{{ ($contents->currentpage()-1) * $contents ->perpage() + $loop->index + 1 }}</td>
                                        <td>
                                            <a href="{{ $content->url }}" target="_blank" rel="noreferrer">
                                                {{ $content->title }}
                                            </a>
                                        </td>
                                        <td>{{ $content->created_at_formated }}</td>
                                        <td>
                                            <a href="{{ $content->content_url }}" class="btn btn-primary" target="_blank" rel="noreferrer">
                                                URL
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{route('content.destroy', $content->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $contents->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
