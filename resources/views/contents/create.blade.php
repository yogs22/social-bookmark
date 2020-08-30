@extends('layouts.app')

@section('page_title')
    {{ 'Create Content' }} - {{ config('app.name', 'Laravel') }}
@endsection

@section('content')
    <create-content-component></create-content-component>
@endsection
