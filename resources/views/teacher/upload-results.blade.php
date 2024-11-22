@extends('teacher.dashboard')

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

<!-- Content section for Uploading Results -->
<div style="height: auto; background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
        Upload Results
    </div>
    <div style="font-size: 14px; line-height: 1.6;">
        {{-- <form action="{{ route('teacher.store-results') }}" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="student" style="font-weight: bold;">Select Student:</label>
                <select id="student" name="student_id" required style="width: 100%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;">
                    <!-- Assuming you will load the students dynamically -->
                    <option value="">Select a Student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->surname }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="exam" style="font-weight: bold;">Select Exam:</label>
                <select id="exam" name="exam_id" required style="width: 100%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;">
                    <!-- Assuming you will load the exams dynamically -->
                    <option value="">Select an Exam</option>
                    @foreach($exams as $exam)
                        <option value="{{ $exam->id }}">{{ $exam->title }} ({{ $exam->exam_date }})</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="score" style="font-weight: bold;">Enter Score:</label>
                <input type="number" id="score" name="score" required style="width: 100%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="grade" style="font-weight: bold;">Grade:</label>
                <input type="text" id="grade" name="grade" required style="width: 100%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="remarks" style="font-weight: bold;">Remarks:</label>
                <textarea id="remarks" name="remarks" required style="width: 100%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></textarea>
            </div>

            <button type="submit" style="background-color: #007bff; color: white; padding: 10px 15px; border: none; cursor: pointer; margin-top: 10px;">
                Upload Results
            </button>
        </form> --}}

        <!-- Display success message -->
        @if(session('success'))
            <div style="margin-top: 10px; color: green;">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>
@endsection
