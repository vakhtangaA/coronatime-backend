<div>
  <label class="block font-bold"
         for="{{ $identifier }}">
    {{ __($label) }}
  </label>
  <div class="relative">
    <input class="block w-full p-4 my-2 border  rounded-lg focus:outline-none h-14
    @if ($text)
        @error($identifier) border-red-400
        @else border-green-400
        @enderror
    @else border-gray-300
    @endif
    "
           type="{{ $type }}"
           id="{{ $identifier }}"
           wire:model="{{ $identifier }}"
           name="{{ $identifier }}"
           value="{{ $type !== 'password' ? old($identifier) : '' }}"
           placeholder="{{ __($placeholder) }}">
    @if ($text and !$errors->has($identifier))
      <img src={{ asset('images/roundedChecked.svg') }}
           class="absolute right-6 top-4" />
    @endif
  </div>
</div>
