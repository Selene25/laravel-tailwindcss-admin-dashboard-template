<x-app-layout>
    <div class="py-2 overflow-y-auto" style="max-height: calc(100vh - 4rem);">
        <div class="mx-auto sm:px-6 lg:px-6 px-4">
            <!-- Search Bar -->
            <div class="mb-4 w-full sm:w-1/2 lg:w-1/3 ml-auto px-4 sm:px-0">
                <label for="searchBar" class="block text-gray-700 dark:text-gray-300 text-sm sm:text-base">Search by Subject:</label>
                <input type="text" id="searchBar" class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-600 text-sm sm:text-base" placeholder="Enter Major" autocomplete="off" autocorrect="off" spellcheck="false" autocapitalize="none">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="userCards">
                @php
                    $users = DB::table('users')
                    ->select('users.*', 'tbl_mentorlearner.major', 'tbl_mentorlearner.mentorlearner')
                    ->join('tbl_mentorlearner', 'users.id', '=', 'tbl_mentorlearner.user_id')
                    ->where('tbl_mentorlearner.mentorlearner', 0)
                    ->get();
                @endphp
                @foreach ($users as $user)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg user-card flex flex-col" data-major="{{ implode(', ', json_decode($user->major ?? '[]')) }}">
                        <div class="p-6 text-gray-900 dark:text-gray-100 flex-grow">
                            <div class="w-24 h-24 mx-auto rounded-full overflow-hidden border border-gray-300 dark:border-gray-600">
                                @if ($user->profile_photo_path)
                                    <img src="data:image/jpeg;base64,{{ base64_encode($user->profile_photo_path) }}" alt="Profile Picture" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('image/defaultDP.jpg') }}" alt="Default Profile Picture" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <p class="mt-4 text-center text-lg font-semibold">
                                <strong>Name:</strong> {{ $user->fname }}
                            </p>
                            <p class="text-center text-lg">
                                <strong>Subjects:</strong> {{ implode(', ', json_decode($user->major ?? '[]')) }}
                            </p>
                        </div>
                        <div class="p-4 dark:bg-gray-800 flex justify-center">
                            <x-primary-button class="ms-3" onclick="openModal('classScheduleModal-{{ $user->id }}')">
                                {{ __('View Details') }}
                            </x-primary-button>
                        </div>
                    </div>
                    <x-modal-details :user="$user" />
                @endforeach 
            </div>
        </div>
    </div>

    <script>
    document.getElementById('searchBar').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const userCards = document.querySelectorAll('.user-card');

        userCards.forEach(card => {
            const major = card.getAttribute('data-major').toLowerCase();
            if (major.includes(searchValue)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
    </script>
</x-app-layout>