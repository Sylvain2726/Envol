<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center ">
            <h1 class="text-3xl md:text-5xl py-4">{{ __('Gestion des Magasins') }}</h1>
            <form class="py-4" method="get" action="">
                <input
                    class="rounded-xl placeholder-emerald-500 ring ring-emerald-500 focus:ring focus:outline-none  focus:border-red-600 p-2 border-none shadow-sm shadow-black"
                    name="search" id="search" value="{{ $request->search ?? '' }}" placeholder="Recherche">

            </form>
            <div class="flex justify-end">
                <a id="add"
                    class="p-1 text-2xl text-white font-bold hover:shadow-xl focus:ring ring-emerald-500 transition-all duration-500 ring-offset-4 rounded bg-emerald-400 shadow-black shadow-inner"
                    href="{{ route('magasin.create') }}">Ajouter</a>
            </div>
        </div>
    </x-slot>

    @if (session('success'))
        <div id="toast-success"
            class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
            role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-md font-bold">{{ session('success') }}.</div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    @if (session('supprimer'))
        <div id="toast-success"
            class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
            role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-md font-bold">{{ session('supprimer') }}.</div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    <div id="popup-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-zinc-100 rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Vous ête sûr de supprimer ce
                        magasin</h3>
                    <button data-modal-hide="popup-modal" type="submit" form="supprimer"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-4 py-2.5 text-center">
                        Oui
                    </button>
                    <button data-modal-hide="popup-modal" type="button"
                        class="py-2.5 px-4 ms-3 md:text-lg text-md font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                </div>
            </div>
        </div>
    </div>


    <div class=" overflow-x-auto rounded-lg shadow shadow-black">
        <table class="min-w-full text-nowrap leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-4 py-3 text-md font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-500 border-b-2 border-gray-200">
                        Nom</th>
                    <th
                        class="px-4 py-3 text-md font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-500 border-b-2 border-gray-200">
                        Localité</th>
                    <th
                        class="px-4 py-3 text-md font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-500 border-b-2 border-gray-200">
                        Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($magasins as $magasin)
                    <tr>
                        <td class="px-4 py-3 md:text-lg text-md bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $magasin->name }}</p>
                        </td>
                        <td class="px-4 py-3 md:text-lg text-md bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $magasin->address }}</p>
                        </td>

                        <td class=" py-4 text-md bg-white border-b border-gray-200">
                            <button id="dropdownMenuIconButton-{{ $magasin->id }}"
                                data-dropdown-toggle="dropdownDots-{{ $magasin->id }}"
                                class="inline-flex items-center p-2 text-md font-extrabold text-center transition-all duration-700 text-black bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                type="button">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 4 15">
                                    <path
                                        d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                </svg>
                            </button>

                        </td>
                    </tr>

                    <div id="dropdownDots-{{ $magasin->id }}" tabindex="-1"
                        class="z-10 hidden bg-gray-200 divide-y divide-gray-300 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-md text-gray-700 dark:text-gray-200 "
                            aria-labelledby="dropdownMenuIconButton">
                            <li>
                                <form method="GET" action="{{ route('salle.liste', ['magasin' => $magasin]) }}">
                                    @csrf
                                    <button type="submit"
                                        class="block px-4 w-full font-semibold text-left py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Voir
                                        les salles</button>
                                </form>
                            </li>
                            <li>
                                <form method="GET" action="{{ route('magasin.edit', ['magasin' => $magasin]) }}">
                                    @csrf
                                    <button type="submit"
                                        class="block px-4 w-full font-semibold text-left py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Modifier</button>
                                </form>
                            </li>

                            <li>
                                <button data-modal-target="crud-modal-{{ $magasin->id }}"
                                    data-modal-toggle="crud-modal-{{ $magasin->id }}"
                                    class="block px-4 w-full font-semibold text-left py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Ajouter
                                    une salle</button>
                            </li>
                            <li>
                                <form id="supprimer" method="POST"
                                    action="{{ route('magasin.destroy', ['magasin' => $magasin]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                        type="button"
                                        class="block  px-4 w-full font-semibold text-left py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Supprimer
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </div>

                    <!-- Main modal -->
                    <div id="crud-modal-{{ $magasin->id }}" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto k overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-xl  max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white shadow-sm shadow-black p-2 rounded-lg  dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        Création d'une nouvelle salle pour le magasin {{ $magasin->name }}
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-toggle="crud-modal-{{ $magasin->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form method="POST" action="{{ route('salle.store') }}" class="p-4 md:p-5">
                                    @csrf
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-2">
                                            <label for="name"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                            <input type="text" name="name" id="name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Nom de la salle" required>
                                        </div>
                                        <input type="hidden" name="magasin_id" value="{{ $magasin->id }}">
                                    </div>
                                    <button type="submit"
                                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Ajouter une salle
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        <div class="flex flex-col items-center px-4 py-5 bg-white border-t xs:flex-row xs:justify-between">
            {{ $magasins->links() }}
        </div>
    </div>

    <script>
        const success = document.getElementById('success');
        if (success) {
            setTimeout(() => {
                success.setAttribute('hidden', 'hidden');
            }, 3000);
        }
    </script>
</x-app-layout>
