@component('layout')
  <div class="flex flex-col items-center justify-around h-screen">
    <img src="{{ asset('images/logo.png') }}"
         class="self-start mt-4 ml-6 md:mt-12 md:ml-0 md:self-center" />
    <div class="flex flex-col items-center m-auto">
      <img src="{{ asset('images/icons8-checked 1.png') }}" />
      <p class="px-4 text-center ">
        {{ __($text) }}
      </p>
      <a class="block w-full"
         href="{{ route('afterVerify', app()->getLocale()) }}">
        <button class="block w-full p-4 mt-12 font-black text-white rounded-lg lg:mt-24 bg-btnColor">
          {{ __('LOG IN') }}
        </button>
      </a>
    </div>
  </div>
@endcomponent
