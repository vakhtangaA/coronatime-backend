<tr>
  <td class="header">
    <a href="{{ $url }}"
       style="display: inline-block;">
      @if (trim($slot) === 'Laravel')
        <img src="https://i.ibb.co/B4558Hh/mail-Landing.png"
             width="300"
             height="300"
             style="text-align: center" />
      @else
        {{ $slot }}
      @endif
    </a>
  </td>
</tr>
