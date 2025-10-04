<div>
<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('Roles') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage All Your Roles ') }}</flux:subheading>
    <flux:separator variant="subtle" />
</div>

<div class="w-170">
    <!-- Back button -->
    <a href="{{ route('role.index') }}"
        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium
            rounded-full shadow-lg text-white bg-gray-800
            hover:bg-yellow-700 focus:outline-none focus:ring-4 focus:ring-indigo-500
            focus:ring-opacity-50
            glowing-button m-4">
        &larr; Back
    </a>

    <div class="w-170">
        <!-- Form to create a new role -->
        <form wire:submit="submit" action="" class="mt-6 space-y-6 bg-light rounded-5">
            <!-- Role Name Input -->
            <flux:input wire:model="name" label="Name" placeholder="Enter Your Name" />

            <!-- Permissions Checkbox Group -->
            <flux:checkbox.group wire:model="rolePermissions" label="Permissions">
                @foreach ($allpermission as $permission)
                    <flux:checkbox wire:model="permission" label="{{ $permission->name }}" value="{{ $permission->name }}" />
                @endforeach
            </flux:checkbox.group>

            <!-- Submit Button -->
            <flux:button type="submit" variant="primary">Submit</flux:button>
        </form>
    </div>
</div>
