@extends('layouts.base_dashboard', ['layout' => 'auth'])
@section('title', $title)
@section('content')
    @livewire('splash-livewire')
@endsection
