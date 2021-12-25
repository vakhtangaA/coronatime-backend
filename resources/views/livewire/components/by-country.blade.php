<div class="flex flex-col">
  <div class="relative w-fit md:my-12">
    <input wire:model='search'
           type="search"
           class="relative px-12 py-4 border-gray-300 rounded-md md:border md:py-3 focus:outline-none w-60 "
           placeholder="Search by country" />
    <x-svgs.searchSvg />
  </div>
  <div class="overflow-x-auto">
    <div class="inline-block py-2 m-auto align-middle">
      <div
           class="m-auto border-b border-gray-200 md:shadow lg:overflow-x-hidden sm:rounded-lg x-scroller flipped md:width90">
        <table class="w-full border border-gray-100 divide-y divide-gray-200 shadow content">
          <thead class="bg-gray-100 h-14">
            <tr>
              <x-utils.tHead text="Location"
                             :filter="$filter"
                             asc="location-asc"
                             desc="location-desc" />
              <x-utils.tHead text="New Cases"
                             :filter="$filter"
                             asc="cases-asc"
                             desc="cases-desc" />
              <x-utils.tHead text="Deaths"
                             :filter="$filter"
                             asc="deaths-asc"
                             desc="deaths-desc" />
              <x-utils.tHead text="Recovered"
                             :filter="$filter"
                             asc="recovered-asc"
                             desc="recovered-desc" />
              <x-utils.tHead text="Critical"
                             :filter="$filter"
                             asc="critical-asc"
                             desc="critical-desc" />
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            @foreach ($countries as $country)
              <tr class="bg-white"
                  wire:key='{{ $country->countryCode }}'>
                <x-utils.tData text="{{ $country->name }}" />
                <x-utils.tData text="{{ $country->confirmed }}" />
                <x-utils.tData text="{{ $country->deaths }}" />
                <x-utils.tData text="{{ $country->recovered }}" />
                <x-utils.tData text="{{ $country->critical }}" />
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
