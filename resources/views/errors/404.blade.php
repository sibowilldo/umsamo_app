@extends('errors::illustrated-layout')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('We couldn\'t find what you were looking for!'))

@section('image')
    {{ asset('media/error/bg6.jpg') }}
@endsection
