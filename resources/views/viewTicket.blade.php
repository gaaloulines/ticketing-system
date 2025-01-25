@extends('layouts.dashboard')

@section('title')
    {{ __('View Ticket') }}
@endsection

@section('content')

    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-6">{{ __('View Ticket') }}</h1>

        <!-- Ticket Details -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium mb-2">{{ __('Title') }}</label>
            <input type="text" id="title" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" value="{{ $ticket->title }}" disabled>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">{{ __('Description') }}</label>
            <textarea id="description" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" rows="3" disabled>{{ $ticket->description }}</textarea>
        </div>

        <div class="mb-4">
            <label for="category" class="block text-gray-700 font-medium mb-2">{{ __('Category') }}</label>
            <input type="text" id="category" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" value="{{ $ticket->category }}" disabled>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-medium mb-2">{{ __('Status') }}</label>
            <input type="text" id="status" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" value="{{ $ticket->state }}" disabled>
        </div>

        <div class="mb-4">
            <label for="priority" class="block text-gray-700 font-medium mb-2">{{ __('Priority') }}</label>
            <input type="text" id="priority" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" value="{{ $ticket->priority }}" disabled>
        </div>

        <div class="mb-4">
            <label for="created_at" class="block text-gray-700 font-medium mb-2">{{ __('Created At') }}</label>
            <input type="text" id="created_at" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" value="{{ $ticket->created_at }}" disabled>
        </div>

        <div class="mb-4">
            <label for="updated_at" class="block text-gray-700 font-medium mb-2">{{ __('Updated At') }}</label>
            <input type="text" id="updated_at" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" value="{{ $ticket->updated_at }}" disabled>
        </div>

        @if($ticket->attachment)
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">{{ __('Attachment') }}</label>
                <a href="{{ route('tickets.downloadAttachment', $ticket->id) }}" class="text-blue-600 hover:underline">{{ __('Download Attachment') }}</a>
            </div>
        @endif

        @if(auth()->user()->role === 'supportagent' || auth()->user()->role === 'admin')
            <div class="mb-4">
                <label for="assigned_to" class="block text-gray-700 font-medium mb-2">{{ __('Assigned To') }}</label>
                <input type="text" id="assigned_to" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" value="{{ $ticket->user->email }}" disabled>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="mt-6 flex space-x-4">
            <a href="{{ route('tickets.edit', $ticket->id) }}" style="display: inline-block; padding: 10px 20px; font-size: 16px; color: #ffffff; background-color: #ffc107; border-radius: 5px; text-decoration: none; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: background-color 0.3s ease;">
                {{ __('Edit') }}
            </a>

            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
                @csrf
                @method('DELETE')
                <button type="submit" style="padding: 10px 20px; font-size: 16px; color: #ffffff; background-color: #dc3545; border: none; border-radius: 5px; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: background-color 0.3s ease;">
                    {{ __('Delete') }}
                </button>
            </form>

            <a href="{{ route('dashboard') }}" style="display: inline-block; padding: 10px 20px; font-size: 16px; color: #ffffff; background-color: #6c757d; border-radius: 5px; text-decoration: none; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: background-color 0.3s ease;">
                {{ __('Back to Dashboard') }}
            </a>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        function confirmDelete() {
            return confirm("Are you sure you want to delete this ticket?");
        }
    </script>
@endsection
