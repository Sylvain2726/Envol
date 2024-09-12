<x-app-layout>
    <x-slot name="header">
        <span class=" animate__animated animate__bounce text-5xl"
            id="title">{{ __('Gestion des utilisateurs ') }}</span>
    </x-slot>
    @if (session('success'))
    <div id="toast-success"
        class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
        role="alert">
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-md font-bold">{{ session('success') }}.</div>
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
            data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
@endif

    <div class="overflow-x-auto  min-w-full rounded-lg shadow shadow-black">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 text-md font-bold tracking-wider text-center text-gray-900 uppercase bg-emerald-500 border-b-2 border-gray-200">
                        Nom
                    </th>
                    <th
                        class="px-5 py-3 text-md font-bold tracking-wider text-center text-gray-900 uppercase bg-emerald-500 border-b-2 border-gray-200">
                        Email
                    </th>

                    <th
                    class="px-5 py-3 text-md font-bold tracking-wider text-center text-gray-900 uppercase bg-emerald-500 border-b-2 border-gray-200">
                        Rôle
                    </th>
                    <th
                        class="px-5 py-3 text-md font-bold tracking-wider text-center text-gray-900 uppercase bg-emerald-500 border-b-2 border-gray-200">
                        Statut
                    </th>
                    <th
                        class="px-5 py-3 text-md font-bold tracking-wider text-center text-gray-900 uppercase bg-emerald-500 border-b-2 border-gray-200">
                        Actions
                    </th>



                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @php/** @var \App\Models\User $user */@endphp
                    <tr>
                        <td class="px-5 py-3 text-lg text-center bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $user->name }}</p>
                        </td>
                        <td class="px-5 py-3 text-lg text-center bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $user->email }}</p>
                        </td>
                        <td class="px-5 py-3 text-lg text-center bg-white border-b border-gray-200">

                            <p class="text-gray-900 whitespace-no-wrap">
                                @foreach ($user->roles as $role)
                                {{ ' '.$role->name }}
                                @endforeach
                            </p>

                        </td>
                        <td class="px-5 py-3 text-lg text-center   bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap flex justify-center items-center"><span
                                    class="{{ $user->status == true ? ' shadow-lg shadow-green-500/50 flex w-4 h-4 me-3 bg-gradient-to-r from-green-400 via-green-500 to-green-600  rounded-full' : 'flex w-4 h-4 me-3 bg-gradient-to-r from-red-400 via-red-500 to-red-600 shadow-lg shadow-red-500/50 rounded-full' }}"></span>
                                   <span class="{{ $user->status == true ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">{{ $user->status == true ? 'Connecter' : 'Deconnecter' }}</span>
                            </p>
                        </td>
                        <td class="px-5 py-4 text-md text-center bg-white border-b border-gray-200">
                            <button id="dropdownMenuIconButton-{{ $user->id }}"
                                data-dropdown-toggle="dropdownDots-{{ $user->id }}"
                                class="inline-flex items-center p-2 text-md font-extrabold text-center transition-all duration-700 text-black bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                type="button">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 4 15">
                                    <path
                                        d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                </svg>
                            </button>
                        </td>

                    </tr>
                    <div id="dropdownDots-{{ $user->id }}" tabindex="-1"
                        class="z-10 hidden bg-gray-200 divide-y divide-gray-300 rounded-lg shadow  dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-md text-gray-700 dark:text-gray-200 "
                            aria-labelledby="dropdownMenuIconButton">

                            <li>
                                <button data-modal-target="user-modal-{{ $user->id }}" data-modal-toggle="user-modal-{{ $user->id }}" class="block px-4 w-full  text-gray-600 font-semibold text-left py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                    Assigner un rôle
                                </button>
                            </li>
                            <li>
                                <button data-modal-target="retirerRole-modal-{{ $user->id }}" data-modal-toggle="retirerRole-modal-{{ $user->id }}" class="block px-4 w-full  text-gray-600 font-semibold text-left py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                    Retirer un rôle
                                </button>
                            </li>

                            <li>
                                <form id="supprimer-{{ $user->id }}" method="post"
                                    action="{{ route('users.delete', ['user' => $user]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button data-modal-target="popup-modal-{{ $user->id }}"
                                        data-modal-toggle="popup-modal-{{ $user->id }}" type="button"
                                        class="block px-4 w-full  text-red-500 font-semibold text-left py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Supprimer
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div id="retirerRole-modal-{{ $user->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center min-w-2xl items-center  md:inset-0 h-[calc(100%-1rem)] ">

                        <div class="relative p-4 w-full max-w-lg max-h-full">
                            <!-- Modal content -->
                            <div class=" bg-slate-100 shadow-lg shadow-black   rounded-lg  dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Retirer des permssions au role {{ $role->name }}
                                    </h3>
                                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="retirerRole-modal-{{ $user->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-2 md:p-5">
                                    <form  class="space-y-4" action="{{ route('user.retirerRole', ['user' => $user]) }}" method="POST">
                                      @csrf
                                        <div class="block w-full">
                                            <label for="name" class="block mb-2  font-medium text-gray-600 w-full">Rôles</label>
                                            <select multiple id="name" name="name[]" class=" text-lg text-md text-gray-600  rounded-lg block w-full py-5 px-2  focus:outline-none">
                                                <option value="">Selection les rôles à retirer</option>
                                                @foreach ($user->roles as $role)
                                                    <option class="text-2xl" value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit"  class="w-full text-white bg-red-700  hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800">Retirer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="user-modal-{{ $user->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center min-w-2xl items-center  md:inset-0 h-[calc(100%-1rem)] ">

                        <div class="relative p-4 w-full max-w-lg max-h-full">
                            <!-- Modal content -->
                            <div class=" bg-slate-100 shadow-lg shadow-black   rounded-lg  dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Assignation de rôle
                                    </h3>
                                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="user-modal-{{ $user->id}}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-2 md:p-5">
                                    <form  class="space-y-4" action="{{ route('user.assignerRole' , $user) }}" method="POST">
                                      @csrf
                                        <div class="block w-full">
                                            <label for="name" class="block mb-2  font-medium text-gray-600 w-full">Rôle</label>
                                            <select multiple id="name" name="name[]" class=" text-lg text-md text-gray-600  rounded-lg block w-full py-5 px-2  focus:outline-none">
                                                <option value="">Selection les rôle à ajouter</option>
                                                @foreach ($roles as $role)
                                                <option class="text-2xl" value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                            </select>
                                            </div>
                                        <button type="submit"  class="w-full text-white bg-emerald-700  hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800">Ajouter</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="popup-modal-{{ $user->id }}" tabindex="-1"
                        class="hidden overflow-y-auto transition duration-700 overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-zinc-100 rounded-lg shadow dark:bg-gray-700">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="popup-modal-{{ $user->id }}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Vous ête sûr
                                        de supprimer cet équipement ?</h3>
                                    <button id="{{ $role->id }}" type="submit" form="supprimer-{{ $user->id }}"
                                        class="confirm-delete text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Oui
                                    </button>
                                    <button data-modal-hide="popup-modal-{{ $user->id }}" type="button"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-emerald-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>
        </table>
        <div class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">
            {{ $users->links() }}
        </div>
    </div>

    <script>
        const btn = document.getElementById("title")
        setInterval(() => {
            btn.classList.add('animate-pulse')
            setTimeout(() => {
                btn.classList.remove('animate-pulse')
            }, 1700);
        }, 5000);
    </script>


</x-app-layout>
