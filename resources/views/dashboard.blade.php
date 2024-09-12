<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    















    {{--     <div class="bg-white overflow-hidden shadow-sm shadow-black sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">
            Bienvenu {{Auth::user()->name}}
        </div>
    </div> --}}

    {{--     <div id="alert-3"
        class="flex items-center p-5 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 animate__animated animate__fadeInUpBig "
        role="alert">

        <span class="sr-only">Info</span>
        <div class="ms-3 text-3xl font-medium  ">
            Bienvenu {{ Auth::user()->name }}
        </div>
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
            data-dismiss-target="#alert-3" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div> --}}
</x-app-layout>
