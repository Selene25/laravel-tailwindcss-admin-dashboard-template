<!-- Include the modal -->
@props(['showModal' => $showModal])

@if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center" id="welcomeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="fixed inset-0 bg-gray-900 opacity-50"></div>
        <div class="relative bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg max-w-sm w-full mx-4">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you a Tutor or Tutee?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form action="{{ route('layouts.mentorlearner') }}" method="POST">
                    @csrf
                    <!-- Mentor & Learner -->
                    <div>
                        <x-label for="mentorlearner" :value="__('Mentor & Learner')" />
                        <select id="mentorlearner" name="mentorlearner" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" required>
                            <option value="" disabled selected>{{ __('Select Tutor or Tutee') }}</option>
                            <option value="0">{{ __('Tutor') }}</option>
                            <option value="1">{{ __('Tutee') }}</option>
                        </select>
                        <x-error-input :messages="$errors->get('mentorlearner')" class="mt-2" />
                    </div>
                    <!-- Subject -->
                    <div>
                        <x-label for="subject" :value="__('Subject')" />
                        <div class="block mt-1 w-full relative">
                            <div class="border border-gray-300 dark:border-gray-700 rounded-md shadow-sm h-12 relative">
                                <button type="button" class="w-full h-full text-left px-3 dark:text-gray-300 flex items-center justify-between" 
                                    id="dropdownMenuOffset" 
                                    aria-labelledby="Select Subjects" 
                                    onclick="toggleDropdown()">
                                    Select Subjects
                                    <svg class="w-4 h-4 ml-auto text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div id="dropdown-menu" aria-labelledby="Select Subjects" role="menu" class="absolute left-0 right-0 mt-1 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded shadow-lg hidden z-50">
                                @php
                                    $majors = DB::table('tbl_major')->select('major')->get();
                                @endphp
                                    @if(isset($majors) && $majors->isNotEmpty())
                                        @foreach ($majors as $major)
                                            <label class="block px-4 py-2 text-gray-900 dark:text-gray-100">
                                                <input type="checkbox" name="subject[]" value="{{ $major->major }}" class="mr-2">
                                                {{ $major->major }}
                                            </label>
                                        @endforeach
                                    @else
                                        <p class="px-4 py-2 text-gray-500 dark:text-gray-400">No majors available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <x-button type="submit">
                            {{ __('Save') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('welcomeModal'));
            myModal.show();
        });
        
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
            const checkboxes = document.querySelectorAll('input[name="subject[]"]');
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
@endif
