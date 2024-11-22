@extends('admin.dashboard')
@section('content')
<div style="height: 3cm; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: center; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
        <span>Logged in as: <span style="color: blue;">{{ auth()->user()->name }}</span></span>
        <span>Academic Year: 2024/2025</span>
        <span style="color: blue;">{{ \Carbon\Carbon::now()->format('l, jS F Y') }}</span>
    </div>
    <div style="display: flex; justify-content: space-between; font-size: 14px;">
        <span>Register Exams</span>
        <span>Admin > Register Exams</span>
    </div>
</div>

<!-- Content section for Registering Exams -->
<div style="height: auto; background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
        Register New Exam
    </div>
    <div style="font-size: 14px; line-height: 1.6;">
        <form action="{{ route('admin.register-exams') }}" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="exam-title" style="font-weight: bold;">Exam Title:</label>
                <p><input type="text" id="exam-title" name="title" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="exam-subject" style="font-weight: bold;">Subject:</label>
                <p>
                    {{-- <select id="exam-subject" name="subject_id" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;">
                        <option value="" disabled selected>Select Subject</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select> --}}
                </p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="exam-class" style="font-weight: bold;">Class:</label>
                <p>
                    {{-- <select id="exam-class" name="class_id" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;">
                        <option value="" disabled selected>Select Class</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }} - {{ $class->stream }}</option>
                        @endforeach
                    </select> --}}
                </p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="exam-date" style="font-weight: bold;">Exam Date:</label>
                <p><input type="date" id="exam-date" name="exam_date" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="academic-year" style="font-weight: bold;">Academic Year:</label>
                <p><input type="text" id="academic-year" name="academic_year" required value="2024/2025" readonly style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <button type="submit" style="background-color: #007bff; color: white; padding: 10px 15px; border: none; cursor: pointer; margin-top: 10px;">
                Register Exam
            </button>
        </form>
    </div>
</div>
@endsection
