<x-app-layout>


    <div class="flex justify-center items-center">

        <div class="bg-white w-full md:w-2/3  overflow-hidden shadow-lg shadow-black/70 rounded-2xl">

            <div class="text-3xl text-center mt-8 ">{{ __('Ajout de Facture') }}</div>

            <div class="p-6 border-b  border-gray-200">
                <form class="space-y-6"  method="post" action="{{ route('facture.store' , $commande ) }}">
                    @method('POST')
                    @csrf


                    <div>
                        <x-input-label for="type" :value="__('Mode de payement')"/>
                        <select class="block mt-1 w-full hover:scale-105  focus:outline-none focus:ring transition-all duration-200 rounded-lg shadow-md focus:ring-zinc-400 focus:scale-105 bg-zinc-300 ring-offset-4 shadow-zinc-700 border-none form-input"
                                      name="modePayement"
                                      id="modePayement"
                                      autofocus
                        >
                            <option>Choisir un mode de payment</option>
                            <option >Espèce</option>
                            <option >Cheque</option>



                        </select>


                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>





                    <div class="flex justify-center items-center">
                        <button class="p-2 transition-all duration-300 rounded hover:scale-105 hover:bg-emerald-400/80 focus:ring ring-emerald-500 ring-offset-4 hover:font-bold bg-emerald-400 w-full mx-4 shadow-md shadow-black">Enregistrer</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
