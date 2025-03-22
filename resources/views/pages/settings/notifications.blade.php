<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Academic & User Management actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">My Notification</h1>
            </div>

        </div>
        
        <!-- Cards -->
        <div class="bg-white dark:bg-gray-800 shadow-xs rounded-xl">
            <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex items-center justify-between">
                <h2 class="font-semibold text-gray-800 dark:text-gray-100">Majors</h2>
                <div class="grid grid-flow-col sm:auto-cols-max gap-2">
                    <!-- Add view button -->
                    <button id="viewBtnCard01" class="btn bg-gray-900 text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white cursor-pointer" title="View Details">
                        <span class="max-xs:sr-only">View</span>
                    </button>
                </div>
            </header>

            <div class="p-3">
                <div class="overflow-x-auto">
                    <div class="relative">
                        <!-- Scrollable Table Container -->
                        <div class="max-h-80 overflow-y-auto">
                            <table class="table-auto w-full border-collapse">
                                <thead class="text-xs font-semibold uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700/50 text-left sticky top-0 z-10">
                                    <tr>
                                        <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-left bg-gray-50 dark:bg-gray-700">#</th>
                                        <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-left bg-gray-50 dark:bg-gray-700">Major</th>
                                        <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-left bg-gray-50 dark:bg-gray-700">Email</th>
                                        <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-left bg-gray-50 dark:bg-gray-700">Created At</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-200 dark:divide-gray-700 text-left">
                                    @php
                                        $appointments = DB::table('tbl_appointment')
                                            ->join('users as tutee', 'tbl_appointment.tutee_id', '=', 'tutee.id')
                                            ->join('users as tutor', 'tbl_appointment.tutor_id', '=', 'tutor.id')
                                            ->select(
                                                'tbl_appointment.*', 
                                                'tutee.fname as tutee_fname', 
                                                'tutor.fname as tutor_fname'
                                            )
                                            ->get();
                                        $i = 1; 
                                    @endphp
                                    @if($appointments->isNotEmpty())
                                        @foreach ($appointments as $appointment)
                                            <tr>
                                                <td class="p-3 border-b border-gray-300 dark:border-gray-700 text-left">{{ $i++ }}</td> 
                                                <td class="p-3 border-b border-gray-300 dark:border-gray-700 text-left">
                                                    @php
                                                        try {
                                                            echo \Illuminate\Support\Facades\Crypt::decryptString($appointment->major);
                                                        } catch (\Exception $e) {
                                                            echo $appointment->major; // Display the raw value if decryption fails
                                                        }
                                                    @endphp
                                                </td>
                                                <td class="p-3 border-b border-gray-300 dark:border-gray-700 text-left">
                                                    @php
                                                        try {
                                                            echo \Illuminate\Support\Facades\Crypt::decryptString($appointment->emails);
                                                        } catch (\Exception $e) {
                                                            echo $appointment->emails; // Display the raw value if decryption fails
                                                        }
                                                    @endphp
                                                </td>
                                                <td class="p-3 border-b border-gray-300 dark:border-gray-700 text-left">{{ \Carbon\Carbon::parse($appointment->created_at)->format('F j, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center p-3 text-red-500 border-b border-gray-300 dark:border-gray-700">No data available.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <div id="toastNotification" class="hidden fixed bottom-5 right-5 bg-gray-900 text-white px-6 py-3 rounded-md shadow-lg transition-opacity duration-300">
            <span id="toastMessage"></span>
        </div>
    </div>
</x-app-layout>