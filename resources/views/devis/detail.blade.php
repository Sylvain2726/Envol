<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Envol Stock</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="flex flex-col gap-5 justify-center mx-3 h-screen">
        <div class="flex items-center justify-between md:justify-start   gap-10 md:gap-32">
            <div class="flex flex-col gap-3">
                <div class="">
                    <h1 class="text-md"> <span class="font-bold">Client :
                        </span>{{ $devis->client->name . ' ' . $devis->client->firstname }}</h1>
                </div>
                <div class="">
                    <h1 class="text-md"> <span class="font-bold">Numéro du client : </span>{{ $devis->client->phone }}
                    </h1>
                </div>

                <div class="">
                    <h1 class="text-md"> <span class="font-bold">Adresse du client :
                        </span>{{ $devis->client->address }}</h1>
                </div>

                <div class="">
                    <h1 class="text-md"> <span class="font-bold">Date de création :
                        </span>{{ $devis->created_at }}</h1>
                </div>

            </div>
            <svg class="bg-emerald-400/70 rounded-xl max-w-sm" viewBox="0 0 2048 831"
                xmlns="http://www.w3.org/2000/svg">
                <path transform="translate(459,178)"
                    d="m0 0 4 2 11 11 8 7 7 7 3 2v2l4 2 14 14 8 7 10 10 8 7 10 10 8 7 11 11 8 7 10 10 8 7 11 11 8 7 10 10 8 7 11 11 8 7 10 10 8 7 10 10 8 7 7 7 1-211h32v283l-7-6-10-9-8-8-8-7-9-9-8-7-8-8-8-7-10-10-8-7-8-8-8-7-13-13-8-7-17-16-11-11-8-7-17-16-11-11-8-7-10-10-8-7-10-10-7-6-1 208h-34l-1-1z"
                    fill="#FEFEFE" />
                <path transform="translate(1455,169)"
                    d="m0 0h28l24 3 19 5 16 6 19 10 17 12 13 12 11 12 7 10 9 15 6 15 5 18 2 12v28l-3 18-6 20-9 19-10 15-9 11-8 9-8 7-16 12-21 11-24 8-24 4-11 1h-26l-21-3-20-5-25-10-14-8-14-10-13-12-9-9-11-15-9-16-6-16-4-17-2-19v-10l2-19 5-19 6-16 11-20 10-13 9-10 10-10 15-11 16-9 16-7 21-6zm0 27-20 4-18 6-16 8-15 10-10 9-5 4-9 11-9 14-5 10-5 15-2 12v29l4 20 6 16 8 15 9 12 9 10 14 11 15 9 20 8 16 4 16 2h22l21-3 20-6 21-10 14-10 12-11 11-13 9-15 6-14 4-16 2-17-1-20-5-21-6-15-8-13-9-11-13-13-17-12-16-8-16-6-18-4-7-1z"
                    fill="#FEFEFE" />
                <path transform="translate(207,183)"
                    d="m0 0h192v27h-159v88h157l2 6v14l-2 7h-157v110h157l2 6v15l-1 5h-191z" fill="#FEFEFE" />
                <path transform="translate(778,181)"
                    d="m0 0 4 2 15 13 11 9 14 12 11 9 13 11 11 9 14 12 14 11 10 9 11 9 13 11 11 9 14 12 11 9 14 12 11 9 14 12 11 9 15 13 11 9h4l14-11 14-12 10-8 22-18 34-28 14-11 14-12 14-11 15-13 14-11 13-11 11-9 16-13 13-11 10-8 22-18 7-6 2 1-15 16-7 8-45 50-7 8-10 11-7 8-9 10-10 11-7 8-27 30-7 8-9 10-10 11-7 8-27 30-7 8-11 12-7 8-11 12-7 8-9 10-4 2-12-14-12-13-7-8-9-10-7-8-11-12-7-8-9-10-7-8-18-20-7-8-10-11-7-8-11-12-7-8-27-30-12-14-14-15-7-8-9-10-7-8-11-12-9-11-7-7-7-8z"
                    fill="#1E99B4" />
                <path transform="translate(1675,184)" d="m0 0h33v250h128l3 6v21h-164z" fill="#FEFEFE" />
                <path transform="translate(207,549)" d="m0 0h769v8h-769z" fill="#FEFEFE" />
                <path transform="translate(1339,547)"
                    d="m0 0h10l42 57 6 8v2h2v-67h9v84h-10l-8-10-14-19-13-18-14-19-1 66h-10z" fill="#FEFEFE" />
                <path transform="translate(1622,547)"
                    d="m0 0h13l13 4 8 5 6 5 7 11 3 9v17l-4 11-7 9-9 8-13 5h-21l-11-4-11-8-7-10-4-11v-17l4-11 6-9 8-7 10-5zm2 9-10 3-9 6-6 7-4 9-1 10 3 12 6 9 9 7 8 3 5 1h7l13-4 9-7 6-10 2-7v-12l-4-10-6-8-9-6-10-3z"
                    fill="#FEFEFE" />
                <path transform="translate(1463,547)"
                    d="m0 0h13l11 3 9 5 7 6 7 11 3 9v17l-4 11-7 9-9 8-13 5h-21l-13-5-10-9-6-8-4-12v-16l4-11 6-9 8-7 10-5zm2 9-10 3-9 6-6 7-4 9-1 9 2 11 6 10 7 6 7 4 9 2h7l11-3 10-7 6-9 3-8v-13l-3-9-7-9-9-6-10-3z"
                    fill="#FEFEFE" />
                <path transform="translate(1082,547)" d="m0 0h57v9h-48v29h43v9h-43l1 28 48 1v9h-58z" fill="#FEFEFE" />
                <path transform="translate(1243,547)" d="m0 0h9v39h51v-39h9v84h-9v-36h-51v36h-9z" fill="#FEFEFE" />
                <path transform="translate(1718,547)"
                    d="m0 0h13l11 3 8 4 5 4-2 5-2 2-4-1-12-6-5-1h-10l-10 3-9 6-6 7-3 8-1 10 2 10 6 10 9 7 13 4h8l13-4 5-2v-26h8v31l-5 4-8 4-7 2h-21l-11-4-11-8-7-10-4-11v-18l5-12 6-8 9-7 12-5z"
                    fill="#FEFEFE" />
                <path transform="translate(1188,547)"
                    d="m0 0h14l12 4 8 5 4 4-5 6-5-2-8-5-7-2h-11l-10 3-8 6h-2l-7 14-1 5v9l4 11 6 8 9 6 6 2 9 1 10-2 10-5 5-2 5 6-7 6-11 5-4 1h-19l-11-4-9-6-7-8-5-10-2-9v-9l3-12 6-10 7-7 8-5z"
                    fill="#FEFEFE" />
                <path transform="translate(1767,547)"
                    d="m0 0h10l17 28 9 14 1 1 17-29 9-14h10l-2 5-9 16-14 24-6 11-1 28h-9l-1-29-17-29-14-24z"
                    fill="#FEFEFE" />
                <path transform="translate(1e3 547)" d="m0 0h64l1 1v8h-28v75h-10v-75h-27z" fill="#FEFEFE" />
                <path transform="translate(1531,547)" d="m0 0h9v76h37v9h-46l-1-1v-83z" fill="#FEFEFE" />
                <path transform="translate(1294,180)" d="m0 0" fill="#FEFEFE" />
                <path transform="translate(777,180)" d="m0 0" fill="#1D99B4" />
                <path transform="translate(776,179)" d="m0 0" fill="#FEFEFE" />
            </svg>



        </div>

        <div class="flex justify-around items-center  ">
            <h1 class="text-2xl font-semibold">Détails du devis numéro {{ $devis->id }}</h1>
            <div class="flex">
                <button id="imprimer" onclick="imprimer()" type="button" class="p-2 bg-emerald-400 rounded-lg shadow-sm shadow-black">Imprimer</button>
                <a id="retour" class="p-2 bg-white rounded-lg mx-4 shadow-sm shadow-black" href="{{ url()->previous() }}">Retour</a>
            </div>
        </div>

        <div class="  overflow-x-auto  w-full  rounded-xl ">

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
                            Prix TTC
                        </th>

                        <th
                            class="px-5  text-lg border-2  font-bold tracking-wider text-center text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-300">
                            Prix Total
                        </th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($devis->devisItems as $item)
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
                                    {{ number_format($item->VPrice, 0, ',', ' ') }}</p>
                            </td>

                            <td class="px-5 py-3 text-lg bg-white border-2  border-gray-300">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ number_format($item->total, 0, ',', ' ') }}</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex flex-col items-center px-5 py-2 bg-white border-t xs:flex-row xs:justify-between">
                <h1 class="text-3xl text-emerald-700 font-bold">Total du devis
                    {{ number_format($devis->total, 2, ',', ' ') }} FCFA</h1>
            </div>
        </div>
    </div>
    <script>
        function imprimer() {

            const original = document.body.innerHTML;
            const imprimer = document.getElementById('imprimer')
            const retour = document.getElementById('retour')
            retour.classList.add('invisible')
            imprimer.classList.add('invisible')
            const contenu =document.body.innerHTML

            document.body.innerHTML = contenu;
            //document.body.classList.add('flex', 'justify-center', 'items-center', 'h-screen');
            window.print();
            document.body.innerHTML = original;
        }
    </script>
</body>

</html>
