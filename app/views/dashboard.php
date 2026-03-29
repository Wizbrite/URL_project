<?php require_once '../app/views/layout/header.php'; ?>

<div style="max-width: 800px; margin: 2rem auto;">
    <div class="card" style="margin-bottom: 2rem;">
        <h2 style="margin-bottom: 1.5rem; color: var(--primary-color);">Create New Short Link</h2>
        <form action="/URL_project/public/links/create" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

            <div class="input-group">
                <label for="long_url">Destination URL</label>
                <input type="url" id="long_url" name="long_url" required placeholder="https://example.com/very-long-url-to-shorten">
            </div>
            <div class="input-group">
                <label for="custom_alias">Custom Alias (Optional)</label>
                <div style="display: flex; align-items: center;">
                    <span style="padding: 0.625rem; background: var(--border-color); border: 1px solid var(--border-color); border-right: none; border-radius: 0.5rem 0 0 0.5rem; font-size: 0.875rem;">URLShortener/</span>
                    <input type="text" id="custom_alias" name="custom_alias" placeholder="my-custom-link" style="border-radius: 0 0.5rem 0.5rem 0;">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="padding: 0.75rem 1.5rem; margin-top: 1rem;">Shorten URL</button>
        </form>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
        <div class="card" style="text-align: center;">
            <p style="font-size: 0.875rem; opacity: 0.7;">Total Links</p>
            <h3 style="font-size: 2rem; color: var(--primary-color);">0</h3>
        </div>
        <div class="card" style="text-align: center;">
            <p style="font-size: 0.875rem; opacity: 0.7;">Total Clicks</p>
            <h3 style="font-size: 2rem; color: var(--primary-color);">0</h3>
        </div>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>
