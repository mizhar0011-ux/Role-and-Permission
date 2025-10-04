<div>
   <div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('Edit Data') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Change the user Data Here') }}</flux:subheading>
    <flux:separator variant="subtle" />
</div>


<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">

            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mb-6 border-b pb-3">
                Edit user: {{ $user->name }}
            </h2>

            <!-- Success Message (if used by the component) -->
            @if (session()->has('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg shadow">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Livewire form submission -->
            <form wire:submit.prevent="update" class="space-y-6">

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-bg font-medium text-black dark:text-gray-300">Name</label>
                    <input 
                        wire:model="name" 
                        type="text" 
                        id="name" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-white p-2 dark:border-gray-600 dark:text-black" 
                        required    
                        autofocus
                    >
                    @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                    <input 
                        wire:model="email" 
                        type="email" 
                        id="email" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-white  p-2 dark:border-gray-600 dark:text-black" 
                        required
                    >
                    @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Password Fields for optional change -->
                <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Change Password (Optional)</h3>
                    
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">New Password</label>
                        <input 
                            wire:model="password" 
                            type="password" 
                            id="password" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-white p-2 dark:border-gray-600 dark:text-black"
                        >
                        @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4 mb-5">
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm New Password</label>
                        <input 
                            wire:model="confirm_password" 
                            type="password" 
                            id="confirm_password" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-white p-2 dark:border-gray-600 dark:text-black"
                        >
                        @error('confirm_password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror

<br><br>
                                    <flux:checkbox.group  wire:model="roles" label="Roles">
                                        @foreach ($allroles as $role)
                                            <flux:checkbox 
                                                label="{{ $role->name }}" 
                                                value="{{ $role->name }}" />
                                        @endforeach
                                    </flux:checkbox.group>
                    </div>
                </div><br>


                <!-- Action Buttons -->
                <div class="flex items-center justify-end mt-6">
                    <a href="{{ route('user.index') }}" class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition ease-in-out duration-150 mr-4">
                        Cancel
                    </a>

                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150 shadow-md disabled:opacity-50" wire:loading.attr="disabled">
                        <span wire:loading wire:target="update">Saving...</span>
                        <span wire:loading.remove wire:target="update">Update user</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
