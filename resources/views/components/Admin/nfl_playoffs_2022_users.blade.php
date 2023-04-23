<div id="UserPanel" class="overflow-y-auto flex justify-start items-center flex-col" style="width:95%;max-height:calc(var(--vh) * 75)">

  @foreach($users as $user)

  <div class="flex flex-col w-full justify-center items-center m-2 p-2 rounded-lg border-2 border-zinc-500 max-w-xl">
    <div class="flex justify-center items-center m-2 p-2 w-full h-full text-ellipsis">{{$user->name}}</div>
    <div class="flex justify-center items-center m-2 p-2 w-full h-full text-ellipsis" id="{{$user->id}}stakeDisplay">{{ __('£') }}{{$user->stake}}</div>
    <input type="number" id="{{$user->id}}stake">
    <x-primary-button data-i='{{$user->id}}' class="updatestakebutton flex justify-center items-center m-2 p-2 w-full h-full max-w-sm">Update Stake</x-primary-button>
  </div>

  @endforeach

</div>