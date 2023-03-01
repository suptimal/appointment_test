@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row row-cols-1 g-2">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Versicherter: ') }}</div>
                <div class="card-body">
                    @foreach (['first_name', 'last_name', 'kvnumber', 'birthdate'] as $key) 
                    <div class="row">
                        <div class="col-2">
                            {{ $key }}
                        </div>
                        <div class="col-6">
                            {{auth('insurence')->user()[$key]}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Kasse: ') }}</div>
                <div class="card-body">
                    <table>
                        @foreach (['name', 'full_name', 'kk_label'] as $key) 
                        <div class="row">
                            <div class="col-2">
                                {{ $key }}
                            </div>
                            <div class="col-6">
                                {{$insurence[$key]}}
                            </div>
                        </div>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-2">
        
        <div class="row">
            <div id='calendar' class='col-md-7'></div>
            <div class="col-md" >
                <div id='day_appointments'></div> 
            </div>
        </div>

        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
        <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.4/index.global.min.js"></script>
        
        <script>
    
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'de',
            weekNumbers: true,
            themeSystem: 'bootstrap5',
            dateClick: function (info) {
                let appointments = get_availibe_appointments(info.date)
                let app_div = document.getElementById('day_appointments')
                app_div.innerHTML = 'Verfügbare Termine: ' + info.dateStr
                app_display = document.createElement('ul')
                app_display.classList.add('list-group')
                appointments.forEach(app => {
                    a = document.createElement('div')
                    a.innerText = app
                    a.classList.add('list-group-item')
                    app_display.appendChild(a)
                });
                app_div.appendChild(app_display)
                
            },
            dayCellDidMount : function (arg) {
                console.log(arg)
                let availible_count = get_availibe_appointments(arg.date).length
                arg.el.querySelector('.fc-daygrid-day-events').innerText = availible_count + " Termine Frei"
            }
            });
            calendar.render();
        });

        let days_cache = {}

        function get_availibe_appointments(date) {
            console.log(date)
            if (date in days_cache) {
                return days_cache[date]
            }
            let possible_appointments = ['10:00', '11:00', '14:00', '17:00', '18:00']
            
            let remove_count = Math.floor(Math.random() * possible_appointments.length)
            let i=0; 
            while (i < remove_count) {
                i++
                let random = Math.floor(Math.random() * possible_appointments.length)
                let value = possible_appointments[random]
                possible_appointments = possible_appointments.filter(function(item) {
                    return item !== value
                })
            }
            days_cache[date] = possible_appointments
            return possible_appointments
        }
    
        </script>
    </div>
</div>
@endsection
