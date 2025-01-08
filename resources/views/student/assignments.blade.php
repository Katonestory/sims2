@extends('student.dashboard')
@section('content')
<!-- Header displaying login info and date -->
<div style="height: 3cm; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: center; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
        <span>Logged in as: <span style="color: blue;">{{ auth()->user()->name }}</span></span>
        <span>Academic Year: 2024/2025</span>
        <span style="color: blue;">{{ \Carbon\Carbon::now()->format('l, jS F Y') }}</span>
    </div>
    <div style="display: flex; justify-content: space-between; font-size: 14px;">
        <span>@yield('page-title')</span>
        <span>@yield('breadcrumb')</span>
    </div>
</div>

<!-- Content section for Assignments -->
<div style="height: auto; background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
        Assignments
    </div>
    <div style="font-size: 14px; line-height: 1.6;">
        @if($assignments->isEmpty())
            <p>No assignments are available at the moment. Please check back later.</p>
        @else
            <p style="font-size: 20px; font-weight: bold; color: #333;">Welcome to the Assignments page. Below are the assignments for your subjects:</p>
            <ul style="list-style-type: none; margin-left: 20px; color: #34495e;">
                @foreach($assignments as $assignment)
                <div style="width: 50%; margin-left: 0px; padding: 15px; background-color: #f8f9fa; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 30px;">
                    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">
                        {{ $assignment->title }}
                    </div>

                    <div style="font-size: 16px; margin-bottom: 10px;">
                        <strong>Uploaded by:</strong> {{ $assignment->thisteacher->first_name }} {{ $assignment->thisteacher->surname }}

                    </div>

                    <div style="font-size: 16px; margin-bottom: 10px;">
                        <strong>Due Date:</strong> {{ \Carbon\Carbon::parse($assignment->dueDate)->format('jS F Y') }}
                    </div><br>

                    <div style="margin-top: 10px;">
                        <a href="{{ asset('storage/' . $assignment->filepath) }}" download
                           style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-size: 16px; cursor: pointer;">
                           Download Assignment
                        </a>
                    </div>
                </div>
            @endforeach

            </ul>
        @endif
    </div>
</div>


@endsection
