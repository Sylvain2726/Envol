<x-entree-layout>

    <div id="divInvisible"
        class="flex invisible animate__animated animate__slideInUp animate__slower justify-center items-start">

        <div class=" entree-bg w-full md:mx-10 mt-10  overflow-hidden shadow-md shadow-black rounded-xl">

            <div class="text-3xl sm:text-4xl md:text-5xl text-black font-extrabold text-center mt-4 mx-8 ">
                {{ __('Ajout d\'une nouvelle Entrée') }}
            </div>

            <div class="p-6 border-gray-200">
                <form class="space-y-6" method="post" action="{{ route('entree.store') }}">
                    @method('POST')
                    @csrf
                    <div class="flex items-center justify-center">
                        <button type="button" id="btn"
                            class="p-1 rounded text-md-center shadow-md shadow-black hover:scale-105 bg-white/80">Ajouter
                            un équipement
                        </button>
                    </div>

                    <div id="addEntree" class="px-2 py-2 space-y-3">
                        <div class="space-y-4" id="divACache">

                            <div>
                                <label class="block text-lg md:text-xl text-black font-bold" for="equipement">
                                    Equipement
                                </label>
                                <select
                                    class="block md:text-xl mt-1 w-full hover:scale-105  focus:outline-none  transition-all duration-200 rounded-lg shadow-md  focus:scale-105 bg-white/40  text-black text-lg font-semibold ring-offset-4 shadow-black border-none form-input"
                                    name="equipement[0][equipement_id]" id="equipement" autofocus="">
                                    <option class="text-black" value="">Selectioner l'equipement</option>
                                    @foreach ($equipements as $equipement)
                                        <option class="text-black" value="{{ $equipement->id }}">{{ $equipement->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('equipement.0.equipement_id')" />
                            </div>
                            <div>
                                <label class="block text-lg md:text-xl text-black font-bold" for="Aprice">
                                    Prix de d'achat
                                </label>
                                <input
                                    class="block mt-1 w-full hover:scale-105  focus:outline-none  transition-all duration-200 rounded-lg shadow-md  focus:scale-105 bg-white/40  text-black text-lg font-semibold ring-offset-4 shadow-black border-none form-input"
                                    type="text" name="equipement[0][Aprice]" id="Aprice" value=""
                                    >
                                <x-input-error class="mt-2" :messages="$errors->get('equipement.0.Aprice')" />
                            </div>
                            <div>
                                <label class="block text-lg md:text-xl text-black font-bold" for="quantite">
                                    Quantite
                                </label>
                                <input
                                    class="block mt-1 w-full hover:scale-105 placeholder:text-black focus:outline-none  transition-all duration-200 rounded-lg shadow-md  focus:scale-105 bg-white/40  text-black text-lg font-semibold ring-offset-4 shadow-black border-none form-input"
                                    type="number" name="equipement[0][quantite]" id="quantite" value=""
                                    placeholder="Entrer la quantité">

                                <x-input-error class="mt-2" :messages="$errors->get('equipement.0.quantite')" />
                            </div>

                            <div>
                                <label class="block text-lg md:text-xl text-black font-bold" for="equipement">
                                    Salle
                                </label> <select
                                    class="block mt-1 w-full hover:scale-105  focus:outline-none  transition-all duration-200 rounded-lg shadow-md  focus:scale-105 bg-white/40  text-black text-lg font-semibold ring-offset-4 shadow-black border-none form-input"
                                    name="equipement[0][salle_id]" id="equipement" autofocus>

                                    <option value="">Choisir la salle pour l'equipement</option>

                                    @foreach ($magasins as $magasin)
                                        @foreach ($magasin->salles as $salle)
                                            <option value="{{ $salle->id }}">
                                                @if (\PHPUnit\Framework\isEmpty($salle))
                                                    {{ $salle->magasin->name . ': ' . $salle->name }}
                                                @else
                                                    pas de salle
                                                @endif
                                            </option>
                                        @endforeach
                                    @endforeach

                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('equipement.0.salle_id')" />
                            </div>

                        </div>

                    </div>

                    <div class="flex justify-center items-center">
                        <button
                            class="p-2 my-4 transition-all duration-300 rounded hover:scale-105 hover:bg-white focus:ring ring-white ring-offset-4 hover:font-bold bg-white/80 w-full mx-4 shadow-md shadow-black">Enregistrer</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        let lastItem
        let i = 1
        const div = document.getElementById('addEntree')

        function addDiv() {
            document.getElementById('divACache').classList.add('hidden')
            let div1 = document.createElement('div')
            div1.classList.add('space-y-3')
            div1.innerHTML = `
            <div class="animate__animated animate__slideInRight animate__fast space-y-4">
             <div>
                <label class="block text-lg text-black font-bold for="equipement">
                    Equipement
                </label>
                <select class="block mt-1 w-full hover:scale-105  focus:outline-none  transition-all duration-200 rounded-lg shadow-md  focus:scale-105 bg-white/40  text-black text-lg font-semibold ring-offset-4 shadow-black border-none form-input" name="equipement[${i}][equipement_id]" id="equipement" autofocus="">
                    @foreach ($equipements as $equipement)
                        <option value="{{ $equipement->id }}">{{ $equipement->name }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('equipement[${i}][equipement_id]')" />
            </div>
            <div>
                <label class="block text-lg text-black font-bold for="Aprice">
                    Prix de d'achat
                </label>
                <input class="block mt-1 w-full hover:scale-105  focus:outline-none  transition-all duration-200 rounded-lg shadow-md  focus:scale-105 bg-white/40  text-black text-lg font-semibold ring-offset-4 shadow-black border-none form-input" type="text" name="equipement[${i}][Aprice]" id="Aprice" value="" >
            </div>
            <div>
                <label class="block text-lg text-black font-bold for="quantite">
                    Quantite
                </label>
                <input class="block mt-1 w-full hover:scale-105  focus:outline-none  transition-all duration-200 rounded-lg shadow-md  focus:scale-105 bg-white/40  text-black text-lg font-semibold ring-offset-4 shadow-black border-none form-input" type="number" name="equipement[${i}][quantite]" id="quantite" value="" >
                <x-input-error class="mt-2" :messages="$errors->get('equipement[${i}][quantite]')" />
                </div>

                    <div>
                        <label class="block text-lg text-black font-bold" for="equipement">
                            Salle
                        </label>
                        <select class="block mt-1 w-full hover:scale-105  focus:outline-none  transition-all duration-200 rounded-lg shadow-md  focus:scale-105 bg-white/40  text-black text-lg font-semibold ring-offset-4 shadow-black border-none form-input"
                                name="equipement[${i}][salle_id]"
                                id="equipement"
                                autofocus
                        >
                            @foreach ($magasins as $magasin)
                                @foreach ($magasin->salles as $salle)
                                    <option value="{{ $salle->id }}">@if (\PHPUnit\Framework\isEmpty($salle)){{ $salle->magasin->name . ': ' . $salle->name }} @else pas de salle @endif</option>
                                @endforeach
                            @endforeach

                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('equipement[${i}][salle_id]')" />
                    </div>
                </div>
            `


            div.append(div1)


            if (lastItem) {
                lastItem.setAttribute('hidden', 'hidden');

            }
            lastItem = div1;

            i++;
        }

        setTimeout(() => {
            document.getElementById('divInvisible').classList.remove('invisible')
        }, 100);


        const btn = document.getElementById('btn')
        btn.addEventListener('click', () => {
            addDiv()
        })
    </script>
</x-entree-layout>
