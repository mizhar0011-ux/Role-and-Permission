<div>
<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('Show Products') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Show Products Here ') }}</flux:subheading>
    <flux:separator variant="subtle" />
</div>

{{--  --}}
<a href="{{ route('product.index') }}" 
       class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium 
              rounded-full shadow-lg text-white bg-gray-800 
              hover:bg-yellow-700 focus:outline-none focus:ring-4 focus:ring-indigo-500 
              focus:ring-opacity-50 
              glowing-button m-4">
       <- Back
    </a>
    


    <div class="w-170">
     <p class="mt-2"><strong>Name : </strong>{{$product->name}}</p>
     <p class="mt-2"><strong>Details : </strong>{{$product->detail}}</p>
    </div>

</div>

