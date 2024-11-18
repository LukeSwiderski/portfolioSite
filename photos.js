const PhotoSelector = {
  init() {
    this.loadPhotos();
    this.bindEvents();
  },

  bindEvents() {
    document.getElementById('select-photo-btn').addEventListener('click', () => {
      const modal = new bootstrap.Modal(document.getElementById('photoModal'));
      modal.show();
    });

    document.getElementById('remove-photo-btn').addEventListener('click', () => {
      this.clearSelection();
    });

    document.getElementById('photo-grid').addEventListener('click', (e) => {
      const photoCard = e.target.closest('.photo-card');
      if (photoCard) {
        this.selectPhoto(photoCard.dataset.id, photoCard.dataset.path);
      }
    });
  },

  async loadPhotos() {
    try {
      const response = await fetch('includes/photo_management.inc.php');
      const data = await response.json();
      if (data.success) {
        this.renderPhotoGrid(data.photos);
      }
    } catch (error) {
      console.error('Error loading photos:', error);
    }
  },

  renderPhotoGrid(photos) {
    const grid = document.getElementById('photo-grid');
    grid.innerHTML = photos.map(photo => `
      <div class="col-6 col-md-4">
        <div class="card photo-card h-100" data-id="${photo.id}" data-path="${photo.path}">
          <img src="${photo.path}" class="card-img-top" alt="${photo.title}">
          <div class="card-body p-2">
            <p class="card-text m-0">${photo.title}</p>
          </div>
        </div>
      </div>
    `).join('');
  },

  selectPhoto(id, path) {
    document.getElementById('selected-photo-id').value = id;
    const preview = document.getElementById('selected-photo-preview');
    preview.querySelector('img').src = path;
    preview.classList.remove('d-none');
    bootstrap.Modal.getInstance(document.getElementById('photoModal')).hide();
  },

  clearSelection() {
    document.getElementById('selected-photo-id').value = '';
    const preview = document.getElementById('selected-photo-preview');
    preview.querySelector('img').src = '';
    preview.classList.add('d-none');
  }
};

document.addEventListener('DOMContentLoaded', () => PhotoSelector.init());
