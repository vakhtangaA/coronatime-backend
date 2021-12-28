<div>
  <div class="flex items-center justify-between m-auto my-6 width90">
    <a href="{{ route('dashboard', app()->getLocale()) }}">
      <img src="{{ asset('images/logo.png') }}" />
    </a>
    @if ($showNavbar)
      <nav class="flex"
           x-data="{open: false}">
        <div x-data="{show: false}"
             class="relative flex items-center justify-center">
          <span @click="show = !show"
                class="cursor-pointer">
            @if (app()->getLocale() === 'en')
              English
            @else
              ქართული
            @endif
          </span>
          <div @click="show = !show">
            <x-svgs.downArrow />
          </div>

          <div x-show="show"
               @click.away="show = false"
               class="absolute p-2 px-4 bg-white border border-gray-200 rounded-md shadow-xl top-8">
            <a class="inline-block text-xs font-semibold leading-5 text-gray-600 hover:underline"
               href="{{ route(Route::currentRouteName(), 'en') }}">
              {{ __('English') }}
            </a>
            <a class="inline-block text-xs font-semibold leading-5 text-gray-600 hover:underline"
               href="{{ route(Route::currentRouteName(), 'ka') }}">
              {{ __('Georgian') }}
            </a>
          </div>
        </div>
        <img class="ml-6 md:hidden"
             @click="open = ! open"
             src="{{ asset('images/burger.png') }}" />
        @auth
          <span
                class="hidden pr-4 ml-10 mr-2 font-bold border-r border-gray-300 md:inline-block">{{ auth()->user()->name }}</span>
          <form action='{{ route('logout', app()->getLocale()) }}'
                method="POST"
                class="hidden md:block">
            @csrf
            <button type="submit">
              {{ __('Log Out') }}
            </button>
          </form>
        @endauth
        @guest
          <ul class="hidden ml-10 md:flex">
            <li class="mr-4 font-semibold underline">
              <a href="{{ route('login', app()->getLocale()) }}">
                {{ __('login') }}
              </a>
            </li>
            <li class="font-semibold underline">
              <a href="{{ route('register', app()->getLocale()) }}">
                {{ __('register') }}
              </a>
            </li>
          </ul>
        @endguest
        <ul x-show="open"
            style="display: none"
            @click.away="open = false"
            class="absolute z-10 p-3 bg-white border border-gray-100 rounded-lg shadow-lg right-3 top-16 h-28 w-28">
          @auth
            <li>
              <form action='{{ route('logout', app()->getLocale()) }}'
                    method="POST"
                    class="md:block">
                @csrf
                <button type="submit"
                        class="text-red-400 hover:text-red-500">
                  {{ __('Log Out') }}
                </button>
              </form>
            </li>
          @endauth
          @guest
            <li class="font-semibold ">
              <a href="{{ route('register', app()->getLocale()) }}"
                 class="hover:underline {{ app()->getLocale() === 'ka' ? 'text-xs' : '' }}">
                {{ __('login') }}
              </a>
            </li>
            <li class="font-semibold ">
              <a class="hover:underline {{ app()->getLocale() === 'ka' ? 'text-xs' : '' }}"
                 href="{{ route('register', app()->getLocale()) }}">
                {{ __('register') }}
              </a>
            </li>
          @endguest
        </ul>
      </nav>
    @endif
  </div>
  <hr class="bg-slate-500">
  {{ $slot }}
</div>
