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
            <table class="table-auto w-full">
                <thead class="text-xs font-semibold uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="p-2 whitespace-nowrap">Major</th>
                        <th class="p-2 whitespace-nowrap">Created By</th>
                        <th class="p-2 whitespace-nowrap">Created At</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100 dark:divide-gray-700/60">
                @if(isset($majors))
                    @foreach ($majors as $major)
                        <tr>
                            <td class="p-2 whitespace-nowrap">{{ $major->major }}</td>
                            <td class="p-2 whitespace-nowrap">{{ $major->user_name }}</td>
                            <td class="p-2 whitespace-nowrap">{{ \Carbon\Carbon::parse($major->created_at)->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="3" class="text-center text-red-500">No data available.</td></tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Small Modal -->
<div id="xlModalCard01" class="fixed inset-0 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center">
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
            alert('Please enter a valid major.');
            return;
        }

        try {
            const response = await fetch('/save-major', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ major: majorName })
            });

            if (response.ok) {
                alert('Major saved successfully!');
                document.getElementById('xlModalCard01').classList.add('hidden');
                document.getElementById('customerName').value = '';
            } else {
                alert('Failed to save major. Please try again.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        }
    });
</script>
