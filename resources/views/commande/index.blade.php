<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:gap-10 md:items-center">
            <h1 class="text-3xl md:text-5xl py-4 ">{{ __('Gestion des commandes') }}</h1>
            <form class="py-4" method="get" action="">
                <input
                    class="rounded-xl placeholder-emerald-500 ring ring-emerald-500 focus:ring focus:outline-none focus:border-red-600 p-2 border-none shadow-sm shadow-black"
                    name="search" id="search" value="{{ $request->search ?? '' }}" placeholder="Recherche">
            </form>

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




    <div class=" overflow-x-auto rounded-lg shadow-md shadow-black/90">

        <table class="min-w-full leading-normal text-nowrap">
            <thead>
                <tr>


                    <th
                        class="px-5  py-4 text-xs font-bold tracking-wider text-center text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                        Numéro Devis
                    </th>

                    <th
                        class="px-5  py-4 text-xs font-bold tracking-wider text-center text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                        Client
                    </th>
                    <th
                        class="px-5 py-4 text-xs font-bold tracking-wider text-center text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                        Totale
                    </th>

                    <th
                        class="px-5 py-4 text-xs font-bold tracking-wider text-center text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                        Date de creation
                    </th>

                    <th
                        class="px-5 py-4 text-xs font-bold tracking-wider text-center text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                        Statut
                    </th>

                    <th
                        class="px-5 py-4 text-xs font-bold tracking-wider text-center text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                        Actions
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                    <tr class="" id="ligne-{{ $commande->id }}" class="">
                        <td class="px-5 py-4 text-md text-center bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $commande->devis ? $commande->devis->id : 'DEVIS INTROUVABLE' }}</p>
                        </td>

                        <td class="px-5 py-4 text-md bg-white border-b border-gray-200">
                            <p class="text-gray-900 text-center whitespace-no-wrap">
                        {{ $commande->devis?->client ? $commande->devis?->client->name . ' ' . $commande->devis?->client->firstname : 'CLIENT INTROUVABLE' }} </p>
                        </td>
                        <td class="px-5 py-4 text-md text-center bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ number_format($commande->total , 0, ',', ' ') }}</p>
                        </td>
                        <td class="px-5 py-4 text-md text-center bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $commande->created_at }}</p>
                        </td>
                        <td class="px-5 py-4 text-md text-center bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $commande->statut }}</p>

                        </td>

                        <td class="px-5 flex justify-center py-4 text-md bg-white border-b border-gray-200">
                            <button id="dropdownMenuIconButton-{{ $commande->id }}"
                                data-dropdown-toggle="dropdownDots-{{ $commande->id }}"
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

                    <div id="dropdownDots-{{ $commande->id }}" tabindex="-1"
                        class="z-10 hidden bg-gray-200 divide-y divide-gray-300 rounded-lg shadow    dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-md text-gray-700 dark:text-gray-200 "
                            aria-labelledby="dropdownMenuIconButton">

                            <li>
                                <form id="payement-{{ $commande->id }}" method="get"
                                    action="{{ route('commande.items', ['commande' => $commande]) }}">

                                    @csrf
                                    <button
                                         type="submit"
                                        class="block w-full text-start px-4 py-2 text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Détails
                                    </button>
                                </form>
                            </li>
                            @if (!$commande->facture)
                            <li>
                                <form id="payement-{{ $commande->id }}" method="post"
                                    action="{{ route('facture.store', ['commande' => $commande]) }}">

                                    @csrf
                                    <button
                                         type="submit"
                                        class="block w-full text-start px-4 py-2 text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Faire la facture
                                    </button>
                                </form>
                            </li>

                            @endif

                            <li>
                                <form id="payement-{{ $commande->id }}" method="get"
                                    action="{{ route('commande.livraison', ['commande' => $commande]) }}">
                                    @csrf
                                    <button

                                         type="submit"
                                        class="block w-full text-start px-4 py-2 text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Faire un bordereaux de livraison
                                    </button>
                                </form>
                            </li>

                            <li>
                                <form id="payement-{{ $commande->id }}" method="get"
                                    action="{{ route('voir.livraison', ['commande' => $livraison = $commande]) }}">
                                    @csrf
                                    <button

                                        type="submit"
                                        class="block w-full text-start px-4 py-2 text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Voir le bordereaux
                                    </button>
                                </form>
                            </li>





                            <li>
                                <form id="annuler-{{ $commande->id }}" method="post"
                                    action="{{ route('commande.annuler', ['commande' => $commande]) }}">
                                    @method('POST')
                                    @csrf
                                    <button data-modal-target="popup-modal-annuler-{{ $commande->id }}"
                                        data-modal-toggle="popup-modal-annuler-{{ $commande->id }}" type="button"
                                        class="block w-full {{ $commande->statut == 'Annulée' ? 'hidden' : '' }} text-start px-4 py-2 text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-id="{{ $commande->id }}">
                                        Annuler
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form id="supprimer-{{ $commande->id }}" method="post"
                                    action="{{ route('commande.destroy', ['commande' => $commande]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button data-modal-target="popup-modal-{{ $commande->id }}"
                                        data-modal-toggle="popup-modal-{{ $commande->id }}" type="button"
                                        class="block w-full text-start px-4 py-2 text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-id="{{ $commande->id }}">
                                        Supprimer
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>


                    <div id="popup-modal-annuler-{{ $commande->id }}" tabindex="-1"
                        class="hidden overflow-y-auto  overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-zinc-100 rounded-lg shadow dark:bg-gray-700">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-md w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="popup-modal-annuler-{{ $commande->id }}">
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
                                    <button id="{{ $commande->id }}"
                                        data-modal-hide="popup-modal-annuler-{{ $commande->id }}" type="submit"
                                        form="annuler-{{ $commande->id }}"
                                        class="text-white bg-red-600 confirm-delete hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-md inline-flex items-center px-5 py-2.5 text-center">
                                        Oui
                                    </button>
                                    <button data-modal-hide="popup-modal-annuler-{{ $commande->id }}" type="button"
                                        class="py-2.5 px-5 ms-3 text-md font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="popup-modal-{{ $commande->id }}" tabindex="-1"
                        class="hidden overflow-y-auto  overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-zinc-100 rounded-lg shadow dark:bg-gray-700">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-md w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="popup-modal-{{ $commande->id }}">
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
                                    <button id="{{ $commande->id }}"
                                        data-modal-hide="popup-modal-{{ $commande->id }}" type="submit"
                                        form="supprimer-{{ $commande->id }}"
                                        class="text-white bg-red-600 confirm-delete hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-md inline-flex items-center px-5 py-2.5 text-center">
                                        Oui
                                    </button>
                                    <button data-modal-hide="popup-modal-{{ $commande->id }}" type="button"
                                        class="py-2.5 px-5 ms-3 text-md font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        const success = document.getElementById('success')
        const add = document.getElementById('add')
        setTimeout(() => {
            success.setAttribute('hidden', 'hidden')
        }, 3000)


        /*         document.addEventListener('DOMContentLoaded', function() {
                    const buttons = document.querySelectorAll('.confirm-delete');
                    buttons.forEach(button => {
                        button.addEventListener('click', function() {
                            const id = this.getAttribute('id');
                            const row = document.getElementById('ligne-' + id);
                            row.classList.add('animate__animated', 'animate__zoomOutLeft', 'animate__fast');
                            document.getElementById('supprimer-' + id).submit();
                        });
                    });
                }) */
        ;
    </script>





</x-app-layout>
