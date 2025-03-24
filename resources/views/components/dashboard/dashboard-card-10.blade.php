<div class="col-span-full xl:col-span-4 bg-white dark:bg-gray-800 shadow-xs rounded-xl">
    <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60">
        <h2 class="font-semibold text-gray-800 dark:text-gray-100">My Schedule Appointment</h2>
    </header>
    <div class="p-3">
        
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <colgroup>
                    <col width="5%">
                    <col width="10%">
                    <col width="5%">
                    <col width="2%">
                </colgroup>
                <!-- Table header -->
                <thead class="text-xs font-semibold uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">#</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Name</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Major</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">Appointed At</div>
                        </th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody class="text-sm divide-y divide-gray-100 dark:divide-gray-700/60">
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
                                <td class="p-2 whitespace-nowrap">{{ $i++ }}</td> 
                                <td class="p-2 whitespace-nowrap text-left">
                                    {{ $appointment->tutee_fname }} {{ $appointment->tutee_lname }}
                                </td>
                                <td class="p-2 whitespace-nowrap text-left">
                                    @php
                                        try {
                                            echo \Illuminate\Support\Facades\Crypt::decryptString($appointment->major);
                                        } catch (\Exception $e) {
                                            echo $appointment->major; // Display the raw value if decryption fails
                                        }
                                    @endphp
                                </td>
                                <td class="p-2 whitespace-nowrap text-left">{{ \Carbon\Carbon::parse($appointment->created_at)->format('F j, Y') }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center p-3 text-red-500 border-b border-gray-300 dark:border-gray-700">No appointment available.</td>
                        </tr>
                    @endif                                                                            
                </tbody>
            </table>
        
        </div>
    
    </div>
</div>