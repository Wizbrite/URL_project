<?php require_once '../app/views/layout/header.php'; ?>

<div style="max-width: 800px; margin: 2rem auto;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
        <div class="card" style="text-align: center;">
            <p style="font-size: 0.875rem; opacity: 0.7;">Account Since</p>
            <h3 style="color: var(--primary-color);"><?= date('M Y', strtotime($user['created_at'])) ?></h3>
        </div>
        <div class="card" style="text-align: center;">
            <p style="font-size: 0.875rem; opacity: 0.7;">Total Performance</p>
            <h3 style="color: var(--primary-color);"><?= $totalClicks ?> Clicks</h3>
        </div>
    </div>

    <div class="card">
        <h2 style="margin-bottom: 2rem; color: var(--primary-color);">Profile Settings</h2>
        
        <?php if (isset($_GET['error'])): ?>
            <div style="padding: 1rem; background: #fee2e2; border-left: 4px solid #ef4444; margin-bottom: 1.5rem; color: #ef4444; border-radius: 0.25rem;">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <div style="padding: 1rem; background: #f0fdf4; border-left: 4px solid #22c55e; margin-bottom: 1.5rem; color: #166534; border-radius: 0.25rem;">
                <?= htmlspecialchars($_GET['success']) ?>
            </div>
        <?php endif; ?>

        <form action="/URL_project/public/profile/update" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
            </div>
            <div class="input-group">
                <label for="email">Email Address (Cannot be changed)</label>
                <input type="email" value="<?= htmlspecialchars($user['email']) ?>" disabled style="opacity: 0.6; cursor: not-allowed;">
            </div>
            
            <hr style="margin: 2rem 0; border: none; border-top: 1px solid var(--border-color);">
            
            <h3 style="margin-bottom: 1.5rem; font-size: 1rem;">Change Password (optional)</h3>
            <div class="input-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" placeholder="Leave blank to keep current">
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat new password">
            </div>
            
            <button type="submit" class="btn btn-primary" style="padding: 0.75rem 2rem; margin-top: 1rem;">Save Changes</button>
        </form>
    </div>
    
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>
