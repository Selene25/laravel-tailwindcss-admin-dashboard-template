<x-app-layout>
    @include('layouts.header-nav')
    <div class="py-2 overflow-y-auto" style="max-height: calc(100vh - 4rem);">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <!-- Search Bar -->
            <div class="mb-4 w-1/6 ml-auto">
                <label for="searchBar" class="block text-gray-700 dark:text-gray-300">Search by Subject:</label>
                <input type="text" id="searchBar" class="block w-full mt-1" placeholder="Enter subject" autocomplete="off" autocorrect="off" spellcheck="false" autocapitalize="none">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="userCards">
            @php
                $users = DB::table('users')
                    ->join('mentorlearner_tbl', 'users.id', '=', 'mentorlearner_tbl.user_id')
                    ->where('mentorlearner_tbl.mentorlearner', 0)
                    ->select('users.*', 'mentorlearner_tbl.subject')
                    ->get();
            @endphp
                @foreach ($users as $user)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg user-card" data-subject="{{ implode(', ', json_decode($user->subject ?? '[]')) }}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border border-gray-300 dark:border-gray-600">
                                @if ($user->userdp)
                                    <img src="data:image/jpeg;base64,{{ base64_encode($user->userdp) }}" alt="Profile Picture" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('image/defaultDP.jpg') }}" alt="Default Profile Picture" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <p class="mt-2 flex justify-between">
                                <span class="text-lg"><strong>Name:</strong> {{ $user->fname }}</span>
                            </p>
                            <p class="text-lg"><strong>Subjects:</strong> {{ implode(', ', json_decode($user->subject ?? '[]')) }}</p>
                        </div>
                        <div class="p-2 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex justify-end">
                            <x-primary-button class="ms-3" onclick="openModal('classScheduleModal-{{ $user->id }}')">
                                {{ __('View Details') }}
                            </x-primary-button>
                        </div>
                    </div>
                    <x-modal-details :user="$user" />
                @endforeach 
        </div>
    </div>

  
    <script>
    document.getElementById('searchBar').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const userCards = document.querySelectorAll('.user-card');

        userCards.forEach(card => {
            const subject = card.getAttribute('data-subject').toLowerCase();
            if (subject.includes(searchValue)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
    </script>
  
</x-app-layout>