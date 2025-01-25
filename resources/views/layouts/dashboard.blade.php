<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @yield('title')
        </h2>
    </x-slot>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="sidebar">
            @yield('sidebar')
        </div>

        <!-- Main content -->
        <div class="flex-1">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>

            <!-- Main content area -->
            <main class="p-6 space-y-6">
                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
</x-app-layout>
