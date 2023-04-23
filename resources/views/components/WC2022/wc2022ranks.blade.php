@foreach($players as $player)

  <div class="togglebreakdownbutton flex flex-row w-full justify-evenly items-center border-b border-zinc-300" data-i={{$player->id}} style="min-height:calc(var(--vh) * 5)">

    <div class="hidden sm:flex w-full justify-center items-center text-center text-ellipsis">
      {{$player->rank}}
    </div>
    <div class="flex w-full justify-center items-center text-center text-ellipsis">
      {{$player->name}}
    </div>
    <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis">
      {{$player->winnerPoints}}
    </div>
    <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis">
      {{$player->homePoints}}
    </div>
    <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis">
      {{$player->awayPoints}}
    </div>
    <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis">
      {{$player->bonusPoints}}
    </div>
    <div class="w-full flex justify-center items-center text-ellipsis">
      {{$player->totalPoints}}
    </div>
    <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis">
      {{$player->stake}}
    </div>
    <div class="w-full flex justify-center items-center text-ellipsis">
      {{$player->currentWinnings}}
    </div>
  
  </div>

  <div class="w-full justify-evenly items-center">

    @foreach($playerscores as $p)

      <?php if($p['userID'] !== $player->id) continue; ?>

      <div id="{{$player->id}}Breakdown" class="flex flex-col w-full justify-evenly items-center border-b border-zinc-300" style="min-height:calc(var(--vh) * 5);display:none;">

        <div class="flex flex-row w-full justify-evenly items-center border-b border-zinc-300" style="min-height:calc(var(--vh) * 5)">

          <div class="flex w-full flex justify-center items-center text-ellipsis">{{ __('Team A') }}</div>
          <div class="flex w-full flex justify-center items-center text-ellipsis">{{ __('') }}</div>
          <div class="flex w-full flex justify-center items-center text-ellipsis">{{ __('') }}</div>
          <div class="flex w-full flex justify-center items-center text-ellipsis">{{ __('Team B') }}</div>
          <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis">{{ __('Winner') }}</div>
          <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis">{{ __('A') }}</div>
          <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis">{{ __('B') }}</div>
          <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis">{{ __('Bonus') }}</div>
          <div class="flex w-full flex justify-center items-center text-ellipsis">{{ __('Total') }}</div>

        </div>

        @foreach($p['games'] as $game)

          <?php if($game['picked'] === false)continue; ?>

          <div class="flex flex-row w-full justify-evenly items-center" style="min-height:calc(var(--vh) * 5)">

            <div 
            <?php 
              if($game['gameWinner'] === "A")
              {
                echo "class='hometeamtoggle flex w-full flex justify-center items-center text-ellipsis font-bold'";
              }
              else
              {
                echo "class='hometeamtoggle flex w-full flex justify-center items-center text-ellipsis'";
              }
            ?>
            data-i={{$game['homeTeam']}}>
              <?php echo $game['homeTLA']; ?>
            </div>
            <div class="flex w-full flex justify-center items-center text-ellipsis"><?php echo $game['homeScore'] . " ( " . $game['homeFinal'] . " ) "; ?></div>
            <div class="flex w-full flex justify-center items-center text-ellipsis"><?php echo $game['awayScore'] . " ( " . $game['awayFinal'] . " ) "; ?></div>
            <div
            <?php 
              if($game['gameWinner'] === "B")
              {
                echo "class='awayteamtoggle flex w-full flex justify-center items-center text-ellipsis font-bold'";
              }
              else
              {
                echo "class='awayteamtoggle flex w-full flex justify-center items-center text-ellipsis'";
              }
            ?>
            data-i={{$game['awayTeam']}}>
              <?php echo $game['awayTLA']; ?>
            </div>
            <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis"><?php echo $game['winnerPoints']; ?></div>
            <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis"><?php echo $game['aPoints']; ?></div>
            <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis"><?php echo $game['bPoints']; ?></div>
            <div class="hidden sm:flex w-full flex justify-center items-center text-ellipsis"><?php echo $game['bonusPoints']; ?></div>
            <div class="flex w-full flex justify-center items-center text-ellipsis"><?php echo $game['totalPoints']; ?></div>

          </div>

        @endforeach

        <x-primary-button class="csvbutton m-2 p-2" data-i='{{$player->id}}'>CSV</x-primary-button>

      </div>

    </div>

  @endforeach

@endforeach