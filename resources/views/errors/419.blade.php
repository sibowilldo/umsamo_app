@extends('errors::illustrated-layout')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))

@section('image')
    {{ asset('media/error/bg6.jpg') }}
@endsection
