<div class="lg:flex justify-between">
  <div class="py-8 px-4 md:flex md:flex-col lg:flex-1 md:items-center lg:items-start lg:pl-32  lg:w-3/5">
    <div class="lg:w-3/5 max-w-lg sm:w-3/4 sm:m-auto lg:m-0">
      <a href="{{ route('dashboard') }}">
        <img src="{{ asset('images/logo.png') }}"
             class="mb-8" />
      </a>
      <h2 class="text-xl font-black leading-6 mb-2">Welcome back
      </h2>
      <p class="text-gray-400 mb-4">Please enter required info to sign up</p>
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
                   class="w-5 h-5 outline-none border-none mr-3">

            <label for="remember_device"
                   class="font-semibold text-sm my-2">Remember this device</label>
          </div>

          <a class="font-semibold text-blue-600">
            Forgot password?
          </a>
        </div>
        <button class="block bg-btnColor w-full p-4 my-6 text-white font-black rounded-lg">
          LOG IN
        </button>

        <p class="text-gray-400 text-center">
          Don't have an account?
          <a href="{{ route('register') }}"
             class="text-black font-bold hover:underline">Sign up for free</a>
        </p>
      </form>
    </div>
  </div>
  <div class="hidden lg:block lg:w-2/5 h-full">
    <img src="{{ asset('images/covidvaccinces.png') }}"
         class="min-h-screen max-h-screen w-full" />
  </div>
</div>
