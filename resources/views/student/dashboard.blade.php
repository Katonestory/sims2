@extends('layouts.dashboard')

@section('title', 'Student Dashboard')
@section('page-title', 'Welcome Student')
@section('breadcrumb', 'Dashboard > Student')

@section('sidebar-links')
    <a class="nav-link" href="#">
        <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
        My Courses
    </a>
    <a class="nav-link" href="#">
        <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
        Timetable
    </a>
@endsection

@section('content')
    <p>This is the student dashboard content.</p>
@endsection
