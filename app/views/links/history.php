<?php require_once '../app/views/layout/header.php'; ?>

<div style="max-width: 1000px; margin: 2rem auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="color: var(--primary-color);">My Shortened Links</h2>
        <a href="/URL_project/public/dashboard" class="btn btn-primary">+ New Link</a>
    </div>

    <div class="card" style="padding: 0; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background: var(--border-color); font-size: 0.875rem;">
                <tr>
                    <th style="padding: 1rem;">Original URL</th>
                    <th style="padding: 1rem;">Short URL</th>
                    <th style="padding: 1rem;">Clicks</th>
                    <th style="padding: 1rem;">Date</th>
                    <th style="padding: 1rem;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($links)): ?>
                    <tr>
                        <td colspan="5" style="padding: 2rem; text-align: center; opacity: 0.6;">No links found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($links as $link): ?>
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td style="padding: 1rem;">
                                <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    <a href="<?= $link['long_url'] ?>" target="_blank" style="color: var(--text-color); text-decoration: none;"><?= $link['long_url'] ?></a>
                                </div>
                            </td>
                            <td style="padding: 1rem;">
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <span style="color: var(--primary-color); font-weight: 600;">/<?= $link['short_slug'] ?></span>
                                    <button onclick="copyToClipboard('<?= $_SERVER['HTTP_HOST'] ?>/URL_project/public/<?= $link['short_slug'] ?>')" class="btn" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; background: var(--border-color);">Copy</button>
                                </div>
                            </td>
                            <td style="padding: 1rem;">
                                <a href="/URL_project/public/analytics/<?= $link['id'] ?>" style="text-decoration: none; color: var(--primary-color); font-weight: 600;"><?= $link['clicks'] ?></a>
                            </td>
                            <td style="padding: 1rem; font-size: 0.875rem; opacity: 0.7;">
                                <?= date('Y-m-d', strtotime($link['created_at'])) ?>
                            </td>
                            <td style="padding: 1rem;">
                                <form action="/URL_project/public/links/delete/<?= $link['id'] ?>" method="POST" onsubmit="return confirm('Are you sure?')">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                                    <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.875rem;">Delete</button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
        <div style="display: flex; justify-content: center; gap: 0.5rem; margin-top: 2rem;">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="btn <?= $i === $currentPage ? 'btn-primary' : '' ?>" style="border: 1px solid var(--border-color);"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Link copied to clipboard!');
    });
}
</script>

<?php require_once '../app/views/layout/footer.php'; ?>
