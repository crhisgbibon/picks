"use strict";

const messageBox = document.getElementById("messageBox");
messageBox.style.display = "none";
let timeOut = undefined;
messageBox.onclick = function() { TogglePanel(togglepanelbutton); };

let csvbutton = document.getElementsByClassName("csvbutton");
for(let i = 0; i < csvbutton.length; i++)
{
  let id = csvbutton[i].dataset.i;
  csvbutton[i].onclick = function() { GetCSV(id); };
}

let togglebreakdownbutton = document.getElementsByClassName("togglebreakdownbutton");
for(let i = 0; i < togglebreakdownbutton.length; i++)
{
  let id = togglebreakdownbutton[i].dataset.i;
  togglebreakdownbutton[i].onclick = function() { ToggleBreakdown(id); };
}

let hometeamtoggle = document.getElementsByClassName("hometeamtoggle");
for(let i = 0; i < hometeamtoggle.length; i++)
{
  let id = hometeamtoggle[i].dataset.i;
  hometeamtoggle[i].onclick = function() { MessageBox(id); };
}

let awayteamtoggle = document.getElementsByClassName("awayteamtoggle");
for(let i = 0; i < awayteamtoggle.length; i++)
{
  let id = awayteamtoggle[i].dataset.i;
  awayteamtoggle[i].onclick = function() { MessageBox(id); };
}

function MessageBox(message)
{
  messageBox.innerHTML = message;
  if(messageBox.style.display === "none") TogglePanel(messageBox);
  AnimatePop(messageBox);
  if(timeOut != null) clearTimeout(timeOut);
  timeOut = setTimeout(AutoOff, 3000);
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

function ToggleBreakdown(index)
{
  let ref = index + "Breakdown";
  let panel = document.getElementById(ref);
  TogglePanel(panel);
}

function TogglePanel(panel)
{
  if(panel.style.display == "none") panel.style.display = "";
  else panel.style.display = "none";
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

function GetCSV(id)
{
  $.ajax(
  {
    method: "POST",
    url: "CSV",
    headers:
    {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data:
    {
      id:id
    },
    success:function(result)
    {
      SaveAs(result, "scores.csv");
    },
    error:function()
    {

    }
  });
}

function SaveAs(data, filename)
{ 
  let output = [];

  for (let type in data) {
    let item = {};
    item = data[type];
    output.push(item);
  }

  let finalOutput = [];

  for(let i = 0; i < output.length; i++)
  {
    let store = output[i]['kickoff'];
    if(i === 0) store = "Kickoff";
    let newItem = [
      store,
      output[i]['stage'],
      output[i]['homeTeam'],
      output[i]['homeFinal'],
      output[i]['homeScore'],

      output[i]['awayTeam'],
      output[i]['awayFinal'],
      output[i]['awayScore'],

      output[i]['winner'],
      output[i]['actualWinner'],

      output[i]['winnerPoints'],
      output[i]['aPoints'],
      output[i]['bPoints'],
      output[i]['bonusPoints'],
      output[i]['totalPoints']
    ];
    finalOutput.push(newItem);
  }

  finalOutput.sort(function(a, b){
    let startA = parseInt(a[13]), startB = parseInt(b[13]);
    if (startA > startB)
      return 1;
    if (startA < startB)
      return -1;
    return 0;
  })

  var csv = finalOutput.map(function(d){
    return d.join();
  }).join('\n');

  var pom = document.createElement('a');
  pom.setAttribute('href', 'data:text/plain;charset=urf-8,'+encodeURIComponent(csv));
  pom.setAttribute('download', filename);
  pom.click();
};