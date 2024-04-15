@extends('layouts.public')
@section('content')
    <div class="flex flex-row justify-center items-center space-x-4">

        <div>
            <a class="hover:text-blue-500 cursor-pointer" href="{{ route('user.login') }}">User Login</a>
        </div>
    </div>
@stop
