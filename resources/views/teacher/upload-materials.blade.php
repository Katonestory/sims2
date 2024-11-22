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

<!-- Content section for Uploading Materials -->
<div style="height: auto; background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
        Upload Materials
    </div>
    <div style="font-size: 14px; line-height: 1.6;">
        <form action="{{ route('teacher.upload-materials') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="material-title" style="font-weight: bold;">Material Title:</label>
                <p><input type="text" id="material-title" name="title" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="material-file" style="font-weight: bold;">Upload File:</label>
                <input type="file" id="material-file" name="file" required style="width: 18%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;">
            </div>
            <button type="submit" style="background-color: #007bff; color: white; padding: 10px 15px; border: none; cursor: pointer; margin-top: 10px;">
                Upload
            </button>
        </form>
    </div>
</div>
@endsection
