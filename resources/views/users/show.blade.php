<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-[#161615] shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 text-white">

                    {{-- Page Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-2">
                            <i class="text-white fa-solid fa-graduation-cap"></i>
                            <h3 class="text-lg font-semibold text-white">User Details</h3>
                        </div>

                        {{-- Consistent Back Button --}}
                        <a href="{{ route('user.index') }}"
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <i class="mr-2 fa-solid fa-arrow-left"></i> Back
                        </a>
                    </div>

                    {{-- Details Table --}}
                    <div class="overflow-x-auto rounded-lg shadow-md">
                        <table class="w-full text-sm text-left text-gray-400 bg-[#1f1f1f] ">
                            <tbody>
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929] w-1/3">ID</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]">#{{ $user->id }}</td>
                                </tr>
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929] w-1/3">Name</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]">{{ $user->name }}</td>
                                </tr>
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929] w-1/3">Email</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]">{{ $user->email }}</td>
                                </tr>
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929] w-1/3">Adress</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]">{{ $user->address_line_1 }}, {{ $user->address_line_2 }}</td>
                                </tr>
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929] w-1/3">City</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]"> {{ $user->city }}</td>
                                </tr>
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929] w-1/3">State</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]"> {{ $user->state }}</td>
                                </tr>
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929] w-1/3">Postal Code</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]"> {{ $user->postcode }}</td>
                                </tr>
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929] w-1/3">Country</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]"> {{ $user->country }}</td>
                                </tr>
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929] w-1/3">Phone Number</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]">{{ $user->phone }}</td>
                                </tr>
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929]">Date of Birth</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]">{{ $user->date_of_birth }}</td>
                                </tr>
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929]">Gender</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]">{{ ucfirst($user->gender) }}</td>
                                </tr>
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929]">Active</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]">
                                        <span class="{{ $user->is_active ? 'text-green-400' : 'text-red-400' }}">
                                            {{ $user->is_active ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929]">Role</th>
                                    @forelse ($user->roles as $role)
                                        <td class="px-6 py-4 hover:bg-[#444242]">{{ $role->name }}</td>
                                    @empty
                                        <td class="px-6 py-4 text-red-400 hover:bg-[#444242]">No roles assigned</td>
                                    @endforelse
                                </tr>
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929]">Created At</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]">{{ $user->created_at }}</td>
                                </tr>
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929]">Updated At</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]">{{ $user->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
