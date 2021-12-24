<div class="grid w-full grid-cols-3 gap-4 2xl:gap-20">
  <div
       class="flex flex-col items-center justify-center flex-1 col-span-3 rounded-lg md:col-span-1 span py-14 bg-bgNewCases">
    <img src="{{ asset('images/newCases.svg') }}" />
    <h3 class="mt-4 font-semibold xl:text-xl">New cases</h3>
    <h3 class="mt-4 text-3xl font-black text-blue-500 xl:text-4xl">4314 31</h3>
  </div>
  <div class="grid grid-cols-2 col-span-3 gap-3 md:col-span-2 md:gap-4 2xl:gap-20">
    <div class="flex flex-col items-center justify-center flex-1 col-span-1 rounded-lg py-14 bg-bgRecoveredCases">
      <img src="{{ asset('images/recovered.svg') }}" />
      <h3 class="mt-4 font-semibold xl:text-xl">Recovered</h3>
      <h3 class="mt-4 text-3xl font-black text-green-500 xl:text-4xl">4314 31</h3>
    </div>
    <div class="flex flex-col items-center justify-center flex-1 col-span-1 rounded-lg py-14 bg-bgDeathCases">
      <img src="{{ asset('images/death.svg') }}" />
      <h3 class="mt-4 font-semibold xl:text-xl">Deaths</h3>
      <h3 class="mt-4 text-3xl font-black text-yellow-500 xl:text-4xl">4314 31</h3>
    </div>
  </div>
</div>
