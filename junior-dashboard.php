<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (($_SESSION['user']['role'] ?? null) !== 'junior') {
    header('Location: login.php');
    exit;
}

$pageTitle = 'Junior Dashboard | NearBy';
$pageScripts = ['assets/js/search.js'];
require_once __DIR__ . '/includes/header.php';
?>
<div data-app-alerts>
    <div class="row justify-content-between align-items-center mb-4">
        <div class="col-md-6">
            <h1 class="h4 fw-semibold">Hi <?= htmlspecialchars($_SESSION['user']['name']) ?>, find your next stay</h1>
            <p class="text-muted small">Filter based on location, type, rent, and must-have facilities.</p>
        </div>
        <div class="col-md-5">
            <div class="glass-card p-3">
                <p class="small text-muted mb-2">Quick tips</p>
                <div class="d-flex flex-wrap gap-2">
                    <span class="filter-pill">Verified owners</span>
                    <span class="filter-pill">Instant contact</span>
                    <span class="filter-pill">Budget friendly</span>
                </div>
            </div>
        </div>
    </div>

    <form id="dashboardSearch" class="glass-card p-4 mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Search</label>
                <input type="text" class="form-control" name="query" placeholder="Location or college name">
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
                <label class="form-label">Max Rent (₹)</label>
                <input type="number" class="form-control" name="max_rent" min="0" step="1000" placeholder="15000">
            </div>
        </div>
        <div class="d-flex justify-content-end gap-3 mt-4">
            <button class="btn btn-outline-light" type="reset">Reset</button>
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <div id="searchResults" class="row g-4"></div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
