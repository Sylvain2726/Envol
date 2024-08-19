<x-app-layout>


    <div class="flex justify-center items-center h-screen " >

    <div class="bg-white w-full md:w-2/3  overflow-hidden shadow-sm rounded-2xl">
        <div class="flex justify-center items-center">
            <div class="text-2xl md:text-4xl italic bg-emerald-400 rounded-xl px-2 text-center mt-8 ">{{ __('Ajout d\'un nouveau client') }}</div>
        </div>


        <div class="p-6 border-b  border-gray-200">
            <form class="space-y-6"  method="post" action="{{route('client.store')}}">
                @method('POST')
                @csrf


                <div class="w-full">
                    <x-input-label for="name" :value="__('Nom')"/>
                    <x-text-input  type="text"
                                  name="name"
                                  id="name"
                                  value="{{ old('name') }}"

                                  autofocus
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="w-full">
                    <x-input-label for="firstname" :value="__('Prenom')"/>
                    <x-text-input type="text"
                                  name="firstname"
                                  id="firstname"
                                  value="{{ old('firstname') }}"

                                  autofocus
                    />
                    <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="phone" :value="__('Telephone')"/>
                    <x-text-input type="text"
                                  name="phone"
                                  id="phone"
                                  value="{{ old('phone') }}"

                                  autofocus
                    />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="mail" :value="__('Email')"/>
                    <x-text-input type="mail"
                                  name="email"
                                  id="mail"
                                  value="{{ old('email') }}"

                                  autofocus
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="address" :value="__('Adresse')"/>
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
