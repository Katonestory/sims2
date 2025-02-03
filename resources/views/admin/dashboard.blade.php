@extends('layouts.dashboard')

@section('content')
    <!-- Login Info Section -->
    <div
        style="height: 3cm; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: center; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
        <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
            <span>Logged in as: <span style="color: blue;">{{ auth()->user()->name }}</span></span>
            <span>Academic Year: <span style="color: blue;">{{ now()->year }}</span></span>
            <span style="color: blue;">{{ \Carbon\Carbon::now()->format('l, jS F Y') }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; font-size: 14px;">
            <span>@yield('page-title')</span>
            <span>@yield('breadcrumb')</span>
        </div>
    </div>

    <!-- Announcements Section -->
    <div style="background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
        <div
            style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
            Announcements
        </div>
        @if (isset($announcements) && $announcements->count() > 0)
            <div style="font-size: 14px; line-height: 1.6;">
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
            </div>
        @else
            <div style="font-size: 14px; line-height: 1.6;">
                <p>No announcements yet. Stay tuned for updates from the admin.</p>
            </div>
        @endif
    </div>

    <!-- Cards Section -->
    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 20px;">

        <!-- Departments Card -->
        @isset($departments)
            <div
                style="flex: 0 0 20%; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <h4>Departments ({{ $departments->count() }})</h4>
                <ul>
                    @foreach ($departments as $department)
                        <li>{{ $department->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endisset

        <!-- Classes and Streams Card -->
        @isset($classes)
            <div
                style="flex: 0 0 30%; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <h4>Classes and Streams ({{ $classes->count() }})</h4>
                <ul>
                    @foreach ($classes as $class)
                        <li>
                            {{ $class->name }}
                            <ul>
                                @foreach ($class->streams as $stream)
                                    <li>
                                        Stream: {{ $stream->name }}
                                        (Teacher: {{ $stream->teacher->first_name ?? 'N/A' }}
                                        {{ $stream->teacher->surname ?? '' }})
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
                <!-- Pagination links for classes -->
                @if ($classes instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {{ $classes->links() }}
                @endif
            </div>
        @endisset

        <!-- Subjects Card -->
        @isset($subjects)
            <div
                style="flex: 1; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <h4>Subjects ({{ $subjects->count() }})</h4>
                <ul>
                    @foreach ($subjects as $subject)
                        <li>{{ $subject->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endisset

        <!-- Exams Card -->
        @isset($exams)
            <div
                style="flex: 1; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <h4>Exams ({{ $exams->count() }})</h4>
                <ul>
                    @foreach ($exams as $exam)
                        <li>{{ $exam->title }} - {{ \Carbon\Carbon::parse($exam->exam_date)->format('jS F Y') }}</li>
                    @endforeach
                </ul>
            </div>
        @endisset
    </div>

    <!-- Teachers Table -->
    @isset($teachers)
        <div
            style="flex: 1; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <h4>Teachers ({{ $teachers->count() }})</h4>
            <input type="text" placeholder="Search teachers..." id="teacherSearch"
                style="margin-bottom: 10px; padding: 5px; width: 100%;">
            <ul> </ul>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;" id="teachersList">
                <thead>
                    <tr style="background-color: #f8f9fa;">
                        <th style="padding: 10px; border: 1px solid #ddd;">First Name</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Middle Name</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Surname</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">DoB</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Gender</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Phone Number</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Email</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Hire Date</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $teacher->first_name }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $teacher->middle_name }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $teacher->surname }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $teacher->DoB }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $teacher->gender }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $teacher->phone_number }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $teacher->email }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $teacher->hireDate }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $teacher->address }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination links for teachers -->
            @if ($teachers instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $teachers->links() }}
            @endif
        </div>
    @endisset

    <!-- Students Table -->
    @isset($students)
        <div
            style="flex: 1; margin-top:10px; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <h4>Students ({{ $students->count() }})</h4>
            <input type="text" placeholder="Search students..." id="studentSearch"
                style="margin-bottom: 10px; padding: 5px; width: 100%;">
            <ul id="studentsList"> </ul>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f8f9fa;">
                        <th style="padding: 10px; border: 1px solid #ddd;">First Name</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Middle Name</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Surname</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">DoB</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Gender</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Student ID</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Email</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Contact</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Class</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Stream</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $student->first_name }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $student->middle_name }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $student->surname }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $student->DoB }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $student->gender }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $student->student_id }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $student->email }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $student->phone_number }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $student->class->name }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $student->stream->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $students->links() }}
        </div>
    @endisset
    <script>
        const studentSearch = document.getElementById('studentSearch');
        const studentsList = document.getElementById('studentsList');

        studentSearch.addEventListener('input', function() {
            const query = studentSearch.value;

            // Send AJAX request to the search route
            fetch(`/admin/search-students?query=${encodeURIComponent(query)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(students => {
                    // Clear the current list
                    studentsList.innerHTML = '';

                    // Populate the list with new results
                    if (students.length === 2) {
                        studentsList.innerHTML = '<li>No students found</li>';
                    } else {
                        students.forEach(student => {
                            const li = document.createElement('li');
                            li.textContent =
                                `${student.first_name} ${student.middle_name} ${student.surname}`;
                            studentsList.appendChild(li);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching students:', error);
                });
        });
    </script>
    <script>
        $(document).ready(function()) {
            $('#teacherSearch').on('keyup', function() {
                const query = $(this).val();

                $.ajax({
                    url: "{{ route('admin.teachers.search') }}",
                    method: "GET",
                    data: {
                        query: query
                    },
                    success: function(response) {
                        $('#teachersList tbody').html(response);
                    }
                });
            });
        };
    </script>
@endsection
