const EmailManager = {
  init() {
    this.loadEmails();
    this.bindTableEvents();
    this.bindAddEmailForm();
  },

  bindTableEvents() {
    const table = document.getElementById('emails-table');
    table.addEventListener('click', (e) => {
      if (e.target.matches('.edit-email')) {
        this.handleEditClick(e);
      } else if (e.target.matches('.delete-email')) {
        this.handleDeleteClick(e);
      } else if (e.target.matches('.toggle-status')) {
        this.handleStatusToggle(e);
      }
    });
  },

  bindAddEmailForm() {
    const form = document.getElementById('add-email-form');
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      this.handleAddEmail(e.target);
    });
  },

  async handleAddEmail(form) {
    const formData = new FormData(form);
    try {
      const response = await fetch('http://localhost/LukeSwiderski/includes/email_management.inc.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          action: 'add',
          email: Object.fromEntries(formData)
        })
      });
      const data = await response.json();
      if (data.success) {
        form.reset();
        this.loadEmails();
      } else {
        alert(data.error || 'Error adding email');
      }
    } catch (error) {
      console.error('Error adding email:', error);
    }
  },

  async loadEmails() {
    try {
      const response = await fetch('http://localhost/LukeSwiderski/includes/email_management.inc.php');
      const data = await response.json();
      if (data.success) {
        this.renderEmailsTable(data.emails);
      }
    } catch (error) {
      console.error('Error loading emails:', error);
    }
  },

  async handleDeleteClick(e) {
    const emailId = e.target.dataset.id;
    if (!confirm('Are you sure you want to delete this email?')) return;

    try {
      const response = await fetch('http://localhost/LukeSwiderski/includes/email_management.inc.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          action: 'delete',
          id: emailId
        })
      });
      const data = await response.json();
      if (data.success) {
        this.loadEmails();
      }
    } catch (error) {
      console.error('Error deleting email:', error);
    }
  },

  handleEditClick(e) {
    const row = e.target.closest('tr');
    const cells = row.getElementsByTagName('td');
    const emailId = e.target.dataset.id;

    row.innerHTML = `
      <td>
        <input type="text" name="name" value="${cells[0].textContent}" class="form-control">
      </td>
      <td>
        <input type="email" name="email" value="${cells[1].textContent}" class="form-control">
      </td>
      <td>
        <select name="subscribe_status" class="form-select">
          <option value="active" ${cells[2].textContent.trim() === 'Active' ? 'selected' : ''}>Active</option>
          <option value="inactive" ${cells[2].textContent.trim() === 'Inactive' ? 'selected' : ''}>Inactive</option>
          <option value="unsubscribed" ${cells[2].textContent.trim() === 'Unsubscribed' ? 'selected' : ''}>Unsubscribed</option>
          <option value="pending" ${cells[2].textContent.trim() === 'Pending' ? 'selected' : ''}>Pending</option>
        </select>
      </td>
      <td>
        <button class="btn btn-success save-edit" data-id="${emailId}">Save</button>
        <button class="btn btn-secondary cancel-edit">Cancel</button>
      </td>
    `;

    row.querySelector('.save-edit').addEventListener('click', () => this.handleSaveEdit(row, emailId));
    row.querySelector('.cancel-edit').addEventListener('click', () => this.loadEmails());
  },

  async handleSaveEdit(row, emailId) {
    const inputs = row.querySelectorAll('input[type="text"], input[type="email"], select');
    
    const emailData = {
      id: emailId,
      name: inputs[0].value,
      email: inputs[1].value,
      subscribe_status: inputs[2].value
    };

    try {
      const response = await fetch('http://localhost/LukeSwiderski/includes/email_management.inc.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          action: 'update',
          email: emailData
        })
      });
      const data = await response.json();
      if (data.success) {
        this.loadEmails();
      } else {
        alert(data.error || 'Error updating email');
      }
    } catch (error) {
      console.error('Error updating email:', error);
    }
  },

  getStatusBadgeClass(status) {
    switch (status) {
      case 'active':
        return 'btn-success';
      case 'inactive':
        return 'btn-warning';
      case 'unsubscribed':
        return 'btn-danger';
      case 'pending':
        return 'btn-info';
      default:
        return 'btn-secondary';
    }
  },

  renderEmailsTable(emails) {
    const tbody = document.getElementById('emails-table').getElementsByTagName('tbody')[0];
    tbody.innerHTML = emails.map(email => `
      <tr>
        <td>${email.name}</td>
        <td>${email.email}</td>
        <td>
          <button class="btn btn-sm toggle-status ${this.getStatusBadgeClass(email.subscribe_status)}"
                  data-id="${email.id}"
                  data-status="${email.subscribe_status}">
            ${email.subscribe_status.charAt(0).toUpperCase() + email.subscribe_status.slice(1)}
          </button>
        </td>
        <td>
          <button class="btn btn-primary btn-sm edit-email" data-id="${email.id}">Edit</button>
          <button class="btn btn-danger btn-sm delete-email" data-id="${email.id}">Delete</button>
        </td>
      </tr>
    `).join('');
  }
};

document.addEventListener('DOMContentLoaded', () => EmailManager.init());