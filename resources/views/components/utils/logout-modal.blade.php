<div class="fixed inset-0 z-10 overflow-y-auto"
     aria-labelledby="modal-title"
     role="dialog"
     aria-modal="true">
  <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
         aria-hidden="true"></div>

    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
          aria-hidden="true">&#8203;</span>

    <div @click.away="show = false"
         class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
      <div class="sm:flex sm:items-start">
        <div
             class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
          <x-svgs.alert />
        </div>
        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
          <h3 class="text-lg font-medium leading-6 text-gray-900"
              id="modal-title">
            {{__("Logout")}}
          </h3>
          <div class="mt-2">
            <p class="text-sm text-gray-500">
              {{__("Are you sure you want to logout?")}}
            </p>
          </div>
        </div>
      </div>
      <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
        <form action='{{ route('logout', app()->getLocale()) }}'
              method="POST">
          @csrf
          <button type="submit"
                  class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
            {{__("Logout")}}
          </button>
        </form>

        <button type="button"
                @click="show = false"
                class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
          {{__("Cancel")}}
        </button>
      </div>
    </div>
  </div>
</div>
