<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg x-scroller flipped width90">
        <table class="min-w-full  content divide-y divide-gray-200">
          <thead class="bg-gray-100 h-14">
            <tr>
              <th scope="col"
                  class="px-6 py-3 text-left text-xs font-extrabold  tracking-wider ">
                Location
                {{-- <div class="inline-block ">
                  <img src="{{ asset('images/arrow-top.png') }}"
                       class="h-4" />
                  <img src="{{ asset('images/arrow-down.png') }}" />
                </div> --}}
                <x-svgs.sortSvg />
              </th>
              <th scope="col"
                  class="px-6 py-3 text-left text-xs font-extrabold  tracking-wider">
                New Cases
                <x-svgs.sortSvg />

              </th>
              <th scope="col"
                  class="px-6 py-3 text-left text-xs font-extrabold  tracking-wider">
                Deaths
                <x-svgs.sortSvg />
              </th>
              <th scope="col"
                  class="px-6 py-3 text-left text-xs font-extrabold  tracking-wider">
                Recovered
                <x-svgs.sortSvg />
              </th>
              <th scope="col"
                  class="px-6 py-3 text-left text-xs font-extrabold  tracking-wider">
                Critical
                <x-svgs.sortSvg />
              </th>
            </tr>
          </thead>
          <tbody>
            <!-- Odd row -->
            @foreach ($countries as $country)

              <tr class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-sm  text-gray-900">
                  {{ $country->name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ $country->confirmed }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ $country->deaths }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ $country->recovered }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ $country->critical }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
