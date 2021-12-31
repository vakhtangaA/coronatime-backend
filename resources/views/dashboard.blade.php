@component('layout')
  @component('logoLayout', ['showNavbar' => true])
    <div x-data="{component: $persist('worldwide')}"
         x-cloak
         class="flex flex-col items-center py-4 md:px-12">
      <div class="flex flex-col items-center justify-between 2xl:max-h-max-w-10xl"
           :class="component === 'worldwide' ? 'width90' : 'w-full lg:width90'">
        <div class="self-center width90">
          <h1 class="text-xl font-black leading-6 lg:text-2xl lg:mt-8"
              x-show="component === 'worldwide'"
              style="display: none">
            {{ __('Worldwide Statistics') }}
          </h1>
          <h1 class="text-xl font-black leading-6 lg:text-2xl lg:mt-8"
              x-show="component === 'byCountry'"
              style="display: none">
            {{ __('Statistics By Country') }}
          </h1>
          <nav class="w-full mt-6 lg:my-12 hrLine"
               :class="component === 'worldwide' ? 'my-4' : ''">
            <ul class="flex justify-between w-48">
              <li @click="component = 'worldwide'"
                  class="pb-4 cursor-pointer"
                  :class="component === 'worldwide' ? 'font-bold border-b-4 border-gray-800' : ''">
                {{ __('Dashboard') }}
              </li>
              <li @click="component = 'byCountry'"
                  class="pb-4 cursor-pointer"
                  :class="
                  component==='byCountry'
                  ? 'font-bold border-b-4 border-gray-800'
                  : ''">
                {{ __('By country') }}
              </li>
            </ul>
          </nav>
        </div>
        <div x-show="component === 'byCountry'"
             class="self-center w-full text-center sm:width90"
             style="display: none">
          @livewire('components.by-country')
        </div>
        <div x-show="component === 'worldwide'"
             class="w-full">
          <x-worldwide :statistics="$statistics" />
        </div>
      </div>
    </div>
  @endcomponent
@endcomponent
