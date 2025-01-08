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
        @if ($errors->any())
            <div class="alert alert-danger">
                 <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('upload.results') }}" method="POST" enctype="multipart/form-data" style="text-align: left; margin-left: 0; width: 50%;">
            @csrf
            <!-- Class Selection -->
            <label for="class_id" style="font-weight: bold; display: block; margin-bottom: 5px;">Select Class:</label>
            <select name="class_id" id="class_id" required style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>

            <!-- Subject Selection -->
            <label for="subject_id" style="font-weight: bold; display: block; margin-bottom: 5px;">Select Subject:</label>
            <select name="subject_id" id="subject_id" required style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>

            <!-- Exam Title Dropdown (Populated Dynamically) -->
            <label for="exam_title" style="font-weight: bold; display: block; margin-bottom: 5px;">Select Exam Title:</label>
            <select name="exam_title" id="exam_title" required style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
                <!-- Options populated via AJAX -->
            </select>

            <!-- Hidden Exam ID Field -->
            <input type="hidden" name="exam_id" id="exam_id">

            <!-- File Upload -->
            <label for="file" style="font-weight: bold; display: block; margin-bottom: 5px;">Upload CSV File:</label>
            <input type="file" name="file" id="file" accept=".csv" required style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">

            <!-- Submit Button -->
            <button type="submit" style="background-color: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; display: block; width: 50%;">Upload Results</button>
            <p style="margin-top: 10px; font-size: 12px; color: #555;">Accepted format: CSV only (Max size: 2MB)</p>
        </form>

        <!-- Success/Warning/Error Messages -->
        @if(session('success'))
            <div style="margin-top: 10px; color: green;">{{ session('success') }}</div>
        @endif
        @if(session('warning'))
            <div style="margin-top: 10px; color: orange;">{{ session('warning') }}</div>
        @endif
        @if(session('error'))
            <div style="margin-top: 10px; color: red;">{{ session('error') }}</div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const classId = document.getElementById('class_id').value;
    const subjectId = document.getElementById('subject_id').value;

    if (classId && subjectId) {
        // If there are already selected values, fetch the exam titles immediately
        fetchExamTitles(classId, subjectId);
    }
});

document.getElementById('subject_id').addEventListener('change', function () {
    const classId = document.getElementById('class_id').value;
    const subjectId = this.value;

    if (classId && subjectId) {
        fetchExamTitles(classId, subjectId);
    }
});

function fetchExamTitles(classId, subjectId) {
    fetch(`/teacher/get-exam-titles?class_id=${classId}&subject_id=${subjectId}`)
        .then(response => response.json())
        .then(data => {
            const examSelect = document.getElementById('exam_title');
            examSelect.innerHTML = '<option value="">Select Exam</option>';  // Reset the dropdown

            data.forEach(title => {
                // Populate the dropdown with exam titles
                examSelect.innerHTML += `<option value="${title.id}">${title.title}</option>`;
            });
        })
        .catch(error => console.error('Error fetching exam titles:', error));
}

// Update the hidden exam_id when an exam title is selected
document.getElementById('exam_title').addEventListener('change', function () {
    const examId = this.value;
    document.getElementById('exam_id').value = examId;  // Set the hidden exam_id
});

</script>

@endsection
