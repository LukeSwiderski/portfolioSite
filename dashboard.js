document.addEventListener('DOMContentLoaded', function () {
  const monthSelect = document.getElementById('month-select');
  const dateSelect = document.getElementById('date-select');

  monthSelect.addEventListener('change', function () {
    const selectedMonth = monthSelect.value;
    const currentYear = new Date().getFullYear();
    const monthLength = new Date(currentYear, selectedMonth, 0).getDate();

    dateSelect.innerHTML = '<option value="">Select Date</option>';
    dateSelect.disabled = false;

    for (let i = 1; i <= monthLength; i++) {
      const option = document.createElement('option');
      option.value = i;
      option.text = i;
      dateSelect.appendChild(option);
    }
  });
});