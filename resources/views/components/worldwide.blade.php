<div class="justify-between w-full md:flex"
     x-show="component === 'worldwide'">
  <div class="relative flex flex-col items-center justify-center">
    <img class="w-full px-0 md:hidden"
         src="{{ asset('images/caseCharts.png') }}" />
    <img class="hidden w-full px-0 md:block"
         src="{{ asset('images/newCasesDesktop.png') }}" />
    <h3 class="absolute ml-2 font-semibold bottom-20">New cases</h3>
    <h3 class="absolute text-3xl font-black text-blue-500 bottom-10">4314 31</h3>
  </div>
  <div class="flex justify-around"
       id="imageParent">
    <div class="relative flex flex-col items-center justify-center w-full md:w-auto">
      <img class="w-full px-0 md:hidden"
           src="{{ asset('images/recoveredChart.png') }}" />
      <img class="hidden w-full px-0 md:block"
           src="{{ asset('images/recoveredDesktop.png') }}" />
      <h3 class="absolute ml-2 font-semibold bottom-20">Recovered</h3>
      <h3 class="absolute text-3xl font-black text-green-500 bottom-10">434 31</h3>
    </div>
    <div class="relative flex flex-col items-center justify-center w-full md:w-auto">
      <img class="w-full px-0 md:hidden"
           src="{{ asset('images/deathchart.png') }}" />
      <img class="hidden w-full px-0 md:block"
           src="{{ asset('images/deathDesktop.png') }}" />
      <h3 class="absolute ml-2 font-semibold bottom-20">Death</h3>
      <h3 class="absolute text-3xl font-black text-yellow-500 bottom-10">44 31</h3>
    </div>
  </div>
</div>
