<div class="flex flex-col items-center justify-start h-screen">
  <img src="{{ asset('images/logo.png') }}"
       class="self-start mt-4 ml-6 md:mt-12 md:ml-0 md:self-center" />


  <div class="flex flex-col items-center self-center w-full max-w-lg px-4 mt-36 md:w-2/5">
    <h2 class="mb-16 text-3xl font-extrabold">
      {{ __('Reset Password') }}
    </h2>
    <form wire:submit.prevent='submit'
          {{-- action="{{ route('password.update', app()->getLocale()) }}" --}}
          class="w-full"
          method="POST">
      @csrf

      <div class="mb-10">
        <x-utils.input label="Password"
                       placeholder="Fill in password"
                       identifier="password"
                       type="password"
                       :text="$password" />
        @error('password')
          {{-- this if statement does,
               that password confirmation message is shown under repeat password input,
               not the actual password input --}}
          @if ($message !== 'The password confirmation does not match.' && $message !== 'პაროლი არ ემთხვევა')
            <x-utils.error :message="$message" />
          @endif
        @enderror
      </div>
      <div class="mb-10">
        <x-utils.input label="Repeat Password"
                       placeholder="Repeat Password"
                       identifier="password_confirmation"
                       type="password"
                       :text="$password_confirmation" />
        @error('password_confirmation')
          <x-utils.error :message="$message" />
        @enderror
      </div>
      <input name="email"
             wire:model='email'
             class="hidden"
             id="email"
             value={{ $email }} />
      <input name="token"
             wire:model='token'
             class="hidden"
             id="token"
             value={{ $token }} />

      <div>
      </div>
      <button type="submit"
              class="block w-full p-4 my-6 font-black text-white rounded-lg bg-btnColor">
        {{ __('SAVE CHANGES') }}
      </button>
    </form>

  </div>
</div>
