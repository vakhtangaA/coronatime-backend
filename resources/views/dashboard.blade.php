@component('layout')
  @component('logoLayout', ['showNavbar' => true])
    <div class="py-4 md:px-12">
      <div class="flex justify-between flex-col items-center">
        <div>
          <div class="ml-4 self-start ">
            <h1 class="text-xl lg:text-2xl lg:mt-8 leading-6 font-black">
              Worldwide Statistics
            </h1>
            <nav class="my-6 lg:my-12">
              <ul class="flex w-48 justify-between">
                <li class="{{ request()->get('show') !== 'by-country' ? 'font-black' : '' }}">
                  <a href="{{ request()->fullUrlWithQuery(['show' => 'worldwide']) }}">
                    Worldwide
                  </a>
                </li>
                <li class="{{ request()->get('show') === 'by-country' ? 'font-black' : '' }}">
                  <a href="{{ request()->fullUrlWithQuery(['show' => 'by-country']) }}">
                    By country
                  </a>
                </li>
              </ul>
            </nav>
          </div>
          @if (request()->get('show') === 'by-country')
            <div>
              By Country
            </div>
          @else
            <div class="px-2 md:flex">
              <div class="relative flex  flex-col justify-center items-center">
                <img class="px-0 w-full md:hidden"
                     src="{{ asset('images/caseCharts.png') }}" />
                <img class="px-0 w-full hidden md:block"
                     src="{{ asset('images/newCasesDesktop.png') }}" />
                <h3 class="absolute bottom-20 font-semibold ml-2">New cases</h3>
                <h3 class="absolute bottom-10 text-3xl font-black text-blue-500">4314 31</h3>
              </div>
              <div class="flex justify-around"
                   id="imageParent">
                <div class="relative flex  flex-col justify-center items-center w-full md:w-auto">
                  <img class="px-0 w-full md:hidden"
                       src="{{ asset('images/recoveredChart.png') }}" />
                  <img class="px-0 w-full hidden md:block"
                       src="{{ asset('images/recoveredDesktop.png') }}" />
                  <h3 class="absolute bottom-20 font-semibold ml-2">Recovered</h3>
                  <h3 class="absolute bottom-10 text-3xl font-black text-green-500">434 31</h3>
                </div>
                <div class="relative flex  flex-col justify-center items-center w-full md:w-auto">
                  <img class="px-0  w-full md:hidden"
                       src="{{ asset('images/deathchart.png') }}" />
                  <img class="px-0  w-full hidden md:block"
                       src="{{ asset('images/deathDesktop.png') }}" />
                  <h3 class="absolute bottom-20 font-semibold ml-2">Death</h3>
                  <h3 class="absolute bottom-10 text-3xl font-black text-yellow-500">44 31</h3>
                </div>
              </div>
            </div>
          @endif
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
