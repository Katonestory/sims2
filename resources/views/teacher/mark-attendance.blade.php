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
@if (!empty($message))
<div style="color: white; background-color: #dc3545; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
    {{ $message }}
</div>
@else
<h2 style="color: #343a40; font-family: 'Arial', sans-serif; margin-bottom: 20px;">
    Mark Attendance for Stream: <span style="color: #007bff;">{{ $stream->name }}</span>
</h2>

<form action="{{ route('teacher.save-attendance') }}" method="POST" style="background-color: #f8f9fa; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    @csrf
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <thead>
            <tr style=" color: rgb(10, 10, 10); text-align: left;">
                <th style="padding: 10px; border: 1px solid #ddd;">STUDENT NAME</th>
                <th style="padding: 10px; border: 1px solid #ddd;">STATUS</th>
                <th style="padding: 10px; border: 1px solid #ddd;">REMARKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr style="background-color: #f8f9fa;">
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $student->first_name }} {{ $student->surname }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">
                        <label style="margin-right: 10px;">
                            <input type="radio" name="attendance[{{ $student->id }}][status]" value="present" checked> Present
                        </label>
                        <label>
                            <input type="radio" name="attendance[{{ $student->id }}][status]" value="absent"> Absent
                        </label>
                    </td>
                    <td style="padding: 10px; border: 1px solid #ddd;">
                        <input type="text" name="attendance[{{ $student->id }}][remarks]" placeholder="Remarks (if absent)" style="width: 100%; padding: 5px; border: 1px solid #ccc; border-radius: 5px;">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px;">
        Upload Attendance
    </button>
</form>
@endif


@endsection
