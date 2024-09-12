<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>

    <style>
        .text-brand { color: #0b5e2a; }
        .bg-highlight { background-color: #e0fb5a; }
        .bg-dark { background-color: #003459; }
        .text-dark { color: #003459; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-200">



    <div class="max-w-2xl mx-auto bg-white animate__animated animate__fadeInDown animate__slow p-10 my-10">



        <div class="flex justify-end  items-center  ">

            <div class="flex">
                <button id="imprimer" onclick="imprimer()" type="button" class="p-2 bg-emerald-400 rounded-lg shadow-sm shadow-black">Imprimer</button>

                <a id="envoyer" class="p-2 bg-blue-500/70 rounded-lg mx-4 shadow-sm shadow-black" href="{{ route('facture.envoyer' , $facture) }}">Envoyer</a>

                <a id="retour" class="p-2 bg-white rounded-lg mx-4 shadow-sm shadow-black" href="{{ route('facture.index') }}">Retour</a>
            </div>
        </div>
        <!-- En-tête -->
        <div class="text-center mb-10">
            <h1 class="text-3xl my-2 font-semibold text-blue-500">FACTURE</h1>
            <p class="text-lg font-bold text-gray-600">Envol Technology</p>
        </div>

        <!-- Informations de facturation -->
        <div class="flex justify-between mb-8">
            <div>
                <p class="text-lg text-gray-600">Date: <span class="font-semibold">{{ $facture->created_at }}</span></p>
                <p class="text-lg text-gray-600">Facturé à: <span class="font-semibold">{{ $facture->commande?->devis?->client?->firstname. ' '. $facture->commande?->devis?->client?->name }}</span></p>
            </div>
            <div class="text-right">
                <p class="text-lg text-gray-600">Numéro du client : <span class="font-semibold">{{ $facture->commande->devis->client->phone }}</span></p>
                <p class="text-lg text-gray-600">Adresse du client : <span class="font-semibold">{{ $facture->commande->devis->client->address }}</span> </p>
            </div>
        </div>

        <!-- Section "INVOICE" -->
        <div class="flex items-center mb-8">
            <div class="bg-blue-400 flex justify-center w-full italic rounded-br-full rounded-tl-full text-white font-bold text-5xl py-4 px-4 rounded-lg ">
                Facture N°{{ $facture->numFacture }}
            </div>
        </div>

        <!-- Tableau des articles -->
        <table class="w-full text-left border-collapse mb-8">
            <thead>
                <tr>
                    <th class="border-b-2 text-center py-2 uppercase text-dark">Désignation</th>
                    <th class="border-b-2 text-center py-2 uppercase text-dark">Prix Unitaire</th>
                    <th class="border-b-2 text-center py-2 uppercase text-dark">quantité</th>
                    <th class="border-b-2 text-center py-2 uppercase text-dark">TOTAL</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($items as $item)
                @php
                    $equipement = \App\Models\Equipement::find($item->equipement_id);
                @endphp

                <tr>

                    <td class=" py-3 text-lg text-center bg-white ">
                        {{ $equipement->name }}

                    </td>
                    <td class=" py-3 text-center text-lg bg-white">

                            {{ number_format($item->VPrice, 0, ',', ' ') }}
                    </td>

                    <td class=" py-3 text-center text-lg bg-white ">
                       {{ $item->quantite }}
                    </td>


                    <td class=" py-3 text-center text-lg bg-white">

                            {{ number_format($item->total, 0, ',', ' ') }}
                    </td>
                </tr>
            @endforeach


            </tbody>
        </table>

        <!-- Totaux -->
        <div class="text-right mb-8">
            <p class="text-blue-500 text-2xl font-bold">Prix Total: <span class="ml-2">{{ number_format($facture->commande->total, 2, ',', ' ') }} FCFA</span></p>

        </div>

        <!-- Pied de page -->
        <div class="bg-dark text-white py-4 px-6 rounded-lg flex justify-between items-center">
            <div>
                <p class="text-xs">Hamdalaye ACI 200</p>
                <p class="text-xs">+223 20 21 18 01</p>
            </div>
            <div>
                <p class="text-xs">contact@envoltechnology.com</p>

            </div>

        </div>
    </div>

    <script>
        function imprimer() {

            const original = document.body.innerHTML;

            const imprimer = document.getElementById('imprimer')
            const retour = document.getElementById('retour')
            const envoyer = document.getElementById('envoyer')
            retour.classList.add('invisible')
            imprimer.classList.add('invisible')
            envoyer.classList.add('invisible')
            const contenu =document.body.innerHTML
            document.body.innerHTML = contenu;
            document.body.classList.remove('bg-gray-200');

            //document.body.classList.add('flex', 'justify-center', 'items-center', 'h-screen');
            window.print();
            document.body.innerHTML = original;
            document.body.classList.add('bg-gray-200');


        }
    </script>

</body>
</html>
