<div>
  <label class="block font-bold"
         for="{{ $identifier }}">
    {{ __($label) }}
  </label>
  <input class="block w-full p-4 my-2 border border-gray-300 rounded-lg focus:outline-none h-14"
         type="{{ $type }}"
         id="{{ $identifier }}"
         wire:model="{{ $identifier }}"
         name="{{ $identifier }}"
         value="{{ $type !== 'password' ? old($identifier) : '' }}"
         placeholder="{{ __($placeholder) }}">
</div>
