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
<div style="height: auto; background-color: #f8f9fa; padding: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 22px; font-weight: bold; margin-bottom: 20px; text-align: center;">
        @if(isset($results) && $results->isNotEmpty())
            Exam Results: {{ $results->first()->exam->title }}
        @else
            No Results Available
        @endif
    </div>

    <div style="font-size: 14px; line-height: 1.6;">
        @if(isset($results) && $results->isEmpty())
            <p>No results available at the moment. Please check back later.</p>
        @elseif(isset($results) && $results->isNotEmpty())
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr style="background-color: #3498db; color: white; text-align: left;">
                        <th style="padding: 10px; border: 1px solid #ddd;">Subject</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Score</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Grade</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                        <tr style="{{ $loop->index % 2 == 0 ? 'background-color: #ecf0f1;' : '' }}">
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $result->exam->subject->name }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $result->score }}%</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $result->grade }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $result->remarks ?? 'No remarks' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Add a button for downloading the results -->
            <div style="margin-top: 20px; text-align: center;">
                <a href="{{ route('student.downloadResults', $results->first()->student_id) }}" style="padding: 10px 20px; background-color: #3498db; color: white; text-decoration: none; border-radius: 5px;">Download Results</a>
            </div>
        @endif
    </div>
</div>





@endsection
