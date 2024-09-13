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

    // Generate button click handler
  document.getElementById('generate-btn').addEventListener('click', function() {
    const venue = document.getElementById('venue-select').value;
    const month = document.getElementById('month-select').value;
    const date = document.getElementById('date-select').value;
    const startTime = document.getElementById('start-select').value;
    const endTime = document.getElementById('end-select').value;
    const messageType = parseInt(document.getElementById('message-select').value);
  
    generateMessage(venue, month, date, startTime, endTime, messageType)
      .then((data) => {
        // Set the plain message in the textarea
        document.getElementById('message-area').value = data.plainMessage;

        // Store the HTML message in a hidden field for the actual email sending
        document.getElementById('hidden-html-message').value = data.htmlMessage;
      })
      .catch((error) => {
        console.error(error);
      });
  });
  

  // Submit button click handler
  document.getElementById('submit-btn').addEventListener('click', function() {
    const message = document.getElementById('message-area').value;
    // Send the message to the server-side PHP script using AJAX or a form submission
    // ...
  });

  // Clear button click handler
  document.getElementById('clear-btn').addEventListener('click', function() {
    document.getElementById('message-area').value = '';
  });

  // Function to generate the message based on the selected values
  function generateMessage(venue, month, date, startTime, endTime, messageType) {
    return new Promise((resolve, reject) => {
      fetch('http://localhost/LukeSwiderski/includes/email.inc.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          venue: venue,
          month: month,
          date: date,
          startTime: startTime,
          endTime: endTime,
          messageType: messageType
        })
      })
      .then(response => response.json())
      .then(data => {
        console.log('Received data:', data);  // Log received data
        if (data && data.plainMessage) {
          resolve(data);
        } else {
          reject('Invalid response data');
        }
      })
      .catch(error => reject(error));
    });
  }
});