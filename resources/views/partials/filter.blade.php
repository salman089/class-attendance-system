<div class="flex justify-end">
  <div class="flex items-center space-x-2">
    <label for="filter" class="text-sm font-semibold text-white">Filter:</label>
    <select wire:model.live="filter" id="filter"
      class="text-sm text-white bg-black rounded-md shadow-sm border-b border-[#363634] focus:border-blue-500 focus:ring-blue-500">
      <option value="All">All</option>
      <option value="Student">Students</option>
      <option value="Head of Department">Head of Departments</option>
      <option value="Teacher">Teachers</option>
    </select>
  </div>
</div>
