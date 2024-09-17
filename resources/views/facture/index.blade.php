<x-app-layout>

    <style>
        .label-container {
            position: fixed;
            bottom: 48px;
            right: 105px;
            display: table;
            visibility: hidden;
        }

        .label-text {
            color: #FFF;
            background: rgba(51, 51, 51, 0.5);
            display: table-cell;
            vertical-align: middle;
            padding: 5px;
            border-radius: 3px;
            font-size: 20px
        }

        .label-arrow {
            display: table-cell;
            vertical-align: middle;
            color: #333;
            opacity: 0.5;
        }

        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 20px;
            right: 30px;
            opacity: 0.7;
            background-color: rgb(0, 204, 153);
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            box-shadow: 5px 5px 5px #131615;
        }

        .my-float {
            font-size: 24px;
            margin-top: 18px;
        }

        a.float+div.label-container {
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.5s ease;
        }

        a.float:hover+div.label-container {
            visibility: visible;
            opacity: 1;
        }
    </style>


    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:gap-40 md:items-center">
            <h1 class="text-3xl md:text-5xl py-4">{{ __(' Factures') }}</h1>
            <form class="py-4 " method="get" action="">
                <input
                    class="rounded-xl placeholder-emerald-500 ring ring-emerald-500 focus:ring focus:outline-none  p-2 border-none shadow-inner shadow-gray-950"
                    name="search" id="search" value="{{ $request->search ?? '' }}" placeholder="Recherche">
            </form>
            {{--             <div>
                <a id="add"
                    class="p-1 text-2xl text-white font-bold hover:shadow-xl focus:ring ring-emerald-500 transition-all duration-500 ring-offset-4 rounded bg-emerald-400 shadow-black shadow-inner"
                    href="{{ route('facture.create') }}">Ajouter</a>
            </div> --}}

            <a href="#" class="float flex justify-center hover:scale-105">

                <svg class="w-6 h-6 text-white font-extrabold fa fa-plus my-float" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>

            </a>
            <div class="label-container">
                <div class="label-text">Ajouter</div>
                <i class="fa fa-play label-arrow"></i>
            </div>
        </div>
    </x-slot>
    @if (session('error'))
    <div id="toast-success"
        class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-red-200 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
        role="alert">
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
              </svg>

            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-md font-bold">{{ session('error') }}.</div>
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5  text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
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

    <div class=" overflow-x-auto rounded-lg shadow-md shadow-black">
        <table class="min-w-full leading-normal text-nowrap">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                        Num Commande
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                        Num Facture
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                        Client
                    </th>
                        <th
                            class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                            Montant Total
                        </th>

                        <th
                            class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                            Montant Payé
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                            Montant Restant
                        </th>

                    <th
                        class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($factures as $facture)
                    <tr id="ligne-{{ $facture->commande_id }}">
                        <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $facture->commande_id }}</p>
                        </td>
                        <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $facture->numFacture }}</p>
                        </td>
                        <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $facture->commande?->devis?->client?->firstname }}</p>
                        </td>
                        <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $facture->commande?->total }}</p>
                        </td>
                        <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $facture->montantPaye }}</p>
                        </td>
                        <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $facture->montantRestant }}</p>
                        </td>


                        <td class="px-5 py-4 text-md bg-white border-b border-gray-200">
                            <button id="dropdownMenuIconButton-{{ $facture->id }}"
                                data-dropdown-toggle="dropdownDots-{{ $facture->id }}"
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

                    <div id="dropdownDots-{{ $facture->id }}" tabindex="-1"
                        class="z-10 hidden bg-gray-200 divide-y divide-gray-300 rounded-lg shadow-md shadow-black w-48 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-md text-gray-700 dark:text-gray-200 "
                            aria-labelledby="dropdownMenuIconButton">


                            <li>
                                <form method="GET" action="{{ route('facture.generer' , $facture) }}">
                                    @csrf
                                    <button type="submit"
                                        class="block px-4 w-full font-semibold text-left py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Génerer la facture</button>
                                </form>
                            </li>
                            
                            <li>
                                <form method="GET" action="{{ route('facture.payements' , $facture) }}" >
                                    @csrf
                                    <button type="submit"
                                        class="block px-4 w-full font-semibold text-left py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Paiements</button>
                                </form>
                            </li>

                            <li>
                                <form method="GET">
                                    @csrf
                                    <button type="submit"
                                        class="block px-4 w-full font-semibold text-left py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Annuler</button>
                                </form>
                            </li>

                            <li>
                                <form id="supprimer-{{ $facture->id }}" method="post" action="{{ route('facture.destroy' , $facture) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button data-modal-target="popup-modal-{{ $facture->id }}"
                                        data-modal-toggle="popup-modal-{{ $facture->id }}" type="button"
                                        class="block px-4 w-full  text-red-500 font-semibold text-left py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Supprimer
                                    </button>
                                </form>
                            </li>



                        </ul>
                    </div>
                    <div id="popup-modal-{{ $facture->id }}" tabindex="-1"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-zinc-100 rounded-lg shadow dark:bg-gray-700">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="popup-modal-{{ $facture->id }}">
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
                                        de supprimer cet équipement ?</h3>
                                    <button id="{{ $facture->id }}"
                                        type="submit" form="supprimer-{{ $facture->id }}"
                                        class="confirm-delete text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Oui
                                    </button>
                                    <button data-modal-hide="popup-modal-{{ $facture->id }}" type="button"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        <div class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.confirm-delete');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('id');
                    const row = document.getElementById('ligne-' + id);
                    row.classList.add('animate__animated', 'animate__fadeOutLeft', 'animate__fast');
                    document.getElementById('supprimer-' + id).submit();
                });
            });
        });
    </script>
</x-app-layout>
