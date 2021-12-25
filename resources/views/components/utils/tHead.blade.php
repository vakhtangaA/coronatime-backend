<th scope="col"
    class="px-3 py-3 text-xs font-extrabold tracking-wider text-left md:px-8 md:w-1/5 md:m-32">
  <div class="flex items-center w-26">
    <p class="inline-block ">
      {{ $text }}
    </p>
    <x-svgs.sortSvg :filter="$filter"
                    :asc="$asc"
                    :desc="$desc" />
  </div>
</th>
