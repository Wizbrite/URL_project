<?php require_once __DIR__ . '/../../layout/header.php'; ?>

<div style="display: flex; justify-content: center; align-items: center; min-height: 70vh;">
    <div class="card" style="width: 100%; max-width: 400px;">
        <h2 style="margin-bottom: 1.5rem; text-align: center; color: var(--primary-color);">Welcome Back</h2>
        <form action="<?= base_url('login') ?>" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.75rem; margin-top: 1rem;">Login</button>
        </form>
        <p style="margin-top: 1.5rem; text-align: center; font-size: 0.875rem;">
            Don't have an account? <a href="<?= base_url('register') ?>" style="color: var(--primary-color); text-decoration: none; font-weight: 600;">Register here</a>
        </p>
    </div>
</div>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>
