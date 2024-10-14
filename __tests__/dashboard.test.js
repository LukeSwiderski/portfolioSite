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

    // Add the dashboard.js script to the JSDOM environment
    const script = document.createElement('script');
    script.textContent = dashboardJs;
    document.body.appendChild(script);

    // Trigger DOMContentLoaded event
    const event = new window.Event('DOMContentLoaded');
    window.document.dispatchEvent(event);

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
    // Set up the form with valid data
    document.getElementById('venue-select').value = '1';
    document.getElementById('month-select').value = '1';
    document.getElementById('month-select').dispatchEvent(new window.Event('change'));
    document.getElementById('date-select').value = '1';
    document.getElementById('start-select').value = '09:00';
    document.getElementById('end-select').value = '10:00';
    document.getElementById('message-select').value = '1';

    // Trigger the generate button click
    const generateBtn = document.getElementById('generate-btn');
    generateBtn.click();

    expect(window.fetch).toHaveBeenCalledWith(
      'http://localhost/LukeSwiderski/includes/email.inc.php',
      expect.objectContaining({
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: expect.any(String),
      })
    );
  });

  test('clear button should clear message area', () => {
    const messageArea = document.getElementById('message-area');
    messageArea.value = 'Test message';

    const clearBtn = document.getElementById('clear-btn');
    clearBtn.click();

    expect(messageArea.value).toBe('');
  });
});