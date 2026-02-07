 <style>
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
<footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3 style="color: #ffffff;">Visit Us</h3>
                    <p style="color: #ffffff;">Jl. Dipati Ukur No. 112-116</p>
                    <p style="color: #ffffff;">Coblong</p>
                </div>
                <div class="footer-section">
                    <h3 style="color: #ffffff;">Hours</h3>
                    <p style="color: #ffffff;">Mon - Fri: 7am - 7pm</p>
                    <p style="color: #ffffff;">Sat - Sun: 8am - 6pm</p>
                </div>
                <div class="footer-section">
                    <h3 style="color: #ffffff;">Contact</h3>
                    <p style="color: #ffffff;">hello.arunikabrew@gmail.com</p>
                    <p style="color: #ffffff;">(555) 123-4567</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p style="color: #ffffff;">&copy; <?php echo date('Y'); ?> Arunika Brew All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('template/lib/easing/easing.min.js') ?>"></script>
    <script src="<?= base_url('template/lib/owlcarousel/owl.carousel.min.js') ?>"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('template/js/main.js') ?>"></script>
</body>