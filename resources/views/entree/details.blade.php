<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center">

            <h1 class="text-3xl md:text-5xl py-4">{{ __('Details de l\'entée')}}</h1>
        </div>

    </x-slot>

    @if(session('echec'))

        <div class="flex items-center w-full max-w-lg p-4 mb-4 text-gray-500 bg-white rounded-lg shadow shadow-black dark:text-gray-400 dark:bg-gray-800" >
            {{session('echec')}}
        </div>

    @endif

    @if(session('success'))
        <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-md font-bold">{{session('success')}}.</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-zinc-100 rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Vous ête sûr de supprimer ce équipement ?</h3>
                    <button data-modal-hide="popup-modal" type="submit" form="supprimer" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Oui
                    </button>
                    <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <div class="relative overflow-x-auto rounded-lg shadow-xl">

        <table class="min-w-full leading-normal text-nowrap">
            <thead>
            <tr>

                <th class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                    Equipement
                </th>
                <th class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                    Type Equipement
                </th>
                <th class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                    Quantite
                </th>

                <th class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                    Prix d'achat
                </th>

                <th class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                    Magasin
                </th>
                <th class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                    Total
                </th>

                <th colspan="2" class="px-5  py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">

                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)

                @php

                    $equipement = \App\Models\Equipement::query()->find($item->equipement_id) ?? null;
                    $message = null;
                    if ($equipement == null) {
                       session()->put('echec', 'Equipement introuvable');
                        continue;
                    }

                @endphp

                <tr>
                    <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                        <p class="text-gray-900 whitespace-no-wrap">{{$equipement->name}}</p>
                    </td>
                    <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                        <p class="text-gray-900 whitespace-no-wrap">{{$equipement->type}}</p>
                    </td>

                    <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $item->quantite}}</p>
                    </td>
                    <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                        <p class="text-gray-900 whitespace-no-wrap">{{$item->Aprice}}</p>
                    </td>
                    <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $item->salle?->magasin?->name. ' '. $item->salle?->name}}</p>
                    </td>
                    <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $item->Aprice * $item->quantite}}</p>
                    </td>

{{--                    <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">--}}
{{--                        <button data-modal-target="crud-modal-{{ $item->id }}" data-modal-toggle="crud-modal-{{ $magasin->id }}" class="text-gray-900 p-2 bg-zinc-300 focus:ring ring-zinc-300 transition-shadow duration-500 ring-offset-4 hover:bg-zinc-300/90 hover:shadow-xl shadow-inner shadow-black rounded text-nowrap whitespace-no-wrap"></button>--}}
{{--                    </td>--}}
                    <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                            <button data-modal-target="crud-modal-{{ $item->id }}" data-modal-toggle="crud-modal-{{ $item->id }}"   type="button" class="text-gray-900 p-2 bg-blue-500 focus:ring ring-blue-500 transition-shadow duration-500 ring-offset-4 hover:bg-blue-500/90 hover:shadow-xl shadow-inner shadow-black rounded whitespace-no-wrap">Modifier </button>
                    </td>

                    <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                        <form id="supprimer" method="POST" action="{{ route('item.destroy', ['item' => $item])}}" >

                            @csrf
                            <button   type="submit" class="text-gray-900 p-2 bg-red-500 focus:ring ring-red-500 transition-shadow duration-500 ring-offset-4 hover:bg-red-500/90 hover:shadow-xl shadow-inner shadow-black rounded whitespace-no-wrap">Supprimer</button>
                        </form>
                    </td>
                </tr>
                <!-- Main modal -->
                <div id="crud-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Modifier les détails de l'entrée
                                </h3>

                            </div>
                            <!-- Modal body -->
                            <form class="p-2 md:p-5" method="POST" action="{{ route('item.update', ['item' => $item])}}">
                                @csrf

                                <div class="m-2 hidden">
                                    <label class="block text-sm text-gray-700" for="id">
                                        ID
                                    </label>
                                    <input class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="text" name="id" id="id" value="{{$item->id}}" autofocus="autofocus">
                                </div>
                                <div class="m-2" >
                                    <label class="block text-sm text-gray-700" for="equipement">
                                        Nom de l'equipement
                                    </label>
                                    <select
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    name="salle_id" id="salle" autofocus>
                                    @foreach ($magasins as $magasin)
                                        @foreach ($magasin->salles as $salle)
                                            <option value="{{ $salle->id }}"
                                                >
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

                                <div class="m-2" >
                                    <label class="block text-sm text-gray-700" for="equipement">
                                        Equipement
                                    </label>
                                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" name="equipement_id" id="equipement" autofocus="">
                                        @foreach($equipements as $equipement)
                                            <option {{$item->equipement_id == $equipement->id ? 'selected' : ''}} value="{{$equipement->id}}">{{$equipement->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="m-2">
                                    <label class="block text-sm text-gray-700" for="Aprice">
                                        Prix de d'achat
                                    </label>
                                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="text" name="Aprice" id="Aprice" value="{{$item->Aprice}}" autofocus="autofocus">
                                </div>
                                <div class="m-2">
                                    <label class="block text-sm text-gray-700" for="quantite">
                                        Quantite
                                    </label>
                                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="number" name="quantite" id="quantite" value="{{$item->quantite}}" autofocus="autofocus">
                                </div>
                                <button type="submit" class="text-white m-2 inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Modifier
                                </button>
                            </form>
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
        setTimeout(()=>{
            success.setAttribute('hidden' , 'hidden')
        },3000)
    </script>
</x-app-layout>
