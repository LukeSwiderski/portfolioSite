// Venue management functionality
const VenueManager = {
  init() {
    this.bindEvents();
    this.loadVenues();
  },

  bindEvents() {
    document.getElementById('add-venue-form').addEventListener('submit', (e) => {
      e.preventDefault();
      this.handleAddVenue(e.target);
    });

    document.getElementById('venues-table').addEventListener('click', (e) => {
      if (e.target.matches('.edit-venue')) {
        this.handleEditClick(e);
      } else if (e.target.matches('.delete-venue')) {
        this.handleDeleteClick(e);
      }
    });
  },

  async loadVenues() {
    try {
      const response = await fetch('includes/venue_management.inc.php');
      const data = await response.json();
      if (data.success) {
        this.renderVenuesTable(data.venues);
      }
    } catch (error) {
      console.error('Error loading venues:', error);
    }
  },

  async handleAddVenue(form) {
    const formData = new FormData(form);
    try {
      const response = await fetch('includes/venue_management.inc.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          action: 'add',
          venue: Object.fromEntries(formData)
        })
      });
      const data = await response.json();
      if (data.success) {
        form.reset();
        this.loadVenues();
      }
    } catch (error) {
      console.error('Error adding venue:', error);
    }
  },

  async handleDeleteClick(e) {
    const venueId = e.target.dataset.id;
    if (!confirm('Are you sure you want to delete this venue?')) return;

    try {
      const response = await fetch('includes/venue_management.inc.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          action: 'delete',
          venue_id: venueId
        })
      });
      const data = await response.json();
      if (data.success) {
        this.loadVenues();
      }
    } catch (error) {
      console.error('Error deleting venue:', error);
    }
  },

  handleEditClick(e) {
    const row = e.target.closest('tr');
    const venueId = e.target.dataset.id;
    const cells = row.getElementsByTagName('td');

    // Create inputs with current values from cells
    const inputs = {
        venue_name: cells[0].textContent.trim(),
        address: cells[1].textContent.trim(),
        city: cells[2].textContent.trim(),
        state: cells[3].textContent.trim(),
        zip: cells[4].textContent.trim()
    };

    row.innerHTML = `
        <td><input type="text" name="venue_name" value="${inputs.venue_name}" class="form-control"></td>
        <td><input type="text" name="address" value="${inputs.address}" class="form-control"></td>
        <td><input type="text" name="city" value="${inputs.city}" class="form-control"></td>
        <td><input type="text" name="state" value="${inputs.state}" class="form-control"></td>
        <td><input type="text" name="zip" value="${inputs.zip}" class="form-control"></td>
        <td>
            <button class="btn btn-success save-edit" data-id="${venueId}">Save</button>
            <button class="btn btn-secondary cancel-edit">Cancel</button>
        </td>
    `;

    row.querySelector('.save-edit').addEventListener('click', () => this.handleSaveEdit(row, venueId));
    row.querySelector('.cancel-edit').addEventListener('click', () => this.loadVenues());
  },

async handleSaveEdit(row, venueId) {
    const inputs = row.querySelectorAll('input[type="text"]');
    const venueData = {
        venue_id: venueId,
        venue_name: inputs[0].value,
        address: inputs[1].value,
        city: inputs[2].value,
        state: inputs[3].value,
        zip: inputs[4].value
    };

    try {
        const response = await fetch('includes/venue_management.inc.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'update',
                venue: venueData
            })
        });
        
        const data = await response.json();
        if (data.success) {
            this.loadVenues();
        } else {
            console.error('Error updating venue:', data.error);
            alert('Failed to update venue: ' + data.error);
        }
    } catch (error) {
        console.error('Error updating venue:', error);
        alert('Failed to update venue: ' + error.message);
    }
  },

  renderVenuesTable(venues) {
    const tbody = document.getElementById('venues-table').getElementsByTagName('tbody')[0];
    tbody.innerHTML = venues.map(venue => `
      <tr>
        <td>${venue.venue_name}</td>
        <td>${venue.address}</td>
        <td>${venue.city}</td>
        <td>${venue.state}</td>
        <td>${venue.zip}</td>
        <td>
          <button class="btn btn-primary edit-venue" data-id="${venue.venue_id}">Edit</button>
          <button class="btn btn-danger delete-venue" data-id="${venue.venue_id}">Delete</button>
        </td>
      </tr>
    `).join('');
  }
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => VenueManager.init());