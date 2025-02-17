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

@if(isset($teacher))
    <!-- Teacher profile -->
    <div style="background-color: #f8f9fa; padding: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h2 style="font-size: 24px; margin-bottom: 10px;"></h2>
        <div style="display: flex; align-items: center; margin-bottom: 20px;">
            <!-- Profile picture -->
            <img src="{{ $teacher->photoPath ? asset('storage/' . $teacher->photoPath) : asset('images/default-profile.png') }}"
                 alt="Profile Picture"
                 style="width: 100px; height: 100px; border-radius: 50%; margin-right: 20px;">

            <!-- Teacher info -->
            <div>
                <p><strong>Name:</strong> {{ $teacher->first_name }} {{ $teacher->middle_name }} {{ $teacher->surname }}</p>
                <p><strong>Date of Birth:</strong> {{ $teacher->DoB ?? 'N/A' }}</p>
                <p><strong>Gender:</strong> {{ $teacher->gender ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p><strong>Phone Number:</strong> {{ $teacher->phone_number ?? 'N/A' }}</p>
                <p><strong>Address:</strong> {{ $teacher->address ?? 'N/A' }}</p>
                <p><strong>Hire Date:</strong> {{ $teacher->hireDate ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
@endif


@endsection
