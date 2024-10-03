document.addEventListener('DOMContentLoaded', function () {
  function validateFormForGenerate() {
    const venue = document.getElementById('venue-select').value;
    const month = document.getElementById('month-select').value;
    const date = document.getElementById('date-select').value;
    const startTime = document.getElementById('start-select').value;
    const endTime = document.getElementById('end-select').value;
    const messageType = document.getElementById('message-select').value;
  
    let errorMessage = '';
  
    if (!venue) errorMessage += 'Please select a venue.\n';
    if (!month) errorMessage += 'Please select a month.\n';
    if (!date) errorMessage += 'Please select a date.\n';
    if (!startTime) errorMessage += 'Please select a start time.\n';
    if (!endTime) errorMessage += 'Please select an end time.\n';
    if (!messageType) errorMessage += 'Please select a message type.\n';
  
    if (startTime && endTime) {
      const start = new Date(`2000-01-01T${startTime}`);
      const end = new Date(`2000-01-01T${endTime}`);
      if (end <= start) {
        errorMessage += 'End time must be after start time.\n';
      }
    }
  
    if (errorMessage) {
      alert(errorMessage);
      return false;
    }
  
    return true;
  }
  
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
    if (validateFormForGenerate()) {
      const venue = document.getElementById('venue-select').value;
      const month = document.getElementById('month-select').value;
      const date = document.getElementById('date-select').value;
      const startTime = document.getElementById('start-select').value;
      const endTime = document.getElementById('end-select').value;
      const messageType = parseInt(document.getElementById('message-select').value);
    
      generateMessage(venue, month, date, startTime, endTime, messageType)
      .then((data) => {
        console.log('Received data:', data); // For debugging
        if (data.success && data.messageData) {
          document.getElementById('message-area').value = data.messageData.plainMessage;
          document.getElementById('hidden-html-message').value = data.messageData.htmlMessage;
        } else {
          console.error('Error generating message:', data.error || 'Unknown error');
          document.getElementById('message-area').value = 'Error generating message';
        }
      })
      .catch((error) => {
        console.error('Error:', error);
        document.getElementById('message-area').value = 'Error: ' + error.message;
      });
    }
  });
  

  // Submit button click handler
  document.getElementById('submit-btn').addEventListener('click', function(e) {
    e.preventDefault();
    console.log('Submit button clicked');

    const messageArea = document.getElementById('message-area').value;
    const htmlMessage = document.getElementById('hidden-html-message').value;

    if (!messageArea) {
      alert('Please enter a message or generate one using the form.');
      return;
    }

    const venue = document.getElementById('venue-select').value;
    const month = document.getElementById('month-select').value;
    const date = document.getElementById('date-select').value;
    const startTime = document.getElementById('start-select').value;
    const endTime = document.getElementById('end-select').value;
    const messageType = parseInt(document.getElementById('message-select').value);

    generateMessage(venue, month, date, startTime, endTime, messageType, 'send', plainMessage, htmlMessage)
      .then((data) => {
        console.log('Server response:', data);
        if (data.success) {
          alert('Email sent successfully!');
        } else {
          alert('Error sending email: ' + (data.error || 'Unknown error'));
        }
      })
      .catch((error) => {
        console.error('Error:', error);
        alert('Error sending email: ' + error.message);
      });
  });



  // Clear button click handler
  document.getElementById('clear-btn').addEventListener('click', function() {
    document.getElementById('message-area').value = '';
  });

  // Function to generate the message based on the selected values
  function generateMessage(venue, month, date, startTime, endTime, messageType, action, plainMessage = '', htmlMessage = '') {
    return fetch('http://localhost/LukeSwiderski/includes/email.inc.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        venue, month, date, startTime, endTime, messageType, action, plainMessage, htmlMessage
      })
    })
    .then(response => response.json())
    .catch(error => {
      console.error('Fetch error:', error);
      throw error;
    });
  }
});