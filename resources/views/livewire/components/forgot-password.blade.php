<div class="flex flex-col items-center justify-start h-screen">
  <img src="{{ asset('images/logo.png') }}"
       class="self-start mt-4 ml-6 md:mt-12 md:ml-0 md:self-center" />

  <div class="flex flex-col items-center self-center w-full max-w-lg px-4 mt-36 md:w-2/5 grow">
    <h2 class="mb-16 text-3xl font-extrabold">
      {{ __('Reset Password') }}
    </h2>
    <form wire:submit.prevent="submit"
          class="flex flex-col w-full grow"
          method="POST">
      @csrf


      <div class="mb-10">
        <x-utils.input wire:model='email'
                       label="Email"
                       placeholder="Enter your email"
                       identifier="email"
                       type="email"
                       :text="$email" />
        @error('email')
          <x-utils.error :message="$message" />
        @enderror
      </div>
      <button class="block w-full p-4 mt-auto mb-12 font-black text-white rounded-lg bg-btnColor md:mt-4">
        {{ __('RESET PASSWORD') }}
      </button>
    </form>

  </div>
</div>
