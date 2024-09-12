<x-app-layout>




    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:gap-10 md:items-center">
            <h1 class="text-3xl md:text-5xl py-4">{{ __('Gestion des roles') }}</h1>
            <form class="py-4 " method="get" action="">
                <input
                    class="rounded-xl placeholder-emerald-500 ring ring-emerald-500 focus:ring focus:outline-none  p-2 border-none shadow-inner shadow-gray-950"
                    name="search" id="search" value="{{ $request->search ?? '' }}" placeholder="Recherche">
            </form>
            {{--             <div>
                <a id="add"
                    class="p-1 text-2xl text-white font-bold hover:shadow-xl focus:ring ring-emerald-500 transition-all duration-500 ring-offset-4 rounded bg-emerald-400 shadow-black shadow-inner"
                    href="{{ route('role.create') }}">Ajouter</a>
            </div> --}}



<!-- Modal toggle -->
<button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="p-1 text-2xl text-white font-bold hover:shadow-sm hover:shadow-black focus:ring ring-emerald-500 transition-all duration-500 ring-offset-4 rounded bg-emerald-400 shadow-black shadow-inner" type="button">
    Ajouter
  </button>

  <!-- Main modal -->
  <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Ajout de rôle
                  </h3>
                  <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5">
                  <form class="space-y-4" action="{{ route('role.store') }}" method="POST">
                    @csrf
                      <div>
                          <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom du rôle</label>
                          <input type="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Nom du rôle" required />
                      </div>
                      <button type="submit" class="w-full text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800">Ajouter</button>

                  </form>
              </div>
          </div>
      </div>
  </div>





        </div>
    </x-slot>

    @error('name')

    <div id="role-exists" class="flex items-center transition-all duration-700 w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">{{ 'Ce rôle existe déja' }}</div>

    @enderror

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

    <div class=" overflow-x-auto rounded-lg shadow-md shadow-black">
        <table class="min-w-full text-nowrap">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                        Nom
                    </th>
                    <th
                    class="px-2 py-3 text-xs font-bold tracking-wider text-left text-gray-900 uppercase bg-emerald-400/70 border-b-2 border-gray-200">
                    Action
                </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr id="ligne-{{ $role->id }}">
                        <td class="px-5 py-3 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $role->name }}</p>
                        </td>


                        <td class="px-5 py-4 text-md bg-white border-b border-gray-200">
                            <button id="dropdownMenuIconButton-{{ $role->id }}"
                                data-dropdown-toggle="dropdownDots-{{ $role->id }}"
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

                    <div id="dropdownDots-{{ $role->id }}" tabindex="-1"
                        class="z-10 hidden bg-gray-200 divide-y divide-gray-300 rounded-lg shadow  dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-md text-gray-700 dark:text-gray-200 "
                            aria-labelledby="dropdownMenuIconButton">

                            <li>
                                <button data-modal-target="authentication-modal-{{ $role->id }}" data-modal-toggle="authentication-modal-{{ $role->id }}" class="block px-4 w-full  text-gray-600 font-semibold text-left py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                    Modifier
                                  </button>

                            </li>

                            <li>
                                <button data-modal-target="permission-modal-{{ $role->id }}" data-modal-toggle="permission-modal-{{ $role->id }}" class="block px-4 w-full  text-gray-600 font-semibold text-left py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                    Ajouter des permissions
                                </button>
                            </li>
                            <li>
                                <button data-modal-target="permissionRetirer-modal-{{ $role->id }}" data-modal-toggle="permissionRetirer-modal-{{ $role->id }}" class="block px-4 w-full  text-gray-600 font-semibold text-left py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                    Retirer des permissions
                                </button>
                            </li>

                            <li>
                                <form id="supprimer-{{ $role->id }}" method="post"
                                    action="{{ route('role.destroy', ['role' => $role]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button data-modal-target="popup-modal-{{ $role->id }}"
                                        data-modal-toggle="popup-modal-{{ $role->id }}" type="button"
                                        class="block px-4 w-full  text-red-500 font-semibold text-left py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Supprimer
                                    </button>
                                </form>
                            </li>



                        </ul>
                    </div>
                    <div id="popup-modal-{{ $role->id }}" tabindex="-1"
                        class="hidden overflow-y-auto transition duration-700 overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-zinc-100 rounded-lg shadow dark:bg-gray-700">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="popup-modal-{{ $role->id }}">
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
                                    <button id="{{ $role->id }}"
                                        class="confirm-delete text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Oui
                                    </button>
                                    <button data-modal-hide="popup-modal-{{ $role->id }}" type="button"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-emerald-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="authentication-modal-{{ $role->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-slate-100 shadow-lg shadow-black   rounded-lg  dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Modification du rôle
                                    </h3>
                                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal-{{ $role->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5">
                                    <form class="space-y-4" action="{{ route('role.update' , $role) }}" method="POST">
                                      @csrf
                                        @method('PUT')
                                        <div class="mb-6">
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom du rôle</label>
                                            <input type="name" name="name" value="{{ $role->name }}" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Nom du rôle" required />
                                        </div>
                                        <button type="submit" class="w-full text-white bg-emerald-700  hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800">Ajouter</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="permission-modal-{{ $role->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center min-w-2xl items-center  md:inset-0 h-[calc(100%-1rem)] ">

                        <div class="relative p-4 w-full max-w-lg max-h-full">
                            <!-- Modal content -->
                            <div class=" bg-slate-100 shadow-lg shadow-black   rounded-lg  dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Assigner des permissions au rôle {{ $role->name }}
                                    </h3>
                                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="permission-modal-{{ $role->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-2 md:p-5">
                                    <form  class="space-y-4" action="{{ route('role.assignerPermission' , $role) }}" method="POST">
                                      @csrf
                                        <div class="block w-full">
                                            <label for="name" class="block mb-2  font-medium text-gray-600 w-full">Permissions</label>
                                            <select multiple id="name" name="name[]" class=" text-lg text-md text-gray-600  rounded-lg block w-full py-5 px-2  focus:outline-none">
                                                <option value="">Selection les permissions à ajouter</option>
                                                @foreach ($permissions as $permisdion)
                                                <option class="text-2xl" value="{{ $permisdion->name }}">{{ $permisdion->name }}</option>
                                            @endforeach
                                            </select>
                                            </div>
                                        <button type="submit"  class="w-full text-white bg-emerald-700  hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800">Ajouter</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="permissionRetirer-modal-{{ $role->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center min-w-2xl items-center  md:inset-0 h-[calc(100%-1rem)] ">

                        <div class="relative p-4 w-full max-w-lg max-h-full">
                            <!-- Modal content -->
                            <div class=" bg-slate-100 shadow-lg shadow-black   rounded-lg  dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Retirer des permssions au role {{ $role->name }}
                                    </h3>
                                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="permissionRetirer-modal-{{ $role->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-2 md:p-5">
                                    <form  class="space-y-4" action="{{ route('role.retirerPermission' ,$role) }}" method="POST">
                                      @csrf
                                        <div class="block w-full">
                                            <label for="name" class="block mb-2  font-medium text-gray-600 w-full">Permissions</label>
                                            <select multiple id="name" name="name[]" class=" text-lg text-md text-gray-600  rounded-lg block w-full py-5 px-2  focus:outline-none">
                                                <option value="">Selection les permissions à retirer</option>
                                                @foreach ($role->permissions as $permisdion)
                                                <option class="text-2xl" value="{{ $permisdion->name }}">{{ $permisdion->name }}</option>
                                            @endforeach
                                            </select>
                                            </div>
                                        <button type="submit"  class="w-full text-white bg-red-700  hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800">Retirer</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        <div class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">

        </div>
    </div>

    <script>
       const roleExists = document.getElementById('role-exists')
       setTimeout(() => {
        roleExists.classList.add('hidden')
       }, 2000);
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.confirm-delete');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('id');
                    const row = document.getElementById('ligne-' + id);
                    row.classList.add('animate__animated', 'animate__fadeOutLeft', 'animate__fast');
                    document.getElementById('supprimer-' + id).submit();
                });
            });
        });
    </script>
</x-app-layout>
