var CalendarBackgroundEvents = function() {
    
    return {
        //main function to initiate the module
        init: function() {
            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
            var events_data;
            var events = [];
            $.ajax({
                url: 'admin/dashboard/getAllTasks',
                success: function(response) { 
                    // similate 2s delay
                    setTimeout(function() {
                        $.each(response, function(i, obj) {
                            var item = {};
                            item['title'] = obj.task_type;
                            item['start'] = obj.task_date;
                            item['description'] = obj.task_status;
                            item['className'] = "m-fc-event--accent";
                            events.push(item);
                        });
                        }, 3000);
            }});
            // setTimeout(function() {
            // $.each(events_data, function(i, obj) {
            //     item['title'] = obj.task_type;
            //     item['start'] = obj.task_date;
            //     item['description'] = obj.description;
            //     item['className'] = "m-fc-event--light m-fc-event--solid-primary";
            //     events.push(item);
            // });
            // }, 4000);
            console.log(events);
            setTimeout(function() {
            $('#m_calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                navLinks: true,
                businessHours: true, // display business hours
                events: events,
                eventRender: function(event, element) {
                    if (element.hasClass('fc-day-grid-event')) {
                        element.data('content', event.description);
                        element.data('placement', 'top');
                        mApp.initPopover(element); 
                    } else if (element.hasClass('fc-time-grid-event')) {
                        element.find('.fc-title').append('<div class="fc-description">' + event.description + '</div>'); 
                    } else if (element.find('.fc-list-item-title').lenght !== 0) {
                        element.find('.fc-list-item-title').append('<div class="fc-description">' + event.description + '</div>'); 
                    }
                }
            });
            }, 5000);
        }
    };
}();

jQuery(document).ready(function() {
    CalendarBackgroundEvents.init();
});