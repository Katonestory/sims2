@extends('teacher.dashboard')
@section('content')
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

<div style="height: auto; background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
        Upload Assignment
    </div>
    <div style="font-size: 14px; line-height: 1.6;">
        @if(session('success'))
            <div style="color: green; font-size: 16px; margin-bottom: 20px;">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div style="color: red; font-size: 16px; margin-bottom: 20px;">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div style="color: red; font-size: 14px; margin-bottom: 20px;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('assignments.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title" style="font-weight: bold;">Title:</label>
               <p> <input type="text" name="title" id="title" required style="width: 50%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"></p>
            </div>

            <div class="form-group">
                <label for="class_id" style="font-weight: bold;">Class:</label>
                <p><select name="class_id" id="class_id" required style="width: 50%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select></p>
            </div>

            <div class="form-group">
                <label for="subject_id" style="font-weight: bold;">Subject:</label>
                <p><select name="subject_id" id="subject_id" required style="width: 50%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select></p>
            </div>

            <div class="form-group">
                <label for="description" style="font-weight: bold;">Description:</label>
                <p><textarea name="description" id="description" rows="3" style="width: 50%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" placeholder="Enter a brief description (optional)"></textarea></p>
            </div>

            <div class="form-group">
                <label for="filpath" style="font-weight: bold;">Upload File:</label>
               <p> <input type="file" name="filepath" id="filepath" required style="width: 50%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"></p>
            </div>

            <div class="form-group">
                <label for="dueDate" style="font-weight: bold;">Due Date:</label>
                <p><input type="date" name="dueDate" id="dueDate" required style="width: 50%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"></p>
            </div>

            <p>
                <button type="submit" style="background-color: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; font-size: 16px; cursor: pointer;">Upload Assignment</button>
            </p>
        </form>
    </div>
</div>

@endsection
