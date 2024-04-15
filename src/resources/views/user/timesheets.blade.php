@extends('layouts.authenticated-user')
@section('header-title')
    <div>Timesheet</div>
@endsection
@section('content')
    <div class="flex flex-col justify-center items-center space-x-4 space-y-4   mx-auto" relative overflow-x-auto>
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium"> {{ session('success') }}</span>
            </div>
        @endif
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Date Submission
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Project
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total Hours / Minutes
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Summary
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($timesheets as $timesheet)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $timesheet->created_at }}
                        </th>
                        <th scope="row" class="px-6 py-4"">
                            {{ $timesheet->date }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $timesheet->projectUser->project->project_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $timesheet->duration }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $timesheet->summary_of_work }}
                        </td>
                        <td scope="col" class="px-6 py-3">
                            <a class="text-blue-500" href="{{ route('user.timesheet.edit', $timesheet->id) }}">Edit</a>
                            <a class="text-red-500" href="{{ route('user.timesheet.delete', $timesheet->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center space-x-4">
            {!! $timesheets->links() !!}
        </div>
    </div>
@stop
