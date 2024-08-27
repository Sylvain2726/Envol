<x-app-layout>


    <span class="sr-only">Loading...</span>
    </div>

    <div id="etape2affichage"
        class="flex justify-center items-start h-screen animate__animated mx-4 mb animate__fadeInRight animate__slow">

        <div class="bg-white w-full md:w-2/3  overflow-hidden shadow-sm shadow-black  rounded-xl ">

            <div class="p-6 border-b  border-gray-200">
                <ol
                    class="flex items-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                    <li class="flex items-center ">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                            1
                        </span>
                        <a href="{{ route('devis.create') }}">Infomation du <span
                                class="hidden sm:inline-flex sm:ms-2">Client</span></a>
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                        </svg>
                    </li>
                    <li class="flex items-center text-blue-600 dark:text-blue-500">
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

                <form class="space-y-5 " method="POST" action="{{ route('post.etape2') }}">
                    @csrf


                    <div>
                        <button onclick="displayForm()" type="button"
                            class="text-white bg-blue-700  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 mx-2 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Ajouter un equipement
                        </button>

                    </div>


                    <div id="div">
                        <div id="equipementDiv" class="space-y-9 animate__animated animate__fadeInRightBig ">
                            <label for="phone"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Equipement</label>
                            <select onchange="formEquipment1()"
                                class="change bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="equipements[0][equipement_id]" id="equipementSelect">
                                <option value="default">Choisir un équipement</option>
                                @foreach ($equipements as $equipement)
                                    @foreach ($equipement->items as $item )
                                        <option value="{{ $item->id }}">{{ $equipement->name.' | Numéro entrée : '. $item->entree_id . ' | Salle : '. $item->salle?->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>

                            <div>
                                <label for="quantite"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantité</label>
                                <input type="number" name="equipements[0][quantite]" id="quantite"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Quantité" required="">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                {{--  <div>
                                    <label for="Aprice"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix
                                        d'achat</label>
                                    <input disabled type="text" name="Aprice" id="Aprice"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Prix d'achat" required="">
                                </div> --}}

                                <div>
                                    <label for="VPrice"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix de
                                        vente</label>
                                    <input disabled type="text" name="VPrice" id="VPrice"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Prix de vente" required="">
                                </div>

                                <div>
                                    <label for="stock"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantité en
                                        stock</label>
                                    <input disabled type="number" name="stock" id="stock"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Quantité en stock" required="">
                                </div>

                                <div>
                                    <label for="type"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                    <input disabled type="text" name="type" id="type"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Type de l'équipement" required="">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="px-6">
                        <a id="btnRetoure" href="{{ url()->previous() }}">Retoure</a>
                        <button type="submit"
                            class="text-white bg-blue-700 mt-2 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 m-2 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Prochaine étape
                        </button>

                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        const qte = document.querySelector('#quantite')
        let quantite
        function formEquipment1() {
            const selectElement = document.getElementById('equipementSelect');
            const id = selectElement.value;
            console.log(id);

            let somme = 0
            let stock

            const form = selectElement.closest('.space-y-9');
             // Récupère le formulaire actuel

            if (id == 'default') {
                document.querySelector('#Aprice').value = ' ';
                document.querySelector('#VPrice').value = ' ';
                document.querySelector('#type').value = ' ';
                document.querySelector('#stock').value = ' ';
                return
                }
                fetch('/voir/equipement/' + id)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('La réponse du réseau n\'était pas correcte');
                        }
                        return response.json();
                    })
                    .then(data => {
                           data.items.forEach((item) => {
                               if(item.id==id){
                                 stock = item.quantite
                               }
                           })
                            document.querySelector('#VPrice').value = data.VPrice;
                            document.querySelector('#stock').value = stock;
                            document.querySelector('#type').value = data.type;

                            qte.addEventListener('change', () => {

                                quantite = document.querySelector('#quantite').value = qte.value;

                                if (quantite > data.stock) {
                                    let alerte = document.querySelector('#alert-2')

                                    alerte.classList.remove('invisible')
                                }
                            });
                        }
                    )
                    .catch(error => {
                        console.error('Il y a eu un problème avec l\'opération fetch:', error);
                    });
        };
        function formEquipment(event) {
            const selectElement = event.target;
            const id = selectElement.value;
            const form = selectElement.closest('.space-y-9'); // Récupère le formulaire actuel
            let somme = 0
            let stock

            if (id === 'default') {
                form.querySelector('[name="Aprice"]').value = '';
                form.querySelector('[name="VPrice"]').value = '';
                form.querySelector('[name="stock"]').value = '';
                form.querySelector('[name="type"]').value = '';
            } else {
                fetch('/voir/equipement/' + id)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('La réponse du réseau n\'était pas correcte');
                        }
                        return response.json();
                    })
                    .then(data => {
                        data.items.forEach((item) => {
                               if(item.id==id){
                                 stock = item.quantite
                               }
                           })
                        //form.querySelector('[name="Aprice"]').value = data.APrice;
                        form.querySelector('[name="VPrice"]').value = data.VPrice;
                        form.querySelector('[name="stock"]').value = stock
                        form.querySelector('[name="type"]').value = data.type;
                    })
                    .catch(error => {
                        console.error('Il y a eu un problème avec l\'opération de recupération:', error);
                    });
            }
        }

        let i = 1;

        const div = document.getElementById('div');
        let lastItem

        function displayForm() {
            const div1 = document.createElement('div');
            const equipementDiv = document.getElementById('equipementDiv');
            equipementDiv.classList.add('hidden')
            div1.innerHTML = `
                        <div class="space-y-9 animate__animated animate__fadeInRightBig ">
                            <label for="phone"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Equipement</label>
                            <select
                                class="change bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="equipements[${i}][equipement_id]" id="equipement">
                                <option value="default">Choisir un équipement</option>
                                @foreach ($equipements as $equipement)
                                    @foreach ($equipement->items as $item )
                                        <option value="{{ $item->id }}">{{ $equipement->name.' | Numéro entrée : '. $item->entree_id . ' | Salle : '. $item->salle?->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>

                            <div>
                                <label for="quantite"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantité</label>
                                <input type="number" name="equipements[${i}][quantite]" id="quantite"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Quantité" required="">
                            </div>



                                <div>
                                    <label for="VPrice"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix de
                                        vente</label>
                                    <input disabled type="text" name="VPrice" id="VPrice"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Prix de vente" required="">
                                </div>

                                <div>
                                    <label for="stock"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantité en
                                        stock</label>
                                    <input disabled type="number" name="stock" id="stock"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Quantité en stock" required="">
                                </div>

                                <div>
                                    <label for="type"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                    <input disabled type="text" name="type" id="type"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Type de l'équipement" required="">
                                </div>
                            </div>
                        </div>
            `;

            div.appendChild(div1);

            if (lastItem) {
                lastItem.setAttribute('hidden', 'hidden');
            }
            lastItem = div1



            // Ajoute l'événement change au nouveau select ajouté
            const newSelect = div1.querySelector('.change');
            newSelect.addEventListener('change', formEquipment);

            i++;
        }

        const animeDiv = document.getElementById('etape2affichage')
        console.log(animeDiv);

        animeDiv.classList.add('invisible')
        setTimeout(() => {

            animeDiv.classList.remove('invisible')

        }, 100);

        /*         const btnRetoure = document.getElementById('btnRetoure')
                const step2 = document.getElementById('etape2affichage')
                btnRetoure.addEventListener('click', () => {

                    step2 = document.getElementById('etape2affichage')
                    step2.classList.add('animate__animated', 'animate__fadeOutLeft' ,'animate__slow');

                }) */
    </script>
</x-app-layout>
