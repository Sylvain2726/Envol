<x-mail::message>
# Facture n°{{ $facture->numFacture }}

Mr/Mme {{ $facture->commande->devis->client->nom }} {{ $facture->commande->devis->client->nom }}
Veuillez trouver ci-joint la facture relative à votre commande

Merci de votre confiance
{{ config('app.name') }}
</x-mail::message>
