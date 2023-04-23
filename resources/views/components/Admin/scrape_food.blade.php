<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <label class="flex justify-evenly items-center mx-2 " for="EditScreenPrice">{{ __('Name:') }}</label>
  <input class="text-center mx-2 w-full" type="text" step="0.01" min="0" value="{{$food->name}}" id="EditScreenName">
</div>
<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <label class="flex justify-evenly items-center mx-2 " for="EditScreenVendor">{{ __('Vendor:') }}</label>
  <input class="text-center mx-2 w-full" type="text" step="0.01" min="0" value="{{$food->vendor}}" id="EditScreenVendor">
</div>
<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <label class="flex justify-evenly items-center mx-2 " for="EditScreenPrice">{{ __('Price:') }}</label>
  <input class="text-center mx-2 " type="number" step="0.01" min="0" value="{{$food->price}}" id="EditScreenPrice">
  <div class="ml-2">{{ __('£') }}</div>
</div>
<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <label class="flex justify-evenly items-center mx-2 " for="EditScreenWeight">{{ __('Weight:') }}</label>
  <input class="text-center mx-2 " type="number" step="0.01" min="0" value="{{$food->weight}}" id="EditScreenWeight">
  <div class="ml-2">{{ __('g') }}</div>
</div>
<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <label class="flex justify-evenly items-center mx-2 " for="EditScreenServings">{{ __('Servings:') }}</label>
  <input class="text-center mx-2 " type="number" step="0.01" min="0" value="{{$food->servings}}" id="EditScreenServings">
  <div class="ml-2">{{ __('s') }}</div>
</div>
<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <label class="flex justify-evenly items-center mx-2 " for="EditScreenExpiry">{{ __('Expiry:') }}</label>
  <input class="text-center mx-2 " type="number" step="0.01" min="0" value="{{$food->expiry}}" id="EditScreenExpiry">
  <div class="ml-2">{{ __('d') }}</div>
</div>
<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <label class="flex justify-evenly items-center mx-2 " for="EditScreenPer">{{ __('Per:') }}</label>
  <input class="text-center mx-2 " type="number" step="1" min="0" value="{{$food->per}}" id="EditScreenPer">
  <div class="ml-2">{{ __('g') }}</div>
</div>
<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <label class="flex justify-evenly items-center mx-2 " for="EditScreenCalories">{{ __('Calories:') }}</label>
  <input class="text-center mx-2 " type="number" step="0.01" min="0" value="{{$food->calories}}" id="EditScreenCalories">
  <div class="ml-2">{{ __('c') }}</div>
</div>
<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <label class="flex justify-evenly items-center mx-2 " for="EditScreenCarbohydrate">{{ __('Carbohydrate:') }}</label>
  <input class="text-center mx-2 " type="number" step="0.01" min="0" value="{{$food->carbohydrate}}" id="EditScreenCarbohydrate">
  <div class="ml-2">{{ __('g') }}</div>
</div>
<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <label class="flex justify-evenly items-center mx-2 " for="EditScreenSugar">{{ __('Sugar:') }}</label>
  <input class="text-center mx-2 " type="number" step="0.01" min="0" value="{{$food->sugar}}" id="EditScreenSugar">
  <div class="ml-2">{{ __('g') }}</div>
</div>
<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <label class="flex justify-evenly items-center mx-2 " for="EditScreenFat">{{ __('Fat:') }}</label>
  <input class="text-center mx-2 " type="number" step="0.01" min="0" value="{{$food->fat}}" id="EditScreenFat">
  <div class="ml-2">{{ __('g') }}</div>
</div>
<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <label class="flex justify-evenly items-center mx-2 " for="EditScreenSaturated">{{ __('Saturated:') }}</label>
  <input class="text-center mx-2 " type="number" step="0.01" min="0" value="{{$food->saturated}}" id="EditScreenSaturated">
  <div class="ml-2">{{ __('g') }}</div>
</div>
<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <label class="flex justify-evenly items-center mx-2 " for="EditScreenProtein">{{ __('Protein:') }}</label>
  <input class="text-center mx-2 " type="number" step="0.01" min="0" value="{{$food->protein}}" id="EditScreenProtein">
  <div class="ml-2">{{ __('g') }}</div>
</div>
<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <label class="flex justify-evenly items-center mx-2 " for="EditScreenFibre">{{ __('Fibre:') }}</label>
  <input class="text-center mx-2 " type="number" step="0.01" min="0" value="{{$food->fibre}}" id="EditScreenFibre">
  <div class="ml-2">{{ __('g') }}</div>
</div>
<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <label class="flex justify-evenly items-center mx-2 " for="EditScreenSalt">{{ __('Salt:') }}</label>
  <input class="text-center mx-2 " type="number" step="0.01" min="0" value="{{$food->salt}}" id="EditScreenSalt">
  <div class="ml-2">{{ __('g') }}</div>
</div>
<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <label class="flex justify-evenly items-center mx-2 " for="EditScreenAlcohol">{{ __('Alcohol:') }}</label>
  <input class="text-center mx-2 " type="number" step="0.01" min="0" value="{{$food->alcohol}}" id="EditScreenAlcohol">
  <div class="ml-2">{{ __('g') }}</div>
</div>
<div class="my-2 w-full  flex flex-row justify-evenly items-center">
  <x-secondary-button class="m-2 flex justify-evenly items-center" id="updateFood">Save</x-secondary-button>
</div>