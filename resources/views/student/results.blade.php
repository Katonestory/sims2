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
        <span>@yield('page-title')</span>
        <span>@yield('breadcrumb')</span>
    </div>
</div>

<!-- Content section for Results -->
<div style="height: auto; background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
        Results
    </div>
    <div style="font-size: 14px; line-height: 1.6;">
        <p>Welcome to the Results page. Below are your latest exam results:</p>
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #3498db; color: white; text-align: left;">
                    <th style="padding: 8px; border: 1px solid #ddd;">Subject</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Score</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Grade</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Remarks</th>
                </tr>
            </thead>
            <tbody>
                <tr style="background-color: #ecf0f1;">
                    <td style="padding: 8px; border: 1px solid #ddd;">Mathematics</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">85%</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">A</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">Excellent</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd;">Science</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">78%</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">B+</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">Good</td>
                </tr>
                <tr style="background-color: #ecf0f1;">
                    <td style="padding: 8px; border: 1px solid #ddd;">History</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">92%</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">A+</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">Outstanding</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection