@extends('layouts.dashboard')

@section('title')
    {{ __('Client Dashboard') }}
@endsection

@section('content')
    <style>
        .card {
            width: 100%;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            font-size: 1.5rem;
            font-weight: bold;
            border-bottom: 1px solid #e9ecef;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
            padding: 0.75rem;
        }

        .table thead th {
            background-color: #343a40;
            color: white;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1.125rem;
            border-radius: 0.375rem;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 0.25rem;
            color: #fff;
            transition: background-color 0.3s ease;
            text-decoration: none;
            cursor: pointer;
        }

        .view-button {
            background-color: #2d3748;
        }

        .view-button:hover {
            background-color: #1a202c;
        }

        .edit-button {
            background-color: #2d3748;
        }

        .edit-button:hover {
            background-color: #1a202c;
        }

        .delete-button {
            background-color: #e3342f;
        }

        .delete-button:hover {
            background-color: #cc1f1a;
        }

        .mdi {
            font-size: 1rem;
            margin-right: 0.25rem;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            border-radius: 0.375rem;
            padding: 0.75rem 1.5rem;
            font-size: 1.125rem;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .form-inline {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }
    </style>

    <div class="mb-4 text-center">
        <a href="{{ route('tickets.create') }}" class="btn btn-success btn-lg">
            {{ __('Create New Ticket') }}
        </a>
    </div>

    <div class="card">
        <div class="card-header">{{ __('Your Tickets') }}</div>
        <div class="card-body">
            @if($tickets->isEmpty())
                <p class="text-center">{{ __('You have no tickets.') }}</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Ticket ID') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Updated At') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Priority') }}</th>
                                <th>{{ __('Attachment') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->id }}</td>
                                    <td>
                                        <i class="mdi mdi-ticket-outline mdi-20px text-danger me-3"></i>
                                        <span class="fw-medium">{{ $ticket->title }}</span>
                                    </td>
                                    <td class="text-wrap">{{ $ticket->description }}</td>
                                    <td>{{ $ticket->category }}</td>
                                    <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $ticket->updated_at->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-label-{{ $ticket->state == 'Open' ? 'primary' : ($ticket->state == 'In Progress' ? 'info' : ($ticket->state == 'Closed' ? 'success' : 'warning')) }} me-1">
                                            {{ $ticket->state }}
                                        </span>
                                    </td>
                                    <td>{{ ucfirst($ticket->priority) }}</td>
                                    <td>
                                        @if($ticket->attachment)
                                            <a href="{{ Storage::url($ticket->attachment) }}" target="_blank">{{ __('View Attachment') }}</a>
                                        @else
                                            {{ __('No Attachment') }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('tickets.show', $ticket->id) }}" class="action-button view-button">
                                                <i class="mdi mdi-eye"></i> View
                                            </a>
                                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="action-button edit-button">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-button delete-button">
                                                    <i class="mdi mdi-delete"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
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
