"use strict";

const bt = document.getElementsByClassName("breakdowntoggle");
for(let i = 0; i < bt.length; i++)
{
  let id = bt[i].dataset.i;
  bt[i].onclick = function() { ToggleBreakdown(id); };
}

function ToggleBreakdown(index)
{
  let ref = index + "Breakdown";
  let panel = document.getElementById(ref);
  TogglePanel(panel);
}

function TogglePanel(panel)
{
  if(panel.style.display == "none") AnimateFadeIn(panel);
  else AnimateFadeOut(panel);
}

function AnimateFadeIn(panel)
{
  panel.style.display = "";
  panel.animate(
  [
    { opacity: '0' },
    { opacity: '0.25' },
    { opacity: '0.5' },
    { opacity: '0.75' },
    { opacity: '1' }
  ],
  {
    duration: 500,
  }
  );
}

function AnimateFadeOut(panel)
{
  let timer = 500;
  let deduct = timer - (timer / 5);
  setTimeout(function() { panel.style.display = "none" }, deduct);
  panel.animate(
  [
    { opacity: '1' },
    { opacity: '0.75' },
    { opacity: '0.5' },
    { opacity: '0.25' },
    { opacity: '0' }
  ],
  {
    duration: timer,
  }
  );
}