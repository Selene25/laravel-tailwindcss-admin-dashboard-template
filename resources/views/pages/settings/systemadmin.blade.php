<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Academic & User Management actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Academic & User Management</h1>
            </div>

        </div>
        
        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6">

          

            <!-- Bar chart (Direct vs Indirect) -->
            <x-systemadmin.systemadmin-card-01 />

            <!-- Line chart (Real Time Value) -->
            <x-systemadmin.systemadmin-card-02 />

            <!-- Card (Customers) -->
            <x-systemadmin.systemadmin-card-03 />

            <!-- Card (Recent Activity) -->
            <x-systemadmin.systemadmin-card-04 />
            
            <!-- Card (Income/Expenses) -->
            <x-systemadmin.systemadmin-card-05 />

        </div>
        <div id="toastNotification" class="hidden fixed bottom-5 right-5 bg-gray-900 text-white px-6 py-3 rounded-md shadow-lg transition-opacity duration-300">
            <span id="toastMessage"></span>
        </div>
    </div>
</x-app-layout>
