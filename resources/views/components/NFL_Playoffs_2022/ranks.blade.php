@foreach($players as $player)
  <div class="breakdowntoggle flex flex-col justify-center items-center border border-zinc-300 rounded-lg my-2 p-2 mx-auto" data-i={{$player->id}} style="width:95%;min-height:calc(var(--vh) * 5)">
    <div class="flex flex-row w-full justify-center items-center">
      <div class="w-full text-right mx-4">{{ __('Rank') }}</div>
      <div class="w-full text-left mx-4">{{$player->rank}}</div>
    </div>
    <div class="flex flex-row w-full justify-center items-center">
      <div class="w-full text-right mx-4">{{ __('Name') }}</div>
      <div class="w-full text-left mx-4">{{$player->name}}</div>
    </div>
    <div class="flex flex-row w-full justify-center items-center">
      <div class="w-full text-right mx-4">{{ __('Buffer') }}</div>
      <div class="w-full text-left mx-4">{{$player->buffer}}</div>
    </div>
    <div class="flex flex-row w-full justify-center items-center">
      <div class="w-full text-right mx-4">{{ __('Remains') }}</div>
      <div class="w-full text-left mx-4">{{$player->spread}}</div>
    </div>
    <div class="flex flex-row w-full justify-center items-center">
      <div class="w-full text-right mx-4">{{ __('Stake') }}</div>
      <div class="w-full text-left mx-4">{{$player->stake}}</div>
    </div>
    <div class="flex flex-row w-full justify-center items-center">
      <div class="w-full text-right mx-4">{{ __('Prize') }}</div>
      <div class="w-full text-left mx-4">{{$player->currentWinnings}}</div>
    </div>
  </div>
  <div id="{{$player->id}}Breakdown" class="w-full flex flex-col justify-evenly items-center" style="display:none;">
    @foreach($playerscores as $p)
      <?php if($p['userID'] !== $player->id) continue; ?>
      <div class="flex flex-row w-full justify-evenly items-center border-b border-zinc-300" style="min-height:calc(var(--vh) * 5)">
        <div class="flex w-full justify-center items-center text-ellipsis">{{ __('Home') }}</div>
        <div class="flex w-full justify-center items-center text-ellipsis">{{ __('Away') }}</div>
        <div class="flex w-full justify-center items-center text-ellipsis">{{ __('Buffer') }}</div>
      </div>
      @foreach($p['games'] as $game)
        <?php if($game['picked'] === false)continue; ?>
        <?php if($game['played'] === "NO")continue; ?>
        <div class="flex flex-row w-full justify-evenly items-center" style="min-height:calc(var(--vh) * 5)">
          <div
            <?php 
              if($game['homeScore'] > $game['awayScore'])
              {
                echo "class='flex w-full justify-center items-center text-ellipsis font-bold'";
              }
              else
              {
                echo "class='flex w-full justify-center items-center text-ellipsis'";
              }
            ?>>
            <?= $game['homeTLA']; ?>
          </div>
          <div
            <?php 
              if($game['homeScore'] < $game['awayScore'])
              {
                echo "class='flex w-full justify-center items-center text-ellipsis font-bold'";
              }
              else
              {
                echo "class='flex w-full justify-center items-center text-ellipsis'";
              }
            ?>>
            <?= $game['awayTLA']; ?>
          </div>
          <div class="flex w-full justify-center items-center text-ellipsis"><?= $game['buffer']; ?></div>
        </div>
        @if($game['stage'] === "SUPERBOWL")
        <div class="w-full max-w-sm">
          <div class="flex flex-col w-full justify-evenly items-center border-b border-zinc-300" style="min-height:calc(var(--vh) * 5)">
            <div class="flex w-full justify-center items-center text-ellipsis">{{ __('Superbowl') }}</div>
          </div>
          <div class="flex flex-col w-full justify-evenly items-center" style="min-height:calc(var(--vh) * 5)">
            <div class="flex flex-row w-full justify-evenly items-center">
              <div class="w-full text-right mx-4">{{ __('Home') }}</div>
              <div class="w-full text-left mx-4"><?= $game['homeTeam']; ?></div>
            </div>
            <div class="flex flex-row w-full justify-evenly items-center">
              <div class="w-full text-right mx-4">{{ __('Scored') }}</div>
              <div class="w-full text-left mx-4"><?= $game['homeFinal']; ?></div>
            </div>
            <div class="flex flex-row w-full justify-evenly items-center">
              <div class="w-full text-right mx-4">{{ __('Predicted') }}</div>
              <div class="w-full text-left mx-4"><?= $game['homeScore']; ?></div>
            </div>
            <div class="flex flex-row w-full justify-evenly items-center">
              <div class="w-full text-right mx-4">{{ __('Away') }}</div>
              <div class="w-full text-left mx-4"><?= $game['awayTeam']; ?></div>
            </div>
            <div class="flex flex-row w-full justify-evenly items-center">
              <div class="w-full text-right mx-4">{{ __('Scored') }}</div>
              <div class="w-full text-left mx-4"><?= $game['awayFinal']; ?></div>
            </div>
            <div class="flex flex-row w-full justify-evenly items-center">
              <div class="w-full text-right mx-4">{{ __('Predicted') }}</div>
              <div class="w-full text-left mx-4"><?= $game['awayScore']; ?></div>
            </div>
            <div class="flex flex-row w-full justify-evenly items-center">
              <div class="w-full text-right mx-4">{{ __('Difference') }}</div>
              <div class="w-full text-left mx-4"><?= $player->difference; ?></div>
            </div>
            <div class="flex flex-row w-full justify-evenly items-center">
              <div class="w-full text-right mx-4">{{ __('Buffer') }}</div>
              <div class="w-full text-left mx-4"><?= $player->buffer; ?></div>
            </div>
            <div class="flex flex-row w-full justify-evenly items-center">
              <div class="w-full text-right mx-4">{{ __('Remains') }}</div>
              <div class="w-full text-left mx-4"><?= $player->spread; ?></div>
            </div>
          </div>
        </div>
        @endif
      @endforeach
    @endforeach
  </div>
@endforeach