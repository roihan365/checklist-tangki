<x-dashboard-layout>
    <div class="flex flex-col lg:flex-row gap-6">
        <div class="lg:w-3/4 bg-white rounded-xl shadow-md p-4">
            <div id='calendar'></div>
        </div>
        <div class="lg:w-1/4">
            <div class="bg-white rounded-xl shadow-md p-4">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Jadwal Hari Ini</h2>
                <div class="space-y-3">
                    @foreach ($schedules as $schedule)
                        @if ($schedule->tanggal->isToday())
                            <div class="border-l-4 border-green-500 bg-green-50 p-3 rounded-r">
                                <p class="font-bold text-gray-800">{{ $schedule->vehicle->plat_nomor }}</p>
                                <p class="text-sm text-gray-600">{{ $schedule->jenis_layanan }}</p>
                                <p class="text-xs text-gray-500">{{ $schedule->waktu }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .fc-daygrid-day-events {
                min-height: 0 !important;
            }

            .fc-event {
                cursor: pointer;
                font-size: 0.8em;
                padding: 2px 4px;
                margin-bottom: 2px;
            }

            .fc-day-today {
                background-color: #f0fdf4 !important;
            }

            .dot-harian {
                background-color: #3b82f6;
            }

            .dot-mingguan {
                background-color: #10b981;
            }

            .dot-rejected {
                background-color: #ef4444;
            }
        </style>
    @endpush

    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var dateInfo = JSON.parse('{!! $dateInfo !!}');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    dayCellDidMount: function(info) {
                        var year = info.date.getFullYear();
                        var month = String(info.date.getMonth() + 1).padStart(2, '0');
                        var day = String(info.date.getDate()).padStart(2, '0');
                        var dateStr = `${year}-${month}-${day}`;
                        if (dateInfo[dateStr] && dateInfo[dateStr].has_schedule) {
                            info.el.style.backgroundColor = '#e0f7fa';
                            info.el.style.borderRadius = '8px';

                            var dotContainer = document.createElement('div');
                            dotContainer.style.display = 'flex';
                            dotContainer.style.justifyContent = 'center';
                            dotContainer.style.gap = '3px';
                            dotContainer.style.position = 'absolute';
                            dotContainer.style.bottom = '5px';
                            dotContainer.style.width = '100%';

                            var services = dateInfo[dateStr].services;
                            var serviceColors = {
                                'checklist_harian': '#3b82f6',
                                'checklist_mingguan': '#10b981',
                                'rejected': '#ef4444'
                            };

                            services.forEach(function(service) {
                                var dot = document.createElement('div');
                                dot.style.width = '8px';
                                dot.style.height = '8px';
                                dot.style.borderRadius = '50%';
                                dot.style.backgroundColor = serviceColors[service.toLowerCase()] ||
                                    'gray';
                                dot.style.zIndex = '10';
                                dotContainer.appendChild(dot);
                            });

                            info.el.style.position = 'relative';
                            info.el.appendChild(dotContainer);
                        }
                    },
                    dateClick: function(info) {
                        var year = info.date.getFullYear();
                        var month = String(info.date.getMonth() + 1).padStart(2, '0');
                        var day = String(info.date.getDate()).padStart(2, '0');
                        var dateStr = `${year}-${month}-${day}`;

                        if (dateInfo[dateStr] && dateInfo[dateStr].has_schedule) {
                            window.location.href = '{{ url('distributor/checklist-schedule/by-date') }}/' +
                                dateStr;
                        }
                    }
                });
                calendar.render();
            });
        </script>
    @endpush
</x-dashboard-layout>
