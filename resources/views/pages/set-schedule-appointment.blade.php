<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Set Appointment</h1>
            </div>
        </div>

        <!-- Calendar Container -->
        <div class="mt-4 bg-white dark:bg-gray-800 p-4 max-w-2xl mx-auto shadow-xs rounded-xl">
            <div id="appointmentCalendar-{{ e($user->id) }}" class="text-gray-900 dark:text-gray-100"></div>
        </div>

        <!-- Inline Modal (Hidden by Default) -->
        <div id="appointmentModal-{{ e($user->id) }}" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-2xl w-full ">
                <header class="border-b-1 border-gray-300 pb-1 -mx-6 px-6 mb-4">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Confirm Appointment</h2>
                </header>
                
                <p class="text-gray-900 dark:text-gray-100">Selected Date: <span id="modalDate-{{ e($user->id) }}"></span></p>

                <!-- New Field with Button -->
                <div class="mt-4">
                    <h2 class="text-lg text-gray-900 dark:text-gray-100">Select a Participation Type:</h2>
                    <div class="radio-button-container">
                        <div class="radio-button">
                            <input type="radio" class="radio-button__input" id="Solo" name="participation_type" value="Solo" required>
                            <label class="radio-button__label" for="Solo">
                                <span class="radio-button__custom"></span>
                                Solo
                            </label>
                        </div>
                        <div class="radio-button">
                            <input type="radio" class="radio-button__input" id="Group" name="participation_type" value="Group" required>
                            <label class="radio-button__label" for="Group">
                                <span class="radio-button__custom"></span>
                                Group
                            </label>
                        </div>
                    </div>
                </div>

                <div class="border border-gray-300 dark:border-gray-700 rounded-md shadow-sm h-12 w-100 relative mt-4">
                    <button type="button" class="w-full h-full text-left px-3 dark:text-gray-300 flex items-center justify-between" 
                    id="dropdownMenuOffset" 
                    aria-labelledby="Select Major" 
                    onclick="toggleDropdown()">
                    Select Major
                    <svg class="w-4 h-4 ml-auto text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    </button>
                    <div id="dropdown-menu" aria-labelledby="Select Major" role="menu" class="absolute left-0 right-0 mt-1 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded shadow-lg hidden z-50">
                    @php
                    $majors = DB::table('tbl_major')->select('major')->get();
                    @endphp
                    @if(isset($majors) && $majors->isNotEmpty())
                        @foreach ($majors as $major)
                        <label class="block px-4 py-2 text-gray-900 dark:text-gray-100">
                            <input type="checkbox" name="major[]" value="{{ $major->major }}" class="mr-2">
                            {{ $major->major }}
                        </label>
                        @endforeach
                    @else
                        <p class="px-4 py-2 text-gray-500 dark:text-gray-400">No majors available.</p>
                    @endif
                    </div>
                </div>
                <div id="toastMessagealert" class="hidden fixed top-5 right-5 bg-red-500 text-white px-4 py-2 rounded shadow-md">
                    Please select a date, at least one major, and a participation type.
                </div>

                <div class="flex justify-end mt-4">
                    <button class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2" onclick="closeModal('{{ $user->id }}')">Cancel</button>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg" onclick="saveAppointment('{{ $user->id }}')">Confirm</button>
                </div>
            </div>
        </div>
        <div id="toastMessage" class="hidden fixed bottom-5 right-5 bg-red-500 text-white px-4 py-2 rounded shadow-md">
            You cannot select past dates or dates within the next 5 days.
        </div>
    </div>

    <!-- Hidden input to store the selected date -->
    <form id="appointmentForm" method="POST" action="{{ route('save.appointment') }}">
        @csrf
        <input type="hidden" id="selectedDate-{{ e($user->id) }}" name="sched">
        <input type="hidden" name="tutor_id" value="{{ $user->id }}">
        <input type="hidden" id="selectedMajors" name="major">
        <input type="hidden" id="type" name="type"> <!-- New hidden input for emails -->
    </form>


    <script>
        function showToast(message) {
            let toast = document.getElementById('toastMessage');
            toast.textContent = message;
            toast.classList.remove('hidden');
            
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000); // Hide after 3 seconds
        }

        function showToastalert(message) {
            let toast = document.getElementById('toastMessagealert');
            toast.textContent = message;
            toast.classList.remove('hidden');

            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000); // Hide after 3 seconds
        }

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('appointmentCalendar-{{ e($user->id) }}');

            if (calendarEl) {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    selectable: true,
                    dateClick: function(info) {
                        let today = new Date();
                        today.setHours(0, 0, 0, 0);

                        let selectedDate = new Date(info.dateStr);
                        selectedDate.setHours(0, 0, 0, 0);

                        let maxRestrictedDate = new Date(today);
                        maxRestrictedDate.setDate(today.getDate() + 5);

                        // Prevent selection of past dates and the next 5 days
                        if (selectedDate < today || selectedDate < maxRestrictedDate) {
                            showToast('You cannot select past dates or dates within the next 5 days.');
                            return;
                        }

                        // Format date as "March 25, 2025"
                        let formattedDate = selectedDate.toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });

                        // Double-click logic
                        if (this.lastClick && (new Date().getTime() - this.lastClick < 300)) {
                            let selectedDateInput = document.getElementById('selectedDate-{{ e($user->id) }}');
                            selectedDateInput.value = info.dateStr;

                            let modalDate = document.getElementById('modalDate-{{ e($user->id) }}');
                            modalDate.textContent = formattedDate;

                            openModal('{{ $user->id }}');
                        }
                        this.lastClick = new Date().getTime();
                    }
                });
                calendar.render();
            }
        });

        function openModal(userId) {
            document.getElementById(`appointmentModal-${userId}`).classList.remove('hidden');
        }

        function closeModal(userId) {
            document.getElementById(`appointmentModal-${userId}`).classList.add('hidden');
        }

        function saveAppointment(userId) {
            const selectedDate = document.getElementById(`selectedDate-${userId}`).value;
            const selectedMajors = Array.from(document.querySelectorAll('input[name="major[]"]:checked'))
                .map(checkbox => checkbox.value)
                .join(', ');
            const participationType = document.querySelector('input[name="participation_type"]:checked')?.value;

            if (selectedDate && selectedMajors && participationType) {
                document.getElementById('selectedMajors').value = selectedMajors;
                document.getElementById('type').value = participationType; // Set participation type
                document.getElementById('appointmentForm').submit();
            } else {
                showToastalert('Please select a date, at least one major, and a participation type.');
            }
        }
    </script>
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-menu');
            dropdown.classList.toggle('hidden');
        }
    
        document.querySelector('form').addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdown-menu');
            const button = dropdown.previousElementSibling;
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('input[name="major[]"]');
            const dropdownButton = document.getElementById('dropdownMenuOffset');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedSubjects);
            });

            function updateSelectedSubjects() {
                let selectedSubjects = [];
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        selectedSubjects.push(checkbox.value);
                    }
                });

                dropdownButton.textContent = selectedSubjects.length > 0 ? selectedSubjects.join(', ') : "Select Subjects";
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', function (event) {
                const dropdown = document.getElementById('dropdown-menu');
                const button = document.getElementById('dropdownMenuOffset');

                if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>
