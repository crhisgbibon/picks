@if($name === "AFC")
  <img class="m-2" src="{{ asset('storage/NFL/AFC.webp') }}" style="max-width:75px;max-height:75px">
@elseif($name === "NFC")
  <img class="m-2" src="{{ asset('storage/NFL/NFC.webp') }}" style="max-width:75px;max-height:75px">
@elseif($name === "NFL")
  <img class="m-2" src="{{ asset('storage/NFL/NFL.webp') }}" style="max-width:75px;max-height:75px">
@else
  <img class="m-2" src="{{ asset('storage/Assets/qMark.svg') }}" style="max-width:75px;max-height:75px">
@endif