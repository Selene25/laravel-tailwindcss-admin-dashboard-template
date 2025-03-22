<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">View Schedule of {{ $user->fname }} {{ $user->lname }}</h1>
            </div>
        </div>

        <!-- Calendar Container -->
        <div class="mt-4 bg-white dark:bg-gray-800 p-4 max-w-2xl mx-auto shadow-xs rounded-xl">
            <div id="appointmentCalendar-{{ $user->id }}" class="text-gray-900 dark:text-gray-100"></div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('appointmentCalendar-{{ $user->id }}');

            if (calendarEl) {
                var appointments = @json($appointments) || []; // Ensure it's an array even if null
                var events = appointments.map(appointment => ({
                    id: appointment.id,
                    start: appointment.sched.split('T')[0], // Ensure only date part is used
                    end: appointment.end_session ? appointment.end_session.split('T')[0] : null, // Handle possible null end_session
                    title: 'Appointed',
                }));
                
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    selectable: true,
                    events: events,
                });
                calendar.render();
            }
        });
    </script>
</x-app-layout>
