@extends('layouts.dashboard')

@section('title')
    {{ __('Edit Ticket') }}
@endsection

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-semibold mb-6">{{ __('Edit Ticket') }}</h1>

    <!-- Form to edit ticket -->
    <form method="POST" action="{{ route('tickets.update', $ticket->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium mb-2">{{ __('Title') }}</label>
            <input type="text" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" id="title" name="title" value="{{ $ticket->title }}" required>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">{{ __('Description') }}</label>
            <textarea class="form-control block w-full border border-gray-300 rounded-lg p-2.5" id="description" name="description" rows="3" required>{{ $ticket->description }}</textarea>
        </div>

        <!-- Category -->
        <div class="mb-4">
            <label for="category" class="block text-gray-700 font-medium mb-2">{{ __('Category') }}</label>
            <select class="form-control block w-full border border-gray-300 rounded-lg p-2.5" id="category" name="category" required>
                <option value="service" {{ $ticket->category == 'service' ? 'selected' : '' }}>{{ __('Asking for Service') }}</option>
                <option value="reclamation" {{ $ticket->category == 'reclamation' ? 'selected' : '' }}>{{ __('Making a Claim') }}</option>
            </select>
        </div>

        <!-- Priority -->
        <div class="mb-4">
            <label for="priority" class="block text-gray-700 font-medium mb-2">{{ __('Priority') }}</label>
            <select class="form-control block w-full border border-gray-300 rounded-lg p-2.5" id="priority" name="priority" required>
                <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>{{ __('Low') }}</option>
                <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>{{ __('Medium') }}</option>
                <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>{{ __('High') }}</option>
            </select>
        </div>

        @if(auth()->user()->role == 'supportagent' || auth()->user()->role == 'admin')
        <!-- State -->
        <div class="mb-4">
            <label for="state" class="block text-gray-700 font-medium mb-2">{{ __('State') }}</label>
            <select class="form-control block w-full border border-gray-300 rounded-lg p-2.5" id="state" name="state" required>
                <option value="Open" {{ $ticket->state == 'Open' ? 'selected' : '' }}>{{ __('Open') }}</option>
                <option value="In Progress" {{ $ticket->state == 'In Progress' ? 'selected' : '' }}>{{ __('In Progress') }}</option>
                <option value="Closed" {{ $ticket->state == 'Closed' ? 'selected' : '' }}>{{ __('Closed') }}</option>
                <option value="On Hold" {{ $ticket->state == 'On Hold' ? 'selected' : '' }}>{{ __('On Hold') }}</option>
            </select>
        </div>
        @endif

        <!-- Attachment -->
        <div class="mb-4">
            <label for="attachment" class="block text-gray-700 font-medium mb-2">{{ __('Attachment') }}</label>
            <input type="file" class="form-control block w-full border border-gray-300 rounded-lg p-2.5" id="attachment" name="attachment">
            @if($ticket->attachment)
                <div class="mt-2">
                    <p>{{ __('Current attachment:') }}</p>
                    <a href="{{ route('tickets.downloadAttachment', $ticket->id) }}" download class="text-blue-500 hover:underline">{{ __('Download Current Attachment') }}</a>
                </div>
            @endif
        </div>

        <!-- Update Button -->
        <button type="submit" style="background-color: #28a745;" class="btn btn-primary mt-4 px-6 py-3 text-white font-semibold rounded-lg shadow-lg hover:bg-green-700 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
            {{ __('Update') }}
        </button>
    </form>

    <!-- Delete Form -->
    <form method="POST" action="{{ route('tickets.destroy', $ticket->id) }}" onsubmit="return confirmDelete()" class="mt-6">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger px-6 py-3 text-white font-semibold bg-red-600 rounded-lg shadow-lg hover:bg-red-700 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
            {{ __('Delete') }}
        </button>
    </form>
</div>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this ticket?');
    }
</script>
@endsection
