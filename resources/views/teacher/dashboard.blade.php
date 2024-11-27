@extends('layouts.dashboard')

@section('content')
   <!-- Normal div displaying login info and date, not fixed to the top -->
   <div style="height: 3cm; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: center; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px; ">
    <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
        <span>Logged in as: <span style="color: blue;"> {{ auth()->user()->name }}</span></span>
        <span>Academic Year: <span style="color: blue;">{{ now()->year }}</span></span>

        <span style="color: blue;">{{ \Carbon\Carbon::now()->format('l, jS F Y')  }}</span>
    </div>
    <div style="display: flex; justify-content: space-between; font-size: 14px;">
        <span>@yield('page-title')</span>
        <span>@yield('breadcrumb')</span>
    </div>
</div>

<div style="height: auto; background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
        Announcements
    </div>
    <div style="font-size: 14px; line-height: 1.6;">
        <p>No announcements yet. Stay tuned for updates from the admin.</p>
        <!-- Future content goes here -->
        <!-- Example: <p>New courses for 2024 are now available. Check the timetable for updates.</p> -->
    </div>
</div>

    <p>This is the teacher dashboard content.</p>
@endsection
