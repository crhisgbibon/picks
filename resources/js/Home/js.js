"use strict";

const projects = document.getElementById("projects");
const SortButton = document.getElementById("SortButton");
SortButton.onclick = function(){ SortProjects("-"); };
const SearchField = document.getElementById("SearchField");
SearchField.onkeyup = function(){ SearchProjects(SearchField.value); };
let sortIndex = 0;
SortProjects("AZ");

function SortProjects(sortBy)
{
  if(sortBy === "-")
  {
    sortIndex++;
    if(sortIndex > 1) sortIndex = 0;

    if(sortIndex === 0) sortBy = "AZ";
    else if(sortIndex === 1) sortBy = "ZA";
  }
  else
  {
    if(sortBy === "AZ") sortIndex = 0;
    if(sortBy === "ZA") sortIndex = 1;
  }

  let p = document.getElementsByClassName("projectLinks");
  if(p.length == 0) return;
  p = Array.prototype.slice.call(p, 0);

  p.sort(function(a, b)
  {
    let f1 = undefined;
    let f2 = undefined;

    if(sortBy == "AZ") // alphabetical
    {
      f1 = a.dataset.name.toUpperCase();
      f2 = b.dataset.name.toUpperCase();
    }
    else if(sortBy == "ZA") // reverse alphabetical
    {
      f1 = b.dataset.name.toUpperCase();
      f2 = a.dataset.name.toUpperCase();
    }

    if(f1 < f2) return 1, -1;
    else return -1, 1;
  });

  projects.innerHTML = "";
  let pLen = p.length;
  for(let i = 0; i < pLen; i++) projects.appendChild(p[i]);
}

function SearchProjects(filter)
{
  filter = filter.toUpperCase();
  let list = document.getElementsByClassName('projectLinks');
  let project;
  for(let i = 0; i < list.length; i++)
  {
    project = list[i].dataset.name.toString();
    if(project.toUpperCase().indexOf(filter) > -1)
    {
      list[i].style.display = "";
    }
    else
    {
      list[i].style.display = "none";
    }
  }
}