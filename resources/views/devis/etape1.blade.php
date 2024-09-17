<x-app-layout>







    <div id="etape1" class="flex justify-center   items-start h-screen ">

        <div class="bg-white w-full md:w-full  overflow-hidden shadow-sm shadow-black rounded-2xl animate__animated animate__fadeInLeftBig animate__slower">
            {{--             <div class="flex justify-center items-center">
                <div class="text-2xl md:text-4xl italic bg-emerald-400 rounded-xl px-2 text-center mt-8 ">
                    {{ __('Ajout d\'un nouveau client') }}</div>
            </div> --}}


            <div class="p-6 border-b  border-gray-200">

                <ol
                    class="flex items-center justify-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                    <li class="flex items-center text-emerald-600 dark:text-emerald-500">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-emerald-600 rounded-full shrink-0 dark:border-emerald-500">
                            1
                        </span>
                        Infomation du <span class="hidden sm:inline-flex sm:ms-2">Client</span>
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                            2
                        </span>
                        Information sur <span class="hidden sm:inline-flex sm:ms-2">les équipements</span>
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                        </svg>
                    </li>

                </ol>
                <form id="formEtape1" class="space-y-4 " method="POST" action="{{ route('post.etape1') }}">
                    @csrf
                    <h3 class="mb-4 text-lg font-medium leading-none text-gray-900 dark:text-white">Détail du client
                    </h3>

                    <div>

{{--                         <select
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                            name="client_id" id="client">
                            <option value="Default">Choissir le numéro</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->phone }}</option>
                            @endforeach
                        </select> --}}

                        <div>
                            <label for="client"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Client</label>
                            <input value="{{ old('client_id')}}"
                              onchange="onChainge()" list="clients" type="text" name="client_id" id="client"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                                placeholder="nom" required="">
                                <x-input-error :messages="$errors->get('client_id')" class="mt-2" />

                                <datalist id="clients">
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name.' '.$client->firstname }}</option>
                                    @endforeach


                                </datalist>
                        </div>

                    </div>
                    <div class="grid gap-5 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="username"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                            <input disabled type="text" name="username" id="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                                placeholder="nom" required="">
                        </div>
                        <div>
                            <label for="Prenom"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prenom</label>
                            <input disabled type="text" name="Prenom" id="Prenom"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                                required="">
                        </div>

                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input disabled type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                                placeholder="email@.com" required="">
                        </div>

                        <div>
                            <label for="address"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse</label>
                            <input disabled type="text" name="address" id="address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                                required="">
                        </div>

                    </div>

                    <button id="btnEtape1" type="button"
                        class="text-white bg-emerald-500 mt-2 hover:bg-emerald-600 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-md md:text-lg px-5 py-2.5 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800">
                        Prochaine étape
                    </button>

                </form>
            </div>
        </div>
    </div>


    <script>


        const id = document.getElementById('client').value
        const selectClient = document.getElementById('client')
        const btnEtap1 = document.getElementById('btnEtape1')
        if (selectClient.value.length==0) {
        btnEtap1.classList.add('invisible')
        }else{
                btnEtap1.classList.remove('invisible')
        }



        //Fonction pour remplire automatiquement le formulaire
        function onChainge() {
            const id = document.getElementById('client').value
            const selectClient = document.getElementById('client')
            const btnEtap1 = document.getElementById('btnEtape1')
            if (selectClient.value.length===0) {
            btnEtap1.classList.add('invisible')
            }else{
                    btnEtap1.classList.remove('invisible')
            }

            if (id=='') {
                document.getElementById('username').value = ''
                    document.getElementById('Prenom').value =''
                    document.getElementById('address').value =''
                    document.getElementById('email').value =''


            }
            if (id!='') {
                fetch('/voir/client/' + id)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('La réponse du réseau n\'était pas correcte');
                    }
                    return response.json();
                })
                .then(data => {

                    document.getElementById('username').value = data.name
                    document.getElementById('Prenom').value = data.firstname
                    document.getElementById('email').value = data.email
                    document.getElementById('address').value = data.address
                })
                .catch(error => {
                    console.error('Il y a eu un problème avec l\'opération fetch:', error);
                });


        }
            }

        let etap1 = document.getElementById('etape1')
        btn = document.getElementById('btnEtape1')


        btn.addEventListener('click', () => {

            etap1.classList.add('animate__animated', 'animate__fadeOutLeft' ,'animate__slow');
            setTimeout(() => {
                document.getElementById('formEtape1').submit()

            }, 500);


        })


    </script>




</x-app-layout>
