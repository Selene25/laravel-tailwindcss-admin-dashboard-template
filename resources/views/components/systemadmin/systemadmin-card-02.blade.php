<div class="col-span-full xl:col-span-6 bg-white dark:bg-gray-800 shadow-xs rounded-xl">
<header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex items-center justify-between">
        <h2 class="font-semibold text-gray-800 dark:text-gray-100">Example Card #04</h2>
        <div class="grid grid-flow-col sm:auto-cols-max gap-2">
            <!-- Add view button -->
            <button id="viewBtnCard02" class="btn bg-gray-900 text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                <svg class="fill-current shrink-0 xs:hidden" width="16" height="16" viewBox="0 0 16 16">
                    <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                </svg>
                <span class="max-xs:sr-only">View</span>
            </button>
        </div>
    </header>
    <div class="p-3">
  
    </div>
</div>

<!-- XL Modal -->
<div id="xlModalCard02" class="hidden fixed inset-0 dark:text-gray-100 dark:bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-11/12 xl:w-3/4 p-6">
        <header class="flex justify-between items-center border-b pb-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Customer Details</h2>
            <button id="closeModalCard02" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">&times;</button>
        </header>
        <div class="mt-4">
            <p class="text-gray-700 dark:text-gray-300">Customer details will be displayed here...</p>
        </div>
    </div>
</div>

<script>
    document.getElementById('viewBtnCard02').addEventListener('click', function() {
        document.getElementById('xlModalCard02').classList.remove('hidden');
    });
    document.getElementById('closeModalCard02').addEventListener('click', function() {
        document.getElementById('xlModalCard02').classList.add('hidden');
    });
</script>
