<x-filament::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <button type="submit" class="mt-10 bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
            ذخیره
        </button>
    </form>
</x-filament::page>
