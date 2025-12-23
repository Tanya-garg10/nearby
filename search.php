<?php
$pageTitle = 'Find Accommodation | NearBy';
$pageScripts = ['assets/js/search.js'];
require_once __DIR__ . '/includes/header.php';
?>
<div data-app-alerts>
    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h4 fw-semibold">Explore nearby stays</h1>
            <p class="text-muted small">Use advanced filters to narrow down the perfect accommodation for you.</p>
        </div>
        <div class="glass-card p-3">
            <span class="small text-muted">Facilities available:</span>
            <div class="d-flex flex-wrap gap-2 mt-2">
                <span class="filter-pill">Wi-Fi</span>
                <span class="filter-pill">Food</span>
                <span class="filter-pill">Water</span>
                <span class="filter-pill">Electricity</span>
                <span class="filter-pill">Parking</span>
                <span class="filter-pill">CCTV</span>
                <span class="filter-pill">Power Backup</span>
            </div>
        </div>
    </div>

    <form id="advancedSearch" class="glass-card p-4 mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Location</label>
                <input type="text" class="form-control" name="query" placeholder="College or area">
            </div>
            <div class="col-md-4">
                <label class="form-label">Accommodation Type</label>
                <select class="form-select" name="type">
                    <option value="">Any</option>
                    <option value="PG">PG</option>
                    <option value="Flat">Flat</option>
                    <option value="Room">Room</option>
                    <option value="Hostel">Hostel</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Allowed For</label>
                <select class="form-select" name="allowed_for">
                    <option value="">All</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Family">Family</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Rent Range (₹)</label>
                <div class="row g-2">
                    <div class="col-6">
                        <input type="number" class="form-control" name="min_rent" placeholder="Min" min="0" step="500">
                    </div>
                    <div class="col-6">
                        <input type="number" class="form-control" name="max_rent" placeholder="Max" min="0" step="500">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
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
        </div>
        <div class="d-flex justify-content-end gap-3 mt-4">
            <button class="btn btn-outline-light" type="reset">Clear</button>
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <div id="searchResults" class="row g-4"></div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
