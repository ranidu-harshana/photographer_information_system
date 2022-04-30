@extends('layouts.app')

@section('content')
    <div id="container">
        <div id="header">
            <div id="monthDisplay"></div>
            <div>
                <button id="backButton" class="btn btn-primary calender_button"><i class="fa-solid fa-arrow-left-long" style="margin-right: 2px;"></i>Back</i></button>
                <button id="nextButton" class="btn btn-primary calender_button">Next<i class="fa-solid fa-arrow-right-long" style="margin-left: 2px"></i></button>
            </div>
        </div>

        <div id="weekdays">
            <div>Sunday</div>
            <div>Monday</div>
            <div>Tuesday</div>
            <div>Wednesday</div>
            <div>Thursday</div>
            <div>Friday</div>
            <div>Saturday</div>
        </div>

        <div id="calendar"></div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">All Functions on - <span class="text-success" id="date_display_area"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="display_area">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            localStorage.clear();
            $.ajax({
                url: "../get_all_func_dates",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "display" : 1,
                },
                success: function(data){
                    console.log(data);
                    let nav = 0;
                    const backDrop = document.getElementById('modalBackDrop');
                    const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

                    let events = localStorage.getItem('events') ? JSON.parse(localStorage.getItem('events')) : [];
                    date_arr = data
                    
                    for (let index = 0; index < date_arr.length; index++) {
                        events.push({
                            date: date_arr[index].replace(/-0+/g, '-'),
                            title: 'There are functions',
                        });
                    }

                    localStorage.setItem('events', JSON.stringify(events));

                    function load() {
                        const dt = new Date();

                        if (nav !== 0) {
                            dt.setMonth(new Date().getMonth() + nav);
                        }

                        const day = dt.getDate();
                        const month = dt.getMonth();
                        const year = dt.getFullYear();

                        const firstDayOfMonth = new Date(year, month, 1);
                        const daysInMonth = new Date(year, month + 1, 0).getDate();
                        
                        const dateString = firstDayOfMonth.toLocaleDateString('en-us', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'numeric',
                            day: 'numeric',
                        });
                        const paddingDays = weekdays.indexOf(dateString.split(', ')[0]);

                        document.getElementById('monthDisplay').innerText = 
                            `${dt.toLocaleDateString('en-us', { month: 'long' })} ${year}`;

                        calendar.innerHTML = '';

                        for(let i = 1; i <= paddingDays + daysInMonth; i++) {
                            const daySquare = document.createElement('div');
                            daySquare.classList.add('day');

                            const dayString = `${year}-${month + 1}-${i - paddingDays}`;

                            if (i > paddingDays) {
                                daySquare.innerText = i - paddingDays;
                                const eventForDay = events.find(e => e.date === dayString);

                                if (i - paddingDays === day && nav === 0) {
                                    daySquare.id = 'currentDay';
                                }

                                if (eventForDay) {
                                    const eventDiv = document.createElement('div');
                                    eventDiv.classList.add('event');
                                    eventDiv.innerText = eventForDay.title;
                                    daySquare.appendChild(eventDiv);
                                }
                                    daySquare.addEventListener('click', () => openModal(dayString));
                            } else {
                                daySquare.classList.add('padding');
                            }

                            calendar.appendChild(daySquare);    
                        }
                    }

                    function openModal(date) {
                        clicked = date;
                        $("#date_display_area").html(clicked);
                        const eventForDay = events.find(e => e.date === clicked);
                        
                        $.ajax({
                            url: "../get_functions_of_day",
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "display" : 1,
                                "date": clicked,
                            },
                            success: function(data){
                                html = ''
                                if(data.length != 0) {
                                    data.forEach(element => {
                                        if(element.type == 1) {
                                            html += '<a class="badge badge-success mb-2" style="font-size: 14px" href="customer/'+element.customer_id+'">';
                                            html += element.bill_number;
                                            html += '</a> | '+element.name+' | <span class="text-success">Wedding</span>  <br>';
                                        }else if(element.type == 2) {
                                            html += '<a class="badge badge-primary mb-2" style="font-size: 14px" href="customer/'+element.customer_id+'">';
                                            html += element.bill_number;
                                            html += '</a> | '+element.name+' | <span class="text-primary">HomeComming</span> <br>';
                                        }else if(element.type == 3) {
                                            html += '<a class="badge badge-warning mb-2" style="color:white; font-size: 14px" href="customer/'+element.customer_id+'">';
                                            html += element.bill_number;
                                            html += '</a> | '+element.name+' | <span class="text-warning">Event</span> <br>';
                                        }else if(element.type == 4) {
                                            html += '<a class="badge mb-2" style="background-color:blue; color:white; font-size: 14px" href="customer/'+element.customer_id+'">';
                                            html += element.bill_number;
                                            html += '</a> | '+element.name+' | <span style="color: blue">PhotoShoot</span> <br>';
                                        }
                                                
                                            
                                            //     html += '<a class="badge badge-primary mb-2" style="font-size: 14px" href="customer/'+element.customer_id+'">';
                                            //     html += element.bill_number;
                                            //     html += '</a> | '+element.name+' | <span class="text-danger">'+element.postponed+'</span><br>';
                                            
                                            // html += '<a class="badge badge-danger mb-2" style="font-size: 14px" href="customer/'+element.customer_id+'">';
                                            // html += element.bill_number;
                                            // html += '</a> | '+element.name+' | <span class="text-danger">cancelled</span><br>';
                                        
                                        
                                    });
                                }else{
                                    html = '<div class="alert alert-success" role="alert">No any Functions on this day</div>';
                                }
                                $('#exampleModal').modal('show')
                                $("#display_area").html(html);
                            }
                        })
                    }

                    function closeModal() {
                        deleteEventModal.style.display = 'none';
                        backDrop.style.display = 'none';
                        clicked = null;
                        load();
                    }

                    function initButtons() {
                        document.getElementById('nextButton').addEventListener('click', () => {
                            nav++;
                            load();
                        });

                        document.getElementById('backButton').addEventListener('click', () => {
                            nav--;
                            load();
                        });

                    }
                    load();
                    initButtons();
                }
            })
            
        });
    </script>
@endsection