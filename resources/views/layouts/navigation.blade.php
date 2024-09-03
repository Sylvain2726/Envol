<style>
    /* Styles pour personnaliser la barre de défilement */
    .scroll-custom::-webkit-scrollbar {
      width: 8px;
      box-shadow: inherit;
      border-radius: inherit;
      margin: 50px 0 0 0;


    }

    .scroll-custom::-webkit-scrollbar-thumb {
      background-color: inherit; /* Couleur de la barre */
      border-radius: 5px;
    }

    .scroll-custom::-webkit-scrollbar-track {
      background-color: #e2e8f000; /* Couleur de la piste */
    }
  </style>

<div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
    class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed z-30 l inset-y-0 left-0 w-64 scroll-custom overflow-y-auto  md:mb-4 md:ms-2 md:mt-2 md:ring-4 me-2 md:ring-emerald-600 transition duration-1000 transform bg-emerald-500  shadow-inner shadow-gray-950  lg:translate-x-0 lg:static lg:inset-0 rounded-3xl ">



    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <span class="text-white transition duration-700  text-4xl mx-2 font-semibold">En<span id="spanv"
                    class="text-5xl text-cyan-400 transition duration-1000">v</span>ol <span class="transition duration-700" id="tech"></span></span>
        </div>
    </div>

    <nav class="mt-10  mx-1" x-data="{ isMultiLevelMenuOpen: false }">
        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            <x-slot name="icon">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                </svg>
            </x-slot>
            {{ __('Tableau de bord') }}
        </x-nav-link>


        <x-nav-link href="{{ route('entree.index') }}" :active="request()->routeIs('entree.*')">
            <x-slot name="icon">

            </x-slot>
            {{ __('Entrées') }}
        </x-nav-link>

        <x-nav-link href="{{ route('devis.index') }}" :active="request()->routeIs('devis.index', 'devis.create', 'get.etape2' ,'devis.items')">
            <x-slot name="icon">

            </x-slot>
            {{ __('Devis') }}
        </x-nav-link>


        <x-nav-link href="{{ route('commande.index') }}" :active="request()->routeIs('commande.index')">
            <x-slot name="icon">

            </x-slot>
            {{ __('Commande') }}
        </x-nav-link>

        <x-nav-link href="{{ route('facture.index') }}" :active="request()->routeIs('facture.index', 'facture.create' , 'facture.payements' , 'facture.createPayment')">
            <x-slot name="icon">

            </x-slot>
            {{ __('Facture') }}
        </x-nav-link>

        <x-nav-link href="{{ route('equipement.stock') }}" :active="request()->routeIs('equipement.stock')">
            <x-slot name="icon">

            </x-slot>
            {{ __('Inventaire') }}
        </x-nav-link>


        <x-nav-link href="{{ route('magasin.index') }}" :active="request()->routeIs('magasin.*', 'salle.liste')">
            <x-slot name="icon">

            </x-slot>
            {{ __('Magasins') }}
        </x-nav-link>

        <x-nav-link href="{{ route('equipement.index') }}" :active="request()->routeIs('equipement.index', 'equipement.create', 'equipement.edit')">
            <x-slot name="icon">

            </x-slot>
            {{ __('Equipements') }}
        </x-nav-link>

        <x-nav-link href="{{ route('client.index') }}" :active="request()->routeIs('client.*')">
            <x-slot name="icon">
                <svg class="w-6 h-6 t " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
                        clip-rule="evenodd" />
                </svg>

            </x-slot>
            {{ __('Clients') }}
        </x-nav-link>


        <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
            <x-slot name="icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </x-slot>
            {{ __('Utilisateurs') }}
        </x-nav-link>
{{--
                  <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
                    <x-slot name="icon">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                        </svg>
                    </x-slot>
                    {{ __('About us') }}
                </x-nav-link>

                <x-nav-link href="#" @click="isMultiLevelMenuOpen = !isMultiLevelMenuOpen">
                    <x-slot name="icon">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"></path>
                        </svg>
                    </x-slot>
                    Two-level menu
                </x-nav-link>
                <template x-if="isMultiLevelMenuOpen">
                    <ul x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mx-4 mt-2 space-y-2 overflow-hidden text-sm font-medium text-white bg-gray-700 bg-opacity-50 rounded-md shadow-inner"
                        aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150">
                            <a class="w-full" href="#">Child menu</a>
                        </li>
                    </ul>
         </template> --}}

    </nav>


</div>
<script>
    function toggleClass(element, className) {
        //Ajouter la classe a l'eleùent
        element.classList.add(className);
        setTimeout(() => {
            element.classList.remove(className);
        }, 2000); // Retire la classe après 2 seconde
    }

    //Pour afficher le Tech lettre par lettre
    const mot = 'Tech'
    //Recuperer le span qui dois afficher le tech
    let spanTech = document.getElementById('tech')
    //Fonction pour l'affichage
    function displayWord() {
        let i = 0
        const t = setInterval(() => {
            if (i < mot.length) {
                //Ajouter à la div la lettre conrespondant à l'index i
                spanTech.innerText += mot[i]
                i++
            } else {
                clearInterval(t)
                //Attendre 2s et vider le span
                setTimeout(() => {
                    spanTech.innerText = ''
                }, 2000)

                setTimeout(displayWord, 3000) //Repeter l'affichage tous les 3000
            }
        }, 500)
    }
    displayWord()




    const element = document.getElementById('spanv');
    //La classe à ajouter
    const className = 'text-white';

    setInterval(() => {
        toggleClass(element, className);
    }, 4000); // Répète le processus toutes les 3 secondes
</script>
