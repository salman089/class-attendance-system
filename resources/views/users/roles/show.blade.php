<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-[#161615] shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 text-white">

                    {{-- Page Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-2">
                            <i class="text-white fa-solid fa-graduation-cap"></i>
                            <h3 class="text-lg font-semibold text-white">Role Details</h3>
                        </div>

                        {{-- Consistent Back Button --}}
                        <a href="{{ route('user.role.index') }}"
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <i class="mr-2 fa-solid fa-arrow-left"></i> Back
                        </a>
                    </div>

                    {{-- Details Table --}}
                    <div class="overflow-x-auto rounded-lg shadow-md">
                        <table class="w-full text-sm text-left text-gray-400 bg-[#1f1f1f]">
                            <tbody>
                                <!-- Role ID -->
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929] w-1/3">Role</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]">#{{ $role->id }}</td>
                                </tr>

                                <!-- Name -->
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929]">Name</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]">{{ $role->name }}</td>
                                </tr>

                                <!-- Permissions -->
                                <tr class="border-b border-[#2f2f2f] align-top">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929]">Permissions</th>
                                    <td class="px-6 py-4h hover:bg-[#444242]">
                                        <ul class="space-y-2">
                                            @forelse ($role->permissions as $permission)
                                                <li class="p-3 rounded-lg hover:bg-[#353333]">
                                                    <div class="font-semibold text-gray-300">{{ $permission->title }}</div>
                                                    <div class="text-sm text-gray-400">{{ $permission->description }}
                                                    </div>
                                                </li>
                                            @empty
                                                <li class="text-gray-500">No permissions assigned.</li>
                                            @endforelse
                                        </ul>
                                    </td>
                                </tr>

                                <!-- Created At -->
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929]">Created At</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]">{{ $role->created_at }}</td>
                                </tr>

                                <!-- Updated At -->
                                <tr class="border-b border-[#2f2f2f]">
                                    <th class="px-6 py-4 font-medium text-white bg-[#292929]">Updated At</th>
                                    <td class="px-6 py-4 hover:bg-[#444242]">{{ $role->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
