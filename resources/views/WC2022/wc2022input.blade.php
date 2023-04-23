@vite(['resources/js/WC2022/input.js'])

<x-app-layout>

  <x-slot name="appTitle">
    {{ __('WC \'22')}}
  </x-slot>

  <x-slot name="appName">
    {{ __('WC \'22') }}
  </x-slot>

  <x-slot name="header" class="flex-row items-center">
    <div class="flex w-full max-w-6xl flex-row justify-center mx-auto" style="min-height:calc(var(--vh) * 7.5)">
      <x-nav-link :href="route('wc2022Input')" class="mr-2" :active="request()->routeIs('wc2022Input')">
        {{ __('Input') }}
      </x-nav-link>
      <x-nav-link :href="route('wc2022Table')" class="ml-2" :active="request()->routeIs('wc2022Table')">
        {{ __('Table') }}
      </x-nav-link>
    </div>
  </x-slot>
  
  <div class="flex flex-row w-full justify-evenly items-center border-b border-zinc-300" style="height:calc(var(--vh) * 7.5)">
    <div class="hidden md:flex w-full justify-center items-center text-center text-ellipsis">
      {{ __('Stage') }}
    </div>
    <div class="hidden md:flex w-full justify-center items-center text-center text-ellipsis">
      {{ __('Kick Off') }}
    </div>
    <div class="w-full flex justify-center items-center text-ellipsis">
      {{ __('Team A') }}
    </div>
    <div class="w-full flex justify-center items-center text-ellipsis">
      {{ __('') }}
    </div>
    <div class="w-full flex justify-center items-center text-ellipsis">
      {{ __('Result') }}
    </div>
    <div class="w-full flex justify-center items-center text-ellipsis">
      {{ __('') }}
    </div>
    <div class="w-full flex justify-center items-center text-ellipsis">
      {{ __('Team B') }}
    </div>
  </div>

  @isset($results)
  @isset($picks)

  <div id="resultsOutput" class="overflow-y-auto w-full" style="max-height:calc(var(--vh) * 70)">

    <x-WC2022.wc2022scores :results="$results" :picks="$picks" :now="$now"/>

  </div>

  @endisset
  @endisset

  <div class="fixed flex flex-col border-t border-zinc-300 w-screen flex justify-center items-center bg-white bottom-0" style="min-height:calc(var(--vh) * 7.5)">
    <div class="w-4/5 mx-auto m-2 p-2 bg-white rounded-lg border border-zinc-300 flex justify-center items-center" id="messageBox"></div>
    <x-primary-button id="savescoresbutton" class="w-1/2 m-2 p-2 max-w-md h-full active:scale-95" style="height:calc(var(--vh) * 5)">Save</x-primary-button>
  </div>

</x-app-layout>