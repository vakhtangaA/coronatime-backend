<div class="inline-block ml-2">
  <a href="{{ request()->fullUrlWithQuery(['sort' => $term . '-asc']) }}">
    <svg width="10"
         height="6"
         viewBox="0 0 10 6"
         fill="none"
         class="mb-1"
         xmlns="http://www.w3.org/2000/svg">
      <path d="M5 0.5L10 5.5L0 5.5L5 0.5Z"
            fill="{{ request()->get('sort') === $term . '-asc' ? 'black' : '#BFC0C4' }}" />
    </svg>
  </a>
  <a href="{{ request()->fullUrlWithQuery(['sort' => $term . '-desc']) }}">
    <svg width="10"
         height="6"
         viewBox="0 0 10 6"
         fill="none"
         xmlns="http://www.w3.org/2000/svg">
      <path d="M5 5.5L0 0.5H10L5 5.5Z"
            fill="{{ request()->get('sort') === $term . '-desc' ? 'black' : '#BFC0C4' }}" />
    </svg>
  </a>
</div>
