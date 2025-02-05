@extends('layouts.dashboard')

@section('content')
    <!-- Normal div displaying login info and date -->
    <div
        style="height: 3cm; background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
        <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
            <span>Logged in as: <span style="color: blue;">{{ auth()->user()->name }}</span></span>
            <span>Academic Year: <span style="color: blue;">{{ now()->year }}</span></span>
            <span style="color: blue;">{{ \Carbon\Carbon::now()->format('l, jS F Y') }}</span>
        </div>
    </div>

    <!-- Student profile -->

    @if (auth()->user()->role == 'parent' && session()->has('selected_student_id'))
        <a href="{{ route('home.parent') }}"
            style="text-decoration: none; color: white; background: #007bff; padding: 10px; border-radius: 5px;">
            Back to Select Student
        </a>
    @endif


    <!-- Announcements -->
    <div style="margin-top: 20px;">
        <h3>Announcements</h3>
        @if (isset($announcements) && $announcements->count() > 0)
            @foreach ($announcements as $announcement)
                <div style="margin-bottom: 15px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <strong style="font-size: 18px;">{{ $announcement->title }}</strong><br>
                    <small>Start Date: {{ \Carbon\Carbon::parse($announcement->startDate)->format('jS F Y') }}
                        @if ($announcement->endDate)
                            | End Date: {{ \Carbon\Carbon::parse($announcement->endDate)->format('jS F Y') }}
                        @endif
                    </small>
                    <p style="font-size: 18px;">{{ strip_tags($announcement->message) }}</p>
                </div>
            @endforeach
        @else
            <p>No announcements yet. Stay tuned for updates from the admin.</p>
        @endif
    </div>
    @if (isset($student))
        <!-- Student profile section -->
        <div style="background-color: #f8f9fa; padding: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <h2 style="font-size: 24px; margin-bottom: 10px;"></h2>
            <div style="display: flex; align-items: center; margin-bottom: 20px;">
                <!-- Profile picture -->
                <img src="{{ $student->photoPath ? asset('storage/' . $student->photoPath) : asset('images/default-profile.png') }}"
                    alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%; margin-right: 20px;">

                <!-- Student info -->
                <div>
                    <p><strong>Name:</strong> {{ $student->first_name }} {{ $student->middle_name }}
                        {{ $student->surname }}</p>
                    <p><strong>Student ID:</strong> {{ $student->student_id ?? 'N/A' }}</p>
                    <p><strong>Date of Birth:</strong> {{ $student->DoB ?? 'N/A' }}</p>
                    <p><strong>Gender:</strong> {{ $student->gender ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p><strong>Phone Number:</strong> {{ $student->phone_number ?? 'N/A' }}</p>
                    <p><strong>Address:</strong> {{ $student->address ?? 'N/A' }}</p>

                    <!-- Fetch class and stream from the streams table -->
                    <p><strong>Class:</strong> {{ $student->stream->class->name ?? 'N/A' }}</p>
                    <p><strong>Stream:</strong> {{ $student->stream->name ?? 'N/A' }}</p>

                    <!-- Fetch class teacher details from the stream -->
                    <p><strong>Class Teacher:</strong> {{ $student->stream->teacher->first_name ?? 'N/A' }}
                        {{ $student->stream->teacher->surname ?? '' }}</p>
                    <p><strong>Class Teacher's Phone:</strong> {{ $student->stream->teacher->phone_number ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    @endif
@endsection
