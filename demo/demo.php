<?php
require_once 'demo_config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Email Service Demo</title>
</head>
<body>
    <div class="container mt-4">
        <!-- Demo Mode Banner -->
        <div class="alert alert-warning text-center" role="alert">
            <h4 class="alert-heading">Demo Mode</h4>
            <p class="mb-0">This is a demonstration version. No emails will actually be sent.</p>
        </div>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs mb-4" id="demoTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="message-tab" data-bs-toggle="tab" href="#message" role="tab">Message</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="venues-tab" data-bs-toggle="tab" href="#venues" role="tab">Venues</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="emails-tab" data-bs-toggle="tab" href="#emails" role="tab">Email List</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="demoTabContent">
            <!-- Message Tab -->
            <div class="tab-pane fade show active" id="message" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form id="demoForm">
                            <div class="row mb-4 align-items-start">
                                <!-- Venue Selection -->
                                <div class="col-md-6 mb-3">
                                    <label for="venue-select" class="form-label fw-bold">Venue</label>
                                    <select class="form-select" id="venue-select" required>
                                        <option value="">Select Venue</option>
                                        <?php foreach ($demoVenues as $venue): ?>
                                            <option value="<?= htmlspecialchars($venue['id']) ?>" 
                                                    data-address="<?= htmlspecialchars($venue['address']) ?>"
                                                    data-city="<?= htmlspecialchars($venue['city']) ?>"
                                                    data-state="<?= htmlspecialchars($venue['state']) ?>"
                                                    data-zip="<?= htmlspecialchars($venue['zip']) ?>">
                                                <?= htmlspecialchars($venue['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Date Selection -->
                                <div class="col-md-3 mb-3">
                                    <label for="date" class="form-label fw-bold">Date</label>
                                    <input type="date" class="form-control" id="date" required>
                                </div>

                                <!-- Message Type -->
                                <div class="col-md-3 mb-3">
                                    <label for="message-type" class="form-label fw-bold">Message Type</label>
                                    <select class="form-select" id="message-type" required>
                                        <option value="">Select Type</option>
                                        <option value="new">New Event</option>
                                        <option value="reminder">Reminder</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Photo Selection -->
                            <div class="mb-4">
                                <button type="button" class="btn btn-outline-dark" id="select-photo-btn">Select Photo</button>
                                <div id="selected-photo-preview" class="mt-2 d-none">
                                    <img src="" alt="Selected photo" style="max-width: 150px">
                                    <button type="button" class="btn btn-sm btn-link text-danger" id="remove-photo-btn">Remove</button>
                                </div>
                            </div>

                            <!-- Preview Area -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Message Preview</label>
                                <div id="preview-area" class="border rounded p-3 bg-light">
                                    Message preview will appear here...
                                </div>
                            </div>

                            <!-- Sample Recipients -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Sample Recipients</label>
                                <div class="border rounded p-3 bg-light">
                                    <?php foreach ($demoRecipients as $recipient): ?>
                                        <div class="mb-1">
                                            <?= htmlspecialchars($recipient['name']) ?> (<?= htmlspecialchars($recipient['email']) ?>)
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="text-center">
                                <button type="button" class="btn btn-primary" id="preview-btn">Generate Preview</button>
                                <button type="button" class="btn btn-success" id="demo-send-btn">Demo Send</button>
                                <button type="button" class="btn btn-secondary" id="clear-btn">Clear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Venues Tab -->
            <div class="tab-pane fade" id="venues" role="tabpanel">
                <div class="row justify-content-center mb-4">
                    <div class="col-md-8">
                        <form id="add-venue-form" class="p-3 bg-light rounded">
                            <h3 class="h5 mb-3">Add New Venue</h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" name="venue_name" class="form-control" placeholder="Venue Name" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="address" class="form-control" placeholder="Address" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="city" class="form-control" placeholder="City" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="state" class="form-control" placeholder="State" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="zip" class="form-control" placeholder="ZIP" required>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-dark">Add Venue (Demo)</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="venues-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Venue Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>ZIP</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($demoVenues as $venue): ?>
                                <tr>
                                    <td><?= htmlspecialchars($venue['name']) ?></td>
                                    <td><?= htmlspecialchars($venue['address']) ?></td>
                                    <td><?= htmlspecialchars($venue['city']) ?></td>
                                    <td><?= htmlspecialchars($venue['state']) ?></td>
                                    <td><?= htmlspecialchars($venue['zip']) ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm edit-venue">Edit</button>
                                        <button class="btn btn-danger btn-sm delete-venue">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Email List Tab -->
            <div class="tab-pane fade" id="emails" role="tabpanel">
                <div class="row justify-content-center mb-4">
                    <div class="col-md-8">
                        <form id="add-email-form" class="p-3 bg-light rounded">
                            <h3 class="h5 mb-3">Add New Email</h3>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="col-md-4">
                                    <select name="status" class="form-select" required>
                                        <option value="">Select Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="unsubscribed">Unsubscribed</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-dark">Add Email (Demo)</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="emails-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($demoRecipients as $recipient): ?>
                                <tr>
                                    <td><?= htmlspecialchars($recipient['name']) ?></td>
                                    <td><?= htmlspecialchars($recipient['email']) ?></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm edit-email">Edit</button>
                                        <button class="btn btn-danger btn-sm delete-email">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Photo Selection Modal -->
    <div class="modal fade" id="photoModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="photo-grid" class="row g-3">
                        <?php foreach ($demoPhotos as $photo): ?>
                            <div class="col-4">
                                <img src="<?= htmlspecialchars($photo['path']) ?>" 
                                     class="img-fluid photo-select" 
                                     data-id="<?= htmlspecialchars($photo['id']) ?>"
                                     alt="Demo photo">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>