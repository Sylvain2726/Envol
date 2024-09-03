<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Envol Stock</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex justify-center">

    @if ($livraison)



    <div class="flex flex-col gap-5 bg-white justify-center mx-3 h-screen w-full ">
        <div class="flex justify-center">
            <h1 class="text-3xl font-semibold">Bordereaux de livraison N°{{ $livraison->numero }}</h1>
        </div>
        <div class="flex justify-center">
            <h1 class="text-3xl font-semibold">Numero de commande {{ $commande->id }}</h1>
        </div>
        <div class="flex justify-end items-center ">
            <div class="flex ">
                <button id="imprimer" onclick="imprimer()" type="button"
                    class="p-2 bg-emerald-400 rounded-lg shadow-sm shadow-black">Imprimer</button>
                <a id="retour" class="p-2 bg-white rounded-lg mx-4 shadow-sm shadow-black"
                    href="{{ url()->previous() }}">Retour
                </a>

                <form id="delete" method="post" action="{{ route('livraison.destroy', $livraison) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 bg-red-500 rounded-lg text-white shadow-sm shadow-black">Supprimer</button>
                </form>
            </div>
        </div>

        <div class="  overflow-x-auto    rounded-xl ">

            <table class="min-w-full text-center py-5   leading-normal text-nowrap">
                <thead>
                    <tr>

                        <th
                            class="  text-lg border-2 font-bold tracking-wider text-center text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-300">
                            Designation
                        </th>
                        <th
                            class="px-5 py-5 text-lg border-2 font-bold tracking-wider text-center text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-300">
                            Quantité
                        </th>

                        <th
                            class="px-5  text-lg border-2 font-bold tracking-wider text-center text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-300">
                            Magasin
                        </th>

                        <th
                            class="px-5  text-lg border-2  font-bold tracking-wider text-center text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-300">
                            Salle
                        </th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($commande->commandeItems as $item)
                        @php
                            $equipement = \App\Models\Equipement::find($item->equipement_id);

                        @endphp

                        <tr class="hover:bg-slate-600">

                            <td class="px-5  py-4 text-lg bg-white border-2 border-gray-300">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $equipement->name }}</p>
                                </p>
                            </td>
                            <td class="px-5 py-3 text-lg bg-white border-2 border-gray-300">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $item->quantite }}</p>
                            </td>
                            <td class="px-5 py-3 text-lg bg-white border-2 border-gray-300">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $item->item->salle->magasin?->name }}</p>
                            </td>

                            <td class="px-5 py-3 text-lg bg-white border-2  border-gray-300">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $item->item->salle->name }}</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    @else

    <div class="flex flex-col gap-5 justify-center item-center mx-3 h-screen animate__animated animate__zoomIn animated__slower ">
        <div class="flex justify-end ">
            <a id="retour" class="p-2 bg-white rounded-lg mx-4 shadow-sm shadow-black"
                href="{{ route('commande.index')}}">Retour
            </a>
        </div>
            <div class="flex justify-center bg-white p-2 rounded shadow-md shadow-black">
                <h1 class="text-md sm:text-2xl md:text-3xl font-semibold">Aucun bordereau de livraison pour cette commande</h1>
            </div>

    @endif

    <script>
        function imprimer() {

            const original = document.body.innerHTML;
            const imprimer = document.getElementById('imprimer')
            const retour = document.getElementById('retour')
            const supprimer = document.getElementById('delete')
            retour.classList.add('invisible')
            imprimer.classList.add('invisible')
            supprimer.classList.add('invisible')
            const contenu = document.body.innerHTML

            document.body.innerHTML = contenu;
            //document.body.classList.add('flex', 'justify-center', 'items-center', 'h-screen');
            window.print();
            document.body.innerHTML = original;
        }
    </script>
</body>

</html>
