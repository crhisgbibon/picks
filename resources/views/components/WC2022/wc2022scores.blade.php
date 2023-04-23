@foreach($results as $result)

  <div class="@if($result->kickoff - $now < 0){{__('flex flex-row w-full justify-evenly items-center bg-red-50 border-b border-r border-l border-zinc-300 box-border')}}@elseif($result->kickoff - $now < 86400 && $result->kickoff - $now > 0){{__('gameLog flex flex-row w-full justify-evenly items-center bg-orange-50 border-b border-r border-l border-zinc-300 box-border')}}@elseif($result->kickoff - $now >= 86400){{__('gameLog flex flex-row w-full border-b border-r border-l border-zinc-300 justify-evenly items-center bg-green-50 box-border')}}@endif"
    
    @if($result->kickoff - $now > 0)
      data-gameID={{$result->gameID}}
    @endif

    data-kickoff={{$result->kickoff}}

    style="min-height:calc(var(--vh) * 7.5)">


    
    <div class="hidden md:flex w-full justify-center items-center text-center text-ellipsis">
      <?php
        if($result->stage === "GROUP_STAGE") echo "Group";
        if($result->stage === "LAST_16") echo "RO16";
        if($result->stage === "QUARTER_FINALS") echo "QF";
        if($result->stage === "SEMI_FINALS") echo "SF";
        if($result->stage === "THIRD_PLACE") echo "3P";
        if($result->stage === "FINAL") echo "Final";
      ?>
    </div>



    <div class="hidden md:flex w-full h-full justify-center items-center text-ellipsis border-x border-zinc-300">
      <?php
        date_default_timezone_set("Europe/London");
        $gmDate = date("d-m H:i", $result->kickoff);
        echo $gmDate;
      ?>
    </div>



    <div class="hidden sm:flex w-full justify-center items-center text-ellipsis">
      <?php
        echo $home = ($result->homeTeam) ? $result->homeTeam : "?";
      ?>
    </div>



    <div data-i={{$result->homeTeam}} class="showhometeam flex sm:hidden w-full justify-center items-center text-ellipsis">
      <?php
        echo $home = ($result->homeTLA) ? $result->homeTLA : "?";
      ?>
    </div>



    <div class="w-full flex justify-center items-center text-ellipsis">

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
        <input class="adjustscorebutton homeScore bg-transparent w-full flex justify-center items-center text-center border-y-0 border-zinc-300"
        type="number" min="0" max="10" step="1" value="<?php 

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
        
        ?>" name="homePick" id="home{{$result->gameID}}"
        data-gameID={{$result->gameID}} data-team="home" data-kickoff={{$result->kickoff}}>
      @endif

    </div>



    <div class="bg-transparent w-full h-full flex justify-center items-center">

      @if($result->stage === "GROUP_STAGE")

        <div
        
        @if($result->kickoff - $now < 0)
          class="w-full h-full flex justify-center items-center text-center text-ellipsis"
        @else
          class="resultSelect w-full h-full flex justify-center items-center text-center text-ellipsis"
        @endif
        
        id="result{{$result->gameID}}">
        
          <?php 

            foreach($picks as $pick)
            {
              if($pick->gameID === $result->gameID)
              {
                if($pick->winner === "A") echo "A";
                else if($pick->winner === "B") echo "B";
                else if($pick->winner === "D") echo "D";
              }
            }
        
          ?>

          @if($result->winner != "?")
            <?php 
              if($result->winner === "HOME_TEAM")
              {
                echo " ( A ) ";
              }
              else if($result->winner === "AWAY_TEAM")
              {
                echo " ( B ) ";
              }
              else if($result->winner === "DRAW")
              {
                echo " ( D ) ";
              }
            
            ?>
          @else
            {{__(' ( ? ) ')}}
          @endif
        
        </div>

      @else

        @if($result->kickoff - $now < 0)

          <div
          
          class="w-full h-full flex justify-center items-center text-center text-ellipsis"
          
          id="result{{$result->gameID}}">
          
            <?php 

              foreach($picks as $pick)
              {
                if($pick->gameID === $result->gameID)
                {
                  if($pick->winner === "A") echo "A";
                  else if($pick->winner === "B") echo "B";
                }
              }
          
            ?>

            @if($result->winner != "?")
              <?php 
                if($result->winner === "HOME_TEAM")
                {
                  echo " ( A ) ";
                }
                else if($result->winner === "AWAY_TEAM")
                {
                  echo " ( B ) ";
                }
              
              ?>
            @else
              {{__(' ( ? ) ')}}
            @endif
          
          </div>

        @else

          <select class="changecheckwinner resultSelect bg-transparent w-full h-full flex justify-center items-center text-center text-ellipsis border-0"
          id="result{{$result->gameID}}" data-kickoff={{$result->kickoff}}>
            <option
              <?php 

                foreach($picks as $pick)
                {
                  if($pick->gameID === $result->gameID)
                  {
                    if($pick->winner === "A") echo "selected";
                  }
                }
            
              ?>
            >A</option>
            <option
            <?php 

              foreach($picks as $pick)
              {
                if($pick->gameID === $result->gameID)
                {
                  if($pick->winner === "B") echo "selected";
                }
              }
          
            ?>
            >B</option>
          </select>

        @endif

      @endif

    </div>



    <div class="w-full flex justify-center items-center text-ellipsis">

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
            $away = ($result->awayScore) ? $result->awayScore : 0;
            echo " ( " . $away . " ) ";
          ?>
        </div>
      @else
        <input class="adjustawayscore awayScore bg-transparent w-full flex justify-center items-center text-center border-y-0 border-zinc-300"
        type="number" min="0" max="10" step="1" value="<?php 

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
        
        ?>" name="awayPick" id="away{{$result->gameID}}"
        data-gameID={{$result->gameID}} data-kickoff={{$result->kickoff}} data-team="away">
      @endif

    </div>



    <div class="hidden sm:flex w-full justify-center items-center text-ellipsis">
      <?php
        echo $home = ($result->awayTeam) ? $result->awayTeam : "?";
      ?>
    </div>



    <div data-i={{$result->awayTeam}} class="showawayteam flex sm:hidden w-full justify-center items-center text-ellipsis">
      <?php
        echo $home = ($result->awayTLA) ? $result->awayTLA : "?";
      ?>
    </div>
  
  </div>

@endforeach

<div class="w-full" style="min-height:calc(var(--vh) * 9)"></div>