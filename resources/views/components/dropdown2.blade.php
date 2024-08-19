<div x-data="{ dropdownOpen: false }" class="relative">
    {{ $trigger }}

    <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

    <div x-show="dropdownOpen" class=" mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10">
        {{ $content }}
    </div>
</div>
