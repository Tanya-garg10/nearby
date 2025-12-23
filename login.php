<?php
$pageTitle = 'Login | NearBy';
$pageScripts = ['assets/js/auth.js'];
require_once __DIR__ . '/includes/header.php';
?>
<div class="row justify-content-center" data-app-alerts>
    <div class="col-lg-6">
        <div class="glass-card p-4 p-md-5">
            <h1 class="h3 fw-semibold mb-4 text-center">Welcome Back</h1>
            <form id="loginForm" novalidate>
                <div class="mb-3">
                    <label for="loginEmail" class="form-label">College Email</label>
                    <input type="email" class="form-control" id="loginEmail" name="email" placeholder="you@college.edu" required>
                    <div class="invalid-feedback">Use your verified college email</div>
                </div>
                <div class="mb-3">
                    <label for="loginPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="loginPassword" name="password" required minlength="6">
                    <div class="invalid-feedback">Password must be at least 6 characters</div>
                </div>
                <div class="mb-4">
                    <label for="loginRole" class="form-label">I am a</label>
                    <select id="loginRole" class="form-select" name="role" required>
                        <option value="">Choose role</option>
                        <option value="junior">Junior Student</option>
                        <option value="senior">Senior Student</option>
                    </select>
                    <div class="invalid-feedback">Please select your role</div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <p class="small text-muted text-center mt-4 mb-0">New here? <a href="register.php">Create an account</a></p>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
