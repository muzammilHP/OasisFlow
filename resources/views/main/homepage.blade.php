<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>OasisFlow - Home</title>
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    <!-- <link rel="stylesheet" href="style.css"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="container">
        <header>
            <div class="nav-above">
                <span><a href="https://wa.me/971566660755" target="_blank" class="whatsapp-link" style="color:inherit;text-decoration:none;">+971566660755</a></span>
                <div class="nav-above-email">
                    <img width="20px" src="{{ asset('images/email-icon.webp') }}" alt="Email Icon" class="email-icon">
                    <span><a href="mailto:care@oasisflow.ae" class="email-link" style="color:inherit;text-decoration:none;">care@oasisflow.ae</a></span>
                </div>
            </div>
            <nav>
                <div class="logo">
                    <img width="80px" src="{{ asset('images/logo.webp') }}" alt="OasisFlow Logo" class="logo-image">
                </div>
                <div class="hamburger" id="hamburger-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul id="nav-list">
                    <li class="nav-item"><a href="#" onclick="event.preventDefault();scrollToSection('.hero-section');">Home</a></li>
                    <li class="nav-item"><a href="#" onclick="event.preventDefault();scrollToSection('.products-section');">Products</a></li>
                    <li class="nav-item"><a href="#" onclick="event.preventDefault();scrollToSection('.services-section');">Services</a></li>
                    <li class="nav-item"><a href="#" onclick="event.preventDefault();scrollToSection('.aboutus-section');">About Us</a></li>
                    <li class="nav-item"><a href="#" onclick="event.preventDefault();scrollToSection('.contact-section');">Contact Us</a></li>
                </ul>
                <div class="nav-buttons">
                    <a href="https://wa.me/971566660755" target="_blank"><button class="login">Order Now</button></a>
                    <!-- <button onclick="toggleLoginDropdown()" class="login">Login</button> -->
                     <div class="login-dropdown-wrapper" id="loginWrapper">
                        <button onclick="toggleLoginDropdown()" class="login">Login</button>

                            <!-- Login Dropdown -->
                        <div id="loginDropdown" class="login-dropdown hidden">
                            <!-- <a href="{{route('customer.login')}}">Login as Customer</a> -->
                            <a href="{{route('driver.login')}}">Login as Driver</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <section class="hero-section">
                <div class="hero-slider">
                    <div class="hero-slide active">
                        <div class="hero-content slide1-background">
                            <div class="hero-left">
                                <h1>Pure Water Delivered To <span>Your Doorstep</span></h1>
                                <p>Experience the convenience of premium water delivery service with OasisFlow. Stay
                                    hydrated with our pure, refreshing water.</p>
                                <div class="hero-buttons">
                                    <a href="https://wa.me/971566660755" target="_blank"><button class="hero-button">Contact on Whatsapp</button></a>
                                </div>
                            </div>
                            <div class="hero-right">
                                <div class="hero-bottles-bg">
                                    <img src="{{ asset('images/hero-bottles.webp') }}" alt="Hero Bottles" class="hero-bottles-image">
                                </div>
                            </div>
                        </div>
                        <!-- SVG Curve only for first slide -->
                        <div class="absolute bottom-[-40px] left-0 w-full overflow-hidden leading-[0]">
                            <svg viewBox="0 0 500 150" preserveAspectRatio="none" class="w-full h-[100px]">
                                <path
                                    d="M0.00,49.98 C150.00,150.00 349.20,-50.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"
                                    style="stroke: none; fill: #ffffff"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="hero-slide">
                        <div class="hero-content slide2-background">
                                <img src="{{ asset('images/coupon1-hero.webp') }}" alt="Hero Slide 1" class="hero-slide-image">
                        </div>
                    </div>
                    <div class="hero-slide">
                        <div class="hero-content slide2-background">
                                <img src="{{ asset('images/coupon2-hero.webp') }}" alt="Hero Slide 2" class="hero-slide-image">
                        </div>
                    </div>
                    <div class="hero-slide">
                        <div class="hero-content slide2-background">
                                <img src="{{ asset('images/coupon3-hero.webp') }}" alt="Hero Slide 3" class="hero-slide-image">
                        </div>
                    </div>
                    <div class="hero-slide">
                        <div class="hero-content slide2-background">
                                <img src="{{ asset('images/coupon4-hero.webp') }}" alt="Hero Slide 4" class="hero-slide-image">
                        </div>
                    </div>
                    <div class="hero-slide">
                        <div class="hero-content slide2-background">
                                <img src="{{ asset('images/coupon1.webp') }}" alt="Hero Slide 5" class="hero-slide-image">
                        </div>
                    </div>
                    <div class="hero-slide">
                        <div class="hero-content slide3-background">
                                <img src="{{ asset('images/coupon6.webp') }}" alt="Hero Slide 6" class="hero-slide-image">
                        </div>
                    </div>
                    <!-- Slider Controls -->
                    <button class="hero-slider-btn hero-slider-btn-left">&#10094;</button>
                    <button class="hero-slider-btn hero-slider-btn-right">&#10095;</button>
                    <!-- Slide Indicators -->
                    <div class="hero-slider-indicators">
                        <span class="hero-indicator active"></span>
                        <span class="hero-indicator"></span>
                        <span class="hero-indicator"></span>
                    </div>
                </div>
            </section>

            <div class="line"></div>
            <section class="why-choose">
                <h1>Why Choose OasisFlow?</h1>
                <p>We provide premium water delivery services that prioritize purity, convenience and customer
                    satisfaction.</p>
                <p>Pure and Fresh Till the Last Drop!!</p>
                <div class="why-choose-bottom">
                    <div class="left">
                        <img src="{{ asset('images/why-choose-img1.webp') }}" alt="Why Choose 1">
                        <img src="{{ asset('images/aboutoasis.webp') }}" alt="Why Choose 2">
                        <img src="{{ asset('images/why-choose-img2.webp') }}" alt="Why Choose 3">
                    </div>
                    <div class="right">
                        <div class="qualities">
                            <div class="quality">
                                <img width="40px" src="{{ asset('images/pure-water.webp') }}" alt="Pure Water">
                                <div class="quality-text">
                                    <h3>Pure & Safe Water</h3>
                                    <p>Oasis Flow Water is processed in an environment where hygiene and safety is strictly monitored</p>
                                </div>
                            </div>

                            <div class="quality">
                                <img width="40px" src="{{ asset('images/certified.webp') }}" alt="Certified">
                                <div class="quality-text">
                                    <h3>Certified</h3>
                                    <p>OasisFlow Marina Co. LLC is a HACCP & ESMA certified company.</p>
                                </div>
                            </div>

                            <div class="quality">
                                <img width="40px" src="{{ asset('images/premium-quality.webp') }}" alt="Premium Quality">
                                <div class="quality-text">
                                    <h3>Premium Quality Assurance</h3>
                                    <p>We maintain high quality standards from bottling to delivery, guaranteeing every
                                        drop is pure and fresh </p>
                                </div>
                            </div>

                            <div class="quality">
                                <img width="40px" src="{{ asset('images/fast-delivery.webp') }}" alt="Fast Delivery">
                                <div class="quality-text">
                                    <h3>Fast & Reliable Delivery</h3>
                                    <p>Get your water delivered within 24 hours. We prioritize speed without compromising on service quality.</p>
                                </div>
                            </div>

                            <div class="quality">
                                <img width="40px" src="{{ asset('images/flexibal-scheduling.webp') }}"
                                    alt="Flexible Scheduling">
                                <div class="quality-text">
                                    <h3>Flexible Scheduling</h3>
                                    <p>Choose delivery times that suit your routine. We adapt to your schedule for
                                        maximum convenience.</p>
                                </div>
                            </div>

                            <div class="quality">
                                <img width="40px" src="{{ asset('images/customer-satisfaction.webp') }}"
                                    alt="Customer Satisfaction">
                                <div class="quality-text">
                                    <h3>Customer Satisfaction</h3>
                                    <p>Your satisfaction is our top priority. We offers you the best quality for the best price.</p>
                                </div>
                            </div>

                            <div class="quality">
                                <img width="40px" src="{{ asset('images/coupons.webp') }}" alt="Affordable Pricing">
                                <div class="quality-text">
                                    <h3>Affordable Pricing</h3>
                                    <p>Our coupon books provide excellent value, with bigger savings on larger packages.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <div class="line"></div>
            <section class="products-section">
                    <h1>Our Product</h1>
                <div class="products-container">
                    <div class="product-card">
                        <img src="{{ asset('images/5-gallon.webp') }}" alt="Product 1" class="product-image">
                        <h2>5 Gallon Bottle</h2>
                        <h3>Price: <Span>AED 6.5</Span></h3>
                        <p>Pure and refreshing water delivered in convenient 5-gallon bottles.</p>
                        <div class="product-info">
                            Can be redeemed using coupon book CB-11, CB-28, or CB-58.”
                        </div>
                        <button class="product-button" onclick="window.open('https://wa.me/971566660755','_blank')">Order Now</button>
                    </div>
                </div>
            </section>
            <div class="line"></div>
            <section class="coupons-section">
                <h1>Coupons</h1>
                <p>Save more with our coupon books! Enjoy bigger savings on larger packages.</p>
                <div class="coupons-container">
                    <div class="coupon-card">
                        <img src="{{ asset('images/coupon3.webp') }}" alt="Coupon Book" class="coupon-image">
                        <div class="coupon-info">
                            <h2>Coupon Book CB-11</h2>
                            <p>Get 11 coupons for AED 250. Each coupon is worth AED 25.</p>
                            <p class="coupon-last-p">Can be redeemed for 5-gallon bottles.</p>
                        </div>
                        <button class="coupon-button" onclick="window.open('https://wa.me/971566660755','_blank')">Buy Now</button>
                    </div>
                    <div class="coupon-card">
                        <img src="{{ asset('images/coupon4.webp') }}" alt="Coupon Book" class="coupon-image">
                        <div class="coupon-info">
                            <h2>Coupon Book CB-28</h2>
                            <p>Get 28 coupons for AED 600. Each coupon is worth AED 25.</p>
                            <p class="coupon-last-p">Can be redeemed for 5-gallon bottles.</p>
                        </div>
                        <button class="coupon-button" onclick="window.open('https://wa.me/971566660755','_blank')">Buy Now</button>
                    </div>
                    <div class="coupon-card">
                        <img src="{{ asset('images/coupon5.webp') }}" alt="Coupon Book" class="coupon-image">
                        <div class="coupon-info">
                            <h2>Coupon Book CB-58</h2>
                            <p>Get 58 coupons for AED 1,200. Each coupon is worth AED 25.</p>
                            <p class="coupon-last-p">Can be redeemed for 5-gallon bottles.</p>
                        </div>
                        <button class="coupon-button" onclick="window.open('https://wa.me/971566660755','_blank')">Buy Now</button>
                    </div>

                    <h1>Special Offers</h1>

                    <div class="coupon-card second-last-coupon">
                        <img src="{{ asset('images/coupon1.webp') }}" alt="Coupon Book" class="coupon-image">
                        <div class="coupon-info">
                            <h2>Coupon Book CB-75 with free Dispenser(For Lifetime)</h2>
                            <p>Get 75 coupons for AED 590.</p>
                            <p class="coupon-last-p">Can be redeemed for 5-gallon bottles.</p>
                        </div>
                        <button class="coupon-button" onclick="window.open('https://wa.me/971566660755','_blank')">Buy Now</button>
                    </div>
                                        <div class="coupon-card last-coupon">
                        <img src="{{ asset('images/coupon2.webp') }}" alt="Coupon Book" class="coupon-image">
                        <div class="coupon-info">
                            <h2>Coupon Book CB-75 and Free Dispenser(Returnable after Stopping Service)</h2>
                            <p>Get 75 coupons for AED 490.</p>
                            <p class="coupon-last-p">Can be redeemed for 5-gallon bottles.</p>
                        </div>
                        <button class="coupon-button" onclick="window.open('https://wa.me/971566660755','_blank')">Buy Now</button>
                    </div>
                </div>
            </section>
            <div class="line"></div>
            
            <section class="banner-image-section">
                <img src="{{ asset('images/intro-banner.webp') }}" alt="OasisFlow Banner" class="banner-image">
            </section>
            <div class="line"></div>
            <section class="services-section">
                <h1>Our Services</h1>
                <p>We offer a range of services to ensure you have the best water delivery experience.</p>
                <div class="services-container">
                    <div class="service-card">
                        <img src="{{ asset('images/coupons.webp') }}" alt="Coupon System" class="service-image">
                        <h2>Coupon System</h2>
                        <p>Enjoy flexible savings and easy redemption with our digital and physical coupon books. Perfect for families and offices looking to save more on every order.</p>
                    </div>
                    <div class="service-card">
                        <img src="{{ asset('images/fast-delivery.webp') }}" alt="Delivery Model" class="service-image">
                        <h2>Delivery Model</h2>
                        <p>Experience fast, reliable, and scheduled water delivery right to your doorstep. Our delivery model adapts to your needs for maximum convenience.</p>
                    </div>
                    <div class="service-card">
                        <img src="{{ asset('images/dispenser.webp') }}" alt="Dispenser Options" class="service-image">
                        <h2>Dispenser Options</h2>
                        <p>Choose from a range of modern water dispensers for home or office. We offer rental and purchase options to suit your hydration needs.</p>
                    </div>
                </div>
            </section>
            <div class="line"></div>
            <section class="aboutus-section">
                <h1>About Us</h1>
                <div class="aboutus-container">
                    <div class="aboutus-left">
                        <img src="{{ asset('images/aboutoasis.webp') }}" alt="OasisFlow Logo" class="aboutus-logo-image">
                    </div>
                    <div class="aboutus-right">
                        <h2>Oasis Flow</h2>
                        <p>OasisFlow is a modern bottled water delivery platform designed to bring pure, premium 5-gallon water bottles right to your doorstep—quickly, easily, and affordably. Built with a focus on quality, reliability, and customer satisfaction, OasisFlow is reshaping how people in the UAE stay hydrated.</p>
                        <p>For the last 20 years, the company helped thousands of families to drink real mineral water and continues its successful journey with our satisfied customers. Today, OasisFlow is striving to help families around the globe with our proficient team and world-class facilities.</p>
                        <p>OasisFlow is the manufacturer of purified mineral water. The company is specialized in 5 gallon bottle market. Now, the company has operation in the Abu Dhabi, Al Ain, Ajman, Dubai, Sharjah market and preparing for expansion nationally and internationally. OasisFlow is well known for the quality product and quality management. As we built our successful history, we are looking for a healthier future.</p>
                        <button onclick="scrollToSection('.products-section')">Explore Our Product</button>
                    </div>
                </div>
            </section>
            <section class="customers-section">
  <h1>What Our Customers Say</h1>

  <div class="customers-slider">
    <div class="customers-slider-track">
      <div class="customer-card active">
        <p class="customer-quote">
         “OasisFlow has made our office water needs stress-free. Their 5-gallon bottles are always sealed and safe, and their driver is polite and punctual.Highly recommend for both home and business use.”
        </p>
        <div class="customer-profile">
          <img width="50px" src="images/muzammil.webp" alt="Muzammil Nawaz" class="customer-image" />
          <div class="customer-info">
          <h3 class="customer-name">Muzammil Nawaz</h3>
          <p class="customer-role">Web Developer</p>
          </div>
        </div>
      </div>

      <!-- Testimonial 2 -->
      <div class="customer-card">
        <p class="customer-quote">“Absolutely love the convenience OasisFlow provides! The water tastes clean and fresh, and the coupon system saves me money too!”</p>
        <div class="customer-profile">
          <img width="50px" src="images/abdullah.webp" alt="Abdullah Abid" class="customer-image" />
          <div class="customer-info">
          <h3 class="customer-name">Abdullah Abid</h3>
          <p class="customer-role">Graphic Designer</p>
          </div>
        </div>

      </div>
    </div>

    <div class="customers-slider-indicators">
      <span class="customers-indicator active" data-slide="0"></span>
      <span class="customers-indicator" data-slide="1"></span>
    </div>
  </div>
