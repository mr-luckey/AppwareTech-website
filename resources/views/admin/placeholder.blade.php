@extends('admin.layouts.app')

@section('title', $title ?? 'Admin')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body py-5 text-center">
        <h3 class="mb-3">{{ $title ?? 'Module' }}</h3>
        <p class="text-muted mb-0">{{ $message ?? 'This module is under setup.' }}</p>
    </div>
</div>
@endsection
