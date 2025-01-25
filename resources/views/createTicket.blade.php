@extends('layouts.dashboard')

@section('title')
    {{ __('Create A New Ticket') }}
@endsection

@section('content')
<div class="container mx-auto p-4 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-semibold mb-4">{{ __('Create A New Ticket') }}</h1>
    <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="form-label block text-gray-700 font-medium mb-2">{{ __('Title') }}</label>
            <input type="text" id="title" name="title" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" required>
        </div>
        <div class="mb-4">
            <label for="description" class="form-label block text-gray-700 font-medium mb-2">{{ __('Description') }}</label>
            <textarea id="description" name="description" rows="3" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" required></textarea>
        </div>
        <div class="mb-4">
            <label for="category" class="form-label block text-gray-700 font-medium mb-2">{{ __('Category') }}</label>
            <select id="category" name="category" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" required>
                <option value="service">{{ __('Asking for Service') }}</option>
                <option value="reclamation">{{ __('Making a Claim') }}</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="priority" class="form-label block text-gray-700 font-medium mb-2">{{ __('Priority') }}</label>
            <select id="priority" name="priority" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" required>
                <option value="low">{{ __('Low') }}</option>
                <option value="medium">{{ __('Medium') }}</option>
                <option value="high">{{ __('High') }}</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="attachment" class="form-label block text-gray-700 font-medium mb-2">{{ __('Attachment') }}</label>
            <input type="file" id="attachment" name="attachment" class="form-control block w-full border border-gray-300 rounded-lg p-2.5">
        </div>
        <button type="submit" style="background-color: #28a745; color: #ffffff;" class="btn btn-primary mt-4 px-6 py-3 font-semibold rounded-lg shadow-lg hover:bg-green-700 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
            {{ __('Create') }}
        </button>
    </form>
</div>
@endsection
