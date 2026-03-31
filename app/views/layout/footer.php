    </div> <!-- End of .container -->

    <footer class="footer">
        <div class="container footer-content">
            <div class="footer-section">
                <h3>URLShortener</h3>
                <p>Making your links shorter, trackable, and easier to share. Fast, secure, and reliable.</p>
                <div class="social-links">
                    <a href="#" title="X (Twitter)"><span class="material-symbols-outlined">public</span></a>
                    <a href="#" title="GitHub"><span class="material-symbols-outlined">terminal</span></a>
                    <a href="#" title="LinkedIn"><span class="material-symbols-outlined">account_circle</span></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                    <li><a href="<?= base_url('history') ?>">History</a></li>
                    <li><a href="<?= base_url('profile') ?>">Profile</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Support</h4>
                <ul>
                    <li><a href="<?= base_url('privacy') ?>">Privacy Policy</a></li>
                    <li><a href="<?= base_url('terms') ?>">Terms of Service</a></li>
                    <li><a href="<?= base_url('api') ?>">Developer API</a></li>
                    <li><a href="<?= base_url('contact') ?>">Contact Us</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; <?= date('Y') ?> URLShortener by NJINI FAVOUR BEMSIMBOM. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const body = document.body;

        // Check for saved theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        body.setAttribute('data-theme', savedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = body.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            body.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
    </script>
</body>
</html>
