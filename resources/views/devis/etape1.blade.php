<x-app-layout>







    <div id="etape1" class="flex justify-center   items-start h-screen ">

        <div class="bg-white w-full md:w-2/3  overflow-hidden shadow-sm shadow-black rounded-2xl animate__animated animate__fadeInLeftBig animate__slower">
            {{--             <div class="flex justify-center items-center">
                <div class="text-2xl md:text-4xl italic bg-emerald-400 rounded-xl px-2 text-center mt-8 ">
                    {{ __('Ajout d\'un nouveau client') }}</div>
            </div> --}}


            <div class="p-6 border-b  border-gray-200">

                <ol
                    class="flex items-center justify-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                    <li class="flex items-center text-blue-600 dark:text-blue-500">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
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
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="client_id" id="client">
                            <option value="Default">Choissir le numéro</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->phone }}</option>
                            @endforeach
                        </select> --}}

                        <div>
                            <label for="client"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Client</label>
                            <input value="{{ old('client_id')}}
                             {{ session('client_id') }}" onchange="onChainge()" list="clients" type="text" name="client_id" id="client"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
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
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="nom" required="">
                        </div>
                        <div>
                            <label for="Prenom"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prenom</label>
                            <input disabled type="text" name="Prenom" id="Prenom"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required="">
                        </div>

                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input disabled type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="email@.com" required="">
                        </div>

                        <div>
                            <label for="address"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse</label>
                            <input disabled type="text" name="address" id="address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required="">
                        </div>

                    </div>

                    <button id="btnEtape1" type="button"
                        class="text-white bg-blue-700 mt-2 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Prochaine étape
                    </button>

                </form>
            </div>
        </div>
    </div>


    <script>
        //Fonction pour remplire automatiquement le formulaire
        function onChainge() {
            const id = document.getElementById('client').value

            if (!id) {
                document.getElementById('username').value = ''
                    document.getElementById('Prenom').value =''
                    document.getElementById('address').value =''


            }
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
        let etap1 = document.getElementById('etape1')
        btn = document.getElementById('btnEtape1')


        btn.addEventListener('click', () => {

            etap1.classList.add('animate__animated', 'animate__fadeOutLeft' ,'animate__slow');
            setTimeout(() => {
                document.getElementById('formEtape1').submit()

            }, 500);


        })

        document.addEventListener('DOMContentLoaded', () => {
        document.innerHTML = `
        <div role="status">
            <svg aria-hidden="true" class="inline w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            <span class="sr-only">Loading...</span>
        </div>`

        })
    </script>




</x-app-layout>
