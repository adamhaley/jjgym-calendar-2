<!DOCTYPE html>
<html>
<head>
    <title>JJGym Calendar</title>

    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="js/app.js"></script>
</head>
<body>
<div class="container">
    <br />
    <h1 class="text-center text-primary">JJGym Calendar</h1>
    <br />[<a href="admin/">Admin</a>]

    <div id="calendar"></div>
</div>

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },
            events:'/calendar',
            selectable:true,
            selectHelper:true,
            select:function(start,end,allDay)
            {
                var date = $.fullCalendar.formatDate(start, 'Y-MM-DD');
                var friendlyStart = $.fullCalendar.formatDate(start, 'HH:mm:ss');
                var friendlyEnd = $.fullCalendar.formatDate(end, 'HH:mm:ss');
                var title = prompt('Inquire about gym use on ' + date + ' from ' + friendlyStart + ' to ' + friendlyEnd + '?\n' + 'Event Title:');

                if(title)
                {
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                    $.ajax({
                        url:"/calendar/action",
                        type:"POST",
                        data:{
                            title:title,
                            start:start,
                            end:end,
                            type: 'add'
                        },
                        success:function(data)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Your request has been sent. An Admin will get back to you shortly!");
                        }
                    })
                }
            },
            editable:false,
            eventResize: function(event, delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss')
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss')
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"/calendar/action",
                    type:"POST",
                    data:{
                        title:title,
                        start:start,
                        end:end,
                        id:id,
                        type:'update'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert('Event Updated Successfully');
                    }
                });
            },
            eventDrop: function(event,delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss')
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss')
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"/calendar/action",
                    type:"POST",
                    data:{
                        title:title,
                        start:start,
                        end:end,
                        id:id,
                        type:'update'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert('Event Updated Successfully');
                    }
                });
            },
            defaultView: window.innerWidth <= 765 ?  "listMonth": "month",
            /*
            eventClick:function(event)
            {
                if(confirm("Are you sure you want to remove it?"))
                {
                    var id = event.id;
                    $.ajax({
                        url:"/calendar/action",
                        type:"POST",
                        data:{
                            id:id,
                            type:"delete"
                        },
                        success:function(response)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert('Event deleted successfully');
                        }
                    })
                }
            }
             */
        });
        console.log('created calendar');
    });

</script>

</body>
</html>
