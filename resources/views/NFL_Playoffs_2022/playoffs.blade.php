@vite(['resources/js/NFLPlayoffs2022/js.js'])

<x-app-layout>

  <x-slot name="appTitle">
    {{ __('Playoffs 22 : Input')}}
  </x-slot>

  <x-slot name="appName">
    {{ __('Playoffs 22 : Input') }}
  </x-slot>

  <x-slot name="header" class="flex-row items-center">
    <x-NFL_Playoffs_2022.headerControls/>
  </x-slot>

  @isset($results)
  @isset($picks)

  <div id="resultsOutput" class="overflow-y-auto max-w-3xl mx-auto" style="max-height:calc(var(--vh) * 77.5)">
    <x-NFL_Playoffs_2022.scores :results="$results" :picks="$picks" :now="$now"/>
  </div>

  @endisset
  @endisset

  <div class="fixed flex flex-col border-t border-zinc-300 w-screen flex justify-center items-center bg-white bottom-0" style="min-height:calc(var(--vh) * 7.5)">
    <div class="w-4/5 mx-auto m-2 p-2 bg-white rounded-lg border border-zinc-300 flex justify-center items-center" id="messageBox"></div>
    <x-primary-button id="savescores" class="w-1/2 m-2 p-2 max-w-md h-full active:scale-95" style="height:calc(var(--vh) * 5)">Save</x-primary-button>
  </div>

</x-app-layout>