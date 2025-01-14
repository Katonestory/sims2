@extends('admin.dashboard')

@section('content')
<div style="height: 3cm; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: center; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
        <span>Logged in as: <span style="color: blue;">{{ auth()->user()->name }}</span></span>
        <span>Academic Year: 2024/2025</span>
        <span style="color: blue;">{{ \Carbon\Carbon::now()->format('l, jS F Y') }}</span>
    </div>
    <div style="display: flex; justify-content: space-between; font-size: 14px;">
        <span>Promote</span>
        <span>Admin > Promote</span>
    </div>
</div>

<div style="max-width: 800px; margin-left:0px; padding: 20px; background-color: #f8f9fa; border-radius: 10px;">
    <h2>Promote Student</h2>
    <br>

    <div id="message" style="color: green; font-weight: bold;">
        @if (session('success'))
            {{ session('success') }}
        @endif
    </div>

    <form id="promoteForm" action="{{ route('admin.promote.submit') }}" method="POST">
        @csrf

        <!-- Student Search -->
        <div style="margin-bottom: 15px;">
            <label for="student_search" style="font-weight: bold;">Search Student:</label>
            <input type="text" id="student_search" name="student_search" placeholder="Enter student name" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
            <ul id="student_list" style="list-style: none; padding: 0; margin-top: 5px; background-color: #fff; border: 1px solid #ccc; display: none;"></ul>
        </div>

        <!-- Class Selection -->
        <div style="margin-bottom: 15px;">
            <label for="class" style="font-weight: bold;">Select Class:</label>
            <select id="class" name="class" class="form-control" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                <option value="">Select a class</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Stream Selection (Dynamically populated) -->
        <div style="margin-bottom: 15px;">
            <label for="stream" style="font-weight: bold;">Select Stream:</label>
            <select id="stream" name="stream" class="form-control" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                <option value="">Select a stream</option>
            </select>
        </div>

        <!-- Promote Button -->
        <button type="submit" class="btn btn-success" style="width: 100%; padding: 10px; background-color: #28a745; border: none; border-radius: 5px; color: white;">Promote</button>
    </form>
</div>

<script>
    // JavaScript for dynamic stream selection based on class
    document.getElementById('class').addEventListener('change', function() {
        let classId = this.value;
        if (classId) {
            fetch(`/admin/get-streams/${classId}`)
                .then(response => response.json())
                .then(data => {
                    let streamSelect = document.getElementById('stream');
                    streamSelect.innerHTML = '<option value="">Select a stream</option>';
                    data.forEach(stream => {
                        let option = document.createElement('option');
                        option.value = stream.id;
                        option.textContent = stream.name;
                        streamSelect.appendChild(option);
                    });
                });
        }
    });

    // Autocomplete for student search
    document.getElementById('student_search').addEventListener('input', function() {
        let query = this.value;
        if (query.length > 1) { // Start searching after 2 characters
            fetch(`/admin/search-student?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    let studentList = document.getElementById('student_list');
                    studentList.innerHTML = ''; // Clear previous results
                    if (data.length > 0) {
                        studentList.style.display = 'block'; // Show the list
                        data.forEach(student => {
                            let li = document.createElement('li');
                            li.textContent = student.name;
                            li.style.padding = '8px';
                            li.style.cursor = 'pointer';
                            li.onclick = function() {
                                document.getElementById('student_search').value = student.name;
                                studentList.innerHTML = ''; // Clear list after selection
                                studentList.style.display = 'none'; // Hide the list
                            };
                            studentList.appendChild(li);
                        });
                    } else {
                        studentList.style.display = 'none'; // Hide the list if no results
                    }
                });
        } else {
            document.getElementById('student_list').innerHTML = ''; // Clear list if input is empty or too short
            document.getElementById('student_list').style.display = 'none'; // Hide the list
        }
    });
</script>

@endsection
