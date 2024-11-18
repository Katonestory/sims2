@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
@section('page-title', 'Welcome Admin')
@section('breadcrumb', 'Dashboard > Admin')

@section('sidebar-links')
    <a class="nav-link" href="#">
        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
        Manage Users
    </a>
    <a class="nav-link" href="#">
        <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
        System Settings
    </a>
@endsection

@section('content')
    <p>This is the admin dashboard content.</p>
@endsection
