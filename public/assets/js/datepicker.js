// refer to https://fullcalendar.io/docs

/* Start Date */
const startDateInput = document.getElementById('start_date');
const startCalendarContainer = document.getElementById('start-calendar-container');

startDateInput.addEventListener('click', function() {
    startCalendarContainer.classList.add('visible');
    renderCalendar(startCalendarContainer, startDateInput);
});

/* End Date */
const endDateInput = document.getElementById('end_date');
const endCalendarContainer = document.getElementById('end-calendar-container');

endDateInput.addEventListener('click', function() {
    endCalendarContainer.classList.add('visible');
    renderCalendar(endCalendarContainer, endDateInput);
});

/* View */
function openCalendar(inputObj) {
  var calendarContainer = inputObj.nextElementSibling;
    calendarContainer.classList.add('visible');
    renderCalendar(calendarContainer, inputObj);
}

/* Common */
document.addEventListener('click', function(event) {
  if (!startCalendarContainer.contains(event.target) && event.target !== startDateInput) {
      startCalendarContainer.classList.remove('visible');
  }

  if (!endCalendarContainer.contains(event.target) && event.target !== endDateInput) {
      endCalendarContainer.classList.remove('visible');
  } 
});

function renderCalendar(calendarObj, inputObj) {
  var date = new Date(inputObj.value);
  date.setDate(date.getDate() - 1);
  var nextDate = date.toISOString().split('T')[0];

  var calendar = new FullCalendar.Calendar(calendarObj, {
    initialView: 'dayGridMonth',
    initialDate: inputObj.value,
    selectable: true,
    dayCellClassNames: function(arg) {
        if (inputObj.value && arg.date.toISOString().split('T')[0] == nextDate) {
          return 'fc-day-selected-date';
        }

        return '';
    },
    dateClick: function(info) {
        var dayEl = info.dayEl;
        var selectedCell = calendarObj.querySelector('.fc-day-selected-date');
        if (selectedCell) {
            selectedCell.classList.remove('fc-day-selected-date');
        }
        
        dayEl.classList.add("fc-day-selected-date");
    },
    select: function(info) {
        console.log('Selected date: ' + info.startStr);
        calendarObj.classList.remove('visible');
        inputObj.value = info.startStr;
    },
    customButtons: {
      todayButton: {
          text: 'Today',
          click: function() {
              calendar.gotoDate(new Date());
              inputObj.value = new Date().toISOString().split('T')[0];
              
              var selectedCell = calendarObj.querySelector('.fc-day-selected-date');
              if (selectedCell) {
                  selectedCell.classList.remove('fc-day-selected-date');
              }

              var todayCell = document.querySelector('.fc-day-today');
              if (todayCell) {
                  todayCell.classList.add('fc-day-selected-date');
              }
          }
      }
    },
    headerToolbar: {
        left: 'todayButton',
        right: 'prev,next',
        center: 'title',
    },
    eventAllow: function(info) {
        return false;
    }
  });

  calendar.render();
}
