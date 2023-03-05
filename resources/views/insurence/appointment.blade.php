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
                    <div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-5">
            <div id='calendar'>
            </div> 
        </div>
        <div class="col-md" >
            <div id='day_appointments'>
            </div> 
        </div>
    </div>

    <script src="/js/calendar.js"></script>
    <script>
        function displayTimeSlots(date, timeSlots) {
            let apps = document.querySelector('#day_appointments')
            apps.innerHTML = `Aktiver Tag: ${date}`
            let ul = document.createElement('ul')
            apps.appendChild(ul)
            timeSlots.forEach(ts => {
                let li = document.createElement('li')
                li.innerText = ts
                ul.appendChild(li)
            });
        }
        let cal = new Calendar('#calendar', () => {
            displayTimeSlots(
                cal.getSelectedDate(),
                getTimeSlots(cal.getSelectedDate())
                )
        })
        const time_slots = ['10:00', '11:00', '14:00', '15:00', '16:00'];
        const chooseRandom = (arr, num = 1) => {
        const res = [];
        for(let i = 0; i < num; ){
            const random = Math.floor(Math.random() * arr.length);
            if(res.indexOf(arr[random]) !== -1){
                continue;
            };
            res.push(arr[random]);
            i++;
        };
        return res;
        };
        var dates = {}
        function getTimeSlots(date) {
            if (date in dates === false){
                dates[date] = chooseRandom(
                    time_slots, 
                    Math.floor(Math.random()*time_slots.length)
                    ).sort()
            }
            return dates[date]
        }
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="/css/calendar.css">
</div>
@endsection
