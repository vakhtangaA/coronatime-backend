@component('layout')
  <div class="flex flex-col items-center justify-around h-screen">
    <img src="{{ asset('images/logo.png') }}"
         class="self-start mt-4 ml-6 md:mt-12 md:ml-0 md:self-center" />
    <div class="flex flex-col items-center m-auto">
      <img src="{{ asset('images/icons8-checked 1.png') }}" />
      <p>
        {{ __('We have sent you a confirmation email') }}
      </p>
    </div>
  </div>
@endcomponent
