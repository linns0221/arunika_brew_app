<?php
// Handle form submission
$submitted = false;
$name = '';
$email = '';
$message = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Validation
    if (empty($name)) {
        $errors['name'] = 'Name is required';
    }
    
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address';
    }
    
    if (empty($message)) {
        $errors['message'] = 'Message is required';
    }
    
    if (empty($errors)) {
        // Process the form (save to database, send email, etc.)
        // For now, just mark as submitted
        $submitted = true;
        
        // Clear form data after successful submission
        $name = '';
        $email = '';
        $message = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arunika Brew - Thank You</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --background: #ffffff;
            --foreground: #C47A3D;
            --card: #ffffff;
            --card-foreground: #C47A3D;
            --primary: #3B2A20;
            --primary-foreground: #ffffff;
            --secondary: #ffffff;
            --secondary-foreground: #C47A3D;
            --muted: #ffffff;
            --muted-foreground: #C47A3D;
            --accent: #C47A3D;
            --accent-foreground: #ffffff;
            --border: #C47A3D;
            --input: #ffffff;
            --ring: #C47A3D;
            --radius: 0.5rem;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--background);
            color: var(--foreground);
            line-height: 1.6;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header */
        header {
            border-bottom: 1px solid var(--border);
            background-color: var(--card);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: var(--foreground);
        }

        .logo-icon {
            width: 2rem;
            height: 2rem;
            color: var(--accent);
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
        }

        nav {
            display: flex;
            gap: 2rem;
        }

        nav a {
            color: var(--muted-foreground);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.2s;
        }

        nav a:hover {
            color: var(--foreground);
        }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 4rem 1rem;
            background: linear-gradient(to bottom, var(--card), var(--background));
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--foreground);
        }

        .hero p {
            color: var(--muted-foreground);
            font-size: 1.125rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Form Section */
        .form-section {
            padding: 2rem 1rem 4rem;
        }

        .form-card {
            max-width: 500px;
            margin: 0 auto;
            background-color: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .form-header {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid var(--border);
        }

        .form-icon {
            width: 3rem;
            height: 3rem;
            margin: 0 auto 1rem;
            color: var(--accent);
        }

        .form-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: var(--muted-foreground);
            font-size: 0.875rem;
        }

        .form-body {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--foreground);
        }

        input, textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            background-color: var(--input);
            color: var(--foreground);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: var(--ring);
            box-shadow: 0 0 0 2px rgba(139, 90, 60, 0.2);
        }

        input::placeholder, textarea::placeholder {
            color: var(--muted-foreground);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .error-message {
            color: #b91c1c;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .input-error {
            border-color: #b91c1c;
        }

        button {
            width: 100%;
            padding: 0.75rem 1.5rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--primary-foreground);
            background-color: var(--primary);
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: var(--accent);
        }

        /* Success State */
        .success-message {
            text-align: center;
            padding: 2rem;
        }

        .success-icon {
            width: 4rem;
            height: 4rem;
            margin: 0 auto 1rem;
            color: #16a34a;
        }

        .success-message h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .success-message p {
            color: var(--muted-foreground);
            margin-bottom: 1.5rem;
        }

        .back-link {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* Footer */
        footer {
            background-color: var(--primary);
            color: var(--primary-foreground);
            padding: 3rem 1rem;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 2rem;
        }

        .footer-section h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .footer-section p {
            font-size: 0.875rem;
            opacity: 0.8;
            margin-bottom: 0.5rem;
        }

        .footer-bottom {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
            font-size: 0.875rem;
            opacity: 0.7;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            nav {
                display: none;
            }

            .footer-content {
                flex-direction: column;
            }
        }
    </style>

    <main>
        <section class="hero">
            <div class="container">
                <h1>Thank You For Your Order!</h1>
                <p>We would love to hear from you. Your feedback helps us brew better experiences for everyone.</p>
            </div>
        </section>

        <section class="form-section">
            <div class="form-card">
                <?php if ($submitted): ?>
                    <div class="success-message">
                        <svg class="success-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <h3>Thank You!</h3>
                        <p>Your message has been received. We truly appreciate you taking the time to share your thoughts with us.</p>
                        <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="back-link">Send another message</a>
                    </div>
                <?php else: ?>
                    <div class="form-header">
                        <svg class="form-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                        </svg>
                        <h2>Leave a Thank You Note</h2>
                        <p>Share your appreciation with our team</p>
                    </div>
                    <div class="form-body">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <div class="form-group">
                                <label for="name">Your Name</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    placeholder="Enter your name"
                                    value="<?php echo htmlspecialchars($name); ?>"
                                    class="<?php echo isset($errors['name']) ? 'input-error' : ''; ?>"
                                >
                                <?php if (isset($errors['name'])): ?>
                                    <p class="error-message"><?php echo htmlspecialchars($errors['name']); ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    placeholder="Enter your email"
                                    value="<?php echo htmlspecialchars($email); ?>"
                                    class="<?php echo isset($errors['email']) ? 'input-error' : ''; ?>"
                                >
                                <?php if (isset($errors['email'])): ?>
                                    <p class="error-message"><?php echo htmlspecialchars($errors['email']); ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="message">Your Message</label>
                                <textarea 
                                    id="message" 
                                    name="message" 
                                    placeholder="Share your experience or leave a thank you note..."
                                    class="<?php echo isset($errors['message']) ? 'input-error' : ''; ?>"
                                ><?php echo htmlspecialchars($message); ?></textarea>
                                <?php if (isset($errors['message'])): ?>
                                    <p class="error-message"><?php echo htmlspecialchars($errors['message']); ?></p>
                                <?php endif; ?>
                            </div>

                            <button type="submit">Send Thank You</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Visit Us</h3>
                    <p>Jl. Dipati Ukur No. 112-116</p>
                    <p>Coblong</p>
                </div>
                <div class="footer-section">
                    <h3>Hours</h3>
                    <p>Mon - Fri: 7am - 7pm</p>
                    <p>Sat - Sun: 8am - 6pm</p>
                </div>
                <div class="footer-section">
                    <h3>Contact</h3>
                    <p>hello.arunikabrew@gmail.com</p>
                    <p>(555) 123-4567</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> Arunika Brew All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
