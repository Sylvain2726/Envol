<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        /* Styles généraux */
        body {
            background-color: white;
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;

        }
        h1, h2, h3, h4, h5, h6 {
            margin: 0;
            padding: 0;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .font-semibold {
            font-weight: 600;
        }
        .uppercase {
            text-transform: uppercase;
        }
        .text-dark {
            color: #003459;
        }
        .bg-dark {
            background-color: #003459;
        }
        .bg-highlight {
            background-color: #0b5e2a;
        }
        .text-white {
            color: #fff;
        }
        .rounded-lg {
            border-radius: 10px;
        }
        .rounded-br-full {
            border-bottom-right-radius: 100%;
        }
        .rounded-tl-full {
            border-top-left-radius: 100%;
        }
        .py-2 {
            padding-top: 8px;
            padding-bottom: 8px;
        }
        .py-4 {
            padding-top: 16px;
            padding-bottom: 16px;
        }
        .px-4 {
            padding-left: 16px;
            padding-right: 16px;
        }
        .px-5 {
            padding-left: 20px;
            padding-right: 20px;
        }
        .py-8 {
            padding-top: 2rem /* 32px */;
            padding-bottom: 2rem /* 32px */;
        }
        .my-10 {
            margin-top: 40px;
            margin-bottom: 40px;
        }
        .mb-8 {
            margin-bottom: 32px;
        }
        .mb-10 {
            margin-bottom: 40px;
        }
        .border-b {
            border-bottom: 1px solid #ddd;
        }
        .border-b-2 {
            border-bottom: 2px solid #003459;
        }
        .bg-blue {
            background-color: #1d4ed8;
        }
        .shadow-md {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .text-lg {
            font-size: 18px;
        }
        .text-xl {
            font-size: 24px;
        }
        .text-2xl {
            font-size: 28px;
        }
        .text-3xl {
            font-size: 36px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 32px;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            font-weight: 600;
            border-bottom: 2px solid #003459;
        }
        td {
            border-bottom: 1px solid #ddd;
        }
        .flex {
            display: flex;

        }
        .justify-between {
            justify-content: space-between;
        }
        .justify-center {
            justify-content: center;
        }
        .items-center {
            align-items: center;
        }
        .invisible {
            display: none;
        }

        .w-full {
            width: 100%;
        }
        .flex-row {
            flex-direction: row;
        }
    </style>
</head>
<body>



        <!-- En-tête -->
        <div class="text-center mb-10">
            <h1 class="text-3xl my-2 font-semibold text-dark">FACTURE</h1>
            <p class="text-lg text-gray-500">Envol Technology</p>
        </div>

        <!-- Informations de facturation -->
        <div class="flex flex-row justify-between items-center mb-8">
            <div>
                <p class="text-lg text-dark">Date: <span class="font-semibold"> {{ $facture->created_at }}</span></p>
                <p class="text-lg text-dark">Facturé à: <span class="font-semibold">{{ $facture->commande?->devis?->client?->firstname. ' '. $facture->commande?->devis?->client?->name }}</span></p>
            </div>
            <div class="text-right">
                <p class="text-lg text-dark">Numéro de la facture</p>
                <p class="text-lg text-dark">Adresse du client : <span class="font-semibold">{{ $facture->commande->devis?->client?->address }}</span> </p>
            </div>
        </div>

        <!-- Section "Facture" -->
        <div class="flex items-center mb-8">
            <div style="text-align: center" class="bg-blue flex justify-center w-full rounded-br-full rounded-tl-full text-white font-bold text-3xl py-8 px-4 shadow-md">
                Facture
            </div>
        </div>

        <!-- Tableau des articles -->
        <table>
            <thead>
                <tr>
                    <th class="uppercase text-dark">Désignation</th>
                    <th class="uppercase text-dark">Quantité</th>
                    <th class="uppercase text-dark">Prix Unitaire</th>
                    <th class="uppercase text-dark">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                @php
                    $equipement = \App\Models\Equipement::find($item->equipement_id);
                @endphp
                <tr>
                    <td class="px-5 py-4 text-lg">{{ $equipement->name }}</td>
                    <td class="px-5 py-3 text-lg">{{ number_format($item->quantite, 0, ',', ' ') }}</td>
                    <td class="px-5 py-3 text-lg">{{ number_format($item->VPrice, 0, ',', ' ') }}</td>
                    <td class="px-5 py-3 text-lg">{{ number_format($item->total, 0, ',', ' ') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totaux -->
        <div class="text-right mb-8">
            <p class="text-dark text-2xl font-bold">Prix Total: <span class="ml-2">{{ number_format($facture->commande->total, 2, ',', ' ') }} FCFA</span></p>
        </div>

        <!-- Pied de page -->
        <div class="bg-dark text-white  px-6 rounded-lg flex justify-between items-center">
            <div style="margin: 20px">
                <p class="text-xs">Hamdalaye ACI 200</p>
                <p class="text-xs">+223 20 21 18 01</p>
                <p class="text-xs">contact@envoltechnology.com</p>
            </div>


        </div>



</body>
</html>
