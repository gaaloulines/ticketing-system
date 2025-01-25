@extends('layouts.dashboard')

@section('title', 'Manage Support Agents')

@section('sidebar')
<nav class="flex flex-col space-y-4">
    <a href="{{ route('admin.tickets.index') }}" class="block bg-blue-500 text-black px-4 py-3 rounded-lg text-sm font-medium hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out">
        {{ __('Manage Tickets') }}
    </a>
    <a href="{{ route('admin.support-agents.index') }}" class="block bg-green-500 text-black px-4 py-3 rounded-lg text-sm font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-300 ease-in-out">
        {{ __('Manage Support Agents') }}
    </a>
</nav>
@endsection

@section('content')
    <style>


    .sidebar {
        width: 16rem;
        background-color: #f5f5f5; /* Off-white background */
        color: #333; /* Dark text color for contrast */
        border-right: 1px solid #e0e0e0; /* Light border color */
        padding: 1rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        height: 100vh;
        overflow-y: auto;
        transition: width 0.3s ease;
    }

    .sidebar:hover {
        width: 18rem; /* Expand on hover */
    }

    .sidebar h2 {
        font-size: 1.25rem;
        color: #333; /* Darker header color */
        margin-bottom: 1.5rem;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: #333; /* Dark text color */
        font-weight: 500;
        border-radius: 0.375rem;
        transition: background-color 0.3s ease, color 0.3s ease;
        text-decoration: none; /* Remove underline */
    }

    .sidebar a:hover {
        background-color: #e0e0e0; /* Light grey background on hover */
        color: #000; /* Darker text on hover */
    }

    .sidebar a.active {
        background-color: #b0bec5; /* Highlight active link with a subtle color */
        color: #000; /* Darker text for active link */
    }

    .sidebar .icon {
        margin-right: 0.75rem; /* Space between icon and text */
        font-size: 1.25rem; /* Larger icons */
    }

    .sidebar .menu-item {
        margin-bottom: 1rem; /* Space between items */
    }


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

        .table {
            width: 100%;
            border-collapse: collapse;
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
        <a href="{{ route('admin.support-agents.create') }}" class="btn btn-success btn-lg">
            {{ __('Add New Support Agent') }}
        </a>
    </div>

    <div class="card">
        <div class="card-header">{{ __('All Support Agents') }}</div>
        <div class="card-body">
            @if($agents->isEmpty())
                <p class="text-center">{{ __('No support agents found.') }}</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Agent ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agents as $agent)
                                <tr>
                                    <td>{{ $agent->id }}</td>
                                    <td>{{ $agent->name }}</td>
                                    <td>{{ $agent->email }}</td>
                                    <td>{{ $agent->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.support-agents.show', $agent->id) }}" class="action-button view-button">
                                                <i class="mdi mdi-eye"></i> View
                                            </a>
                                            <a href="{{ route('admin.support-agents.edit', $agent->id) }}" class="action-button edit-button">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.support-agents.destroy', $agent->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
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
                <div class="mt-4">
                    {{ $agents->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function confirmDelete() {
            return confirm("Are you sure you want to delete this support agent?");
        }
    </script>
@endsection

