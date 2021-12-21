<div>
  <div class="flex items-center justify-between my-6  width90 m-auto">
    <a href="{{ route('dashboard') }}">
      <img src="{{ asset('images/logo.png') }}" />
    </a>
    @if ($showNavbar)
      <nav class="flex"
           x-data="{open: false}">
        <select name="choice"
                class="bg-white w-24 md:mr-5">
          <option value="english">English</option>
          <option value="georgian">Georgian</option>
        </select>
        <img class="ml-6 md:hidden"
             @click="open = ! open"
             src="{{ asset('images/burger.png') }}" />
        @auth
          <span
                class="font-bold ml-10 mr-2 hidden md:inline-block pr-4  border-r border-gray-300">{{ auth()->user()->name }}</span>
          <form action='{{ route('logout') }}'
                method="POST"
                class="hidden md:block">
            @csrf
            <button type="submit">Log Out</button>
          </form>
        @endauth
        @guest
          <ul class="md:flex ml-10 hidden">
            <li class="mr-4 font-semibold underline">
              <a href="{{ route('login') }}">login</a>
            </li>
            <li class="font-semibold underline">
              <a href="{{ route('register') }}">register</a>
            </li>
          </ul>
        @endguest
        <ul x-show="open"
            style="display: none"
            @click.away="open = false"
            class="absolute right-3 z-10 top-16 p-3 bg-white shadow-lg border border-gray-100 rounded-lg">
          @auth
            <li>
              <form action='{{ route('logout') }}'
                    method="POST"
                    class="md:block">
                @csrf
                <button type="submit"
                        class="text-red-400 hover:text-red-500">Log Out</button>
              </form>
            </li>
          @endauth
          @guest
            <li class="underline font-semibold">
              <a href="{{ route('register') }}">login</a>
            </li>
            <li class="underline font-semibold">
              <a href="{{ route('register') }}">register</a>
            </li>
          @endguest
        </ul>
      </nav>
    @endif
  </div>
  <hr class="bg-slate-500">
  {{ $slot }}
</div>
