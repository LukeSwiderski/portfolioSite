document.addEventListener('DOMContentLoaded', function() {
  // Message Tab Functionality
  const form = document.getElementById('demoForm');
  const previewArea = document.getElementById('preview-area');
  const previewBtn = document.getElementById('preview-btn');
  const demoSendBtn = document.getElementById('demo-send-btn');
  const clearBtn = document.getElementById('clear-btn');

  // Photo Selection
  const photoModal = new bootstrap.Modal(document.getElementById('photoModal'));
  const selectPhotoBtn = document.getElementById('select-photo-btn');
  const removePhotoBtn = document.getElementById('remove-photo-btn');
  const selectedPhotoPreview = document.getElementById('selected-photo-preview');
  let selectedPhotoId = null;

  function generatePreview() {
      const venueSelect = document.getElementById('venue-select');
      const venue = venueSelect.options[venueSelect.selectedIndex];
      const date = document.getElementById('date').value;
      const messageType = document.getElementById('message-type').value;

      if (!venue.value || !date || !messageType) {
          alert('Please fill in all fields');
          return;
      }

      const formattedDate = new Date(date).toLocaleDateString('en-US', {
          weekday: 'long',
          year: 'numeric',
          month: 'long',
          day: 'numeric'
      });

      const address = `${venue.dataset.address}, ${venue.dataset.city}, ${venue.dataset.state} ${venue.dataset.zip}`;
      
      let message = '';
      if (messageType === 'new') {
          message = `Hi friends,\n\nJust writing to let you know I'll be playing at ${venue.text} on ${formattedDate}.\n\nVenue: ${address}\n\nHope to see you there!\n\nBest,\nLuke`;
      } else {
          message = `Reminder!\n\nI'll be playing at ${venue.text} this ${formattedDate}.\n\nVenue: ${address}\n\nHope you can make it!\n\nBest,\nLuke`;
      }

      previewArea.innerHTML = message.replace(/\n/g, '<br>');
  }

  // Photo Selection Events
  selectPhotoBtn.addEventListener('click', () => photoModal.show());

  document.querySelectorAll('.photo-select').forEach(photo => {
      photo.addEventListener('click', () => {
          selectedPhotoId = photo.dataset.id;
          selectedPhotoPreview.querySelector('img').src = photo.src;
          selectedPhotoPreview.classList.remove('d-none');
          photoModal.hide();
      });
  });

  removePhotoBtn.addEventListener('click', () => {
      selectedPhotoId = null;
      selectedPhotoPreview.classList.add('d-none');
      selectedPhotoPreview.querySelector('img').src = '';
  });

  // Venue Management
  const addVenueForm = document.getElementById('add-venue-form');
  addVenueForm.addEventListener('submit', (e) => {
      e.preventDefault();
      alert('In demo mode - venue would be added to database');
  });

  document.querySelectorAll('.edit-venue').forEach(btn => {
      btn.addEventListener('click', () => {
          alert('In demo mode - venue editing disabled');
      });
  });

  document.querySelectorAll('.delete-venue').forEach(btn => {
      btn.addEventListener('click', () => {
          alert('In demo mode - venue deletion disabled');
      });
  });

  // Email List Management
  const addEmailForm = document.getElementById('add-email-form');
  addEmailForm.addEventListener('submit', (e) => {
      e.preventDefault();
      alert('In demo mode - email would be added to database');
  });

  document.querySelectorAll('.edit-email').forEach(btn => {
      btn.addEventListener('click', () => {
          alert('In demo mode - email editing disabled');
      });
  });

  document.querySelectorAll('.delete-email').forEach(btn => {
      btn.addEventListener('click', () => {
          alert('In demo mode - email deletion disabled');
      });
  });

  // Main Form Events
  previewBtn.addEventListener('click', generatePreview);

  demoSendBtn.addEventListener('click', function() {
      if (!previewArea.textContent || previewArea.textContent === 'Message preview will appear here...') {
          alert('Please generate a preview first');
          return;
      }
      alert('Demo Mode: In a live environment, this message would be sent to the email list.');
  });

  clearBtn.addEventListener('click', function() {
      form.reset();
      previewArea.innerHTML = 'Message preview will appear here...';
      selectedPhotoId = null;
      selectedPhotoPreview.classList.add('d-none');
      selectedPhotoPreview.querySelector('img').src = '';
  });
});