</section>
<section class="contact-section">
    <h1>Contact Us</h1>
    <p>Have questions or need assistance? Reach out to us!</p>
    <div class="contact-container">
        <div class="contact-info">
            <div class="contact-info-top">
            <h2>Contact Information</h2>
            <div class="address contact-info-detail">
                <img width="30px" src="images/address.webp" alt="Address Icon" class="contact-icon">
                <p>Oasis Flow WATER DESALINATION FILLING FACTORY LLC, Mussafah, Abu Dhabi</p>
            </div>
            <div class="phone contact-info-detail">
                <img width="30px" src="images/call.webp" alt="Call Icon" class="contact-icon">
                <p><a href="https://wa.me/971566660755" target="_blank" class="whatsapp-link" style="color:inherit;text-decoration:none;">+971566660755</a></p>
            </div>
            <div class="phone contact-info-detail">
                <h3>(Landline)</h3>
                <p><a href="https://wa.me/971566660755" target="_blank" class="whatsapp-link" style="color:inherit;text-decoration:none;">025846870</a></p>
            </div>
            <div class="email contact-info-detail">
                <img width="30px" src="images/email-icon.webp" alt="Email Icon" class="contact-icon">
                <p><a href="mailto:care@oasisflow.ae" class="email-link" style="color:inherit;text-decoration:none;">care@oasisflow.ae</a></p>
            </div>
            </div>
            <div class="contact-info-bottom">
                <h2>Follow Us</h2>
                <div class="social-icons">
                    <a href="#"><img width="30px" src="images/facebook.avif" alt="Facebook Icon"></a>
                    <a href="#"><img width="30px" src="images/insta.avif" alt="Instagram Icon"></a>
                    <a href="#"><img width="30px" src="images/linkedin.avif" alt="LinkedIn Icon"></a>
                </div>
            </div>
        </div>
        <div class="contact-form">
            <form>
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="phone">Your Phone</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter your phone" required>
                    </div>
                    <div class="form-group half-width">
                        <label for="email">Your Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" placeholder="Type your message" required></textarea>
                </div>
                <button type="submit" class="contact-submit-btn">Send Message</button>
            </form>
        </div>
    </div>
