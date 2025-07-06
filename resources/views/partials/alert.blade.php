<div>
    @if (session('alert'))
        <div class="flex items-center justify-between px-4 py-3 mb-4 text-sm text-red-200 bg-red-900 rounded-md">
            <span>{{ session('alert') }}</span>
            <button type="button" onclick="this.parentElement.remove()"
                class="text-red-700 transition hover:text-red-900 dark:text-red-300 dark:hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @endif
</div>
