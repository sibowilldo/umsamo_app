@extends('errors::illustrated-layout')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Service Unavailable'))

@section('image')
    {{ asset('media/error/503.jpg') }}
@endsection
