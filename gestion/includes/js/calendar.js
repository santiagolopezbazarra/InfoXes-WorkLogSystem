(function ($) {
  'use strict';
  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();
  $(function () {
    var style = getComputedStyle(document.body);
    if ($('#calendar').length) {
      var calendar = $('#calendar').fullCalendar({
       editable: true,
       defaultView: 'month',
       //initialView: 'dayGridMonth',
       header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
        //right: 'agendaWeek,agendaDay'
       },
       locale: 'es',
       minTime: "08:00:00",
       maxTime: "21:00:00",

       dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles',
         'Jueves', 'Viernes', 'Sábado'
       ],
       dayNamesShort: ['DOM','LUN', 'MAR', 'MIE', 'JUE', 'VIE', 'SÁB'],
       monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
         'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
       ],
       monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
         'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
       ],
       
       //events: "../../includes/events.php", // Recupera los Eventos de la BD
       //eventRender: function(event, element, view) {
       // if (event.allDay === 'true') {
       //  event.allDay = true;
        //} else {
        // event.allDay = false;
       // }
       //},
       //eventRender: function(eventObj, $el) {
       //  $el.popover({
       //    title: eventObj.title,
       //    content: eventObj.description,
       //    trigger: 'hover',
       //    placement: 'top',
       //    container: 'body',
       //    html: true,
       //  });
       //},
       selectable: true,
       selectHelper: true,
       displayEventTime: true,
       //timeFormat: 'H:m',
       slotLabelFormat: 'HH:mm',
       hiddenDays: [0],
       //select: function(start, end, allDay) {
       //var title = prompt('Event Title:');

       //if (title) {
       //var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
       //var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
       //$.ajax({
    	 //  url: 'add_events.php',
    	 //  data: 'title='+ title+'&start='+ start +'&end='+ end,
    	 //  type: "POST",
    	 //  success: function(json) {
    	 //  alert('Added Successfully');
    	 //  }
       //});
       //calendar.fullCalendar('renderEvent',
       //{
    	 //  title: title,
    	 //  start: start,
    	 //  end: end,
    	 //  allDay: allDay
       //},
       //true
       //);
       //}
       //calendar.fullCalendar('unselect');
       //},
       editable: false,
       //eventDrop: function(event, delta) {
       //var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
       //var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
       //$.ajax({
    	 //  url: 'update_events.php',
    	 //  data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
    	 //  type: "POST",
    	 //  success: function(json) {
    	 //   alert("Updated Successfully");
    	 //  }
       //});
       //},
      eventClick: function(event) {
      					$('#ModalEdit #id').val(event.id);
      					$('#ModalEdit #title').val(event.title);
      					$('#ModalEdit #color').val(event.color);
      					$('#ModalEdit').modal('show');
          },

       //eventResize: function(event) {
    	 //  var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
    	 //  var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
    	 //  $.ajax({
    	 //   url: 'update_events.php',
    	 //   data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
    	 //   type: "POST",
    	 //   success: function(json) {
    	 //    alert("Updated Successfully");
    	 //   }
    	 //  });
    	//}
      });
    }  // Funcion anterior
  });
})(jQuery);
