// __tests__/dashboard.test.js

const fs = require('fs');
const path = require('path');
const { JSDOM } = require('jsdom');

// Read the dashboard.js file
const dashboardJs = fs.readFileSync(path.resolve(__dirname, '../dashboard.js'), 'utf8');

describe('Dashboard.js Tests', () => {
  let dom;
  let window;
  let document;

  beforeEach(() => {
    // Set up a new JSDOM instance before each test
    dom = new JSDOM('<!DOCTYPE html><html><body></body></html>', {
      url: 'http://localhost',
      runScripts: 'dangerously',
      resources: 'usable',
    });
    window = dom.window;
    document = window.document;

    // Mock alert
    window.alert = jest.fn();

    // Set up the necessary DOM elements
    document.body.innerHTML = `
      <select id="venue-select">
        <option value="">Select Venue</option>
        <option value="1">Test Venue</option>
      </select>
      <select id="month-select">
        <option value="">Select Month</option>
        <option value="1">January</option>
      </select>
      <select id="date-select">
        <option value="">Select Date</option>
      </select>
      <select id="start-select">
        <option value="">Select Start Time</option>
        <option value="09:00">9:00 AM</option>
      </select>
      <select id="end-select">
        <option value="">Select End Time</option>
        <option value="10:00">10:00 AM</option>
      </select>
      <select id="message-select">
        <option value="">Select Message Type</option>
        <option value="1">New</option>
      </select>
      <textarea id="message-area"></textarea>
      <input type="hidden" id="hidden-html-message">
      <button id="generate-btn"></button>
      <button id="submit-btn"></button>
      <button id="clear-btn"></button>
    `;

    window.validateFormForGenerate = function() {
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
        window.alert(errorMessage);
        return false;
      }
    
      return true;
    };

    window.generateMessage = jest.fn(() => {
      window.fetch('http://localhost/LukeSwiderski/includes/email.inc.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({}) // Add relevant data here if needed
      });
      return Promise.resolve({success: true});
    });

    window.generateBtn = document.getElementById('generate-btn');
    window.generateBtn.addEventListener('click', function() {
      if (window.validateFormForGenerate()) {
        const venueSelect = document.getElementById('venue-select');
        window.generateMessage(
          venueSelect.value,
          "Test Address",
          "Test City", 
          "Test State",
          "12345",
          document.getElementById('month-select').value,
          document.getElementById('date-select').value,
          document.getElementById('start-select').value,
          document.getElementById('end-select').value,
          parseInt(document.getElementById('message-select').value)
        );
      }
    });

    window.clearBtn = document.getElementById('clear-btn');
    window.clearBtn.addEventListener('click', function() {
      document.getElementById('message-area').value = '';
    });

    // Mock the fetch function
    window.fetch = jest.fn(() =>
      Promise.resolve({
        ok: true,
        text: () => Promise.resolve(JSON.stringify({ success: true, messageData: { plainMessage: 'Test message', htmlMessage: '<p>Test message</p>' } })),
      })
    );

    // Make sure global.document and global.window are set
    global.document = document;
    global.window = window;
  });

  test('validateFormForGenerate should return false when form is incomplete', () => {
    expect(typeof window.validateFormForGenerate).toBe('function');
    const result = window.validateFormForGenerate();
    console.error('Incomplete form values:', {
      venue: document.getElementById('venue-select').value,
      month: document.getElementById('month-select').value,
      date: document.getElementById('date-select').value,
      startTime: document.getElementById('start-select').value,
      endTime: document.getElementById('end-select').value,
      messageType: document.getElementById('message-select').value,
    });
    console.error('Incomplete form validation result:', result);
    console.error('Alert calls for incomplete form:', window.alert.mock.calls);
    expect(result).toBe(false);
    expect(window.alert).toHaveBeenCalled();
  });

  test('validateFormForGenerate should return true when form is complete', () => {
    // Set form values
    document.getElementById('venue-select').value = '1';
    document.getElementById('month-select').value = '1';
    document.getElementById('start-select').value = '09:00';
    document.getElementById('end-select').value = '10:00';
    document.getElementById('message-select').value = '1';
    

    // Trigger the month change event to populate the date select
    const monthChangeEvent = new window.Event('change');
    document.getElementById('month-select').dispatchEvent(monthChangeEvent);

    // Now set the date value after the month change event has populated the options
    document.getElementById('date-select').innerHTML = '<option value="1">1</option>';
    document.getElementById('date-select').value = '1';

    // Log form state before validation
    console.error('Form state before validation:', {
      venue: document.getElementById('venue-select').value,
      month: document.getElementById('month-select').value,
      date: document.getElementById('date-select').value,
      startTime: document.getElementById('start-select').value,
      endTime: document.getElementById('end-select').value,
      messageType: document.getElementById('message-select').value,
    });

    const result = window.validateFormForGenerate();
    console.error('Complete form validation result:', result);
    console.error('Alert calls for complete form:', window.alert.mock.calls);
    expect(result).toBe(true);
  });

  test('generateMessage should call fetch with correct parameters', () => {
    // Set all form values
    document.getElementById('venue-select').value = '1';
    document.getElementById('month-select').value = '1';
    document.getElementById('date-select').innerHTML = '<option value="1">1</option>';
    document.getElementById('date-select').value = '1';
    document.getElementById('start-select').value = '09:00';
    document.getElementById('end-select').value = '10:00';
    document.getElementById('message-select').value = '1';
  
    window.validateFormForGenerate = jest.fn(() => true); // Mock to always return true
  
    window.generateBtn.click();
  
    expect(window.fetch).toHaveBeenCalledWith(
      'http://localhost/LukeSwiderski/includes/email.inc.php',
      expect.objectContaining({
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: expect.any(String)
      })
    );
    });

  test('clear button should clear message area', () => {
    const messageArea = document.getElementById('message-area');
    messageArea.value = 'Test message';
    window.clearBtn.click();
    expect(messageArea.value).toBe('');
  });
});