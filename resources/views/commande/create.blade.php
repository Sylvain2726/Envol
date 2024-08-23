<x-app-layout>


    <span class="sr-only">Loading...</span>
    </div>

    <div id="etape2affichage"
        class="flex justify-center items-start h-screen animate__animated mx-4 mb animate__fadeInRight animate__slow">

        <div class="bg-white w-full md:w-2/3  overflow-hidden shadow-sm shadow-black  rounded-xl ">

            <div class="p-6 border-b  border-gray-200">

                <form id="form" class="space-y-5 " method="POST" action="{{ route('commande.store') }}">
                    @csrf
                    <div id="div">
                        <div id="equipementDiv" class="space-y-2 animate__animated animate__fadeInRightBig my-9 ">
                            <label for="phone"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Magasin</label>
                            <select onchange="fetchMagasin()"
                                class="change bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="salle_id" id="salle">
                                <option value="default">Choisir le magasin</option>
                                @foreach ($magasins as $magasin)
                                    @foreach ($magasin->salles as $salle)
                                        <option value="{{ $salle->id }}">{{ $magasin->name . ' ' . $salle->name }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                        <div id="equipementDiv" class="space-y-2 animate__animated animate__fadeInRightBig ">
                            <label for="equipement"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Equipement</label>
                            <select
                                class="change bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="equipement_id" id="equipement">
                                <option value="default">Choisir l'équipement</option>

                            </select>
                        </div>

                        <div class="my-5">
                            <button type="submit"
                                class="text-white shadow-sm transition duration-300 ease-in-out  shadow-black bg-emerald-500 mt-2 hover:bg-emerald-400 hover:text-black focus:ring-4 focus:outline-none focus:ring-emerald-100 font-medium rounded-lg text-sm px-5  py-2.5 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800">
                                Enregistrer
                            </button>

                        </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function fetchMagasin() {
            const selectElement = document.getElementById('salle');
            let select = document.getElementById('equipement');
            const id = selectElement.value;
            select.innerHTML = ' <option value="default">Choisir l\'équipement</option>';
            const form = selectElement.closest('.space-y-9'); // Récupère le formulaire actuel

            if (id === 'default') {
                return;
            }


            fetch('/voir/magasin/' + id)
                .then(response => {
                    if (!response.ok) {

                        throw new Error('La réponse du réseau n\'était pas correcte');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);

                    for (let i = 0; i < data.length; i++) {
                        const option = document.createElement('option');
                        option.value = data[i].id;
                        option.text = data[i].equipement.name + ' | ' + 'Numéro entrée ' + data[i].entree_id;
                        select.appendChild(option);
                    }
                })
                .catch(error => {
                    console.error('Il y a eu un problème avec l\'opération fetch:', error);
                });
        }
    </script>
</x-app-layout>
