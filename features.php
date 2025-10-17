<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Features - Urban Elegance</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    /* Features Page Styles */
    .features-section {
      padding: 60px 20px;
      background-color: #f7f9fc;
      text-align: center;
    }

    .features-section h1 {
      font-size: 2.5rem;
      color: #2c3e50;
      margin-bottom: 10px;
    }

    .features-section p {
      color: #555;
      margin-bottom: 40px;
      font-size: 1rem;
    }

    .feature-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
    }

    .feature-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      width: 300px;
      transition: transform 0.3s;
    }

    .feature-card:hover {
      transform: translateY(-10px);
    }

    .feature-card img {
      width: 100%;
      height: 200px;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
      object-fit: cover;
    }

    .feature-card h3 {
      margin: 15px 0 5px;
      color: #2c3e50;
    }

    .feature-card p {
      padding: 0 15px 20px;
      color: #666;
      font-size: 0.95rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .feature-container {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>


  <section class="features-section">
    <h1>Our Exclusive Features</h1>
    <p>Discover the modern living spaces and amenities that make Urban Elegance stand out in real estate excellence.</p>

    <div class="feature-container">

      <div class="feature-card">
        <img src="https://images.unsplash.com/photo-1597047084897-51e81819a499?auto=format&fit=crop&w=900&q=60" alt="Modern Apartment">
        <h3>Modern Apartments</h3>
        <p>Experience the luxury of urban-style apartments designed with comfort, aesthetics, and space efficiency in mind.</p>
      </div>

      <div class="feature-card">
        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=900&q=60" alt="Luxury Villa">
        <h3>Luxury Villas</h3>
        <p>Live in beautifully crafted villas offering privacy, elegance, and top-class interiors with serene surroundings.</p>
      </div>

      <div class="feature-card">
        <img src="https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=900&q=60" alt="Affordable Homes">
        <h3>Affordable Homes</h3>
        <p>Find your perfect match among a wide range of affordable homes tailored for families, students, and working professionals.</p>
      </div>

      <div class="feature-card">
        <img src="https://images.unsplash.com/photo-1613977257360-087d1d3f3f2b?auto=format&fit=crop&w=900&q=60" alt="Smart Security">
        <h3>Smart Security</h3>
        <p>Enjoy peace of mind with 24/7 CCTV surveillance, digital locks, and secure gated communities.</p>
      </div>

      <div class="feature-card">
        <img src="https://images.unsplash.com/photo-1527030280862-64139fba04ca?auto=format&fit=crop&w=900&q=60" alt="Prime Locations">
        <h3>Prime Locations</h3>
        <p>All our listed properties are located in well-connected, safe, and developing urban areas.</p>
      </div>

      <div class="feature-card">
        <img src="https://images.unsplash.com/photo-1589919248591-715e0d3a5b7b?auto=format&fit=crop&w=900&q=60" alt="24/7 Support">
        <h3>24/7 Assistance</h3>
        <p>Our support team ensures smooth communication between owners and tenants at all times.</p>
      </div>

    </div>
  </section>

 
</body>
</html>
