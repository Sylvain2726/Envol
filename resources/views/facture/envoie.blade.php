<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Envol Stock</title>

    <style>
        body {
            background: linear-gradient(to bottom, #6b7280, #374151, #f3f4f6);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 2rem;
            font-weight: 600;
            text-align: center;

        }

        h3 {
            text-align: center;
            font-weight: bold;
            margin: 2rem 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 1rem;
            margin: 2rem 0;
        }

        .flex {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .flex-column {
            flex-direction: column;
            gap: 1.25rem;
        }

        .gap {
            gap: 2.5rem;
        }

        .svg-wrapper {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            max-width: 24rem;
            margin: 0 auto;
        }
        span {
            font-weight: normal;
        }

        p {

            margin: 0.5rem 0;
        }

        p span, p a {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
        }

        th, td {
            padding: 0.75rem;
            font-size: 1.125rem;
            border: 2px solid rgba(75, 85, 99, 0.5);
        }

        th {
            background-color: #60a5fa;
            color: #111827;
            text-transform: uppercase;
            text-align: center;
        }

        tr:hover {
            background-color: #475569;
        }



        .total h1 {
            color: #2563eb;
            font-weight: 700;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Facture N°{{ $facture->numFacture }}</h1>

        <div class="flex gap">
            <div class="svg-wrapper">
                <svg viewBox="0 0 2048 831" xmlns="http://www.w3.org/2000/svg">
                    <!-- SVG content here -->
                </svg>
            </div>
            <div class="flex-column">
                <p>Adresse : <span>Hamdalaye ACI 2000</span></p>
                <p>Contact : <a href="tel:+223 20 21 18 01">+223 20 21 18 01</a></p>
                <p>E-mail : <a href="mailto:contact@envoltechnology.com">contact@envoltechnology.com</a></p>
            </div>
        </div>

        <div class="flex-column">
            <div class="flex">
                <div>
                    <h3 class="text-md">Client : <span>{{ $facture->commande->devis?->client?->name . ' ' . $facture->commande->devis?->client?->firstname }}</span></h3>
                    <h3 class="text-md">Numéro du client : <span>{{ $facture->commande->devis?->client?->phone }}</span></h3>
                    <h3 class="text-md">Adresse du client : <span>{{ $facture->commande->devis?->client?->address }}</span></h3>
                    <h3 class="text-md">Date de création : <span>{{ $facture->commande->created_at }}</span></h3>
                </div>
            </div>

            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Designation</th>
                            <th>Quantité</th>
                            <th>Prix TTC</th>
                            <th>Prix Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            @php
                                $equipement = \App\Models\Equipement::find($item->equipement_id);
                            @endphp
                            <tr>
                                <td>{{ $equipement->name }}</td>
                                <td>{{ $item->quantite }}</td>
                                <td>{{ number_format($item->VPrice, 0, ',', ' ') }}</td>
                                <td>{{ number_format($item->total, 0, ',', ' ') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="total">
                <h1>Total de la facture : {{ number_format($facture->commande->total, 2, ',', ' ') }} FCFA</h1>
            </div>
        </div>
    </div>

    <script>
        function imprimer() {
            const original = document.body.innerHTML;
            const retour = document.getElementById('retour');
            const imprimer = document.getElementById('imprimer');
            retour.classList.add('invisible');
            imprimer.classList.add('invisible');
            window.print();
            document.body.innerHTML = original;
        }
    </script>
</body>

</html>
