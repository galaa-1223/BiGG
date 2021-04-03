import { Calendar } from "@fullcalendar/core";
import interactionPlugin, { Draggable } from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";

(function (cash) {
    if (cash("#calendar").length) {
        if (cash("#calendar-events").length) {
            new Draggable(cash("#calendar-events")[0], {
                itemSelector: ".event",
                eventData: function (eventEl) {
                    return {
                        title: cash(eventEl).find(".event__title").html(),
                        duration: {
                            days: parseInt(
                                cash(eventEl).find(".event__days").text()
                            ),
                        },
                    };
                },
            });
        }

        let calendar = new Calendar(cash("#calendar")[0], {
            plugins: [
                interactionPlugin,
                dayGridPlugin,
                timeGridPlugin,
                listPlugin,
            ],
            firstDay: 1,
            // dayNames: ['Ням', 'Даваа', 'Мягмар', 'Лхагва','Пүрэв', 'Баасан', 'Бямба'],
            // dayNamesShort: ['Ням', 'Дав', 'Мяг', 'Лха', 'Пүр', 'Баа', 'Бям'],
            // monthNames: ['1-р сар', '2-р сар', '3-р сар', '4-р сар', '5-р сар', '6-р сар', '7-р сар', '8-р сар', '9-р сар', '10-р сар', '11-р сар', '12-р сар'],
            // mongthNamesShort: ['1-р сар', '2-р сар', '3-р сар', '4-р сар', '5-р сар', '6-р сар', '7-р сар', '8-р сар', '9-р сар', '10-р сар', '11-р сар', '12-р сар'],
            droppable: true,
            // titleFormat: 'YYYY, MMMM D, dddd',
            
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
            },
            buttonText: {
                today:    'Өнөөдөр',
                month:    'Сар',
                week:     '7 хоног',
                day:      'Өдөр',
                list:     'Жагсаалт'
            },
            allDayText: 'Өдрийн турш',
            navLinks: true,
            editable: true,
            dateClick: function(info) {
                // alert('Clicked on: ' + info.dateStr);
                // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                // alert('Current view: ' + info.view.type);
                // change the day's background color just for fun
                // info.dayEl.style.backgroundColor = 'red';

                if (info.jsEvent.detail === 2) {
                    // alert(info.dateStr);
                    
                    cash("#calendar-over-preview").modal("show");
                }
            },
            eventClick: function(info) {
                alert('Event: ' + info.event.title);
                alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                alert('View: ' + info.view.type);
            
                // change the border color just for fun
                // info.el.style.borderColor = 'red';
            },
            events: {
                url: '/api/v1/events'
            },
            // drop: function (info) {
            //     if (
            //         cash("#checkbox-events").length &&
            //         cash("#checkbox-events")[0].checked
            //     ) {
            //         cash(info.draggedEl).parent().remove();

            //         if (cash("#calendar-events").children().length == 1) {
            //             cash("#calendar-no-events").removeClass("hidden");
            //         }
            //     }
            // },
        });

        calendar.render();
    }
})(cash);
