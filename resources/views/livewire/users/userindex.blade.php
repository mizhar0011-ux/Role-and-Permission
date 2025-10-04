

<div>
<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('Users') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage All Your User ') }}</flux:subheading>
    <flux:separator variant="subtle" />
</div>


            @if (session('success'))
                <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded-md shadow-md" role="alert">
                    <p class="font-bold">Success!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

{{--  --}}
<a href="{{ route('user.create') }}" 
       class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium 
              rounded-full shadow-lg text-white bg-gray-800 
              hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-indigo-500 
              focus:ring-opacity-50 
              glowing-button m-4">
         Create User
    </a>

<div class="p-6 bg-white shadow-lg rounded-xl">
    <div class="mb-6">
        <input wire:model.live="search" type="text" placeholder="Search by name or email..." 
               class="p-3 border border-gray-300 rounded-lg w-full text-gray-700 
                      focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out">
    </div>
    
    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
            <p>{{ session('message') }}</p>
        </div>
    @endif

    <div class="overflow-x-auto relative sm:rounded-lg" >
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead  style="background-color: gray" class="text-xs text-white uppercase bg-gray-100 border-b border-gray-200">
                <tr>
                    <th scope="col" class="py-3 px-6">S.No</th>
                    <th scope="col" class="py-3 px-6">Name</th>
                    <th scope="col" class="py-3 px-6">Email</th>
                    <th scope="col" class="py-3 px-6">Roles</th>
                    <th scope="col" class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr style="background-color: rgba(180, 180, 180, 0.838)" class="border-b hover:bg-gray-50">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                            {{ $loop->iteration }}
                        </th>
                        <td class="py-4 px-6">{{ $user->name }}</td>
                        <td class="py-4 px-6">{{ $user->email }}</td>
                        <td class="py-4 px-6">
                        @if ($user->roles)
                              @foreach ($user->roles as $role)
                              <flux:badge class="mt-1" variant="solid">{{ $role->name }}</flux:badge>
                               @endforeach
                            @endif
                        </td>
                        </td>
                        <td class="py-4 px-6 flex justify-center space-x-3">

                            <a href="{{ route('user.show', $user->id) }}" 
                               class="text-sm font-medium text-blue-600 hover:text-blue-800 transition duration-150">
                                Show
                            </a>
                            

                            {{-- past this in href {{ route('users.edit', $user->id) }}--}}
<a href="{{ route('user.edit', $user) }}" 
    class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition duration-150">
    Edit
</a>

                            <button wire:click="delete({{ $user->id }})" 
                                    wire:confirm="Are you sure you want to delete {{ $user->name }}?"
                                    class="text-sm font-medium text-red-600 hover:text-red-800 transition duration-150">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 px-6 text-center text-gray-500">
                            No users found matching your search.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>

</div>
