@extends('layouts.dashboard')

@section('title')
    {{ __('Create Support Agent') }}
@endsection

@section('content')
<div class="container mx-auto p-4 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-semibold mb-4">{{ __('Create Support Agent') }}</h1>
    <form action="{{ route('admin.support_agents.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="form-label block text-gray-700 font-medium mb-2">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" required>
        </div>
        <div class="mb-4">
            <label for="email" class="form-label block text-gray-700 font-medium mb-2">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" required>
        </div>
        <div class="mb-4">
            <label for="password" class="form-label block text-gray-700 font-medium mb-2">{{ __('Password') }}</label>
            <input type="password" name="password" id="password" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" required>
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="form-label block text-gray-700 font-medium mb-2">{{ __('Confirm Password') }}</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" required>
        </div>
        <button type="submit" style="background-color: #28a745;" class="btn btn-primary mt-4 px-6 py-3 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-700 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
    {{ __('Create') }}
</button>
    </form>
</div>
@endsection
