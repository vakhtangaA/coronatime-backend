@component('layout')
  @component('logoLayout', ['showNavbar' => true])
    <div x-data="{component: 'worldwide' }"
         class="flex flex-col items-center py-4 md:px-12">
      <div class="flex flex-col items-center justify-between width90">
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
        <div class="w-screen md:width90"
             x-show="component === 'byCountry'">
          @livewire('components.by-country')
        </div>
        <x-worldwide />
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
