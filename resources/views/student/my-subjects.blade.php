@extends('student.dashboard') <!-- Path to your dashboard.blade.php file -->

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

<!-- Content section for My Subjects -->
<div style="height: auto; background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
        My Subjects
    </div>
    <div style="font-size: 18px; line-height: 1.8; padding: 10px;">
        @if(isset($message))
            <p style="font-size: 20px; font-weight: bold; color: #333;">{{ $message }}</p>
        @else
            <p style="font-size: 20px; font-weight: bold; color: #333;">Welcome to the Subjects page. Below are the subjects for your Class:</p>
            <ul style="list-style-type: square; margin-left: 20px; color: #34495e; font-size: 18px;">
                @foreach($subjects as $subject)
                    <li style="margin-bottom: 10px; font-size: 18px;">
                        <strong style="font-size: 20px;">{{ $subject->name }}</strong>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>


@endsection
