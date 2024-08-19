<x-app-layout>
    <x-slot name="header">
        <span class=" animate__animated animate__bounce text-5xl"
            id="title">{{ __('Gestion des utilisateurs ') }}</span>
    </x-slot>

    <div class="mb-4 inline-flex overflow-hidden w-full bg-white rounded-lg shadow-md">
        <div class="flex justify-center items-center w-12 bg-blue-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
                </path>
            </svg>
        </div>
    </div>

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow-xl">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-500 border-b-2 border-gray-200">
                        Name
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-500 border-b-2 border-gray-200">
                        Email
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-500 border-b-2 border-gray-200">
                        Statut
                    </th>
                    <th colspan="2"
                        class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-500 border-b-2 border-gray-200">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @php/** @var \App\Models\User $user */@endphp
                    <tr>
                        <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $user->name }}</p>
                        </td>
                        <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $user->email }}</p>
                        </td>
                        <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap"><span
                                    class="{{ $user->status == true ? ' shadow-lg shadow-green-500/50 flex w-4 h-4 me-3 bg-gradient-to-r from-green-400 via-green-500 to-green-600  rounded-full' : 'flex w-4 h-4 me-3 bg-gradient-to-r from-red-400 via-red-500 to-red-600 shadow-lg shadow-red-500/50 rounded-full' }}"></span>
                            </p>
                        </td>

                        <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                            <form method="post" action="#">
                                @method('DELETE')
                                @csrf
                                <button id="supprimer-{{ $user->id }}" type="submit"
                                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-4 py-2.5 text-center transition delay-150 duration-300 ease-in-out">
                                    <svg class="w-4 h-4 text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">
            {{ $users->links() }}
        </div>
    </div>

    <script>
        const btn = document.getElementById("title")
        setInterval(() => {
            btn.classList.add('animate-pulse')
            setTimeout(() => {
                btn.classList.remove('animate-pulse')
            }, 1700);
        }, 5000);
    </script>


</x-app-layout>
