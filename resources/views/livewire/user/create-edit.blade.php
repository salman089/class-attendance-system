<div>
    <form wire:submit="save">
        <!-- Section Header -->
        <div class="pb-4 mb-6">
            <div class="pb-6 border-b border-gray-700">
                <h2 class="text-base font-semibold text-white">User Information</h2>
                <p class="mt-1 text-sm text-gray-400">Fill in the user's personal details.</p>
            </div>

            <!-- Form Fields -->
            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-6">
                <!-- Left Column -->
                <div class="mt-6 space-y-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-white">Name</label>
                        <input type="text" wire:model="name" id="name" placeholder="Enter full name"
                            class="mt-1 block w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                        @error('name')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-white">Address</label>
                        <textarea wire:model="address" id="address" rows="5" placeholder="Enter your address"
                            class="mt-1 block w-full rounded-md bg-[#1f1f1f] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm resize-none"></textarea>
                        @error('address')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-white">Phone</label>
                        <input type="text" wire:model="phone" id="phone" placeholder="Enter phone number"
                            class="mt-2.5 block w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                        @error('phone')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="mt-6 space-y-6">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-white">Email</label>
                        <input type="email" wire:model="email" id="email" placeholder="abc@gmail.com"
                            class="mt-1 block w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                        @error('email')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-white">Password</label>
                        <input type="password" wire:model="password" id="password" placeholder="Enter password"
                            class="mt-1 block w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
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
                            class="mt-1 block w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                        @error('password_confirmation')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label for="date_of_birth" class="block mb-1 text-sm font-semibold text-gray-200">
                            Date of Birth
                        </label>
                        <input type="date" wire:model="date_of_birth" id="date_of_birth" onclick="this.showPicker()"
                            class="block w-full rounded-md bg-[#1f1f1f] px-3 py-2 h-10 text-white placeholder:text-gray-400
           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            style="color-scheme: dark;" />

                        @error('date_of_birth')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end mt-8 gap-x-4">
                <a href="{{ route('user.index') }}"
                    class="px-2 text-sm font-semibold leading-6 text-gray-300 hover:text-white">Back</a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 rounded-md hover:bg-blue-500 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Save
                </button>
            </div>
        </div>
    </form>
</div>
