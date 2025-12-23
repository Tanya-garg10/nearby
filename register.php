<?php
$pageTitle = 'Register | NearBy';
$pageScripts = ['assets/js/auth.js'];
require_once __DIR__ . '/includes/header.php';
?>
<div class="row justify-content-center" data-app-alerts>
    <div class="col-lg-7">
        <div class="glass-card p-4 p-md-5">
            <h1 class="h3 fw-semibold mb-4 text-center">Create Your NearBy Account</h1>
            <form id="registerForm" novalidate>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="regName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="regName" name="name" required>
                        <div class="invalid-feedback">Please enter your name</div>
                    </div>
                    <div class="col-md-6">
                        <label for="regEmail" class="form-label">College Email</label>
                        <input type="email" class="form-control" id="regEmail" name="email" placeholder="you@college.edu" required>
                        <div class="invalid-feedback">Please use your college email (.edu)</div>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label for="regPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="regPassword" name="password" required minlength="6">
                        <div class="invalid-feedback">Password must be at least 6 characters</div>
                    </div>
                    <div class="col-md-6">
                        <label for="regRole" class="form-label">I am a</label>
                        <select id="regRole" class="form-select" name="role" required>
                            <option value="">Choose role</option>
                            <option value="junior">Junior Student</option>
                            <option value="senior">Senior Student</option>
                        </select>
                        <div class="invalid-feedback">Please select your role</div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-4">Create Account</button>
            </form>
            <p class="small text-muted text-center mt-4 mb-0">Already a member? <a href="login.php">Login instead</a></p>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
