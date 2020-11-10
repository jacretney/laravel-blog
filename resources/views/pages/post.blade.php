@extends('layouts.app')

@section('title', $postTitle)

@section('content')
    <div class="content">
        {{ $postContent }}
    </div>
@endsection
