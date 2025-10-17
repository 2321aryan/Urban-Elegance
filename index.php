<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Urban Elegance</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f8fafc;
      color: #1e293b;
    }
    header {
      position: sticky;
      top: 0;
      background: rgba(255,255,255,0.9);
      backdrop-filter: blur(6px);
      border-bottom: 1px solid #e2e8f0;
      padding: 12px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      z-index: 1000;
    }
    header .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: bold;
      font-size: 18px;
    }
    header .logo div {
      background: #0f172a;
      color: white;
      width: 40px;
      height: 40px;
      display: grid;
      place-items: center;
      border-radius: 12px;
    }
    nav a {
      margin: 0 12px;
      color: #475569;
      text-decoration: none;
      font-size: 14px;
    }
    nav a:hover {
      color: #0f172a;
    }
    
	.auth {
	  display: flex;
	  gap: 15px;
	  justify-content: center;
	  align-items: center;
	  margin-top: 20px;
	}

	/* Common button style */
	.btn {
	  text-decoration: none;
	  padding: 10px 20px;
	  border-radius: 25px;
	  font-weight: 600;
	  font-size: 16px;
	  border: none;
	  transition: 0.3s;
	  display: inline-block;
	}

	/* Login button */
	.btn.login {
	  background-color: #000000;
	  color: #ffffff;
	}

	.btn.login:hover {
	  background-color: #808080;
	}

	/* Register button */
	.btn.register {
	  background-color: #000000;
	  color: #ffffff;
	}

	.btn.register:hover {
	  background-color: #808080;
	}


    /* Hero */
    .hero {
      position: relative;
      color: white;
      text-align: center;
      padding: 100px 20px;
    }
    .hero img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0.6;
      z-index: -1;
    }
    .hero h1 {
      font-size: 48px;
      font-weight: 800;
    }
    .hero span {
      color:#4169E1;
    }
    .hero p {
      margin-top: 16px;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }
    .search-box {
      margin-top: 30px;
      background: white;
      padding: 20px;
      border-radius: 12px;
      max-width: 400px;
      margin-left: auto;
      margin-right: auto;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      color: #1e293b;
    }
    .search-box label {
      font-size: 14px;
      color: #475569;
    }
    .search-box input {
      width: 90%;
      padding: 10px;
      border: 1px solid #cbd5e1;
      border-radius: 8px;
      margin-top: 6px;
      margin-bottom: 12px;
    }
    .search-box button {
      width: 100%;
      padding: 10px;
      background: #ADD8E6;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
    }
    /* Features */
    .features {
      padding: 80px 20px;
      max-width: 1100px;
      margin: auto;
    }
    .features h2 {
      text-align: center;
      font-size: 32px;
      margin-bottom: 40px;
    }
    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit,minmax(300px,1fr));
      gap: 20px;
    }
    .feature-card {
      background: white;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    .feature-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }
    .feature-card div {
      padding: 20px;
    }
    .feature-card h3 {
      font-size: 20px;
      margin-bottom: 8px;
    }
    .feature-card p {
      color: #475569;
      font-size: 14px;
    }
    /* About */
    .about {
      padding: 80px 20px;
      max-width: 1100px;
      margin: auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      align-items: center;
    }
    .about img {
      width: 100%;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .about h2 {
      font-size: 32px;
      margin-bottom: 16px;
    }
    .about p {
      color: #475569;
      line-height: 1.6;
    }
    /* Contact */
    .contact {
      background: #0f172a;
      color: white;
      text-align: center;
      padding: 80px 20px;
    }
    .contact h2 {
      font-size: 32px;
      margin-bottom: 16px;
    }
    .contact button {
      margin-top: 20px;
      padding: 12px 24px;
      background: #ADD8E6;
      color: #0f172a;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
    }
    /* Footer */
    footer {
      max-width: 1100px;
      margin: auto;
      padding: 40px 20px;
      color: #475569;
      font-size: 14px;
    }
    footer .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit,minmax(200px,1fr));
      gap: 20px;
    }
    footer h4 {
      color: #0f172a;
      font-weight: bold;
      margin-bottom: 8px;
    }
    footer a {
      display: block;
      color: #475569;
      text-decoration: none;
      margin: 4px 0;
    }
    footer a:hover {
      text-decoration: underline;
    }
    footer .bottom {
      border-top: 1px solid #e2e8f0;
      margin-top: 20px;
      padding-top: 20px;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }
  </style>
