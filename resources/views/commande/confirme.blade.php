<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <h1 class="text-3xl md:text-5xl py-4">{{ __('Confirmation de commande') }}</h1>
            <div class="flex justify-end gap-4">
                <button form="confirmCommande" type="submit" class="p-1  text-2xl text-white font-bold hover:shadow-sm hover:shadow-black focus:ring ring-emerald-500 transition-all duration-500 ring-offset-4 rounded bg-emerald-400 shadow-black shadow-inner">Confirmer</button>
                <form method="post" action="{{ route('commande.retour' , ['commande' => $commande]) }}">
                    @csrf
                    <button class="p-1  text-2xl text-black font-bold hover:shadow-sm hover:shadow-black focus:ring ring-emerald-500 transition-all duration-500 ring-offset-4 rounded bg-white shadow-black shadow-inner">Retour</button>
                </form>

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

    @if (session('error'))
    <div id="toast-success"
        class="flex items-center w-full max-w-auto p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
        role="alert">
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-md font-bold">{{ session('error') }}.</div>
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

    <div class="relative overflow-x-auto rounded-lg shadow-sm shadow-black">

        <table class="min-w-full leading-normal text-nowrap">
            <thead>
                <tr>
                    <th class="px-5 hidden py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">ID</th>

                    <th class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">Nom équipement</th>
                    <th class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">Type</th>
                    <th class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">Prix de vente</th>
                    <th class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">Quantité</th>
                    <th class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">Salle</th>
                </tr>
            </thead>
            <tbody>
                <form id="confirmCommande" action="{{ route('commande.store') }}" method="post">
                    @csrf
                    <input type="text" class="hidden" name="client_id" value="{{ $commande->client_id }}">
                    <input type="text" class="hidden" name="devis_id" value="{{ $commande->id }}">


                    @php
                        $i = 0
                    @endphp

                    @foreach ($commande->devisItems as $item)



                        <tr class=" ">
                            <td class="px-2 hidden py-3 text-sm bg-white border-b border-gray-200">
                                <input onblur="this.readOnly = true" ondblclick="this.readOnly = false" readonly id="name" class="border-none focus:outline-none focus:ring-0" type="text" name="id" value="{{ $item->id }}">
                            </td>

                            <td class="px-2 py-3 text-sm bg-white border-b border-gray-200">
                                <input onblur="this.readOnly = true" ondblclick="this.readOnly = false" readonly id="name" class="border-none focus:outline-none focus:ring-0" type="text" name="item[{{ $i }}][name] " value="{{ $item->name}}">
                            </td>

                            <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                                <input ondblclick="this.readOnly = false" onblur="this.readOnly = true" readonly class="border-none focus:outline-none focus:ring-0" type="text" name="item[{{ $i }}][type]" value="{{ $item->type }}">
                            </td>

                            <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                                <input onblur="this.readOnly = true" ondblclick="this.readOnly = false" readonly type="text" name="item[{{ $i }}][VPrice]" value="{{ $item->VPrice }}" class="border-none focus:outline-none focus:ring-0">
                            </td>

                            <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                                <input ondblclick="this.readOnly = false" onblur="this.readOnly = true" readonly type="text" name="item[{{ $i }}][quantite]" value="{{ $item->quantite }}" class="border-none focus:outline-none focus:ring-0">
                            </td>

                            <td class="px-5 py-3 hidden text-sm bg-white border-b border-gray-200">
                                <input ondblclick="this.readOnly = false" onblur="this.readOnly = true" readonly type="text" name="item[{{ $i }}][equipement_id]" value="{{ $item->equipement_id }}" class="border-none  focus:outline-none focus:ring-0">
                            </td>

                            <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                                <input list="equipements" onblur="this.readOnly = true" ondblclick="this.readOnly = false" readonly type="text" value="{{ $item->item_id }}" name="item[{{ $i }}][item_id]" class="border-none focus:outline-none focus:ring-0">
                                <datalist id="equipements">
                                    @foreach ($equipements as $equipement)
                                        @foreach ($equipement->items as $items)
                                            <option {{ $equipement->id == $item->equipement_id ? 'selected' : '' }} value="{{ $items->id }}">
                                                {{ $equipement->name . ' | Numéro entrée : ' . $items->entree_id . ' | Stock : ' . $items->quantite }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </datalist>
                            </td>
                        </tr>
                        @php
                            $i++
                        @endphp
                    @endforeach
                </form>
            </tbody>
        </table>
    </div>

    <script>
        const success = document.getElementById('success');
        const add = document.getElementById('add');
        setTimeout(() => {
            success.setAttribute('hidden', 'hidden');
        }, 3000);

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
