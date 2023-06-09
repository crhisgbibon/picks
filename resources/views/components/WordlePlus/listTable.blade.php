<style>
  #listTableCenter{
    position: fixed;
    width: 100%;
    height: calc(var(--vh) * 55);
    min-height: calc(var(--vh) * 55);
    padding: 0;
    margin: 0;
  }

  #wordTableList{
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100%;
    width: 95%;
    max-width: 600px;
    max-height: 600px;
    margin: auto;
    padding: 0;
    border: 0;
    border-spacing: 0;
    border-collapse: collapse;
  }

  #wordTableListHead{
    width: 100%;
    max-width: 800px;
    margin: 0;
    padding: 0;
    border: 0;
  }

  #wordTableListHead tr{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    max-width: 800px;
    height: calc(var(--vh) * 10);
    margin: 0;
    padding: 0;
    border: 0;
  }

  #wordTableListHead td{
    text-transform: uppercase;
    text-align: center;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  #dictionaryName{
    text-transform: uppercase;
    font-size: 16px;
  }

  #totalWordCount{
    text-transform: uppercase;
    font-size: 16px;
  }

  #wordTableListBody{
    overflow-y: auto;
    scrollbar-width: none;
    
    position: absolute;
    
    width: 100%;
    height: calc(var(--vh) * 45);
    max-height: 600px;
    max-width: 800px;
    margin: auto;
    padding: 0;
    border: 0;
    box-sizing: border-box;
  }

  /* Hide scrollbar for Chrome, Safari and Opera */
  ::-webkit-scrollbar {
    display: none;
  }

  /* Hide scrollbar for IE, Edge and Firefox */
  body{
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
  }

  #wordTableListBody tr{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    max-width: 800px;
    height: calc(var(--vh) * 10);
    margin: 0;
    padding: 0;
    border: 0;
  }

  #wordTableListBody td{
    text-transform: uppercase;
    text-align: center;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .listEnd{
    width: 12.5%;
    max-width: 200px;
    height: 100%;
  }

  .listCol{
    width: 15%;
    max-width: 120px;
    height: 100%;
    text-align: center;
  }

  .wordFilter{
    position: relative;
    width: 90%;
    max-width: 80px;
    height: 90%;
    max-height: 60px;
    margin: 0;
    padding: 0;
    border: 0;
    box-sizing: border-box;
    border-radius: 12px;
    background-color: var(--backgroundLight);
    text-transform: uppercase;
    font-size: 16px;
  }

  .wordFilterBookend{
    width: 100%;
    max-width: 200px;
    max-height: 100%;
    margin: 0;
    padding: 0;
    border: 0;
    box-sizing: border-box;
    text-transform: uppercase;
    font-size: 16px;
  }

  .wordFilterBookend img{
    width: 75%;
    height: 75%;
  }

  #backPageDiv{
    position: fixed;
    width: 10vw;
    left: 0;
    height: calc(var(--vh) * 55);
    min-height: calc(var(--vh) * 55);
    top: calc(var(--vh) * 15);
    padding: 0;
    margin: 0;
  }

  #backPageButton{
    width: 100%;
    height: 100%;
    text-align: center;
    margin: 0;
    padding: 0;
    font-size: 16px;
    border-radius: 12px;
    box-sizing: border-box;
  }

  #nextPageDiv{
    position: fixed;
    width: 10vw;
    height: calc(var(--vh) * 55);
    min-height: calc(var(--vh) * 55);
    top: calc(var(--vh) * 15);
    padding: 0;
    margin: 0;
    
    right: 0;
  }

  #nextPageButton{
    width: 100%;
    height: 100%;
    text-align: center;
    margin: 0;
    padding: 0;
    font-size: 16px;
    border-radius: 12px;
    box-sizing: border-box;
  }

</style>
<div id="listTableCenter">
  <div id="backPageDiv">
    <button id="backPageButton"></button>
  </div>
  
  <div id="nextPageDiv">
    <button id="nextPageButton"></button>
  </div>
  
  <table id="wordTableList">
  
    <thead id="wordTableListHead">
    
      <tr>
        <td class="listEnd filterTD">
          {{-- <input disabled class="wordFilterBookend" id="dictionaryName" type="text"> --}}
          <button id="sortButton" class="wordFilterBookend flex justify-center items-center mx-4 active:scale-95"><img id="ioSort" src="{{ asset('storage/Assets/crownLight.svg') }}"></button>
        </td>
        <td class="listCol filterTD">
          <input disabled class="wordFilter" id="o0" maxlength="1" type="text">
        </td>
        <td class="listCol filterTD">
          <input disabled class="wordFilter" id="o1" maxlength="1" type="text">
        </td>
        <td class="listCol filterTD">
          <input disabled class="wordFilter" id="o2" maxlength="1" type="text">
        </td>
        <td class="listCol filterTD">
          <input disabled class="wordFilter" id="o3" maxlength="1" type="text">
        </td>
        <td class="listCol filterTD">
          <input disabled class="wordFilter" id="o4" maxlength="1" type="text">
        </td>
        <td class="listEnd filterTD">
          <input disabled class="wordFilterBookend" id="totalWordCount" type="text">
        </td>
      </tr>
    </thead>
    <tbody id="wordTableListBody">
    </tbody>
  </table>
</div>