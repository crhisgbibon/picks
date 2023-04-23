@vite(['resources/js/NFLPlayoffs2022/table.js'])

<x-app-layout>
  <x-slot name="appTitle">
    {{ __('Playoffs 22 : Table') }}
  </x-slot>
  <x-slot name="appName">
    {{ __('Playoffs 22 : Table') }}
  </x-slot>
  <x-slot name="header" class="flex-row items-center">
    <x-NFL_Playoffs_2022.headerControls/>
  </x-slot>
  <div id="tableOutput" class="flex flex-col justify-start items-start w-full max-w-sm mx-auto overflow-y-auto" style="max-height:calc(var(--vh) * 77)">
    @isset($players)
    <div id="rankOutput" class="flex flex-col justify-center items-start w-full h-full mx-auto">
      <x-NFL_Playoffs_2022.ranks :players="$players" :playerscores="$playerscores"/>
    </div>
    @endisset
  </div>
</x-app-layout>