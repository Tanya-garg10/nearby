<?php
$pageTitle = 'Find Accommodation | NearBy';
$pageScripts = ['assets/js/search.js'];
require_once __DIR__ . '/includes/header.php';
?>
<div data-app-alerts>
    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h4 fw-semibold">Discover rooms & local services near MITS</h1>
            <p class="text-muted small mb-0">Filter verified listings shared by students, owners, and community providers — all in one place.</p>
        </div>
        <div class="d-flex flex-column flex-sm-row align-items-stretch gap-3">
            <div class="glass-card p-3">
                <span class="small text-muted">Popular searches:</span>
                <div class="d-flex flex-wrap gap-2 mt-2">
                    <span class="filter-pill">Hostels</span>
                    <span class="filter-pill">Tiffin</span>
                    <span class="filter-pill">Gas Cylinder</span>
                    <span class="filter-pill">Milk Delivery</span>
                </div>
            </div>
            <?php if ($currentUser): ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPostModal">
                    <i class="bi bi-plus-circle me-2"></i>Create Post
                </button>
            <?php else: ?>
                <a class="btn btn-outline-light" href="login.php">
                    <i class="bi bi-lock me-2"></i>Login to Create Post
                </a>
            <?php endif; ?>
        </div>
    </div>

    <form id="advancedSearch" class="glass-card p-4 mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label" for="filterCategory">Post Type</label>
                <select class="form-select" id="filterCategory" name="post_category">
                    <option value="">All Posts</option>
                    <option value="room">Room Rent</option>
                    <option value="service">Local Service</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="filterServiceType">Service Type</label>
                <select class="form-select" id="filterServiceType" name="service_type">
                    <option value="">All Services</option>
                    <option value="tiffin">Tiffin / Mess</option>
                    <option value="gas">Gas Provider</option>
                    <option value="milk">Milk (Doodh)</option>
                    <option value="sabji">Vegetable (Sabji)</option>
                    <option value="other">Other Local Service</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="filterAccommodation">Accommodation Type</label>
                <select class="form-select" id="filterAccommodation" name="accommodation_type">
                    <option value="">All Types</option>
                    <option value="PG">PG</option>
                    <option value="Flat">Flat</option>
                    <option value="Room">Room</option>
                    <option value="Hostel">Hostel</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="filterAllowedFor">Allowed For</label>
                <select class="form-select" id="filterAllowedFor" name="allowed_for">
                    <option value="">Anyone</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Family">Family</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="filterLocation">Location / Keyword</label>
                <input type="text" class="form-control" id="filterLocation" name="location" placeholder="MITS Gate, Thatipur, City Center...">
            </div>
            <div class="col-md-3">
                <label class="form-label" for="filterMinPrice">Min Price (₹)</label>
                <input type="number" class="form-control" id="filterMinPrice" name="min_price" min="0" step="500" placeholder="0">
            </div>
            <div class="col-md-3">
                <label class="form-label" for="filterMaxPrice">Max Price (₹)</label>
                <input type="number" class="form-control" id="filterMaxPrice" name="max_price" min="0" step="500" placeholder="15000">
            </div>
        </div>
        <div class="d-flex justify-content-end gap-3 mt-4">
            <button class="btn btn-outline-light" type="reset">Clear</button>
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <section class="row g-4 align-items-stretch mb-5">
        <div class="col-lg-4">
            <div class="glass-card h-100 p-3 p-md-4">
                <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=900&q=80" class="img-fluid rounded-3 mb-3" alt="Cozy student room with study desk">
                <h2 class="h5 fw-semibold mb-2">Find Your Study-Ready Space</h2>
                <p class="text-muted small mb-0">Browse curated listings with Wi-Fi, power backup, and quiet corners so you can stay focused during exam season.</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="glass-card h-100 p-3 p-md-4">
                <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=900&q=80" class="img-fluid rounded-3 mb-3" alt="Students collaborating in a modern common area">
                <h2 class="h5 fw-semibold mb-2">Share With Trusted Roommates</h2>
                <p class="text-muted small mb-0">Match with fellow MITS students who share similar schedules and lifestyle preferences for a smoother living experience.</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="glass-card h-100 p-3 p-md-4">
                <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80" class="img-fluid rounded-3 mb-3" alt="Modern apartment building exterior">
                <h2 class="h5 fw-semibold mb-2">Stay Close to Campus</h2>
                <p class="text-muted small mb-0">Filter by walking distance, public transport, and neighborhood amenities to settle into the perfect location.</p>
            </div>
        </div>
    </section>

    <div class="glass-card p-4 p-md-5 mb-5">
        <div class="row g-4 align-items-center">
            <div class="col-md-5">
                <img src="https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=900&q=80" class="img-fluid rounded-4" alt="Student planning accommodation search on a laptop">
            </div>
            <div class="col-md-7">
                <h3 class="h4 fw-semibold mb-3">Smart Tips for Your Next Move</h3>
                <ul class="list-unstyled text-muted small mb-0">
                    <li class="d-flex gap-3 mb-3">
                        <i class="bi bi-geo-alt text-primary fs-5"></i>
                        <span>Start with the location filter to stay within 2 km of the main MITS gate and minimize commute stress.</span>
                    </li>
                    <li class="d-flex gap-3 mb-3">
                        <i class="bi bi-currency-rupee text-primary fs-5"></i>
                        <span>Use the rent slider to lock a budget, then compare amenities like food plans or laundry to maximize value.</span>
                    </li>
                    <li class="d-flex gap-3 mb-3">
                        <i class="bi bi-lightbulb text-primary fs-5"></i>
                        <span>Look for listings marked “Owner Verified” and message seniors through the contact section for authentic reviews.</span>
                    </li>
                    <li class="d-flex gap-3 mb-0">
                        <i class="bi bi-shield-check text-primary fs-5"></i>
                        <span>Finalize only after a video walkthrough or weekend visit—NearBy reminders help you track follow-ups.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="searchResults" class="row g-4"></div>
</div>
<?php include __DIR__ . '/includes/create-post-modal.php'; ?>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
