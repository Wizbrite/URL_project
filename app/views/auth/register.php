<?php require_once __DIR__ . '/../../layout/header.php'; ?>

<div style="display: flex; justify-content: center; align-items: center; min-height: 70vh;">
    <div class="card" style="width: 100%; max-width: 400px;">
        <h2 style="margin-bottom: 1.5rem; text-align: center; color: var(--primary-color);">Create Account</h2>
        <form action="<?= base_url('register') ?>" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required placeholder="Choose a username">
            </div>
            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Create a password">
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required placeholder="Repeat your password">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.75rem; margin-top: 1rem;">Register</button>
        </form>
        <p style="margin-top: 1.5rem; text-align: center; font-size: 0.875rem;">
            Already have an account? <a href="<?= base_url('login') ?>" style="color: var(--primary-color); text-decoration: none; font-weight: 600;">Login here</a>
        </p>
    </div>
</div>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>
