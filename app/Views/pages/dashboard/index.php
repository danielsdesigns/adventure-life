

<div class="header">
    <div class="float-start">
        <h3>Adventure Life Event Calendar</h3>
        <?php if($is_admin){?>
        <button id="add" class="btn btn-sm btn-primary">Add New Event</button>
        <?php } ?>
    </div>

    <div class="float-end">Hi <?=$user->name;?>! <a href="/logout">Log out</a></div>

</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            initialDate: '<?=date('Y-m-d',time()) ?>',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },

            events: [
                <?php if(!empty($calendar)){?>

                    <?php foreach ($calendar as $c) {?>
                    {
                        title: '<?=$c->title;?>',
                        start: '<?php echo date('Y-m-d H:i:s', strtotime($c->start));?>',
                        end: '<?php echo date('Y-m-d H:i:s', strtotime($c->end));?>',
                        description: '<?=$c->description;?>',
                        className: "fc-event-success fc-event-solid-primary",
                        extendedProps: {
                            calendar_id: <?=$c->id;?>
                        }
                    },
                    <?php } ?>
                <?php } ?>
            ],
            eventClick: function(info) {

                var cid = info.event.extendedProps.calendar_id;

                app.request({
                    url : 'view_event',
                    data : {id : cid},
                    success : function (data) {
                        if(data.success) {

                            var end = data.end ? '<p><strong>End: </strong>' + data.end + '</p>' : '';

                            Swal.fire({
                                title: data.title,
                                html: '<div>' +
                                    '<p><strong>Description :</strong> '+data.description+'</p>' +
                                    '<p><strong>Start:</strong> ' + data.start + '</p>' +
                                     end +
                                    '</div>'
                            })

                        }
                    }
                });

            }
        });

        calendar.render();
    });

</script>

<div id='calendar'></div>