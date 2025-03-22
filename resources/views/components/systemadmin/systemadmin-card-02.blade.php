<div class="col-span-full xl:col-span-6 bg-white dark:bg-gray-800 shadow-xs rounded-xl">
<header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex items-center justify-between">
        <h2 class="font-semibold text-gray-800 dark:text-gray-100">Customers</h2>
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
        
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <!-- Table header -->
                <thead class="text-xs font-semibold uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Name</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Email</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Spent</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">Country</div>
                        </th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody class="text-sm divide-y divide-gray-100 dark:divide-gray-700/60">
                    <tr>
                        <td class="p-2 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 shrink-0 mr-2 sm:mr-3">
                                    <img class="rounded-full" src="{{ asset('images/user-36-05.jpg') }}" width="40" height="40" alt="Alex Shatov" />
                                </div>
                                <div class="font-medium text-gray-800">Alex Shatov</div>
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left">alexshatov@gmail.com</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left font-medium text-green-500">$2,890.66</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-lg text-center">🇺🇸</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 shrink-0 mr-2 sm:mr-3">
                                    <img class="rounded-full" src="{{ asset('images/user-36-06.jpg') }}" width="40" height="40" alt="Philip Harbach" />
                                </div>
                                <div class="font-medium text-gray-800">Philip Harbach</div>
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left">philip.h@gmail.com</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left font-medium text-green-500">$2,767.04</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-lg text-center">🇩🇪</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 shrink-0 mr-2 sm:mr-3">
                                    <img class="rounded-full" src="{{ asset('images/user-36-07.jpg') }}" width="40" height="40" alt="Mirko Fisuk" />
                                </div>
                                <div class="font-medium text-gray-800">Mirko Fisuk</div>
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left">mirkofisuk@gmail.com</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left font-medium text-green-500">$1,220.66</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-lg text-center">🇫🇷</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 shrink-0 mr-2 sm:mr-3">
                                    <img class="rounded-full" src="{{ asset('images/user-36-08.jpg') }}" width="40" height="40" alt="Burak Long" />
                                </div>
                                <div class="font-medium text-gray-800">Burak Long</div>
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left">longburak@gmail.com</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left font-medium text-green-500">$1,890.66</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-lg text-center">🇬🇧</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 shrink-0 mr-2 sm:mr-3">
                                    <img class="rounded-full" src="{{ asset('images/user-36-09.jpg') }}" width="40" height="40" alt="Alex Shatov" />
                                </div>
                                <div class="font-medium text-gray-800">Alex Shatov</div>
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left">alexshatov@gmail.com</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left font-medium text-green-500">$2,890.66</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-lg text-center">🇺🇸</div>
                        </td>
                    </tr>                                                                                
                </tbody>
            </table>
        
        </div>
    
    </div>
</div>

<!-- XL Modal -->
<div id="xlModalCard02" class="fixed inset-0 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center">
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