</section>
<footer>
    <div class="footer-container">
        <div class="footer-top">
            <div class="footer-top-top">
                <div class="footer-top-left">
                    <div class="footer-logo">
                        <img width="60px" src="images/logo.webp" alt="OasisFlow Logo" class="logo-image">
                        <span>Oasis Flow</span>
                    </div>
                    <p>Delivering pure water to your doorstep with a commitment to quality and customer satisfaction.</p>
                    <div class="footer-socials">
                        <a href="#"><img src="images/facebook.avif" alt="Facebook"></a>
                        <a href="#"><img src="images/insta.avif" alt="Instagram"></a>
                        <a href="#"><img src="images/linkedin.avif" alt="LinkedIn"></a>
                    </div>
                </div>
                <div class="footer-top-left quick-links-col">
                    <h2>Quick Links</h2>
                    <div class="footer-links">
                        <a href="#" onclick="event.preventDefault();scrollToSection('.hero-section');">Home</a>
                        <a href="#" onclick="event.preventDefault();scrollToSection('.products-section');">Products</a>
                        <a href="#" onclick="event.preventDefault();scrollToSection('.services-section');">Services</a>
                        <a href="#" onclick="event.preventDefault();scrollToSection('.aboutus-section');">About Us</a>
                        <a href="#" onclick="event.preventDefault();scrollToSection('.contact-section');">Contact Us</a>
                    </div>
                </div>
                <div class="footer-top-left">
                    <h2>Our Mission</h2>
                    <p>To provide safe, pure, and affordable water to every home and office, ensuring health and satisfaction for all our customers. We are committed to sustainability and excellence in service.</p>
                </div>
                <div class="footer-top-left">
                    <h2>Contact Information</h2>
                    <div class="footer-contact-info">
                        <div class="footer-contact-row">
                            <img width="35px" src="images/address.webp" alt="Address Icon">
                            <span>Oasis Flow WATER FILLING FACTORY LLC, Mussafah, Abu Dhabi</span>
                        </div>
                        <div class="footer-contact-row">
                            <img width="32px" src="images/call.webp" alt="Call Icon">
                            <span><a href="https://wa.me/971566660755" target="_blank" class="whatsapp-link" style="color:inherit;text-decoration:none;">+971566660755</a></span>
                        </div>
                        <div class="footer-contact-row">
                            <h3>(Landline)</h3>
                            <span><a href="tel:025846870" style="color:inherit;text-decoration:none;">025846870</a></span>
                        </div>
                        <div class="footer-contact-row">
                            <img width="32px" src="images/email-icon.webp" alt="Email Icon">
                            <span><a href="mailto:care@oasisflow.ae" class="email-link" style="color:inherit;text-decoration:none;">care@oasisflow.ae</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-top-bottom"></div>

            
        </div>
        <div class="footer-bottom">
         <p>&copy; 2025 OasisFlow. All rights reserved.</p>
        </div>
    </div>
