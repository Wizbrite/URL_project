<?php require_once '../app/views/layout/header.php'; ?>

<div style="max-width: 1000px; margin: 2rem auto;">
    <div style="margin-bottom: 2rem;">
        <h2 style="color: var(--primary-color);">Analytics: /<?= $link['short_slug'] ?></h2>
        <p style="opacity: 0.7;"><?= $link['long_url'] ?></p>
    </div>

    <!-- Trend Chart (Mock Visualization) -->
    <div class="card" style="margin-bottom: 2rem;">
        <h3 style="margin-bottom: 1.5rem;">Click Trends (Last 7 Days)</h3>
        <div style="display: flex; align-items: flex-end; gap: 1rem; height: 200px; padding-bottom: 2rem; border-bottom: 2px solid var(--border-color);">
            <?php 
            $maxCount = 0;
            foreach ($stats as $s) if ($s['count'] > $maxCount) $maxCount = $s['count'];
            $maxCount = $maxCount ?: 1;
            
            foreach ($stats as $s): 
                $height = ($s['count'] / $maxCount) * 100;
            ?>
                <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 0.5rem;">
                    <div style="width: 100%; background: var(--primary-color); height: <?= $height ?>%; border-radius: 0.25rem 0.25rem 0 0; min-height: 2px;"></div>
                    <span style="font-size: 0.75rem; writing-mode: vertical-rl;"><?= $s['date'] ?></span>
                    <span style="font-size: 0.75rem; font-weight: 700;"><?= $s['count'] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="card" style="padding: 0; overflow: hidden;">
        <h3 style="padding: 1.5rem; border-bottom: 1px solid var(--border-color);">Recent Clicks</h3>
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background: var(--border-color); font-size: 0.875rem;">
                <tr>
                    <th style="padding: 1rem;">IP Address</th>
                    <th style="padding: 1rem;">Device / Browser</th>
                    <th style="padding: 1rem;">Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($clicks)): ?>
                    <tr>
                        <td colspan="3" style="padding: 2rem; text-align: center; opacity: 0.6;">No clicks yet.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($clicks as $click): ?>
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td style="padding: 1rem; font-family: monospace;"><?= $click['ip_address'] ?></td>
                            <td style="padding: 1rem; font-size: 0.875rem;">
                                <div style="max-width: 400px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    <?= $click['user_agent'] ?>
                                </div>
                            </td>
                            <td style="padding: 1rem; font-size: 0.875rem; opacity: 0.7;">
                                <?= $click['clicked_at'] ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>
