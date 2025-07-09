<div>
    <form wire:submit.prevent="save">
        <!-- Section Header -->
        <div class="pb-4 mb-6">
            <div class="pb-6 border-b border-gray-700">
                <h2 class="text-base font-semibold text-white">User Information</h2>
                <p class="mt-1 text-sm text-gray-400">
                    {{ $user->exists ? 'Update the user\'s personal details.' : 'Fill in the user\'s personal details.' }}
                </p>
            </div>

            <!-- Form Fields -->
            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-6">
                <!-- Left Column -->
                <div class="mt-6 space-y-6">
                    <div class="flex space-x-6">
                        <!-- Name -->
                        <div class="w-1/2">
                            <label for="name" class="block text-sm font-medium text-white">Name</label>
                            <input type="text" wire:model="name" id="name" placeholder="Enter full name"
                                class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                            @error('name')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div class="w-1/2">
                            <label class="block mb-2 text-sm font-medium text-white">Gender</label>
                            <div class="flex items-center space-x-6 mt-[6px]">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="gender" wire:model="gender" value="male"
                                        class="mt-2 text-blue-600 bg-gray-700 border-gray-600 focus:ring-blue-500" />
                                    <span class="mt-2 ml-2 text-white">Male</span>
                                </label>

                                <label class="inline-flex items-center">
                                    <input type="radio" name="gender" wire:model="gender" value="female"
                                        class="mt-2 text-blue-600 bg-gray-700 border-gray-600 focus:ring-blue-500" />
                                    <span class="mt-2 ml-2 text-white">Female</span>
                                </label>
                            </div>
                            @error('gender')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex space-x-6">

                        <!-- Email -->
                        <div class="w-1/2">
                            <label for="email" class="block text-sm font-medium text-white">Email</label>
                            <input type="email" wire:model="email" id="email" placeholder="abc@gmail.com"
                                class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                            @error('email')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="w-1/2">
                            <label for="phone" class="block text-sm font-medium text-white">Phone</label>
                            <input type="text" wire:model="phone" id="phone" placeholder="Enter phone number"
                                class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                            @error('phone')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-white">Password</label>
                        <input type="password" wire:model="password" id="password" placeholder="Enter password"
                            class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                        @error('password')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-white">Confirm
                            Password</label>
                        <input type="password" wire:model="password_confirmation" id="password_confirmation"
                            placeholder="Confirm password"
                            class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                        @error('password_confirmation')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="relative mt-6 space-y-6">
                    <!-- Address Line 1 -->
                    <div>
                        <label for="address_line_1" class="block text-sm font-medium text-white">Address Line
                            1</label>
                        <input type="text" wire:model="address_line_1" id="address_line_1"
                            placeholder="Enter address line 1"
                            class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                        @error('address_line_1')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address Line 2 -->
                    <div class="flex mt-4 space-x-6">
                        <div class="w-1/2">
                            <label for="address_line_2" class="block text-sm font-medium text-white">Address Line
                                2</label>
                            <input type="text" wire:model="address_line_2" id="address_line_2"
                                placeholder="Enter address line 2"
                                class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                            @error('address_line_2')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- City -->
                        <div class="w-1/2">
                            <label for="city" class="block text-sm font-medium text-white">City</label>
                            <input type="text" wire:model="city" id="city" placeholder="Enter city"
                                class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                            @error('city')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex mt-4 space-x-6">

                        <!-- State -->
                        <div class="w-1/2">
                            <label for="state" class="block text-sm font-medium text-white">State</label>
                            <input type="text" wire:model="state" id="state" placeholder="Enter state"
                                class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                            @error('state')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="w-1/2">
                            <label for="postcode" class="block text-sm font-medium text-white">Postal Code</label>
                            <input type="text" wire:model="postcode" id="postcode"
                                placeholder="Enter postal code"
                                class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                            @error('postcode')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex mt-4 space-x-6">
                        <!-- Country -->
                        <div class="w-1/2">
                            <label for="country" class="block text-sm font-medium text-white">Country</label>
                            <input type="text" wire:model="country" id="country" placeholder="Enter country"
                                class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                            @error('country')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Date of Birth -->
                        <div class="w-1/2">
                            <label for="date_of_birth" class="block text-sm font-medium text-white">Date of
                                Birth</label>
                            <input type="date" wire:model="date_of_birth" id="date_of_birth"
                                onclick="this.showPicker()"
                                class="mt-2 block w-full rounded-md bg-[#1f1f1f] px-3 py-2 h-[38px] text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm"
                                style="color-scheme: dark;" />
                            @error('date_of_birth')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                @if ($roles->isNotEmpty())
                    <!-- Role Dropdown -->
                    <div>
                        <label for="selectedRoleID" class="block text-sm font-medium text-white">Select
                            Role</label>
                        <select id="selectedRoleID" wire:model="selectedRoleID" wire:change="$refresh"
                            class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm">
                            <option value="">-- Select Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('selectedRoleID')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                @endif

                @if ($selectedRoleID == $studentRoleID)
                    <div class="space-y-6">
                        <div class="flex space-x-6">
                        <!-- Classroom -->
                        <div class="w-1/2">
                            <label for="classroom_id" class="block text-sm font-medium text-white">Classroom</label>
                            <select id="classroom_id" wire:model="classroom_id"
                                class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm">
                                <option value="">-- Select Classroom --</option>
                                @foreach ($classrooms as $classroom)
                                    <option value="{{ $classroom->id }}">{{ $classroom->name }} ({{ $classroom->section }})</option>
                                @endforeach
                            </select>
                            @error('classroom_id')
                                <span class="text-sm text-red-500">Please choose a classroom</span>
                            @enderror
                        </div>

                        <div class="w-1/2">
                            <label for "roll_no" class="block text-sm font-medium text-white">Roll No</label>
                            <input type="text" wire:model="roll_no" id="roll_no" placeholder="Enter roll no"
                                class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                            @error('roll_no')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                        <!-- Guardian Name -->
                        <div>
                            <label for="guardian_name" class="block text-sm font-medium text-white">Guardian
                                Name</label>
                            <input type="text" wire:model="guardian_name" id="guardian_name"
                                placeholder="Enter guardian name"
                                class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                            @error('guardian_name')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex space-x-6">
                            <!-- Guardian Relation -->
                            <div class="w-1/2">
                                <label for="guardian_relation"
                                    class="block text-sm font-medium text-white">Relation</label>
                                <input type="text" wire:model="guardian_relation" id="guardian_relation"
                                    placeholder="Enter relation"
                                    class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                                @error('guardian_relation')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Guardian Phone -->
                            <div class="w-1/2">
                                <label for="guardian_phone" class="block text-sm font-medium text-white">Guardian
                                    Phone Number</label>
                                <input type="text" wire:model="guardian_phone" id="guardian_phone"
                                    placeholder="Enter guardian phone number"
                                    class="mt-2 w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                                @error('guardian_phone')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Is Active -->
            <div class="mt-4">
                <label for="is_active" class="inline-flex items-center">
                    <input type="checkbox" wire:model="is_active" id="is_active"
                        class="text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500" />
                    <span class="ml-2 text-sm text-white">Active?</span>
                </label>
                @error('is_active')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Save Button -->
            <div class="flex items-center justify-end mt-8 gap-x-4">
                <a href="{{ route('user.index') }}"
                    class="px-2 text-sm font-semibold text-gray-300 hover:text-white">Back</a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Save
                </button>
            </div>
        </div>
    </form>
</div>
