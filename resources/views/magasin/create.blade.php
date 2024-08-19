<x-app-layout>


    <div class="flex justify-center items-center">

        <div class="bg-white w-full md:w-2/3  overflow-hidden shadow-lg shadow-black/70 rounded-2xl">

            <div class="text-3xl text-center mt-8 ">{{ __('Ajout d\'un nouveau magasin') }}</div>

            <div class="p-6 border-b  border-gray-200">
                <form class="space-y-6"  method="post" action="{{route('magasin.store')}}">
                    @method('POST')
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Nom')"/>
                        <x-text-input type="text"
                                      name="name"
                                      id="name"
                                      value="{{ old('name') }}"
                                      autofocus
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="address" :value="__('Localité')"/>
                        <x-text-input type="text"
                                      name="address"
                                      id="address"
                                      value="{{ old('address') }}"
                                      autofocus
                        />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>



                    <div class="flex justify-center items-center">
                        <button class="p-2 transition-all duration-300 rounded hover:scale-105 hover:bg-emerald-400/80 focus:ring ring-emerald-500 ring-offset-4 hover:font-bold bg-emerald-400 w-full mx-4 shadow-md shadow-black">Enregistrer</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
