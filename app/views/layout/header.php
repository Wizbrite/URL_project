<!DOCTYPE html>
<html lang="en">
<head>
    <?php if (class_exists('Core\Controller')) { (new class extends \Core\Controller { public function gen() { return $this->generateCsrfToken(); } })->gen(); } ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'URL Shortener' ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>?v=1.1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body data-theme="light">
    <?php 
        $currentUri = $_SERVER['REQUEST_URI'];
        function isActive($path, $current) {
            return strpos($current, $path) !== false ? 'active' : '';
        }
    ?>
    <nav class="card nav-container">
        <a href="<?= base_url() ?>" class="nav-logo">URLShortener</a>
        <div class="nav-links">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="nav-link <?= isActive('/dashboard', $currentUri) ?>" href="<?= base_url('dashboard') ?>">Dashboard</a>
                <a class="nav-link <?= isActive('/history', $currentUri) ?>" href="<?= base_url('history') ?>">History</a>
                <a class="nav-link <?= isActive('/profile', $currentUri) ?>" href="<?= base_url('profile') ?>">Profile</a>
                <a class="btn btn-primary" href="<?= base_url('logout') ?>">Logout</a>
            <?php else: ?>
                <a class="nav-link <?= isActive('/login', $currentUri) ?>" href="<?= base_url('login') ?>">Login</a>
                <a href="<?= base_url('register') ?>" class="btn btn-primary">Register</a>
            <?php endif; ?>
            <button id="theme-toggle" class="btn theme-btn">
                <span class="material-symbols-outlined">dark_mode</span>
            </button>
        </div>
    </nav>

    <div class="container">
        <?php if (isset($error)): ?>
            <div class="card" style="border-left: 4px solid #ef4444; margin-bottom: 1rem; padding: 1rem;">
                <p style="color: #ef4444;"><?= $error ?></p>
            </div>
        <?php endif; ?>
        
        <?php if (isset($success)): ?>
            <div class="card" style="border-left: 4px solid #22c55e; margin-bottom: 1rem; padding: 1rem;">
                <p style="color: #22c55e;"><?= $success ?></p>
            </div>
        <?php endif; ?>
