document.addEventListener('DOMContentLoaded', function () {
  function showEmailResults(results) {
    // First check if modal already exists and remove it
    let existingModal = document.getElementById('emailResultsModal');
    if (existingModal) {
        existingModal.remove();
    }

    // Create modal HTML
    const modalHTML = `
        <div class="modal fade" id="emailResultsModal" tabindex="-1" aria-labelledby="emailResultsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="emailResultsModalLabel">Email Sending Results</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Success Alert -->
                        <div class="alert alert-success" role="alert">
                            Successfully sent to ${results.successful} recipient${results.successful !== 1 ? 's' : ''}
                        </div>
                        
                        ${results.failed > 0 ? `
                            <!-- Failed Alert -->
                            <div class="alert alert-danger" role="alert">
                                Failed to send to ${results.failed} recipient${results.failed !== 1 ? 's' : ''}
                            </div>
                            
                            <!-- Failed Details -->
                            <div class="mt-3">
                                <h6>Failed Email Details:</h6>
                                <div class="list-group">
                                    ${results.failedDetails.map(failure => `
                                        <div class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">${failure.name}</h6>
                                                <small class="text-muted">${failure.email}</small>
                                            </div>
                                            <p class="mb-1 text-danger">Error: ${failure.error}</p>
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        ` : ''}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Add modal to document
    document.body.insertAdjacentHTML('beforeend', modalHTML);

    // Show the modal
    const modalElement = document.getElementById('emailResultsModal');
    const modal = new bootstrap.Modal(modalElement);
    modal.show();

    // Clean up modal when hidden
    modalElement.addEventListener('hidden.bs.modal', function () {
        modalElement.remove();
    });
}

  window.validateFormForGenerate = function () {
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
      const venueSelect = document.getElementById('venue-select');
      const selectedOption = venueSelect.options[venueSelect.selectedIndex];
      const venue = venueSelect.value;
      const address = selectedOption.dataset.address;
      const city = selectedOption.dataset.city;
      const state = selectedOption.dataset.state;
      const zip = selectedOption.dataset.zip;
      const month = document.getElementById('month-select').value;
      const date = document.getElementById('date-select').value;
      const startTime = document.getElementById('start-select').value;
      const endTime = document.getElementById('end-select').value;
      const messageType = parseInt(document.getElementById('message-select').value);
    
      generateMessage(venue, address, city, state, zip, month, date, startTime, endTime, messageType)
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

    if (!validateFormForGenerate()) {
        return;
    }

    const messageArea = document.getElementById('message-area').value;
    const htmlMessage = document.getElementById('hidden-html-message').value;

    if (!messageArea) {
        alert('Please write or generate a message using the drop down menus.');
        return;
    }

    const venueSelect = document.getElementById('venue-select');
    const selectedOption = venueSelect.options[venueSelect.selectedIndex];

    generateMessage(
        venueSelect.value,
        selectedOption.dataset.address,
        selectedOption.dataset.city,
        selectedOption.dataset.state,
        selectedOption.dataset.zip,
        document.getElementById('month-select').value,
        document.getElementById('date-select').value,
        document.getElementById('start-select').value,
        document.getElementById('end-select').value,
        parseInt(document.getElementById('message-select').value),
        'send',
        messageArea,
        htmlMessage
    )
    .then((data) => {
        console.log('Server response:', data);
        if (data.success && data.results) {
            showEmailResults(data.results);
        } else {
            alert('Error sending email: ' + (data.error || 'Unknown error'));
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('Error sending email: ' + error.message);
    })
    .finally(() => {
        // Reset form
        document.getElementById('venue-select').selectedIndex = 0;
        document.getElementById('month-select').selectedIndex = 0;
        document.getElementById('date-select').innerHTML = '<option value="">Select Date</option>';
        document.getElementById('date-select').disabled = true;
        document.getElementById('start-select').selectedIndex = 0;
        document.getElementById('end-select').selectedIndex = 0;
        document.getElementById('message-select').selectedIndex = 0;
        document.getElementById('message-area').value = "";
        document.getElementById('hidden-html-message').value = '';

        // Clear photo selection
        document.getElementById('selected-photo-id').value = '';
        const photoPreview = document.getElementById('selected-photo-preview');
        if (photoPreview) {
            photoPreview.classList.add('d-none');
            const previewImg = photoPreview.querySelector('img');
            if (previewImg) {
                previewImg.src = '';
            }
        }
    });
  });

  // Clear button click handler
  document.getElementById('clear-btn').addEventListener('click', function() {
    document.getElementById('message-area').value = '';
  });

  // Test button click handler
  document.getElementById('test-btn').addEventListener('click', function(e) {
    e.preventDefault();
    
    if (!validateFormForGenerate()) {
      return;
    }

    const venueSelect = document.getElementById('venue-select');
    const selectedOption = venueSelect.options[venueSelect.selectedIndex];
    const venue = venueSelect.value;
    const address = selectedOption.dataset.address;
    const city = selectedOption.dataset.city;
    const state = selectedOption.dataset.state;
    const zip = selectedOption.dataset.zip;
    const month = document.getElementById('month-select').value;
    const date = document.getElementById('date-select').value;
    const startTime = document.getElementById('start-select').value;
    const endTime = document.getElementById('end-select').value;
    const messageType = parseInt(document.getElementById('message-select').value);
    const messageArea = document.getElementById('message-area').value;
    const htmlMessage = document.getElementById('hidden-html-message').value;
    const photo_id = document.getElementById('selected-photo-id')?.value || null;

    generateMessage(venue, address, city, state, zip, month, date, startTime, endTime, messageType, 'test', messageArea, htmlMessage, photo_id)
      .then(data => {
        console.log('Server response for test:', data);
        if (data.success) {
          // If there are results, show them in the modal
          if (data.results) {
            showEmailResults(data.results);
          } else {
            // Legacy success handling
            showEmailResults({
              successful: 1,
              failed: 0,
              failedDetails: []
            });
          }
        } else {
          showEmailResults({
            successful: 0,
            failed: 1,
            failedDetails: [{
              name: 'Test Recipient',
              email: 'test@example.com',
              error: data.error || 'Unknown error'
            }]
          });
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showEmailResults({
          successful: 0,
          failed: 1,
          failedDetails: [{
            name: 'Test Recipient',
            email: 'test@example.com',
            error: error.message
          }]
        });
      });
  });

  // Function to generate the message based on the selected values
  window.generateMessage = function (venue, address, city, state, zip, month, date, startTime, endTime, messageType, action = '', plainMessage = '', htmlMessage = '') {
    const photo_id = document.getElementById('selected-photo-id')?.value || null;
  
    return fetch('http://localhost/LukeSwiderski/includes/email.inc.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        venue, address, city, state, zip, month, date, startTime, endTime, messageType, action, plainMessage, htmlMessage, photo_id
      })
    })
    .then(response => {
      if (!response.ok) {
        return response.text().then(text => {
          throw new Error(`HTTP error! status: ${response.status}, body: ${text}`);
        });
      }
      return response.text();
    })
    .then(text => {
      console.log('Raw response from server:', text);
      try {
        return JSON.parse(text);
      } catch (e) {
        console.error('Server response was not valid JSON:', text);
        throw new Error('The server response was not valid JSON');
      }
    })
    .catch(error => {
      console.error('Fetch error:', error);
      throw error;
    });
  }
});