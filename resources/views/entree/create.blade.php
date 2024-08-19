<x-app-layout>


    <div class="flex justify-center items-center">

        <div class="bg-white w-full md:w-2/3  overflow-hidden shadow-lg shadow-black/70 rounded-2xl">

            <div class="text-3xl text-center mt-8 ">{{ __('Ajout d\'une nouvelle Entree') }}</div>

            <div class="p-6 border-b  border-gray-200">
                <form class="space-y-6"  method="post" action="{{route('entree.store')}}">
                    @method('POST')
                    @csrf
                    <div class="flex items-center gap-4">
                        <h1 class="text-3xl">Equipement</h1>
                        <button type="button" id="btn" class="p-1 rounded text-md-center bg-emerald-300">Ajouter</button>

                    </div>

                    <div id="addEntree" class="px-5 space-y-3">

                    </div>

                        <div>

                        <x-input-label for="magasin" :value="__('Magasin')"/>
                        <select class=" mt-1 w-full hover:scale-105  focus:outline-none focus:ring transition-all duration-200 rounded-lg shadow-md focus:ring-zinc-400 focus:scale-105 bg-zinc-300 ring-offset-4 shadow-zinc-700 border-none form-input"
                                name="salle_id"
                                id="equipement"
                                autofocus
                        >
                            @foreach($magasins as $magasin)
                                @foreach($magasin->salles as $salle)
                                    <option value="{{$salle->id}}">@if(\PHPUnit\Framework\isEmpty($salle)){{ $salle->magasin->name. ": " . $salle->name}} @else pas de salle @endif</option>
                                @endforeach
                            @endforeach


                        </select>
                    </div>


                    <div class="flex justify-center items-center">
                        <button class="p-2 transition-all duration-300 rounded hover:scale-105 hover:bg-emerald-400/80 focus:ring ring-emerald-500 ring-offset-4 hover:font-bold bg-emerald-400 w-full mx-4 shadow-md shadow-black">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let lastItem
        let i = 0
        const div = document.getElementById('addEntree')

        function addDiv(){
            let div1 = document.createElement('div')
            div1.classList.add('space-y-3')
            div1.innerHTML = `
             <div>
                <label class="block text-sm text-gray-700" for="equipement">
                    Equipement
                </label>
                <select class="block mt-1 w-full hover:scale-105  focus:outline-none focus:ring transition-all duration-200 rounded-lg shadow-md focus:ring-zinc-400 focus:scale-105 bg-zinc-300 ring-offset-4 shadow-zinc-700 border-none form-input" name="equipement[${i}][equipement_id]" id="equipement" autofocus="">
                    @foreach($equipements as $equipement)
                        <option value="{{$equipement->id}}">{{$equipement->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-700" for="Aprice">
                    Prix de d'achat
                </label>
                <input class="block mt-1 w-full hover:scale-105  focus:outline-none focus:ring transition-all duration-200 rounded-lg shadow-md focus:ring-zinc-400 focus:scale-105 bg-zinc-300 ring-offset-4 shadow-zinc-700 border-none form-input" type="text" name="equipement[${i}][Aprice]" id="Aprice" value="" autofocus="autofocus">
            </div>
            <div>
                <label class="block text-sm text-gray-700" for="quantite">
                    Quantite
                </label>
                <input class="block mt-1 w-full hover:scale-105  focus:outline-none focus:ring transition-all duration-200 rounded-lg shadow-md focus:ring-zinc-400 focus:scale-105 bg-zinc-300 ring-offset-4 shadow-zinc-700 border-none form-input" type="number" name="equipement[${i}][quantite]" id="quantite" value="" autofocus="autofocus">
            </div>`


            div.append(div1)


            if (lastItem) {
                lastItem.setAttribute('hidden' , 'hidden');

            }
            lastItem = div1;

            i++;
    }


       const btn = document.getElementById('btn')
       btn.addEventListener('click' , ()=>{
           addDiv()
       })
</script>
</x-app-layout>
