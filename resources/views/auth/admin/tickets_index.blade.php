

@extends('layouts.dashboard')

@section('title')
    {{ __('All Tickets') }}
@endsection

@section('content')
    <style>
        .card {
            width: 100%;
        }

        .table th, .table td {
            width: calc(100% / 10);
        }

        .text-wrap {
            white-space: normal;
        }

        .btn-lg {
            padding: 1rem 2rem;
            font-size: 1.25rem;
        }

        .card-header {
            font-size: 1.5rem;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table thead th {
            background-color: #343a40;
            color: white;
        }

        .text-center {
            text-align: center;
        }
    </style>

    <div class="card">
        <div class="card-header bg-primary text-white">{{ __('All Tickets') }}</div>
        <div class="card-body">
            <div class="mb-4">
                <form action="{{ route('tickets.index') }}" method="GET" class="form-inline">
                    <label for="sort" class="mr-2">{{ __('Sort By:') }}</label>
                    <select name="sort" id="sort" class="form-control mr-2">
                        <option value="priority" {{ request('sort') == 'priority' ? 'selected' : '' }}>{{ __('Priority') }}</option>
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>{{ __('Date Created') }}</option>
                        <option value="state" {{ request('sort') == 'state' ? 'selected' : '' }}>{{ __('Status') }}</option>
                    </select>
                    <select name="order" id="order" class="form-control mr-2">
                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>{{ __('Ascending') }}</option>
                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>{{ __('Descending') }}</option>
                    </select>
                    <button type="submit" class="btn btn-primary">{{ __('Sort') }}</button>
                </form>
                <a href="{{ route('tickets.create') }}" class="btn btn-success btn-lg mt-3">{{ __('Create New Ticket') }}</a>
            </div>
            @if($tickets->isEmpty())
                <p class="text-center">{{ __('No tickets found.') }}</p>
            @else
                <div class="table-responsive text-nowrap">
                    <table class="table w-100" style="table-layout: fixed;">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('Ticket ID') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Updated At') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Priority') }}</th>
                                <th>{{ __('Assigned To') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->id }}</td>
                                    <td><i class="mdi mdi-ticket-outline mdi-20px text-danger me-3"></i><span class="fw-medium">{{ $ticket->title }}</span></td>
                                    <td class="text-wrap">{{ $ticket->description }}</td>
                                    <td>{{ $ticket->category }}</td>
                                    <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $ticket->updated_at->format('d/m/Y') }}</td>
                                    <td>
                                        <form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="state" class="form-control form-control-sm" onchange="this.form.submit()">
                                                <option value="Open" {{ $ticket->state == 'Open' ? 'selected' : '' }}>Open</option>
                                                <option value="In Progress" {{ $ticket->state == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="Closed" {{ $ticket->state == 'Closed' ? 'selected' : '' }}>Closed</option>
                                                <option value="On Hold" {{ $ticket->state == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>{{ $ticket->priority }}</td>
                                    <td>{{ $ticket->user->email }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('tickets.show', $ticket->id) }}"><i class="mdi mdi-eye-outline me-1"></i> View</a>
                                                <a class="dropdown-item" href="{{ route('tickets.edit', $ticket->id) }}"><i class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                                                <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit"><i class="mdi mdi-trash-can-outline me-1"></i> Delete</button>
                                                </form>
                                            </div>
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

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this ticket?');
        }
    </script>
@endsection
