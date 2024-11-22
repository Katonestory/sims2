@extends('student.dashboard')
@section('content')
   <!-- Header displaying login info and date -->
   <div style="height: 3cm; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: center; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
        <span>Logged in as: <span style="color: blue;">{{ auth()->user()->name }}</span></span>
        <span>Academic Year: 2024/2025</span>
        <span style="color: blue;">{{ \Carbon\Carbon::now()->format('l, jS F Y') }}</span>
    </div>
    <div style="display: flex; justify-content: space-between; font-size: 14px;">
        <span>Change Password</span>
    </div>
</div>

<!-- Content section for Change Password -->
<div style="height: auto; background-color: #f8f9fa; padding: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
        Change Password
    </div>

    @if(session('status'))
        <div style="background-color: #28a745; color: white; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background-color: #dc3545; color: white; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('student.update-password') }}" method="POST">
        @csrf

        <div style="margin-bottom: 20px;">
            <label for="current_password" style="font-size: 14px; font-weight: bold;">Current Password</label>
           <p> <input type="password" id="current_password" name="current_password" class="form-control" style="width: 50%; padding: 8px; margin-top: 5px;" required></p>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="new_password" style="font-size: 14px; font-weight: bold;">New Password</label>
          <p>  <input type="password" id="new_password" name="new_password" class="form-control" style="width:50%; padding: 8px; margin-top: 5px;" required></p>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="new_password_confirmation" style="font-size: 14px; font-weight: bold;">Confirm New Password</label>
           <p> <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" style="width: 50%; padding: 8px; margin-top: 5px;" required></p>
        </div>

        <div>
            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; background-color: #3498db; border: none; color: white; font-size: 16px;">Update Password</button>
        </div>
    </form>
</div>
@endsection
