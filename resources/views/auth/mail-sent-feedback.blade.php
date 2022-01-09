@component('layout')
  <div class="flex flex-col items-center min-h-screen">
    <img src="{{ asset('images/logo.png') }}"
         class="self-start mt-4 ml-6 md:mt-12 md:ml-0 md:self-center" />
    <div class="flex flex-col items-center justify-center  @if ($button) grow @else m-auto @endif">
      <img src="{{ asset('images/icons8-checked 1.png') }}"
           class="mt-auto md:mt-0" />
      <p class="px-4 mt-6 text-center">
        {{ __($text) }}
      </p>
      @if ($button)
        <form action="{{ route('verification.send', app()->getLocale()) }}"
              method="POST"
              class="flex flex-col items-center w-full mt-auto md:mt-0">
          @csrf
          <button class="block w-4/5 p-4 my-12 font-black text-white rounded-lg sm:w-full lg:mt-24 bg-btnColor">
            {{ __('SEND AGAIN') }}
          </button>
        </form>
      @endif
    </div>
  </div>
@endcomponent
