<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <div class="mt-6">
                        @if (auth()->user()->role === 'admin')
                            <x-responsive-nav-link :active="request()->routeIs('admtickets.index')" href="{{ route('admtickets.index') }}">
                                Manage Tickets
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :active="request()->routeIs('users.index')" href="{{ route('users.index') }}">
                                Manage Users
                            </x-responsive-nav-link>
                        @else
                            <x-responsive-nav-link :active="request()->routeIs('usrtickets.index')" href="{{ route('usrtickets.index') }}">
                                Go to My Tickets
                            </x-responsive-nav-link>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
