<div class="flex flex-col">
  <div class="relative w-fit md:my-10 lg:mt-0 lg:mb-10">
    <input wire:model='search'
           type="search"
           class="relative w-64 px-4 py-4 font-semibold text-center border-gray-300 rounded-md md:border md:py-3 focus:outline-none"
           placeholder="{{ __('Search by country') }}" />
    <x-svgs.searchSvg />
  </div>
  <div class="overflow-x-auto"
       wire:loading.class.delay="opacity-50">
    <div class="inline-block py-2 m-auto align-middle">
      <div class="m-auto border-b border-gray-200 md:shadow lg:overflow-x-hidden sm:rounded-lg x-scroller sm:width90">
        <table class="w-full divide-y divide-gray-200 shadow content ">
          <thead class="bg-gray-100 h-14">
            <tr>
              <x-utils.tHead text="Location"
                             :filter="$filter"
                             asc="name-asc"
                             desc="name-desc" />
              <x-utils.tHead text="New Cases"
                             :filter="$filter"
                             asc="confirmed-asc"
                             desc="confirmed-desc" />
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
            @forelse ($countries as $country)
              <tr class="bg-white"
                  wire:key='{{ $country->countryCode }}'>
                <x-utils.tData text="{{ $country->name }}" />
                <x-utils.tData text="{{ $country->confirmed }}" />
                <x-utils.tData text="{{ $country->deaths }}" />
                <x-utils.tData text="{{ $country->recovered }}" />
                <x-utils.tData text="{{ $country->critical }}" />
              </tr>
            @empty
              <tr class="bg-white">
                <td colspan="5">
                  <div class="flex items-center justify-center p-8 py-32">
                    <p class="text-2xl font-bold opacity-70">
                      No countries were found...
                    </p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