</head>
<body>
  <!-- NAVBAR -->
  <header>
    <div class="logo"><div>UE</div> Urban Elegance</div>
    <nav>
	  <a href="#about">About Us</a>
      <a href="features.php">Features</a>
      <a href="#property">Property</a>
      <a href="#contact">Contact</a>
    </nav>
   <div class="auth">
  <a href="login.php" class="btn login">Login</a>
  <a href="register.php" class="btn register">Register</a>
</div>

  </header>

  <!-- HERO -->
  <section class="hero">
    <img src="images\building 1.jpeg" alt="Hero">
    <h1>Find your dream home with <span>Urban Elegance</span></h1>
    <p>Explore modern apartments, luxury villas, and cozy rentals—all verified for your peace of mind.</p>
    <div class="search-box">
      <label>Location</label>
      <input type="text" placeholder="Enter location">
      <button>Search</button>
    </div>
  </section>

  <!-- FEATURES -->
  <section id="features" class="features">
    <h2>Why Choose Urban Elegance?</h2>
    <div class="features-grid">
      <div class="feature-card">
        <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?q=80&w=800&auto=format&fit=crop" alt="">
        <div>
          <h3>Verified Listings</h3>
          <p>Every property is checked and verified before being listed.</p>
        </div>
      </div>
      <div class="feature-card">
        <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?q=80&w=800&auto=format&fit=crop" alt="">
        <div>
          <h3>Direct Connect</h3>
          <p>Chat with property owners and schedule visits instantly.</p>
        </div>
      </div>
      <div class="feature-card">
        <img src="https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?q=80&w=800&auto=format&fit=crop" alt="">
        <div>
          <h3>24/7 Support</h3>
          <p>Our support team is available around the clock to guide you through your housing journey.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- PROPERTY SECTION -->
  <section id="property" class="features">
      <h2>Featured Properties</h2>
  <div class="features-grid">
    <div class="feature-card">
      <img src="images\Home 1.jpeg" alt="Modern Apartment">
      <div>
        <h3>Modern Apartment</h3>
        <p>Stylish 2BHK apartment with modern interiors, balcony view, and nearby shopping centers.</p>
      </div>
    </div>

    <div class="feature-card">
      <img src="images\Home 2.jpeg" alt="Luxury Villa">
      <div>
        <h3>Luxury Villa</h3>
        <p>Spacious 4BHK villa with private parking, garden area, and premium quality finishing.</p>
      </div>
    </div>

    <div class="feature-card">
      <img src="images\family flat.jpg" alt="Family Flat">
      <div>
        <h3>Family Flat</h3>
        <p>Comfortable and affordable 2BHK flat perfect for small families, near schools and hospitals.</p>
      </div>
    </div>
  </section>

  <!-- ABOUT -->
  <section id="about" class="about">
    <img src="https://images.unsplash.com/photo-1599423300746-b62533397364?q=80&w=1600&auto=format&fit=crop" alt="">
    <div>
      <h2>About Urban Elegance</h2>
      <p>
        We are a modern real estate platform focused on making rental property hunting easy, transparent, and reliable. From luxury villas to affordable studios, our listings are curated to suit every lifestyle.
      </p>
    </div>
  </section>

  <!-- CONTACT -->
  <section id="contact" class="contact">
    <h2>Get in Touch</h2>
    <p>Have questions or need assistance? Our team is here to help you find your perfect home.</p>
    <button>Contact Us</button>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="grid">
      <div>
        <h4>Urban Elegance</h4>
        <p>Your trusted partner for rental homes.</p>
      </div>
      <div>
        <h4>Company</h4>
        <a href="#">About</a>
        <a href="#">Careers</a>
        <a href="#">Contact</a>
      </div>
      <div>
        <h4>Explore</h4>
        <a href="#features">Features</a>
        <a href="#property">Property</a>
        <a href="#about">About</a>
      </div>
      <div>
        <h4>Legal</h4>
        <a href="#">Privacy</a>
        <a href="#">Terms</a>
      </div>
    </div>
    <div class="bottom">
      <div>
        <a href="#">Instagram</a> |
        <a href="#">Facebook</a> |
        <a href="#">LinkedIn</a>
      </div>
    </div>
  </footer>
</body>
</html>
