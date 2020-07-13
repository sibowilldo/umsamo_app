@extends('errors::illustrated-layout')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))

@section('image')
    {{ asset('media/error/bg6.jpg') }}
@endsection
