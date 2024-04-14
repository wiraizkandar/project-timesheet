@extends('layouts.authenticated-user')
@section('header-title')
    <div>Timesheet</div>
@endsection
@section('content')
    <div class="flex flex-col justify-center items-center space-x-4 space-y-4   mx-auto" relative overflow-x-auto>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
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
                            {{ $timesheet->date }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $timesheet->projectUser->project->project_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $timesheet->total_minutes }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $timesheet->summary_of_work }}
                        </td>
                        <td scope="col" class="px-6 py-3">
                            <a>Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {!! $timesheets->links() !!}
        </div>
    </div>
@stop
