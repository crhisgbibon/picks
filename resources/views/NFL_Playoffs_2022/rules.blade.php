<x-app-layout>
  <x-slot name="appTitle">
    {{ __('Playoffs 22 : Rules')}}
  </x-slot>
  <x-slot name="appName">
    {{ __('Playoffs 22 : Rules') }}
  </x-slot>
  <x-slot name="header" class="flex-row items-center">
    <x-NFL_Playoffs_2022.headerControls/>
  </x-slot>
  <div class="w-full max-w-5xl flex flex-col justify-start items-center mx-auto overflow-y-auto m-2 p-2" style="width:95%;max-height:calc(var(--vh) * 77)">
    <h3 class="my-2 italic mx-auto">
      Buffer points
    </h3>
    <section class="my-2 w-full mx-auto">
      Pick the game winner in each playoff round to accrue buffer points:<br>
    </section>
    <section class="my-2 w-full mx-auto">
      Wild-Card: 1 point.<br>
      Divisional: 2 points.<br>
      Conference: 4 points.<br>
      Superbowl: 8 points.<br>
      Maximum possible buffer points: 30.
    </section>
    <h3 class="my-2 italic mx-auto">
      {{ __('Superbowl') }}
    </h3>
    <section class="my-2 w-full mx-auto">
      Predict the final score of the Superbowl.<br><br>
      The final rankings are based on the difference between your prediction and the final Superbowl score, then adding your buffer points.<br>
      The player with the most points wins.
    </section>
    <h3 class="my-2 italic mx-auto">
      {{ __('Example') }}
    </h3>
    <section class="my-2 w-full mx-auto">
      Player A predicts the Superbowl will end 15-0.<br>
      Player B predicts the Superbowl will end 12-10.<br>
      The Superbowl ends 15-10.<br><br>
      Player A ends with 15 buffer points, has a Superbowl points difference of -10 points, meaning they have a final score of +5.<br><br>
      Player B ends with 5 buffer points, has a Superbowl points difference of -3 points, meaning they have a final score of +2.<br><br>
      Player A wins.
    </section>
  </div>
</x-app-layout>