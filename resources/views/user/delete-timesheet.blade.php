@extends('layouts.authenticated-user')
@section('header-title')
    <div>Delete Timesheet</div>
@endsection
@section('content')
    <div class="flex flex-col justify-center items-center space-x-4 space-y-4 mx-auto">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium"> {{ session('success') }}</span>
            </div>
        @endif
        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">Error(s)!</span> Change a few things up and try submitting again.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="space-y-6 w-full md:w-1/2" action="{{ route('user.timesheet.delete.store', $timesheet->id) }}"
            method="POST">
            @method('delete')
            @csrf
            <div>
                <div class="flex items-center justify-between">
                    <label for="total_minutes" class="block text-sm font-medium leading-6 text-gray-900">Project
                        Name</label>
                </div>
                <div class="mt-2">
                    <input type="text" id="disabled-input" aria-label="disabled input"
                        value="{{ $timesheet->projectUser->project->project_name }}"
                        class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="Disabled input" disabled>

                </div>
            </div>
            <div>
                <div class="flex items-center justify-between">
                    <label for="total_minutes" class="block text-sm font-medium leading-6 text-gray-900">Date</label>
                </div>
                <div class="mt-2">
                    <input type="text" id="disabled-input" aria-label="disabled input" value="{{ $timesheet->date }}"
                        class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="Disabled input" disabled>

                </div>
            </div>
            <div>
                <div class="flex items-center justify-between">
                    <label for="total_minutes" class="block text-sm font-medium leading-6 text-gray-900">Duration</label>
                </div>
                <div class="mt-2">
                    <input type="text" id="disabled-input" aria-label="disabled input" value="{{ $timesheet->duration }}"
                        class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="Disabled input" disabled>

                </div>
            </div>
            <div>
                <div class="flex items-center justify-between">
                    <label for="summary_of_work" class="block text-sm font-medium leading-6 text-gray-900">Summary</label>
                </div>
                <div class="mt-2">
                    <textarea id="summary_of_work" name="summary_of_work" rows="10" disabled
                        class="bg-gray-100 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-2">{{ $timesheet->summary_of_work }} </textarea>
                </div>
            </div>

            <div class="flex flex-row justify-end space-x-4">
                <a type="button" href="{{ route('user.timesheet') }}"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Cancel</a>
                <button type="submit"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Delete</button>
            </div>
        </form>
    </div>
@stop
