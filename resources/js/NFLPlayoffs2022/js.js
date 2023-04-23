"use strict";

const resultsOutput = document.getElementById("resultsOutput");
const savescores = document.getElementById("savescores");
savescores.onclick = function() { SaveScores('SaveScores') };
const messageBox = document.getElementById("messageBox");
messageBox.onclick = function() { TogglePanel(messageBox) };
messageBox.style.display = "none";
let timeOut = undefined;

function ReAssign()
{
  let pickbuttons = document.getElementsByClassName("pickButton");
  for(let i = 0; i < pickbuttons.length; i++)
  {
    let r = pickbuttons[i].dataset.r;
    let s = pickbuttons[i].dataset.s;
    pickbuttons[i].onclick = function() { ChooseGame(r, s, pickbuttons[i]); };
  }
}

let green = {
  r:100,
  g:175,
  b:100
};

let foreground = {
  r:75,
  g:75,
  b:75
};

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

function ChooseGame(id, side, it)
{
  if(it.dataset.clicked === "clicked" || it.style.backgroundColor === "rgb(100, 175, 100)") return;
  let hTeam = document.getElementById(id + "homeTeam");
  let aTeam = document.getElementById(id + "awayTeam");

  if(side === "home")
  {
    Fade(hTeam, 'background-color', foreground, green, 500, "selected");
    Fade(aTeam, 'background-color', green, foreground, 500, "disabled");
    hTeam.dataset.clicked = "clicked";
  }
  else if(side === "away")
  {
    Fade(hTeam, 'background-color', green, foreground, 500, "disabled");
    Fade(aTeam, 'background-color', foreground, green, 500, "selected");
    aTeam.dataset.clicked = "clicked";
  }
}

function SaveScores(command)
{
  let data = [];
  let gameLogs = document.getElementsByClassName("gameLog");
  for(let i = 0; i < gameLogs.length; i++)
  {
    let id = gameLogs[i].dataset.id;
    let stage = gameLogs[i].dataset.stage;
    if(stage === "SUPERBOWL")
    {
      let home = document.getElementById("homeSuperbowl");
      let away = document.getElementById("awaySuperbowl");
      let game = [id, stage, home.value, away.value];
      data.push(game);
    }
    else
    {
      let aTeam = document.getElementById(id + "awayTeam");
      let winner = true;
      if(aTeam.dataset.state === "selected") winner = false;

      let game = [id, stage, winner];
      data.push(game);
    }
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
    error:function()
    {
      MessageBox("Error. Please try again.");
    }
  });
}

function Print(result)
{
  resultsOutput.innerHTML = result;
  ReAssign();
  MessageBox("Saved.");
}

function AdjustScore()
{
  let homeSuperbowl = parseInt(document.getElementById("homeSuperbowl").value);
  let awaySuperbowl = parseInt(document.getElementById("awaySuperbowl").value);

  let homeSuperbowlLogo = document.getElementById("homeSuperbowlLogo");
  let awaySuperbowlLogo = document.getElementById("awaySuperbowlLogo");

  if(homeSuperbowl >= awaySuperbowl)
  {
    Fade(homeSuperbowlLogo, 'background-color', foreground, green, 500, "selected");
    Fade(awaySuperbowlLogo, 'background-color', green, foreground, 500, "disabled");
  }
  else
  {
    Fade(homeSuperbowlLogo, 'background-color', green, foreground, 500, "disabled");
    Fade(awaySuperbowlLogo, 'background-color', foreground, green, 500, "selected");
  }
}

function Lerp(a, b, u)
{
  return ( 1 - u ) * a + u * b;
};

function Fade(el, property, start, end, duration, state)
{
  let interval = 10;
  let steps = duration / interval;
  let step_u = 1.0 / steps;
  let u = 0.0;
  let theInterval = setInterval( function()
  {
    if(u >= 1.0)
    { 
      clearInterval(theInterval);
      el.dataset.state = state;
      el.dataset.clicked = "unclicked";
    }
    let r = parseInt(Lerp(start.r, end.r, u));
    let g = parseInt(Lerp(start.g, end.g, u));
    let b = parseInt(Lerp(start.b, end.b, u));
    let col = 'rgb(' + r + ',' + g + ',' + b + ')';
    el.style.setProperty(property, col);
    u += step_u;
  },
  interval);
};

document.addEventListener("DOMContentLoaded", ReAssign);