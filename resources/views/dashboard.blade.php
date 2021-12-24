@component('layout')
  @component('logoLayout', ['showNavbar' => true])
    <div x-data="{component: 'worldwide' }"
         x-cloak
         class="flex flex-col items-center py-4 md:px-12">
      <div class="flex flex-col items-center justify-between width90 2xl:max-h-max-w-10xl">
        <div class="self-start w-full">
          <h1 class="text-xl font-black leading-6 lg:text-2xl lg:mt-8"
              x-text="component === 'worldwide' ? ' Worldwide Statistics' : 'Statistics By Country'">
          </h1>
          <nav class="w-full mt-6 lg:my-12 hrLine"
               :class="component === 'worldwide' ? 'my-4' : ''">
            <ul class="flex justify-between w-48">
              <li @click="component = 'worldwide'"
                  class="pb-4 cursor-pointer"
                  :class="component === 'worldwide' ? 'font-bold border-b-4 border-gray-800' : ''">
                Worldwide
              </li>
              <li @click="component = 'byCountry'"
                  class="pb-4 cursor-pointer"
                  :class="
                  component==='byCountry'
                  ? 'font-bold border-b-4 border-gray-800'
                  : ''">
                By country
              </li>
            </ul>
          </nav>
        </div>
        <div class="w-full md:width90"
             x-show="component === 'byCountry'">
          @livewire('components.by-country')
        </div>
        <div x-show="component === 'worldwide'"
             class="w-full">
          <x-worldwide />
        </div>
      </div>
    </div>
  @endcomponent
@endcomponent

<script>
  let width = screen.width;
  let elem = document.getElementById('imageParent');

  alert
  if (width > 768) {
    elem.replaceWith(...elem.childNodes);
  }
</script>
