
<div class="shadow shadow-black">


<header class="flex justify-between items-center py-4 px-6 m-1 ms-0 rounded-lg shadow-sm shadow-black/70 bg-white">
    <div class="flex justify-between items-center">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>


    <div class="flex items-center ">


        <x-dropdown>

            <x-slot name="trigger">

                <button @click="dropdownOpen = ! dropdownOpen" class="relative block hover:scale-105 focus:scale-105 overflow-hidden">
                    <div class="flex justify-center items-center">
                        <div class="relative me-4">
                            <img class="w-7 h-7  rounded-full" src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="profile image">
                            <span class="top-0 start-7 absolute w-3.5 h-3.5 bg-green-500 border-2 border-white dark:border-gray-800 rounded-full"></span>
                        </div>
                        <div>
                            {{ Auth::user()->name }}
                            <svg class="w-4 inline h-4 mx-2 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="m19 9-7 7-7-7"/>
                            </svg>
                        </div>





                    </div>

                </button>


            </x-slot>


            <x-slot name="content">
                <x-dropdown-link href="{{ route('profile.edit') }}">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Deconnection') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</header>
</div>
