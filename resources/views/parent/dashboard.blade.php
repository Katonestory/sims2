@extends('layouts.dashboard')

@section('content')
    <div
        style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center;">
        <div style="background: white; padding: 20px; border-radius: 10px; text-align: center; width: 300px;">
            <h3>Select a Student</h3>

            @foreach ($students as $student)
                <form method="POST" action="{{ route('parent.selectStudent') }}">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <button type="submit"
                        style="display: block; width: 100%; margin: 10px 0; padding: 10px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        {{ $student->first_name }} {{ $student->surname }}
                    </button>
                </form>
            @endforeach
        </div>
    </div>
@endsection
