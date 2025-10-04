<div>
<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('products') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage All Your product ') }}</flux:subheading>
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
        <form wire:submit="submit" action="" class="mt-6 space-y-6 bg-light rounded-5">
            <flux:input wire:model="name" label="Name" placeholder="Enter Your Name" />
            <flux:textarea wire:model="detail" label="Product Details" placeholder="Enter Your Details" />

            <flux:button type="submit" variant="primary">Submit</flux:button>
        </form>
    </div>

</div>

