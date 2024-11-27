@extends('admin.dashboard')
@section('content')
<div style="height: 3cm; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: center; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
        <span>Logged in as: <span style="color: blue;">{{ auth()->user()->name }}</span></span>
        <span>Academic Year: 2024/2025</span>
        <span style="color: blue;">{{ \Carbon\Carbon::now()->format('l, jS F Y') }}</span>
    </div>
    <div style="display: flex; justify-content: space-between; font-size: 14px;">
        <span>Upload Announcement</span>
    </div>
</div>
 <!-- Success Message -->
 @if (session('success'))
 <div style="background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px;">
     {{ session('success') }}
 </div>
@endif

<!-- Error Message -->
@if ($errors->any())
 <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 20px;">
     <ul>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </ul>
 </div>
@endif
<!-- Content section for Uploading Announcements -->
<div style="height: auto; background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
        Upload Announcement
    </div>
    <div style="font-size: 14px; line-height: 1.6;">
        <form action="{{ route('admin.upload-announcement') }}" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="announcement-title" style="font-weight: bold;">Announcement Title:</label>
                <p><input type="text" id="announcement-title" name="title" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="announcement-message" style="font-weight: bold;">Message:</label>
                <textarea id="announcement-message" name="message" required></textarea>
            </div>

            <!-- Include CKEditor -->
            <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('announcement-message', {
                    toolbar: [
                        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript'] },
                        { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                        { name: 'links', items: ['Link', 'Unlink'] },
                        { name: 'insert', items: ['Image', 'Table', 'HorizontalRule'] },
                        { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
                        { name: 'colors', items: ['TextColor', 'BGColor'] },
                        { name: 'tools', items: ['Maximize'] }
                    ],
                    height: 300
                });
            </script>

            <div style="margin-bottom: 15px;">
                <label for="announcement-start-date" style="font-weight: bold;">Start Date:</label>
                <p><input type="date" id="announcement-start-date" name="startDate" required style="width: 20%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="announcement-end-date" style="font-weight: bold;">End Date:</label>
                <p><input type="date" id="announcement-end-date" name="endDate" required style="width: 20%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <button type="submit" style="background-color: #007bff; color: white; padding: 10px 15px; border: none; cursor: pointer; margin-top: 10px;">
                Upload
            </button>
        </form>
    </div>
</div>
@endsection
