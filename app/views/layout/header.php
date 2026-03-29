<!DOCTYPE html>
<html lang="en">
<head>
    <?php if (class_exists('Core\Controller')) { (new class extends \Core\Controller { public function gen() { return $this->generateCsrfToken(); } })->gen(); } ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'URL Shortener' ?></title>
    <link rel="stylesheet" href="/URL_project/public/assets/css/style.css?v=1.1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body data-theme="light">
    <nav class="card" style="margin: 1rem; display: flex; justify-content: space-between; align-items: center; border-radius: 0.5rem; padding: 1rem 2rem;">
        <a href="/URL_project/public/" style="text-decoration: none; font-weight: 700; color: var(--primary-color); font-size: 1.25rem;">URLShortener</a>
        <div style="display: flex; gap: 1rem; align-items: center;">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="" href="/URL_project/public/dashboard" style="text-decoration: none; color: var(--text-color);">Dashboard</a>
                <a class="" href="/URL_project/public/history" style="text-decoration: none; color: var(--text-color);">History</a>
                <a class="" href="/URL_project/public/profile" style="text-decoration: none; color: var(--text-color);">Profile</a>
                <a class="" href="/URL_project/public/logout" class="btn btn-primary">Logout</a>
            <?php else: ?>
                <a class="btn btn-primary" href="/URL_project/public/login" style="text-decoration: none; color: var(--text-color);">Login</a>
                <a href="/URL_project/public/register" class="btn btn-primary">Register</a>
            <?php endif; ?>
            <button id="theme-toggle" class="btn" style="background: none; color: var(--text-color); border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: center; padding: 0.5rem;">
                <span class="material-symbols-outlined" style="font-size: 1.25rem;">dark_mode</span>
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