</footer>

        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slides = document.querySelectorAll('.hero-slide');
            const indicators = document.querySelectorAll('.hero-indicator');
            const btnLeft = document.querySelector('.hero-slider-btn-left');
            const btnRight = document.querySelector('.hero-slider-btn-right');
            let current = 0;
            let autoSlideInterval = null;
            const slideCount = slides.length;
            const slideDuration = 5000;

            function showSlide(idx) {
                slides.forEach((slide, i) => {
                    slide.classList.toggle('active', i === idx);
                    slide.style.transform = `translateX(${100 * (i - idx)}%)`;
                });
                indicators.forEach((dot, i) => {
                    dot.classList.toggle('active', i === idx);
                });
                current = idx;
            }

            function nextSlide() {
                showSlide((current + 1) % slideCount);
            }

            function prevSlide() {
                showSlide((current - 1 + slideCount) % slideCount);
            }

            function startAutoSlide() {
                stopAutoSlide();
                autoSlideInterval = setInterval(nextSlide, slideDuration);
            }

            function stopAutoSlide() {
                if (autoSlideInterval) clearInterval(autoSlideInterval);
            }

            btnLeft.addEventListener('click', () => {
                prevSlide();
                startAutoSlide();
            });
            btnRight.addEventListener('click', () => {
                nextSlide();
                startAutoSlide();
            });
            indicators.forEach((dot, i) => {
                dot.addEventListener('click', () => {
                    showSlide(i);
                    startAutoSlide();
                });
            });

            showSlide(0);
            startAutoSlide();
        });

  const track = document.querySelector('.customers-slider-track');
  const cards = document.querySelectorAll('.customer-card');
  const indicators = document.querySelectorAll('.customers-indicator');

  let currentIndex = 0;

  function updateSlider(index) {
    track.style.transform = `translateX(-${index * 100}%)`;

    indicators.forEach(ind => ind.classList.remove('active'));
    if (indicators[index]) indicators[index].classList.add('active');
  }


  indicators.forEach((indicator, idx) => {
    indicator.addEventListener('click', () => {
      currentIndex = idx;
      updateSlider(currentIndex);
    });
  });

  setInterval(() => {
    currentIndex = (currentIndex + 1) % cards.length;
    updateSlider(currentIndex);
  }, 5000);

  function scrollToSection(selector) {
        const navbar = document.querySelector('header');
        const section = document.querySelector(selector);
        if (section) {
            const navHeight = navbar ? navbar.offsetHeight : 0;
            const sectionTop = section.getBoundingClientRect().top + window.pageYOffset;
            window.scrollTo({
                top: sectionTop - navHeight,
                behavior: 'smooth'
            });
        }
    }

    // Toggle login dropdown
            function toggleLoginDropdown() {
                const dropdown = document.getElementById('loginDropdown');
                dropdown.classList.toggle('hidden');
            }

            document.addEventListener('click',function(event){
                const wrapper = document.getElementById("loginWrapper");
                const dropdown = document.getElementById("loginDropdown");

                if (!wrapper.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });


    // Hamburger menu functionality
    document.addEventListener('DOMContentLoaded', function () {
        const hamburger = document.getElementById('hamburger-menu');
        const navList = document.getElementById('nav-list');
        hamburger.addEventListener('click', function () {
            navList.classList.toggle('show');
            hamburger.classList.toggle('active');
        });
        // Optional: Hide menu after clicking a link (for mobile)
        navList.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if(window.innerWidth <= 900) {
                    navList.classList.remove('show');
                    hamburger.classList.remove('active');
                }
            });
        });
    });
    </script>
</body>

</html>