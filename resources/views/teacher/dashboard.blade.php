@extends('layouts.dashboard')

@section('title', 'Teacher Dashboard')
@section('page-title', 'Welcome Teacher')
@section('breadcrumb', 'Dashboard > Teacher')

@section('sidebar-links')
    <a class="nav-link" href="#">
        <div class="sb-nav-link-icon"><i class="fas fa-chalkboard-teacher"></i></div>
        Manage Classes
    </a>
    <a class="nav-link" href="#">
        <div class="sb-nav-link-icon"><i class="fas fa-clipboard"></i></div>
        Attendance
    </a>
@endsection

@section('content')
    <p>This is the teacher dashboard content.</p>
@endsection
