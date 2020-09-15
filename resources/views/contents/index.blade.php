@extends('layouts.app')

@section('page_title')
    {{ 'Content Management' }} - {{ config('app.name', 'Laravel') }}
@endsection

@section('content')
<div class="container">
    <form method="get">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="user_id">Filter berdasarkan user</label>
                                        <select class="form-control" name="user_id">
                                            <option value="">Semua User</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" @if(request('user_id') == $user->id) selected @endif>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="status">Filter berdasarkan status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="">Semua status</option>
                                            <option value="published" @if(request('status') == 'published') selected @endif>Published</option>
                                            <option value="pending" @if(request('status') == 'pending') selected @endif>Pending</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-block mt-2">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        @if(Session::has('message'))
                            <p class="alert alert-success">{{ Session::get('message') }}</p>
                        @endif
                        <div class="row">
                            <div class="col-md-5">
                                <input type="text" name="q" class="form-control mb-3" placeholder="Cari berdasarkan link / judul, lalu tekan enter" value="{{ request('q') }}">
                            </div>
                            <div class="col-md-7 text-sm-right">
                                <a href="{{ route('content.index') }}" class="btn btn-warning">Refresh</a>
                                <a href="{{ route('content.download') }}" class="btn btn-success">Download</a>
                                <a href="{{ route('content.create') }}" class="btn btn-primary">Tambah Content</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th width="500px">Title</th>
                                        <th>Status</th>
                                        <th>Tanggal Publish</th>
                                        <th>User</th>
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
                                            <td>{!! $content->published_status !!}</td>
                                            <td>{{ $content->published_at_formated }}</td>
                                            <td>{{ @$content->user->name }}</td>
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
    </form>
</div>
@endsection
