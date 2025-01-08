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

<!-- Announcements Section -->
<div style="height: auto; background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
        Announcements
    </div>
    @if(isset($announcements) && $announcements->count() > 0)
    <div style="font-size: 14px; line-height: 1.6;">
        @foreach($announcements as $announcement)
            <div style="margin-bottom: 15px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <strong style=" font-size: 18px; ">{{ $announcement->title }}</strong><br>
                <small>Start Date: {{ \Carbon\Carbon::parse($announcement->startDate)->format('jS F Y') }}
                    @if($announcement->endDate) | End Date: {{ \Carbon\Carbon::parse($announcement->endDate)->format('jS F Y') }} @endif</small>
                    <p style=" font-size: 18px; ">  {{ strip_tags($announcement->message) }}</p>
            </div>
        @endforeach
    </div>
@else
    <div style="font-size: 14px; line-height: 1.6;">
        <p>No announcements yet. Stay tuned for updates from the admin.</p>
    </div>
@endif
</div>
    <p>This is the admin dashboard content.</p>
@endsection
