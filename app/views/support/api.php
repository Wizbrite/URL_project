<?php require_once '../app/views/layout/header.php'; ?>

<div class="card" style="max-width: 800px; margin: 2rem auto; padding: 2.5rem;">
    <h1 style="color: var(--primary-color); margin-bottom: 1.5rem;">Developer API</h1>
    
    <div style="line-height: 1.8; opacity: 0.9;">
        <p>Integrate URLShortener directly into your applications using our simple REST API.</p>
        
        <div style="background: var(--bg-color); padding: 1rem; border-radius: 0.5rem; border: 1px solid var(--border-color); margin: 1.5rem 0; font-family: monospace;">
            <p style="color: var(--primary-color); font-weight: bold;">POST /api/shorten</p>
            <p>Content-Type: application/json</p>
            <p>Body: { "long_url": "https://example.com" }</p>
        </div>
        
        <h3 style="margin: 1.5rem 0 0.5rem;">Coming Soon</h3>
        <p>We are currently working on finalizing our public API. Stay tuned for official documentation and API key management in your dashboard.</p>
        
        <div class="card" style="margin-top: 2rem; border-left: 4px solid var(--primary-color); padding: 1rem;">
            <p><strong>Note:</strong> API access will be free for all registered users during the beta period.</p>
        </div>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>
