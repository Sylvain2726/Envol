<x-app-layout>


    <div class="flex justify-center items-center px-6">

        <div class="bg-white mx-10 w-2/3 overflow-hidden shadow-sm sm:rounded-lg">

            <div class="text-3xl text-center mt-8 ">{{ __('Modification') }}</div>

            <div class="p-6 border-b  border-gray-200">
                <form class="space-y-6"  method="post" action="{{ route('itemDevis.update', ['itemDevi'=>$itemDevi]) }}">
                    @method('PUT')
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('id')"/>
                        <x-text-input hidden="hidden" type="text"
                                      name="id"
                                      id="id"
                                      value="{{ $itemDevi->id }}"
                                      autofocus

                        />
                        <x-input-error :messages="$errors->get('id')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="name" :value="__('Nom')"/>
                        <x-text-input type="text"
                                      name="name"
                                      id="name"
                                      value="{{ $itemDevi->name }}"
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
                            <option @selected($itemDevi->type==='Onduleur')>Onduleur</option>
                            <option @selected($itemDevi->type==='Cofret')>Cofret</option>
                            <option @selected($itemDevi->type==='Pied D\'Onduleur')>Pied D'Onduleur</option>


                        </select>


                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="VPrice" :value="__('Prix de vente')"/>
                        <x-text-input type="text"
                                      name="VPrice"
                                      id="VPrice"
                                      value="{{ $itemDevi->VPrice }}"

                                      autofocus
                        />
                        <x-input-error :messages="$errors->get('Vprice')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="quantite" :value="__('quantite')"/>
                        <x-text-input type="text"
                                      name="quantite"
                                      id="quantite"
                                      value="{{ $itemDevi->quantite }}"

                                      autofocus
                        />
                        <x-input-error :messages="$errors->get('quantite')" class="mt-2" />
                    </div>



                    <div class="flex justify-center items-center">
                        <button class="p-2 transition-all duration-300 rounded hover:scale-105 hover:bg-emerald-400/80 focus:ring ring-emerald-500 ring-offset-4 hover:font-bold bg-emerald-400 w-full mx-4 shadow-md shadow-black">Enregistrer</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
