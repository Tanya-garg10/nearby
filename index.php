<?php
$pageTitle = 'NearBy | Student Housing Simplified';
require_once __DIR__ . '/includes/header.php';
?>
<section class="hero-section d-flex flex-column flex-lg-row align-items-center">
    <div class="hero-card text-center text-lg-start">
        <span class="badge bg-light text-success mb-3">Find Your Perfect Stay</span>
        <h1 class="display-5 fw-semibold mb-4">Discover Student-Friendly Rooms Near Your Campus</h1>
        <p class="lead text-muted mb-4">Search verified accommodations, connect with senior owners, and settle into a comfortable, affordable space designed for student life.</p>
        <div class="d-flex flex-column flex-md-row gap-3">
            <a href="search.php" class="btn btn-primary btn-lg px-4">Start Searching</a>
            <a href="register.php" class="btn btn-outline-light btn-lg px-4">Join NearBy</a>
        </div>
    </div>
    <div class="hero-illustration p-4 mt-4 mt-lg-0 w-100">
        <div class="row g-3">
            <div class="col-6">
                <div class="glass-card p-4 text-center">
                    <i class="bi bi-house-heart fs-1 text-success"></i>
                    <p class="fw-semibold mt-3 mb-1">Verified Listings</p>
                    <p class="small text-muted">Curated stays with trusted senior owners.</p>
                </div>
            </div>
            <div class="col-6">
                <div class="glass-card p-4 text-center">
                    <i class="bi bi-wifi fs-1 text-success"></i>
                    <p class="fw-semibold mt-3 mb-1">Essential Facilities</p>
                    <p class="small text-muted">Wi-Fi, meals, and amenities in every budget.</p>
                </div>
            </div>
            <div class="col-12">
                <div class="glass-card p-4 text-center">
                    <i class="bi bi-geo-alt fs-1 text-success"></i>
                    <p class="fw-semibold mt-3 mb-1">Stay Close to Campus</p>
                    <p class="small text-muted">Locate rooms around your college in minutes.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title fw-semibold">Why NearBy Works</h2>
        <a href="register.php" class="btn btn-sm btn-outline-light">Become a member</a>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="glass-card p-4 h-100">
                <h3 class="h5 fw-semibold">Built for Students</h3>
                <p class="text-muted">Discover accommodations curated for student needs with budgets tailored around college life.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card p-4 h-100">
                <h3 class="h5 fw-semibold">Safe & Verified</h3>
                <p class="text-muted">Listings are posted by senior students with owner verification badges for peace of mind.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card p-4 h-100">
                <h3 class="h5 fw-semibold">Smart Recommendations</h3>
                <p class="text-muted">Powerful filters and real-time search make finding the perfect stay quick and stress-free.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="row g-4 align-items-center">
        <div class="col-lg-6">
            <h2 class="section-title fw-semibold mb-4">How NearBy Supports Juniors & Seniors</h2>
            <ul class="list-unstyled d-grid gap-3">
                <li class="glass-card p-3">
                    <div class="d-flex align-items-center gap-3">
                        <span class="facility-icon"><i class="bi bi-search"></i></span>
                        <div>
                            <p class="fw-semibold mb-1">Explore instantly</p>
                            <p class="small text-muted mb-0">Search rooms by location, budget, type, and facilities with live updates.</p>
                        </div>
                    </div>
                </li>
                <li class="glass-card p-3">
                    <div class="d-flex align-items-center gap-3">
                        <span class="facility-icon"><i class="bi bi-chat-dots"></i></span>
                        <div>
                            <p class="fw-semibold mb-1">Connect securely</p>
                            <p class="small text-muted mb-0">AJAX-powered contact requests keep your conversation private and fast.</p>
                        </div>
                    </div>
                </li>
                <li class="glass-card p-3">
                    <div class="d-flex align-items-center gap-3">
                        <span class="facility-icon"><i class="bi bi-clipboard-plus"></i></span>
                        <div>
                            <p class="fw-semibold mb-1">Host with ease</p>
                            <p class="small text-muted mb-0">Senior students can post rooms with all essentials and get junior leads quickly.</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-lg-6">
            <div class="glass-card p-4">
                <h3 class="h5 fw-semibold mb-3">Ready to experience NearBy?</h3>
                <p class="text-muted">Create an account to explore verified accommodations, get local recommendations, and settle into your second home.</p>
                <div class="d-flex flex-column flex-sm-row gap-3">
                    <a class="btn btn-primary flex-fill" href="register.php">Create account</a>
                    <a class="btn btn-outline-light flex-fill" href="login.php">I already have one</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>