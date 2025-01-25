@extends('layouts.dashboard')

@section('title')
    {{ __('Edit Support Agent') }}
@endsection

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-semibold mb-6">{{ __('Edit Support Agent') }}</h1>

    <!-- Form to edit support agent -->
    <form action="{{ route('admin.support_agents.update', $supportAgent->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" value="{{ $supportAgent->name }}" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" value="{{ $supportAgent->email }}" required>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-medium mb-2">{{ __('Password (leave blank to keep current password)') }}</label>
            <input type="password" name="password" id="password" class="form-control block w-full border border-gray-300 rounded-lg p-2.5">
        </div>

        <!-- Password Confirmation -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">{{ __('Confirm Password') }}</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control block w-full border border-gray-300 rounded-lg p-2.5">
        </div>

        <!-- Submit Button -->
        <button type="submit" style="background-color: #28a745;" class="btn btn-primary mt-4 px-6 py-3 text-white font-semibold rounded-lg shadow-lg hover:bg-green-700 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
            {{ __('Update') }}
        </button>
    </form>

    <!-- Delete Form -->
    <form method="POST" action="{{ route('admin.support_agents.destroy', $supportAgent->id) }}" onsubmit="return confirmDelete()" class="mt-6">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger px-6 py-3 text-white font-semibold bg-red-600 rounded-lg shadow-lg hover:bg-red-700 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
            {{ __('Delete') }}
        </button>
    </form>
</div>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this support agent?');
    }
</script>
@endsection
