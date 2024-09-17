<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h1 class="text-5xl">{{ __('Liste des Salles ')}}</h1>
        </div>
    </x-slot>
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
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-lg w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Vous ête sûr de supprimer cette salle ?</h3>
                    <button data-modal-hide="popup-modal" type="submit" form="supprimer" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-lg inline-flex items-center px-5 py-2.5 text-center">
                        Oui
                    </button>
                    <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-lg font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow shadow-black">
        @if(!($salles->isEmpty()))
            <table class="min-w-full leading-normal">
                <thead>
                <tr>
                    <th class="px-5 py-3 text-lg font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-500 border-b-2 border-gray-200">Nom</th>
                    <th class="px-5 py-3 text-lg font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-500 border-b-2 border-gray-200">Magasin</th>
                    <th colspan="3" class="px-5 py-3 text-lg font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-500 border-b-2 border-gray-200"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($salles as $salle)
                    <tr>
                        <td class="px-5 py-3 text-lg bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $salle->name }}</p>
                        </td>
                        <td class="px-5 py-3 text-lg bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $salle->magasin->name }}</p>
                        </td>

                        <td class="px-5 py-3 text-lg bg-white border-b border-gray-200">
                            <form id="supprimer" method="POST" action="{{ route('salle.destroy', ['salle' => $salle]) }}">
                                @method('DELETE')
                                @csrf
                                <button  data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-lg px-4 py-2.5 text-center transition delay-150 duration-300 ease-in-out">Supprimer</button>
                            </form>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>


        <div class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">
        </div>
        @else
            <div class="flex justify-center items-center bg-white h-4/6">
                <h1 class="text-4xl text-center font-bold italic py-5 text-black">Pas de salle associer !</h1>
            </div>

        @endif
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
