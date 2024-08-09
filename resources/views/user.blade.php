<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Flash Messages -->
            @if (session('success'))
                <div id="flash-message" class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div id="flash-message" class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold mb-4">My Details</h2>

                    <div class="mb-4">
                        <strong>ID:</strong> {{ $user->id }}
                    </div>
                    <div class="mb-4">
                        <strong>Name:</strong> {{ $user->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Email:</strong> {{ $user->email }}
                    </div>
                    <div class="mb-4">
                        <strong>Role:</strong> {{ $user->role == 1 ? 'Admin' : 'User' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
