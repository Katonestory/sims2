@extends('admin.dashboard')

@section('content')
<div style="height: 3cm; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: center; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
        <span>Logged in as: <span style="color: blue;">{{ auth()->user()->name }}</span></span>
        <span>Academic Year: 2024/2025</span>
        <span style="color: blue;">{{ \Carbon\Carbon::now()->format('l, jS F Y') }}</span>
    </div>
    <div style="display: flex; justify-content: space-between; font-size: 14px;">
        <span>Assign Class Teacher</span>
        <span>Admin > Assign Class Teacher</span>
    </div>
</div>

<div style="max-width: 800px; margin-left: 0px; padding: 20px; background-color: #f8f9fa; border-radius: 10px;">
    <h2>Assign Class Teacher</h2>
    <br>

    <div id="message" style="color: green; font-weight: bold;">
        @if (session('success'))
            {{ session('success') }}
        @endif
    </div>

    <form action="{{ route('admin.storeAssignClassTeacher') }}" method="POST">
        @csrf

        <!-- Select Class -->
        <div style="margin-bottom: 15px;">
            <label for="class_id" style="font-weight: bold;">Select Class:</label>
            <select id="class_id" name="class_id" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" required>
                <option value="">Select a class</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Select Stream (Dynamically populated) -->
        <div style="margin-bottom: 15px;">
            <label for="stream_id" style="font-weight: bold;">Select Stream:</label>
            <select id="stream_id" name="stream_id" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" required>
                <option value="">Select a stream</option>
            </select>
        </div>

        <!-- Select Class Teacher -->
        <div style="margin-bottom: 15px;">
            <label for="teacher_id" style="font-weight: bold;">Class Teacher:</label>
            <select id="teacher_id" name="teacher_id" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" required>
                <option value="">Select Teacher</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->surname }}</option>
                @endforeach
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" style="width: 100%; padding: 10px; background-color: #007bff; border: none; border-radius: 5px; color: white;">
            Assign Teacher
        </button>
    </form>
</div>

<script>
    // Fetch streams based on selected class
    document.getElementById('class_id').addEventListener('change', function() {
        const classId = this.value;

        if (classId) {
            fetch(`{{ route('admin.getStreamsByClass') }}?class_id=${classId}`)
                .then(response => response.json())
                .then(data => {
                    const streamSelect = document.getElementById('stream_id');
                    streamSelect.innerHTML = '<option value="">Select Stream</option>';
                    data.forEach(stream => {
                        const option = document.createElement('option');
                        option.value = stream.id;
                        option.textContent = stream.name;
                        streamSelect.appendChild(option);
                    });
                });
        } else {
            document.getElementById('stream_id').innerHTML = '<option value="">Select Stream</option>';
        }
    });
</script>
@endsection
