<div id="classScheduleModal-{{ e($user->id) }}" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="fixed inset-0 bg-gray-900 opacity-50" onclick="closeModal('classScheduleModal-{{ e($user->id) }}')"></div>

    <div class="relative bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg max-w-4xl w-full mx-4">
        <!-- Close Button (Top Right) -->
        <button class="absolute top-4 right-4 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white"
            onclick="closeModal('classScheduleModal-{{ e($user->id) }}')">
            ✖
        </button>
        <!-- Modal Header -->
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $user->fname }}'s Class Schedule</h3>
        <!-- User Details -->
        <div class="mt-4 p-4 border rounded-lg dark:border-gray-700 flex items-center justify-between">
            <div>
                <p class="text-lg text-gray-900 dark:text-gray-100"><strong>Name:</strong> {{ $user->fname }}</p>
                <p class="text-lg text-gray-900 dark:text-gray-100"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="text-lg text-gray-900 dark:text-gray-100"><strong>Major/s:</strong> {{ implode(', ', json_decode($user->major ?? '[]')) }}</p>
                <p class="text-lg text-gray-900 dark:text-gray-100"><strong>Status:</strong> {{ $user->mentorlearner == 0 ? 'Tutor' : 'Tutee' }}</p>
            </div>
            <div class="w-32 h-32 overflow-hidden rounded-full flex-shrink-0">
                @if ($user->profile_photo_path)
                    <img src="data:image/jpeg;base64,{{ base64_encode($user->profile_photo_path) }}" 
                        alt="Profile Picture" 
                        class="w-full h-full object-cover cursor-pointer"
                        onclick="openModal('imageModal-{{ e($user->id) }}')">
                @else
                    <img src="{{ asset('image/defaultDP.jpg') }}" 
                        alt="Default Profile Picture" 
                        class="w-full h-full object-cover cursor-pointer"
                        onclick="openModal('imageModal-{{ e($user->id) }}')">
                @endif
            </div>
        </div>

        <!-- Class Schedule Details -->
        <div class="mt-6">
            <h4 class="text-xl text-gray-900 dark:text-gray-100 font-semibold">Schedule:</h4>
            <p class="mt-2 text-gray-700 dark:text-gray-300">
                📅 Class schedule details go here...
                <a href="{{ route('view-schedule-appointment', ['user' => $user->id]) }}">
                    <x-success-button class="ms-3">
                        {{ __('Set Appointment') }}
                    </x-success-button>
                </a>
            </p>
        </div>

        <!-- Close Button (Bottom) -->
        <div class="mt-6 flex justify-end">
            <x-primary-button onclick="closeModal('classScheduleModal-{{ e($user->id) }}')">
                {{ __('Close') }}
            </x-primary-button>
        </div>
    </div>
</div>

<!-- Include the Set Appointment Modal component -->
@include('components.modal-appointment', ['user' => $user])

<!-- Image Modal -->
<div id="imageModal-{{ e($user->id) }}" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="fixed inset-0 bg-gray-900 opacity-75" onclick="closeModal('imageModal-{{ e($user->id) }}')"></div>
    <div class="relative bg-white dark:bg-gray-800 p-4 rounded-lg shadow-lg max-w-2xl w-full mx-4">
        <button class="absolute top-4 right-4 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white"
            onclick="closeModal('imageModal-{{ e($user->id) }}')">
            ✖
        </button>
        <div class="flex justify-center items-center">
            @if ($user->profile_photo_path)
                <img src="data:image/jpeg;base64,{{ base64_encode($user->profile_photo_path) }}" 
                    alt="Profile Picture" 
                    class="w-full h-full object-cover">
            @else
                <img src="{{ asset('image/defaultDP.jpg') }}" 
                    alt="Default Profile Picture" 
                    class="w-full h-full object-cover">
            @endif
        </div>
    </div>
</div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function setAppointment(userId) {
        const selectedDate = document.getElementById(`selectedDate-${userId}`).value;

        if (selectedDate) {
            // Handle the appointment saving logic here
            console.log(`Saving appointment for user ${userId} on ${selectedDate}`);
            closeModal(`setAppointmentModal-${userId}`);
        } else {
            alert('Please select a date.');
        }
    }
</script>
