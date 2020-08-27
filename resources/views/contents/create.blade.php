@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Create Content</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('content.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">URL</label>
                            <input type="url" name="url" class="form-control">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary w-25">Process</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
