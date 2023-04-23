<div class="flex w-full max-w-6xl h-full flex-row justify-center mx-auto py-1 sm:px-6 lg:px-8">
  <x-nav-link :href="route('adminindex')" class="mr-2" :active="request()->routeIs('adminindex')" style="min-height:calc(var(--vh) * 7.5)">
    {{ __('Panel') }}
  </x-nav-link>
</div>