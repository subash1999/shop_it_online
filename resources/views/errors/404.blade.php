{{-- it extends the errors layout form the default 404.blade.php --}}
@extends('errors/layout')
@include('layouts.favicon')
@section('title', 'Page Not Found')
@php
	$message = 'Sorry, the page you are looking for could not be found.';
@endphp
@if ($exception->getMessage()!=null || $exception->getMessage()!='')
	@php
		$message = $exception->getMessage();
	@endphp
@endif

@section('message', $message)
