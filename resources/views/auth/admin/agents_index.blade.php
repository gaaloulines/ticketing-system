

@extends('layouts.dashboard')

@section('title')
    {{ __('Manage Support Agents') }}
@endsection

@section('content')
    <style>
        .card {
            width: 100%;
        }

        .table th, .table td {
            width: calc(100% / 4);
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
        <div class="card-header bg-primary text-white">{{ __('Support Agents') }}</div>
        <div class="card-body">
            <div class="mb-4">
                <a href="{{ route('agents.create') }}" class="btn btn-success btn-lg mt-3">{{ __('Create New Agent') }}</a>
            </div>
            @if($agents->isEmpty())
                <p class="text-center">{{ __('No agents found.') }}</p>
            @else
                <div class="table-responsive text-nowrap">
                    <table class="table w-100" style="table-layout: fixed;">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($agents as $agent)
                                <tr>
                                    <td>{{ $agent->name }}</td>
                                    <td>{{ $agent->email }}</td>
                                    <td>{{ $agent->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('agents.show', $agent->id) }}"><i class="mdi mdi-eye-outline me-1"></i> View</a>
                                                <a class="dropdown-item" href="{{ route('agents.edit', $agent->id) }}"><i class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                                                <form action="{{ route('agents.destroy', $agent->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit"><i class="mdi mdi-trash-can-outline me-1"></i
