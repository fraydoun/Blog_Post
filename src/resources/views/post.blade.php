@extends('blog::layouts.app')

@section('css')
<link href="{{asset('/vendor/blog/assets/css/elements/custom-pagination.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
@livewire('Post')

@endsection


