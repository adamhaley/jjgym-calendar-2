<!DOCTYPE html>
<html>
<head>
    <title>JJGym Calendar</title>

    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" integrity="sha256-5veQuRbWaECuYxwap/IOE/DAwNxgm4ikX7nrgsqYp88=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js" integrity="sha256-XCdgoNaBjzkUaEJiauEq+85q/xi/2D4NcB3ZHwAapoM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.min.js" integrity="sha256-GcByKJnun2NoPMzoBsuCb4O2MKiqJZLlHTw3PJeqSkI=" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
<div class="container">
    <br />
    <h1 class="text-center text-primary">JJGym Calendar</h1>
    <br />[<a href="admin/">Admin</a>] [<a href="#" class="request-time">Request Time</a>]
    <span class="cta float-right d-none text-primary">Click anywhere on the calendar to request a time slot:</span>
    <div id="calendar"></div>
</div>

<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Time</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl,{
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },
            events:'/calendar',
            selectable:true,
            selectHelper:true,
            select: function(start,end,allDay)
            {
            },
            editable:false,
            eventColor: '#fff',
            minTime:'08:00',
            maxTime:'22:00',
            eventTimeFormat: {
                hour: 'numeric',
                minute: '2-digit',
                meridiem:'short'
            },
            hour12: true,
            html: true,
            themeSystem: 'bootstrap5'
        });
        calendar.render();
        console.log('created calendar');
        $('.request-time').click((e) => {
            $('.fc-view-harness').toggleClass('active');
            $('.cta').toggleClass('d-none').toggleClass('d-block');
            if($('.fc-view-harness').hasClass('active')) {
                calendar.on('select', function (e) {
                    $('.modal').modal('show');
                });
            }else{
                calendar.off('select');
            }
        });
    });

    $('.modal form').submit(() => {
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
    });

</script>
</body>
</html>
