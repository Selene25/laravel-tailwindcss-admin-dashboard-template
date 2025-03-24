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
                <h2 class="font-semibold text-gray-800 dark:text-gray-100">Appointment Schedule</h2>
            </header>

            <div class="p-3">
                <div class="overflow-x-auto">
                    <div class="relative">
                        <!-- Scrollable Table Container -->
                        <div class="max-h-80 overflow-y-auto">
                            <table class="table-auto w-full border-collapse">
                                <colgroup>
                                    <col width="5%">
                                    <col width="10%">
                                    <col width="5%">
                                    <col width="15%">
                                    <col width="10%">
                                    <col width="10%">
                                </colgroup>
                                <thead class="text-xs font-semibold uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700/50 text-left sticky top-0 z-10">
                                    <tr>
                                        <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-left bg-gray-50 dark:bg-gray-700">#</th>
                                        <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-left bg-gray-50 dark:bg-gray-700">Name of Tutee</th>
                                        <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-left bg-gray-50 dark:bg-gray-700">Type</th>
                                        <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-left bg-gray-50 dark:bg-gray-700">Major</th>
                                        <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-left bg-gray-50 dark:bg-gray-700">Created At</th>
                                        <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-left bg-gray-50 dark:bg-gray-700">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-200 dark:divide-gray-700 text-left">
                                    @php
                                        $appointments = DB::table('tbl_appointment')
                                            ->join('users', 'tbl_appointment.tutee_id', '=', 'users.id')
                                            ->select(
                                                'tbl_appointment.*', 
                                                'users.fname as tutee_fname', 
                                                'users.lname as tutee_lname'
                                            )
                                            ->where('tbl_appointment.tutor_id', '=', Auth::id())
                                            ->get();
                                        $i = 1; 
                                    @endphp
                                    @if($appointments->isNotEmpty())
                                        @foreach ($appointments as $appointment)
                                            <tr>
                                                <td class="p-3 border-b border-gray-300 dark:border-gray-700 text-left">{{ $i++ }}</td> 
                                                <td class="p-3 border-b border-gray-300 dark:border-gray-700 text-left">{{ $appointment->tutee_fname }} {{ $appointment->tutee_lname }}</td> 
                                                <td class="p-3 border-b border-gray-300 dark:border-gray-700 text-left">
                                                    {{ $appointment->type }}
                                                </td>
                                                <td class="p-3 border-b border-gray-300 dark:border-gray-700 text-left">
                                                    @php
                                                        try {
                                                            echo \Illuminate\Support\Facades\Crypt::decryptString($appointment->major);
                                                        } catch (\Exception $e) {
                                                            echo $appointment->major; // Display the raw value if decryption fails
                                                        }
                                                    @endphp
                                                </td>
                                                <td class="p-3 border-b border-gray-300 dark:border-gray-700 text-left">{{ \Carbon\Carbon::parse($appointment->created_at)->format('F j, Y') }}</td>
                                                <td class="p-3 border-b border-gray-300 dark:border-gray-700 text-left">
                                                    <button class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-lg cursor-pointer">Edit</button>
                                                    <button class="px-4 py-2 bg-gray-600 hover:bg-gray-500 text-white rounded-lg cursor-pointer">View</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center p-3 text-red-500 border-b border-gray-300 dark:border-gray-700">No appointment available.</td>
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