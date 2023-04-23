"use strict";

const resultsOutput = document.getElementById("resultsOutput");
const messageBox = document.getElementById("messageBox");
messageBox.onclick = function() { TogglePanel(messageBox) };
messageBox.style.display = "none";
const savescoresbutton = document.getElementById("savescoresbutton");
savescoresbutton.onclick = function() { SaveScores('SaveScores') };
let timeOut = undefined;

function MessageBox(message)
{
  messageBox.innerHTML = message;
  if(messageBox.style.display === "none") TogglePanel(messageBox);
  AnimatePop(messageBox);
  if(timeOut != null) clearTimeout(timeOut);
  timeOut = setTimeout(AutoOff, 3000);
}

function TogglePanel(panel)
{
  if(panel.style.display == "none") panel.style.display = "";
  else panel.style.display = "none";
}

function AnimatePop(panel)
{
  panel.animate([
    { transform: 'scale(110%, 110%)'},
    { transform: 'scale(109%, 109%)'},
    { transform: 'scale(108%, 108%)'},
    { transform: 'scale(107%, 107%)'},
    { transform: 'scale(106%, 106%)'},
    { transform: 'scale(105%, 105%)'},
    { transform: 'scale(104%, 104%)'},
    { transform: 'scale(103%, 103%)'},
    { transform: 'scale(102%, 102%)'},
    { transform: 'scale(101%, 101%)'},
    { transform: 'scale(100%, 100%)'}],
    {
      duration: 100,
    }
  );
}

function AutoOff()
{
	messageBox.style.display = "none";
}

function AdjustScore(index, kickoff, check)
{
  let now = Date.now() / 1000;
  if(kickoff < now && check)
  {
    MessageBox("Game has kicked off, edit will not save.");
    return;
  }
  let home = parseInt(document.getElementById("home" + index).value);
  let away = parseInt(document.getElementById("away" + index).value);
  let result = document.getElementById("result" + index);

  if(result.nodeName === "DIV")
  {
    if(home > away)
    {
      result.innerHTML = "A";
    }
    else if(away > home)
    {
      result.innerHTML = "B";
    }
    if(home === away)
    {
      result.innerHTML = "D";
    }
  }
  if(result.nodeName === "SELECT")
  {
    if(home > away)
    {
      result.value = "A";
    }
    else if(away > home)
    {
      result.value = "B";
    }
  }
}

function CheckWinner(index, kickoff)
{
  let now = Date.now() / 1000;
  if(kickoff < now)
  {
    MessageBox("Game has kicked off, edit will not save.");
    return;
  }

  let home = parseInt(document.getElementById("home" + index).value);
  let away = parseInt(document.getElementById("away" + index).value);
  let result = document.getElementById("result" + index);

  if(home > away)
  {
    result.value = "A";
  }
  else if(away > home)
  {
    result.value = "B";
  }
}

function Main()
{
  let games = document.getElementsByClassName("gameLog");
  for(let i = 0; i < games.length; i++)
  {
    AdjustScore(games[i].dataset.gameid, games[i].dataset.kickoff, false);
  }
}

function SaveScores(command)
{
  let data = [];
  let gameLogs = document.getElementsByClassName("gameLog");
  for(let i = 0; i < gameLogs.length; i++)
  {
    let id = gameLogs[i].dataset.gameid;
    let home = document.getElementById("home" + id);
    let away = document.getElementById("away" + id);
    let result = document.getElementById("result" + id);
    let r = "";
    if(result.nodeName === "DIV") r = result.innerHTML;
    if(result.nodeName === "SELECT") r = result.value;
    let game = [id, home.value, away.value, r];
    data.push(game);
  }

  $.ajax(
  {
    method: "POST",
    url: command,
    headers:
    {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data:
    {
      games:data
    },
    success:function(result)
    {
      Print(result);
    },
    error:function(result)
    {
      MessageBox("Error saving scores. Please try again.");
    }
  });
}

function Print(result)
{
  resultsOutput.innerHTML = result;
  Main();
  ReAssign();
  MessageBox("Scores Saved.");
}

function ReAssign()
{
  let showhometeam = document.getElementsByClassName("showhometeam");
  for(let i = 0; i < showhometeam.length; i++)
  {
    let id = showhometeam[i].dataset.i;
    showhometeam[i].onclick = function() { MessageBox(id) };
  }

  let showawayteam = document.getElementsByClassName("showawayteam");
  for(let i = 0; i < showawayteam.length; i++)
  {
    let id = showawayteam[i].dataset.i;
    showawayteam[i].onclick = function() { MessageBox(id) };
  }

  let adjustscorebutton = document.getElementsByClassName("adjustscorebutton");
  for(let i = 0; i < adjustscorebutton.length; i++)
  {
    let id = adjustscorebutton[i].dataset.gameID;
    let kickoff = adjustscorebutton[i].dataset.kickoff;
    adjustscorebutton[i].oninput = function() { AdjustScore(id, kickoff, true) };
  }

  let changecheckwinner = document.getElementsByClassName("changecheckwinner");
  for(let i = 0; i < changecheckwinner.length; i++)
  {
    let id = changecheckwinner[i].dataset.gameID;
    let kickoff = changecheckwinner[i].dataset.kickoff;
    changecheckwinner[i].onchange = function() { CheckWinner(id, kickoff) };
  }

  let adjustawayscore = document.getElementsByClassName("adjustawayscore");
  for(let i = 0; i < adjustawayscore.length; i++)
  {
    let id = adjustawayscore[i].dataset.gameID;
    let kickoff = adjustawayscore[i].dataset.kickoff;
    adjustawayscore[i].oninput = function() { AdjustScore(id, kickoff, true) };
  }
}

document.addEventListener("DOMContentLoaded", Main);
document.addEventListener("DOMContentLoaded", ReAssign);