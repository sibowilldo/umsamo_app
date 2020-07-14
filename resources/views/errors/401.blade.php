@extends('errors::illustrated-layout')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))

@section('image')
    {{ asset('media/error/401.jpg') }}
@endsection
