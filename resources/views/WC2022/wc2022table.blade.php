@vite(['resources/js/WC2022/table.js'])

<x-app-layout>

  <x-slot name="appTitle">
    {{ __('WC \'22') }}
  </x-slot>

  <x-slot name="appName">
    {{ __('WC \'22') }}
  </x-slot>

  <x-slot name="header" class="flex-row items-center">
    <div class="flex w-full max-w-6xl flex-row justify-center mx-auto py-1 sm:px-6 lg:px-8">
      <x-nav-link :href="route('wc2022Input')" class="mr-2" :active="request()->routeIs('wc2022Input')" style="min-height:calc(var(--vh) * 7.5)">
        {{ __('Input') }}
      </x-nav-link>
      <x-nav-link :href="route('wc2022Table')" class="ml-2" :active="request()->routeIs('wc2022Table')" style="min-height:calc(var(--vh) * 7.5)">
        {{ __('Table') }}
      </x-nav-link>
    </div>
  </x-slot>
  
  <div id="tableOutput" class="flex flex-col justify-center items-center w-full max-w-6xl mx-auto">

    @isset($players)

    <div class="flex flex-row w-full justify-evenly items-center py-2 border-b border-zinc-300">

      <div class="hidden sm:flex w-full justify-center items-center text-center text-ellipsis ">
        {{ __('Rank') }}
      </div>
      <div class="flex w-full justify-center items-center text-center text-ellipsis">
        {{ __('Name') }}
      </div>
      <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis">
        {{ __('Result') }}
      </div>
      <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis">
        {{ __('A') }}
      </div>
      <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis">
        {{ __('B') }}
      </div>
      <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis">
        {{ __('Bonus') }}
      </div>
      <div class="w-full flex justify-center items-center text-ellipsis">
        {{ __('Total') }}
      </div>
      <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis">
        {{ __('Stake') }}
      </div>
      <div class="w-full flex justify-center items-center text-ellipsis">
        {{ __('Prize') }}
      </div>
      
    </div>

    <div id="rankOutput" class="flex flex-col justify-center items-center w-full max-w-6xl mx-auto">

      <x-WC2022.wc2022ranks :players="$players" :playerscores="$playerscores"/>

    </div>

    @endisset

  </div>

  <div class="togglepanelbutton sticky bottom-6 z-10 w-4/5 mx-auto bg-white rounded-lg border m-2 p-2 border-zinc-300 flex justify-center items-center" id="messageBox"></div>

</x-app-layout>