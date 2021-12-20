@component('layout')
  <div class="flex flex-col items-center h-full justify-around"
       style="margin-top: 4rem; text-align: center">
    <img src="{{ asset('images/logo.png') }}" />
    <div class="flex flex-col items-center"
         style="margin-top: 40%">
      <img src="{{ asset('images/icons8-checked 1.png') }}" />
      <p style="margin-top: 1rem">
        We have sent you a confirmation email
      </p>
    </div>
  </div>
@endcomponent
