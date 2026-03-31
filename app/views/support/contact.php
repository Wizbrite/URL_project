<?php require_once __DIR__ . '/../../layout/header.php'; ?>

<div class="card" style="max-width: 600px; margin: 2rem auto; padding: 2.5rem;">
    <h1 style="color: var(--primary-color); margin-bottom: 1.5rem;">Contact Us</h1>
    <p style="margin-bottom: 2rem; opacity: 0.8;">Have questions or feedback? We'd love to hear from you. Fill out the form below and we'll get back to you as soon as possible.</p>
    
    <form onsubmit="event.preventDefault(); alert('Message sent! (Simulation)');">
        <div class="input-group">
            <label>Name</label>
            <input type="text" placeholder="Your Name" required>
        </div>
        <div class="input-group">
            <label>Email Address</label>
            <input type="email" placeholder="email@example.com" required>
        </div>
        <div class="input-group">
            <label>Subject</label>
            <input type="text" placeholder="How can we help?" required>
        </div>
        <div class="input-group">
            <label>Message</label>
            <textarea style="width: 100%; padding: 0.625rem; border-radius: 0.5rem; border: 1px solid var(--border-color); background-color: var(--input-bg); color: var(--text-color); min-height: 120px;" placeholder="Tell us more..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Send Message</button>
    </form>
    
    <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--border-color); text-align: center; font-size: 0.875rem; opacity: 0.7;">
        <p>Email: support@urlshortener.test</p>
        <p>Location: Buea, Cameroon</p>
    </div>
</div>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>
