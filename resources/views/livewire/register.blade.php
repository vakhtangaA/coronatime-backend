<div class="lg:flex justify-between">
  <div class="py-8 px-4 md:flex md:flex-col lg:flex-1 md:items-start md:pl-32  lg:w-3/5">
    <div class="md:w-1/2">
      <img src="{{ asset('images/logo.png') }}"
           class="mb-8" />
      <h2 class="text-xl font-black leading-6 mb-2">Welcome to Coronatime
      </h2>
      <p class="text-gray-400 mb-4">Please enter required info to sign up</p>
      <form>

        <livewire:components.input label="Username"
                                   placeholder="Enter unique username"
                                   identifier="name" />
        <livewire:components.input label="Email"
                                   placeholder="Enter your email"
                                   identifier="mail" />
        <livewire:components.input label="Password"
                                   placeholder="Fill in password"
                                   identifier="password" />
        <livewire:components.input label="Repeat Password"
                                   placeholder="Repeat Password"
                                   identifier="repeat_password" />

        <div class="flex items-center">
          <input type="checkbox"
                 id="remember_device"
                 name="remember_device"
                 class="w-5 h-5 outline-none border-none mr-3">

          <label for="remember_device"
                 class="font-semibold text-sm my-2">Remember this device</label>
        </div>
        <button class="block bg-btnColor w-full p-4 my-6 text-white font-black rounded-lg">
          SIGN UP
        </button>

        <p class="text-gray-400 text-center">
          Already have an account?
          <a href="login"
             class="text-black font-bold">Log in</a>
        </p>

      </form>
    </div>
  </div>
  <div class="hidden lg:block lg:w-2/5 h-full">
    <img src="{{ asset('images/covidvaccinces.png') }}"
         class="min-h-screen max-h-screen w-full" />
  </div>
</div>
