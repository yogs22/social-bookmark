@extends('layouts.app')

@section('page_title')
    {{ 'Content Download' }} - {{ config('app.name', 'Laravel') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Download Content</div>

                <div class="card-body">
                    <form action="{{ route('content.report') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="start_date">Tanggal Publish Mulai</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="start_date">Tanggal Publish Akhir</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="start_date">User</label>
                            <select class="form-control" name="user_id">
                                <option value="">Semua User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="is_active">
                            <label for="start_date">Hanya konten aktif</label>
                        </div>
                        <div class="form-group">
                            <p class="text-danger">* Kosongi input jika tidak ingin menggunakan range tanggal</p>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Download</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
