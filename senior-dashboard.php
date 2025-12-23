<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (($_SESSION['user']['role'] ?? null) !== 'senior') {
    header('Location: login.php');
    exit;
}

$pageTitle = 'Senior Dashboard | NearBy';
$pageScripts = ['assets/js/senior.js'];
require_once __DIR__ . '/includes/header.php';
?>
<div data-app-alerts>
    <div class="row align-items-center mb-4">
        <div class="col-md-7">
            <h1 class="h4 fw-semibold">Share your accommodation with juniors</h1>
            <p class="text-muted small">List rooms, flats, or PGs to help junior students find safe homes near campus.</p>
        </div>
        <div class="col-md-5">
            <div class="glass-card p-3">
                <p class="small text-muted mb-2">Posting tips</p>
                <div class="d-flex flex-wrap gap-2">
                    <span class="filter-pill">Detailed description</span>
                    <span class="filter-pill">Verified facilities</span>
                    <span class="filter-pill">Accurate rent</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="glass-card p-4">
                <h2 class="h5 fw-semibold mb-3">Add Accommodation</h2>
                <form id="postAccommodation" novalidate>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Cozy 2BHK near XYZ College" required>
                        <div class="invalid-feedback">Provide a quick title for your listing</div>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">Type</label>
                            <select class="form-select" name="type" required>
                                <option value="">Select type</option>
                                <option value="PG">PG</option>
                                <option value="Flat">Flat</option>
                                <option value="Room">Room</option>
                                <option value="Hostel">Hostel</option>
                            </select>
                            <div class="invalid-feedback">Pick a type</div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Allowed For</label>
                            <select class="form-select" name="allowed_for" required>
                                <option value="">Select option</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Family">Family</option>
                            </select>
                            <div class="invalid-feedback">Select who can stay</div>
                        </div>
                    </div>
                    <div class="row g-3 mt-1">
                        <div class="col-sm-6">
                            <label class="form-label">Monthly Rent (₹)</label>
                            <input type="number" class="form-control" name="monthly_rent" min="1000" step="500" required>
                            <div class="invalid-feedback">Rent helps juniors filter quickly</div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" placeholder="Near ABC Hostel Road" required>
                            <div class="invalid-feedback">Location is required</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Facilities</label>
                        <div class="d-flex flex-wrap gap-2">
                            <?php
                            $facilities = ['Wi-Fi', 'Food', 'Water', 'Electricity', 'Parking', 'CCTV', 'Power Backup'];
                            foreach ($facilities as $facility):
                            ?>
                                <label class="form-check form-check-inline facility-checkbox">
                                    <input class="form-check-input" type="checkbox" name="facilities[]" value="<?= $facility ?>">
                                    <span class="form-check-label"><?= $facility ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4" placeholder="Share highlights, nearby places, rules, etc." required></textarea>
                        <div class="invalid-feedback">Help juniors understand the stay better</div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-4">Post Accommodation</button>
                </form>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="glass-card p-4 h-100">
                <h2 class="h5 fw-semibold mb-3">Why list with NearBy?</h2>
                <ul class="list-unstyled d-grid gap-3">
                    <li class="d-flex gap-3">
                        <span class="facility-icon"><i class="bi bi-lightning-charge"></i></span>
                        <div>
                            <p class="fw-semibold mb-1">Quick responses</p>
                            <p class="small text-muted mb-0">Juniors can request contact instantly through NearBy.</p>
                        </div>
                    </li>
                    <li class="d-flex gap-3">
                        <span class="facility-icon"><i class="bi bi-shield-check"></i></span>
                        <div>
                            <p class="fw-semibold mb-1">Trusted community</p>
                            <p class="small text-muted mb-0">Connect with your juniors and build a helpful network.</p>
                        </div>
                    </li>
                    <li class="d-flex gap-3">
                        <span class="facility-icon"><i class="bi bi-piggy-bank"></i></span>
                        <div>
                            <p class="fw-semibold mb-1">Manage vacancy</p>
                            <p class="small text-muted mb-0">Keep your space occupied with respectful tenants.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
