<x-app-layout>


    <div class="flex justify-center items-center px-6">

        <div class="bg-white mx-10 w-2/3 overflow-hidden shadow-sm sm:rounded-lg">

            <div class="text-3xl text-center mt-8 ">{{ __('Ajout d\'un nouveau Equipement') }}</div>

            <div class="p-6 border-b  border-gray-200">
                <form class="space-y-6"  method="post" action="{{route('equipement.store')}}">
                    @method('POST')
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('id')"/>
                        <x-text-input hidden="hidden" type="text"
                                      name="id"
                                      id="id"
                                      value="{{ $equipement->id }}"
                                      autofocus

                        />
                        <x-input-error :messages="$errors->get('id')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="name" :value="__('Nom')"/>
                        <x-text-input type="text"
                                      name="name"
                                      id="name"
                                      value="{{ $equipement->name }}"
                                      autofocus
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="type" :value="__('Type')"/>
                        <select class="block mt-1 w-full rounded-md form-input focus:border-indigo-600"
                                name="type"
                                id="type"
                                autofocus
                        >
                            <option>Batterie</option>
                            <option @selected($equipement->type==='Onduleur')>Onduleur</option>
                            <option @selected($equipement->type==='Cofret')>Cofret</option>
                            <option @selected($equipement->type==='Pied D\'Onduleur')>Pied D'Onduleur</option>

->type
                        </select>


                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="Vprice" :value="__('Prix de vente')"/>
                        <x-text-input type="text"
                                      name="Vprice"
                                      id="Vprice"
                                      value="{{ $equipement->VPrice }}"

                                      autofocus
                        />
                        <x-input-error :messages="$errors->get('Vprice')" class="mt-2" />
                    </div>



                    <div class="flex justify-center items-center">
                        <button class="p-2 transition-all duration-300 rounded hover:scale-105 hover:bg-emerald-400/80 focus:ring ring-emerald-500 ring-offset-4 hover:font-bold bg-emerald-400 w-full mx-4 shadow-md shadow-black">Enregistrer</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
