<?php

namespace App\enum;

enum PermissionsEnum : string
{
    // Permissions pour la gestion des équipements
    case GERER_EQUIPEMENTS = 'Gerer les équipements';
    case SUPPRIMER_EQUIPEMENT = 'Supprimer un équipement';
    case CONSULTER_STOCK = 'Consulter le stock des equipements';

    // Permissions pour la gestion des entrées et sorties
    case GERER_ENTREES = 'Gerer les entrées';
    case SUPPRIMER_ENTREE = 'Supprimer une entrée';

    //Permissions pour la gestion des clients
    case GERER_CLIENTS = 'Gerer les clients';
    case SUPPRIMER_CLIENT = 'Supprimer un client';


    // Permissions pour la getion des devis
    case GERER_DEVIS = 'Gerer les devis';
    case SUPPRIMER_DEVIS = 'Supprimer un devis';

    // Permissions pour la gestion des magasins et salles
    case GERER_MAGASINS = 'Gerer les magasins';
    case SUPPRIMER_MAGASIN = 'Supprimer un magasin';

    // Permissions pour la gestion des commandes
    case GERER_COMMANDES = 'Gerer les commandes';
    case SUPPRIMER_COMMANDE = 'Supprimer une commande';

    // Permissions pour la gestion des factures
    case GERER_FACTURES = 'Gerer les factures';
    case SUPPRIMER_FACTURE = 'Supprimer une facture';

    // Permissions pour la gestion des utilisateurs et rôles
    case GERER_UTILISATEURS = 'Gerer les utilisateurs';
    case SUPPRIMER_UTILISATEUR = 'Supprimer un utilisateur';

    case ATTRIBUER_ROLES = 'Attribuer des rôles';
    case MODIFIER_ROLES = 'Modifier des rôles';
    case SUPPRIMER_ROLES = 'Supprimer des rôles';
    case CONSULTER_ROLES = 'Consulter les rôles';
}
