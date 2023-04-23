<style>

  :root {
    --background: rgba(75, 75, 75, 1);
    --foreground: rgba(225, 225, 225, 1);
    --green: rgba(100, 175, 100, 1);

    --won: rgba(175, 175, 100, 1);
    --lost: rgba(175, 100, 100, 1);
  }

  img{
    user-select: none;
    -drag: none;
    -moz-user-select: none;
    -webkit-user-drag: none;
    -webkit-user-select: none;
  }

  [data-state="disabled"]{
    background-color: var(--background);
    color: var(--foreground);
  }

  [data-state="selected"]{
    background-color: rgb(100, 175, 100);
    color: var(--foreground);
  }

  [data-state="won"]{
    background-color: var(--won);
    color: var(--foreground);
  }

  [data-state="lost"]{
    background-color: var(--lost);
    color: var(--foreground);
  }
  
</style>

@foreach($results as $result)

<div class="@if($result->kickoff - $now <= 0){{__('flex flex-col justify-evenly items-center bg-zinc-300 my-4 border border-zinc-300 rounded-lg box-border mx-auto')}}
  @elseif($result->kickoff - $now > 0){{__('flex flex-col justify-evenly items-center bg-transparant my-4 border border-zinc-300 rounded-lg box-border mx-auto')}}@endif"
  style="width:95%">

  <div class="flex flex-row w-full justify-evenly items-center border-b border-zinc-300 box-border" style="min-height:calc(var(--vh) * 7.5)">
    <div class="flex w-full justify-center items-center text-center text-ellipsis">
      <x-NFL_Playoffs_2022.confImg :name="$result->conference"></x-NFL_Playoffs_2022.confImg>
    </div>
    <div class="flex w-full justify-center items-center text-center text-ellipsis">
      @if($result->stage === "WILDCARD")
        {{ __('Wild-Card') }}
      @elseif($result->stage === "DIVISIONAL")
        {{ __('Divisional') }}
      @elseif($result->stage === "CONFERENCE")
        {{ __('Conference') }}
      @elseif($result->stage === "SUPERBOWL")
        {{ __('Superbowl') }}
      @endif
    </div>
    <div class="flex flex-col w-full h-full justify-center items-center text-ellipsis">
      <div>
        <?php
          date_default_timezone_set("Europe/London");
          $gmDate = date("d-m", $result->kickoff);
          echo $gmDate;
        ?>
      </div>
      <div>
        <?php
          date_default_timezone_set("Europe/London");
          $gmDate = date("H:i", $result->kickoff);
          echo $gmDate;
        ?>
      </div>
    </div>
  </div>

  <div
    @if($result->kickoff - $now > 0)
      data-id={{$result->gameID}} class="gameLog w-full flex flex-col justify-evenly items-center"
    @else
      class="w-full flex flex-col justify-evenly items-center"
    @endif

    data-kickoff={{$result->kickoff}}

    data-stage={{$result->stage}}

    style="min-height:calc(var(--vh) * 7.5)">

    @if($result->stage === "SUPERBOWL")

      <div class="w-full border-b border-zinc-300 box-border" style="min-height:calc(var(--vh) * 7.5)">

        <div class="flex flex-row w-full justify-evenly items-center">
          <div class="w-1/2 border-r border-zinc-300 box-border">
            <div class="flex justify-center items-center text-ellipsis rounded-lg m-2" id="homeSuperbowlLogo"
              <?php
                $check = false;
                foreach($picks as $pick)
                {
                  if($pick->gameID === $result->gameID)
                  {
                    if($pick->homeScore > $pick->awayScore) $check = true;
                    break;
                  }
                }
                if($check)
                {
                  if($result->played === "YES")
                  {
                    if($result->homeScore > $result->awayScore) echo "data-state=won";
                    else echo "data-state=lost";
                  }
                  else
                  {
                    echo "data-state=selected data-clicked=clicked";
                  }
                }
                else
                {
                  echo "data-state=disabled";
                }
              ?>
            >
              <x-NFL_Playoffs_2022.logoImg :name="$result->homeTLA"></x-NFL_Playoffs_2022.logoImg>
            </div>
          </div>
          <div class="w-1/2">
            <div class="flex justify-center items-center text-ellipsis rounded-lg m-2" id="awaySuperbowlLogo"
              <?php
                $check = false;
                foreach($picks as $pick)
                {
                  if($pick->gameID === $result->gameID)
                  {
                    if($pick->homeScore < $pick->awayScore) $check = true;
                    break;
                  }
                }
                if($check)
                {
                  if($result->played === "YES")
                  {
                    if($result->homeScore < $result->awayScore) echo "data-state=won";
                    else echo "data-state=lost";
                  }
                  else
                  {
                    echo "data-state=selected data-clicked=clicked";
                  }
                }
                else
                {
                  echo "data-state=disabled";
                }
              ?>
            >
              <x-NFL_Playoffs_2022.logoImg :name="$result->awayTLA"></x-NFL_Playoffs_2022.logoImg>
            </div>
          </div>
        </div>

      </div>

      <div class="flex flex-row w-full justify-evenly items-center" style="min-height:calc(var(--vh) * 7.5)">

        @if($result->kickoff - $now < 0)
          <div class="bg-transparent w-full flex justify-center items-center text-center">
            <?php
              $playerPick = " n / a ";
              foreach($picks as $pick)
              {
                if($pick->gameID === $result->gameID)
                {
                  $playerPick = $pick->homeScore;
                }
              }
              echo $playerPick . " ";
              $home = ($result->homeScore) ? $result->homeScore : 0;
              echo " ( " . $home . " ) ";
            ?>
          </div>
        @else
          <input class="bg-transparent w-full flex justify-center items-center text-center border-0 border-r border-zinc-300 box-border"
          type="number" min="0" max="100" step="1" value="<?php 
            $pickScore = 0;
            foreach($picks as $pick)
            {
              if($pick->gameID === $result->gameID)
              {
                $pickScore = $pick->homeScore;
                break;
              }
            }
            echo $pickScore;
          ?>" name="homeSuperbowl" id="homeSuperbowl"
          data-gameID={{$result->gameID}} data-team="home" oninput="AdjustScore()">
        @endif

        @if($result->kickoff - $now < 0)
          <div class="bg-transparent w-full flex justify-center items-center text-center">
            <?php
              $playerPick = " n / a ";
              foreach($picks as $pick)
              {
                if($pick->gameID === $result->gameID)
                {
                  $playerPick = $pick->awayScore;
                }
              }
              echo $playerPick . " ";
              $home = ($result->awayScore) ? $result->awayScore : 0;
              echo " ( " . $home . " ) ";
            ?>
          </div>
        @else
          <input class="bg-transparent w-full flex justify-center items-center text-center border-0 "
          type="number" min="0" max="100" step="1" value="<?php 
            $pickScore = 0;
            foreach($picks as $pick)
            {
              if($pick->gameID === $result->gameID)
              {
                $pickScore = $pick->awayScore;
                break;
              }
            }
            echo $pickScore;
          ?>" name="awaySuperbowl" id="awaySuperbowl"
          data-gameID={{$result->gameID}} data-team="away" oninput="AdjustScore()">
        @endif

      </div>

    @else

    <div class="flex flex-row w-full justify-evenly items-center" style="min-height:calc(var(--vh) * 7.5)">
      <div class="flex w-full justify-center items-center text-ellipsis" style="min-height:calc(var(--vh) * 7.5);">
        <button class="pickButton rounded-lg flex w-full h-full justify-center items-center my-2" 
          @if($result->kickoff - $now > 0)
          data-r={{$result->gameID}}
          data-s="home"
            <?php
              $check = false;
              foreach($picks as $pick)
              {
                if($pick->gameID === $result->gameID)
                {
                  if($pick->homeScore > $pick->awayScore) $check = true;
                  break;
                }
              }
              if($check)
              {
                if($result->played === "YES")
                {
                  if($result->homeScore > $result->awayScore) echo "data-state=won";
                  else echo "data-state=lost";
                }
                else
                {
                  echo "data-state=selected data-clicked=clicked";
                }
              }
              else
              {
                echo "data-state=disabled";
              }
            ?>
            style="width:90%; height:90%;"
          @else
            style="cursor:default; width:90%; height:90%;"
            <?php
              $check = false;
              foreach($picks as $pick)
              {
                if($pick->gameID === $result->gameID)
                {
                  if($pick->homeScore > $pick->awayScore) $check = true;
                  break;
                }
              }
              if($check)
              {
                if($result->played === "YES")
                {
                  if($result->homeScore > $result->awayScore) echo "data-state=won";
                  else echo "data-state=lost";
                }
                else
                {
                  echo "data-state=selected data-clicked=clicked";
                }
              }
              else
              {
                echo "data-state=disabled";
              }
            ?>
          @endif
          id="{{$result->gameID}}homeTeam">
            <x-NFL_Playoffs_2022.logoImg :name="$result->homeTLA"></x-NFL_Playoffs_2022.logoImg>
        </button>
      </div>
      <div class="flex w-full justify-center items-center text-ellipsis" style="min-height:calc(var(--vh) * 7.5);">
        <button class="pickButton rounded-lg flex w-full h-full justify-center items-center my-2" 
          @if($result->kickoff - $now > 0)
          data-r={{$result->gameID}}
          data-s="away"
            <?php
              $check = false;
              foreach($picks as $pick)
              {
                if($pick->gameID === $result->gameID)
                {
                  if($pick->homeScore < $pick->awayScore) $check = true;
                  break;
                }
              }
              if($check)
              {
                if($result->played === "YES")
                {
                  if($result->homeScore < $result->awayScore) echo "data-state=won";
                  else echo "data-state=lost";
                }
                else
                {
                  echo "data-state=selected data-clicked=clicked";
                }
              }
              else
              {
                echo "data-state=disabled";
              }
            ?>
            style="width:90%; height:90%;"
          @else
            style="cursor:default; width:90%; height:90%;"
            <?php
              $check = false;
              foreach($picks as $pick)
              {
                if($pick->gameID === $result->gameID)
                {
                  if($pick->homeScore < $pick->awayScore) $check = true;
                  break;
                }
              }
              if($check)
              {
                if($result->played === "YES")
                {
                  if($result->homeScore < $result->awayScore) echo "data-state=won";
                  else echo "data-state=lost";
                }
                else
                {
                  echo "data-state=selected data-clicked=clicked";
                }
              }
              else
              {
                echo "data-state=disabled";
              }
            ?>
          @endif
          id="{{$result->gameID}}awayTeam">
            <x-NFL_Playoffs_2022.logoImg :name="$result->awayTLA"></x-NFL_Playoffs_2022.logoImg>
        </button>
      </div>
    </div>
    @endif
  </div>

</div>

@endforeach

<div class="w-full border-0" style="min-height:calc(var(--vh) * 7.5)"></div>