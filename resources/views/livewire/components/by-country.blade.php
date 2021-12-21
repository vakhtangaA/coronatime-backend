<div class="flex flex-col">
  <div class="relative w-fit md:my-12">
    <input wire:model='search'
           type="search"
           class="relative md:border border-gray-300 py-4 md:py-3 rounded-md focus:outline-none px-12 w-60 "
           placeholder="Search by country" />
    <x-svgs.searchSvg />
  </div>
  <div class="overflow-x-auto">
    <div class="py-2 align-middle inline-block m-auto">
      <div
           class="md:shadow overflow-hidden border-b border-gray-200 sm:rounded-lg x-scroller lg:overflow-hidden flipped  md:width90 m-auto">
        <table class="content divide-y divide-gray-200 w-screen ">
          <thead class="bg-gray-100 h-14">
            <tr>
              <x-utils.tHead text="Location"
                             term="location" />
              <x-utils.tHead text="New Cases"
                             term="cases" />
              <x-utils.tHead text="Deaths"
                             term="deaths" />
              <x-utils.tHead text="Recovered"
                             term="recovered" />
              <x-utils.tHead text="Critical"
                             term="critical" />
            </tr>
          </thead>
          <tbody>
            <!-- Odd row -->
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
