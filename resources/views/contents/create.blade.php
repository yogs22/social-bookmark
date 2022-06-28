@extends('layouts.app')

@section('page_title')
    {{ 'Create Content' }} - {{ config('app.name', 'Laravel') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Create Content</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('content.store') }}">
                        @csrf
                        <input type="hidden" v-model="form.user_id">
                        <div class="form-group">
                            <label for="url">Masukkan URL (https://www.google.com)</label>
                            <textarea name="url" rows="5" class="form-control" placeholder="Pisahkan dengan enter" v-model="form.url"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-25" :disabled="disabled">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
