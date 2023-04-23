<div class="flex w-full max-w-6xl flex-row justify-center mx-auto" style="min-height:calc(var(--vh) * 7.5)">
  <x-nav-link :href="route('nflplayoffs2022index')" class="mx-2" :active="request()->routeIs('nflplayoffs2022index')">
    {{ __('Input') }}
  </x-nav-link>
  <x-nav-link :href="route('nflplayoffs2022GetTable')" class="mx-2" :active="request()->routeIs('nflplayoffs2022GetTable')">
    {{ __('Table') }}
  </x-nav-link>
  <x-nav-link :href="route('nflplayoffs2022rules')" class="mx-2" :active="request()->routeIs('nflplayoffs2022rules')">
    {{ __('Rules') }}
  </x-nav-link>
</div>