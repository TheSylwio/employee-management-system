const todayEventsButton = document.querySelector('#todayEvents');
const weekEventsButton = document.querySelector('#weekEvents');
const allEventsButton = document.querySelector('#allEvents');
const rows = document.querySelectorAll('.eventRow');
const table = document.querySelector('#eventTable tbody');

const getValidRows = date => {
  const todayDate = new Date();
  todayDate.setHours(0, 0, 0, 0);

  return [...rows].map(row => {
    const startDate = new Date(row.dataset.startdate);
    startDate.setHours(0, 0, 0, 0)

    return (todayDate.getTime() <= startDate.getTime() && startDate.getTime() <= date.getTime()) ? row : null;
  }).filter(el => el !== null);
}

const toggleVisibility = date => {
  let validRows = rows;

  if (date) validRows = getValidRows(date);

  while (table.childNodes.length > 1) {
    table.removeChild(table.lastChild);
  }

  for (let row of validRows) {
    table.appendChild(row);
  }
}

if (todayEventsButton) {
  todayEventsButton.addEventListener('click', () => {
    const todayDate = new Date();
    todayDate.setHours(0, 0, 0, 0);
    toggleVisibility(todayDate);
  });

  weekEventsButton.addEventListener('click', () => {
    const weekDate = new Date();
    weekDate.setHours(0, 0, 0, 0);
    weekDate.setDate(weekDate.getDate() + 7);

    toggleVisibility(weekDate);
  });

  allEventsButton.addEventListener('click', () => {
    toggleVisibility();
  });
}