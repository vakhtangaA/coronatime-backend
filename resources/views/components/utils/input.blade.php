<div>
  <label class="block font-bold"
         for="{{ $identifier }}">{{ $label }}</label>
  <input class="my-2 block border border-gray-300 focus:outline-none p-4 w-full h-14 rounded-lg"
         type="{{ $type }}"
         id="{{ $identifier }}"
         wire:model="{{ $identifier }}"
         name="{{ $identifier }}"
         value="{{ $type === 'password' ?: old($identifier) }}"
         placeholder="{{ $placeholder }}">
</div>
