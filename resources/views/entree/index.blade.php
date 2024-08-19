<x-app-layout>
    <x-slot name="header">
        <div class="flex headline  flex-col md:flex-row md:justify-between md:items-center">

            <h1 class="text-3xl md:text-5xl py-4">{{ __('Gestion des Entrées') }}</h1>
            <form class="py-4" method="get" action="">
                <input
                    class="rounded-xl placeholder-emerald-500 ring ring-emerald-500 focus:ring focus:outline-none  focus:border-red-600 p-2 border-none shadow-inner shadow-black"
                    name="search" id="search" value="{{ $request->search ?? '' }}" placeholder="Recherche">
            </form>
            <div>
                <a id="add"
                    class="p-1 text-2xl text-white font-bold hover:shadow-sm hover:shadow-black focus:ring ring-emerald-500 transition-all duration-500 ring-offset-4 rounded bg-emerald-400 shadow-black shadow-inner"
                    href="{{ route('entree.create') }}">Ajouter</a>
            </div>
        </div>
    </x-slot>

    @if (session('success'))
        <div id="toast-success"
            class="  flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg dark:text-gray-400 dark:bg-gray-800 "
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


    <div class=" overflow-x-auto rounded-lg shadow-sm shadow-black">

        <table class="min-w-full leading-normal text-nowrap">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 text-md font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                        #
                    </th>
                    <th
                        class="px-5 py-3 text-md font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                        Magasin
                    </th>
                    <th
                        class="px-5 py-3 text-md font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                        Salle
                    </th>

                    <th
                        class="px-5 py-3 text-md font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                        Totale
                    </th>



                    <th colspan="3"
                        class="px-5 py-3 text-md font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($entrees as $entree)
                    <tr id="ligne-{{ $entree->id }}" class=" ">
                        <td class="px-5 py-3 text-md bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $entree->id }}</p>
                        </td>
                        <td class="px-5 py-3 text-md bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $entree->salle->magasin->name }}</p>
                        </td>
                        <td class="px-5 py-3 text-md bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $entree->salle->name }}</p>
                        </td>
                        <td class="px-5 py-3 text-md bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ number_format($entree->total , '0' , ',' , ' ')  }} FCFA</p>
                        </td>
                        <td class="px-5 py-3 text-md bg-white border-b border-gray-200">
                            <form method="post" action="{{ route('entree.detail', ['entree' => $entree]) }}">
                                @method('GET')
                                @csrf
                                <button type="submit"
                                    class="text-gray-900 p-2 bg-blue-500 focus:ring ring-blue-500 transition-shadow duration-500 ring-offset-4 hover:bg-blue-500/90 hover:shadow-xl shadow-inner shadow-black rounded whitespace-no-wrap">Details
                                </button>

                            </form>
                        </td>
                        <td class="px-5 py-3 text-md  bg-white border-b border-gray-200">
                            <form method="post" action="{{ route('entree.edit', ['entree' => $entree]) }}">
                                @method('GET')
                                @csrf
                                <button type="button" data-modal-target="crud-modal-{{ $entree->id }}"
                                    data-modal-toggle="crud-modal-{{ $entree->id }}"
                                    class="text-gray-900 p-2 bg-blue-500 focus:ring ring-blue-500 transition-shadow duration-500 ring-offset-4 hover:bg-blue-500/90 hover:shadow-xl shadow-inner shadow-black rounded whitespace-no-wrap">Modifier
                                </button>

                            </form>
                        </td>

                        <td class="px-5 py-3 text-md bg-white border-b border-gray-200">
                            <form id="supprimer-{{ $entree->id }}" method="post"
                                action="{{ route('entree.destroy', ['entree' => $entree]) }}">
                                @method('DELETE')
                                @csrf
                                <button data-modal-target="popup-modal-{{ $entree->id }}"
                                    data-modal-toggle="popup-modal-{{ $entree->id }}" type="button"
                                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-inner shadow-black dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-md px-4 py-2.5 text-center transition delay-150 duration-300 ease-in-out" >
                                    <svg class="w-8 h-5 text-white" aria-hidden="true"
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
                    <div id="crud-modal-{{ $entree->id }}" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white p-2 rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Modifier la salle de
                                        l'entrée </h4>

                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-md w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-toggle="crud-modal-{{ $entree->id }}">
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
                                <form method="POST" action="{{ route('entree.update', ['entree' => $entree]) }}"
                                    class="p-4 md:p-5">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-2">
                                            <label for="name"
                                                class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Magsin</label>
                                            <select
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                name="salle_id" id="equipement" autofocus>
                                                @foreach ($magasins as $magasin)
                                                    @foreach ($magasin->salles as $salle)
                                                        <option value="{{ $salle->id }}"
                                                            {{ $entree->salle->id == $salle->id ? 'selected' : '' }}>
                                                            @if (\PHPUnit\Framework\isEmpty($salle))
                                                                {{ $salle->magasin->name . ': ' . $salle->name }}
                                                            @else
                                                                pas de salle
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                @endforeach


                                            </select>
                                        </div>
                                        <input type="hidden" name="magasin_id"
                                            value="{{ $entree->salle->magasin->id }}">
                                    </div>
                                    <button type="submit"
                                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Moddier
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div id="popup-modal-{{ $entree->id }}" tabindex="-1"
                        class="hidden overflow-y-auto  overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-zinc-100 rounded-lg shadow dark:bg-gray-700">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-md w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="popup-modal-{{ $entree->id }}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Vous ête sûr
                                        de supprimer ce équipement ?</h3>
                                    <button id="{{ $entree->id }}"
                                        data-modal-hide="popup-modal-{{ $entree->id }}" type="button"
                                        class="text-white bg-red-600 confirm-delete hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-md inline-flex items-center px-5 py-2.5 text-center">
                                        Oui
                                    </button>
                                    <button data-modal-hide="popup-modal-{{ $entree->id }}" type="button"
                                        class="py-2.5 px-5 ms-3 text-md font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <div class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">
            {{ $entrees->links() }}
        </div>
    </div>

    <script>
        const success = document.getElementById('success')
        const add = document.getElementById('add')
        setTimeout(() => {
            success.setAttribute('hidden', 'hidden')
        }, 3000)


        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.confirm-delete');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('id');
                    const row = document.getElementById('ligne-' + id);
                    row.classList.add('animate__animated', 'animate__zoomOutLeft', 'animate__fast');
                    document.getElementById('supprimer-' + id).submit();
                });
            });
        });
    </script>


</x-app-layout>
