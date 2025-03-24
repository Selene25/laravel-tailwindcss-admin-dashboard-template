<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Check if modal should be shown -->
        @php
            $showModal = !\DB::table('tbl_mentorlearner')->where('user_id', auth()->id())->exists();
        @endphp

        <!-- Include modal if necessary -->
        <x-modal-mentorlearner :showModal="$showModal" />

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Dashboard</h1>
            </div>

          

        </div>
        
        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6">

            <!-- Table (Top Channels) -->
            <x-dashboard.dashboard-card-12 />

            <!-- Card (Customers) -->
            @php
                $mentorlearner = \DB::table('tbl_mentorlearner')
                    ->where('user_id', auth()->id())
                    ->value('mentorlearner');
            @endphp

            @if($mentorlearner != 1)
                <x-dashboard.dashboard-card-10 />
            @endif

            <!-- Card (Recent Activity) -->
            <x-dashboard.dashboard-card-07 />
            
            <!-- Card (Income/Expenses) -->
            <x-dashboard.dashboard-card-13 />

        </div>

    </div>
</x-app-layout>
