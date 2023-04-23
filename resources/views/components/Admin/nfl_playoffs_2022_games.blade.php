@isset($games)
@isset($nflteams)

<div id="GamePanel" class="overflow-y-auto flex justify-start items-center flex-col" style="width:95%;max-height:calc(var(--vh) * 75)">

  <div class="flex flex-col justify-center items-center border border-black rounded-lg my-4" style="width:95%;max-width:300px;">
    <div class="flex justify-center items-center w-full my-4 font-bold">{{ __('Commands') }}</div>
    <x-primary-button id="fillData" class="flex justify-center items-center my-4 active:scale-95">{{ __('Reset Result Data') }}</x-primary-button>
    <x-primary-button id="resetScores" class="flex justify-center items-center my-4 active:scale-95">{{ __('Reset Player Scores') }}</x-primary-button>
  </div>

  @foreach($games as $game)

  <div class="flex flex-col justify-center items-center border border-black rounded-lg my-4" style="width:95%;max-width:300px;">
    <div class="flex flex-col justify-center items-center border-b border-black w-full my-2 p-2 font-bold">
      {{ __('Game ID: ') }}{{$game->id}}
    </div>

    <label class="w-full text-center mx-auto">Conference:</label>
    <select id="{{$game->id}}CONFERENCE" class="w-full text-center mx-auto my-2 border-x-0">
      <option <?php if($game->conference === "AFC") echo "selected" ?>>AFC</option>
      <option <?php if($game->conference === "NFC") echo "selected" ?>>NFC</option>
      <option <?php if($game->conference === "NFL") echo "selected" ?>>NFL</option>
    </select>

    <label class="w-full text-center mx-auto">Stage:</label>
    <select id="{{$game->id}}STAGE" class="w-full text-center mx-auto my-2 border-x-0">
      <option <?php if($game->stage === "WILDCARD") echo "selected" ?>>WILDCARD</option>
      <option <?php if($game->stage === "DIVISIONAL") echo "selected" ?>>DIVISIONAL</option>
      <option <?php if($game->stage === "CONFERENCE") echo "selected" ?>>CONFERENCE</option>
      <option <?php if($game->stage === "SUPERBOWL") echo "selected" ?>>SUPERBOWL</option>
    </select>

    <label class="w-full text-center mx-auto">Home Team:</label>
    <select id="{{$game->id}}HOMETEAMNAME" class="w-full text-center mx-auto my-2 border-x-0">
      <option <?php if($game->homeTeam === "?") echo "selected" ?> data-teamid='-1'>?</option>
      @foreach($nflteams as $nflteam)
        <option <?php if($game->homeTeam === $nflteam->name) echo "selected" ?> data-teamid='{{$nflteam->id}}'>{{$nflteam->name}}</option>
      @endforeach
    </select>

    <label class="w-full text-center mx-auto">Home Score:</label>
    <input id="{{$game->id}}HOMETEAMSCORE" class="w-full text-center mx-auto my-2 border-x-0" type="number" value="{{$game->homeScore}}">

    <label class="w-full text-center mx-auto">Away Team:</label>
    <select id="{{$game->id}}AWAYTEAMNAME" class="w-full text-center mx-auto my-2 border-x-0">
      <option <?php if($game->awayTeam === "?") echo "selected" ?> data-teamid='-1'>?</option>
      @foreach($nflteams as $nflteam)
        <option <?php if($game->awayTeam === $nflteam->name) echo "selected" ?> data-teamid='{{$nflteam->id}}'>{{$nflteam->name}}</option>
      @endforeach
    </select>

    <label class="w-full text-center mx-auto">Away Score:</label>
    <input id="{{$game->id}}AWAYTEAMSCORE" class="w-full text-center mx-auto my-2 border-x-0" type="number" value="{{$game->awayScore}}">

    <label class="w-full text-center mx-auto">Kickoff:</label>
    <input id="{{$game->id}}KICKOFF" class="w-full text-center mx-auto my-2 border-x-0" type="datetime-local" value="<?= date("Y-m-d H:i", $game->kickoff) ?>">

    <label class="w-full text-center mx-auto">Played:</label>
    <select id="{{$game->id}}PLAYED" class="w-full text-center mx-auto my-2 border-x-0">
      <option <?php if($game->played === "YES") echo "selected" ?>>YES</option>
      <option <?php if($game->played === "NO") echo "selected" ?>>NO</option>
    </select>

    <button class="savegamebutton m-4 flex justify-center items-center" data-i={{$game->id}}>
      <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

  @endforeach

</div>

@endisset
@endisset