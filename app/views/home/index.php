<?php require_once '../app/views/layout/header.php'; ?>

<div style="text-align: center; padding: 4rem 1rem;">
    <h1 style="font-size: 3rem; margin-bottom: 1rem; color: var(--text-color);">Shorten Your <span style="color: var(--primary-color);">Long Links</span></h1>
    <p style="font-size: 1.25rem; color: var(--text-color); opacity: 0.8; margin-bottom: 2.5rem; max-width: 600px; margin-left: auto; margin-right: auto;">
        Create concise, easy-to-share URLs and track their performance in real-time with our secure and robust platform.
    </p>
    
    <div style="display: flex; gap: 1rem; justify-content: center;">
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="/URL_project/public/register" class="btn btn-primary" style="padding: 1rem 2rem; font-size: 1.125rem;">Get Started for Free</a>
            <a href="/URL_project/public/login" class="btn" style="padding: 1rem 2rem; font-size: 1.125rem; border: 1px solid var(--border-color); color: var(--text-color);">Sign In</a>
        <?php else: ?>
            <a href="/URL_project/public/dashboard" class="btn btn-primary" style="padding: 1rem 2rem; font-size: 1.125rem;">Go to Dashboard</a>
        <?php endif; ?>
    </div>
    
    <div style="margin-top: 5rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; text-align: left;">
        <div class="card">
            <div style="margin-bottom: 1rem;"><span class="material-symbols-outlined" style="font-size: 2.5rem; color: var(--primary-color);">bolt</span></div>
            <h3 style="margin-bottom: 0.5rem;">Lightning Fast</h3>
            <p style="opacity: 0.8;">Redirect your users instantly to their destination with our optimized architecture.</p>
        </div>
        <div class="card">
            <div style="margin-bottom: 1rem;"><span class="material-symbols-outlined" style="font-size: 2.5rem; color: var(--primary-color);">bar_chart</span></div>
            <h3 style="margin-bottom: 0.5rem;">Detailed Analytics</h3>
            <p style="opacity: 0.8;">Track clicks, location, and device information for every link you create.</p>
        </div>
        <div class="card">
            <div style="margin-bottom: 1rem;"><span class="material-symbols-outlined" style="font-size: 2.5rem; color: var(--primary-color);">shield</span></div>
            <h3 style="margin-bottom: 0.5rem;">Secure & Reliable</h3>
            <p style="opacity: 0.8;">Your links are protected with CSRF, XSS prevention, and secure password hashing.</p>
        </div>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>
