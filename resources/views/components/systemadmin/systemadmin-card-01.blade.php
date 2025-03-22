<div class="col-span-full xl:col-span-6 bg-white dark:bg-gray-800 shadow-xs rounded-xl">
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
                                <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-left bg-gray-50 dark:bg-gray-700">Created By</th>
                                <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-left bg-gray-50 dark:bg-gray-700">Created At</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-200 dark:divide-gray-700 text-left">
                            @php
                                $majors = DB::table('tbl_major')
                                    ->join('users', 'tbl_major.user_id', '=', 'users.id')
                                    ->select('tbl_major.*', 'users.fname as user_fname') // Use fname instead of name
                                    ->get();
                                $i = 1; 
                            @endphp
                            @if($majors->isNotEmpty())
                                @foreach ($majors as $major)
                                    <tr>
                                        <td class="p-3 border-b border-gray-300 dark:border-gray-700 text-left">{{ $i++ }}</td> 
                                        <td class="p-3 border-b border-gray-300 dark:border-gray-700 text-left">{{ $major->major }}</td>
                                        <td class="p-3 border-b border-gray-300 dark:border-gray-700 text-left">{{ $major->user_fname }}</td>
                                        <td class="p-3 border-b border-gray-300 dark:border-gray-700 text-left">{{ \Carbon\Carbon::parse($major->created_at)->format('F j, Y') }}</td>
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


<!-- Small Modal -->
<div id="xlModalCard01" class="fixed inset-0 hidden dark:text-gray-100 dark:bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-11/12 sm:w-1/3 p-6">
        <header class="flex justify-between items-center border-b pb-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Add a New Major</h2>
            <button id="closeModal" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer">&times;</button>
        </header>

        <div class="mt-4">
            <p class="text-gray-700 dark:text-gray-300 mb-4">Enter new major:</p>

            <!-- Strict input field -->
            <input type="text" id="customerName" 
                class="w-full p-3 border rounded-md text-gray-800 dark:text-gray-200 dark:bg-gray-700"
                placeholder="Enter Major" 
                oninput="formatInput(this)" autocomplete="off" />

            <p id="errorMessage" class="text-red-500 text-sm mt-2 hidden">Only letters are allowed.</p>
        </div>
        <div class="mt-6 flex justify-end">
            <button id="saveBtnCard01" class="btn bg-gray-900 text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white cursor-pointer">
                <span class="max-xs:sr-only">Save</span>
            </button>
        </div>
    </div>
</div>

<script>
    document.getElementById('viewBtnCard01').addEventListener('click', function() {
        document.getElementById('xlModalCard01').classList.remove('hidden');
    });
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('xlModalCard01').classList.add('hidden');
    });

    function showToast(message, type = 'success') {
        const toast = document.getElementById('toastNotification');
        const toastMessage = document.getElementById('toastMessage');

        // Set the message text
        toastMessage.innerText = message;

        // Apply styles based on the type (success or error)
        if (type === 'success') {
            toast.classList.remove('bg-red-600');
            toast.classList.add('bg-green-600');
        } else {
            toast.classList.remove('bg-green-600');
            toast.classList.add('bg-red-600');
        }

        // Show the toast
        toast.classList.remove('hidden');
        toast.classList.add('opacity-100');

        // Hide the toast after 3 seconds
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 3000);
    }

    function formatInput(input) {
        let value = input.value;

        // Allow only letters and spaces
        if (!/^[a-zA-Z\s]*$/.test(value)) {
            document.getElementById("errorMessage").classList.remove("hidden");
            input.value = value.replace(/[^a-zA-Z\s]/g, ""); // Remove invalid characters
        } else {
            document.getElementById("errorMessage").classList.add("hidden");
        }

        // Capitalize first letter of each word
        input.value = input.value.replace(/\b\w/g, char => char.toUpperCase());
    }

    document.getElementById('saveBtnCard01').addEventListener('click', async function() {
        const majorName = document.getElementById('customerName').value.trim();

        if (majorName === '') {
            showToast('Please enter a valid major.', 'error');
            return;
        }

        try {
            // Check if the major already exists
            const checkResponse = await fetch('/check-major', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ major: majorName })
            });

            const checkResult = await checkResponse.json();

            if (checkResult.exists) {
                showToast('This major already exists. Please enter a unique major.', 'error');
                return;
            }

            // Save the new major
            const saveResponse = await fetch('/save-major', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ major: majorName })
            });

            if (saveResponse.ok) {
                showToast('Major saved successfully!', 'success');
                document.getElementById('xlModalCard01').classList.add('hidden');
                document.getElementById('customerName').value = '';
                setTimeout(() => {
                    location.reload(); // Refresh after showing the toast
                }, 2000);
            } else {
                showToast('Failed to save major. Please try again.', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('An error occurred. Please try again.', 'error');
        }
    });
</script>
