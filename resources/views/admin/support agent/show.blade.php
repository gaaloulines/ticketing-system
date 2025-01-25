@extends('layouts.dashboard')

@section('title')
    {{ __('View Support Agent') }}
@endsection

@section('content')


    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-6">{{ __('View Support Agent') }}</h1>

        <!-- Support Agent Details -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">{{ __('Name') }}</label>
            <input type="text" id="name" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" value="{{ $agent->name }}" disabled>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">{{ __('Email') }}</label>
            <input type="text" id="email" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" value="{{ $agent->email }}" disabled>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-gray-700 font-medium mb-2">{{ __('Role') }}</label>
            <input type="text" id="role" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" value="{{ $agent->role }}" disabled>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex space-x-4">
            <a href="{{ route('admin.support_agents.edit', $agent->id) }}" style="display: inline-block; padding: 10px 20px; font-size: 16px; color: #ffffff; background-color: #ffc107; border-radius: 5px; text-decoration: none; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: background-color 0.3s ease;">
                {{ __('Edit') }}
            </a>

            <form action="{{ route('admin.support_agents.destroy', $agent->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
                @csrf
                @method('DELETE')
                <button type="submit" style="padding: 10px 20px; font-size: 16px; color: #ffffff; background-color: #dc3545; border: none; border-radius: 5px; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: background-color 0.3s ease;">
                    {{ __('Delete') }}
                </button>
            </form>

            <a href="{{ route('admin.dashboard') }}" style="display: inline-block; padding: 10px 20px; font-size: 16px; color: #ffffff; background-color: #6c757d; border-radius: 5px; text-decoration: none; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: background-color 0.3s ease;">
                {{ __('Back to Dashboard') }}
            </a>
        </div>

    </div>

@section('scripts')
    <script type="text/javascript">
        function confirmDelete() {
            return confirm("Are you sure you want to delete this support agent?");
        }
    </script>
@endsection
@endsection
