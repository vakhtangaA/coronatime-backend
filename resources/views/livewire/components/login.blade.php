<div class="justify-between lg:flex">
  <div class="px-4 py-8 md:flex md:flex-col lg:flex-1 md:items-center lg:items-start lg:pl-32 lg:w-3/5">
    <div class="max-w-lg lg:w-3/5 sm:w-3/4 sm:m-auto lg:m-0">
      <a href="{{ route('dashboard', app()->getLocale()) }}">
        <img src="{{ asset('images/logo.png') }}"
             class="mb-8" />
      </a>
      <h2 class="mb-2 text-xl font-black leading-6">
        {{ __('Welcome back') }}
      </h2>
      <p class="mb-4 text-gray-400">
        {{ __('Please enter required info to sign up') }}
      </p>
      <form wire:submit.prevent="submit">
        @csrf

        <div class="mb-10">
          <x-utils.input label="Username"
                         placeholder="Enter unique username"
                         identifier="name"
                         type="text" />
          @error('name')
            <x-utils.error :message="$message" />
          @enderror
        </div>
        <div class="mb-10">
          <x-utils.input label="Password"
                         placeholder="Fill in password"
                         identifier="password"
                         type="password" />
          @error('password')
            <x-utils.error :message="$message" />
          @enderror
        </div>
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input type="checkbox"
                   id="remember_device"
                   name="remember_device"
                   class="w-5 h-5 mr-3 border-none outline-none">

            <label for="remember_device"
                   class="my-2 text-sm font-semibold">
              {{ __('Remember this device') }}
            </label>
          </div>

          <a class="font-semibold text-blue-600">
            {{ __('Forgot password?') }}
          </a>
        </div>
        <button class="block w-full p-4 my-6 font-black text-white rounded-lg bg-btnColor">
          {{ __('LOG IN') }}
        </button>

        <p class="text-center text-gray-400">
          {{ __("Don't have an account?") }}
          <a href="{{ route('register', app()->getLocale()) }}"
             class="font-bold text-black hover:underline">
            {{ __('Sign up for free') }}</a>
        </p>
      </form>
    </div>
  </div>
  <div class="hidden h-full lg:block lg:w-2/5">
    <img src="{{ asset('images/covidvaccinces.png') }}"
         class="w-full max-h-screen min-h-screen" />
  </div>
</div>
