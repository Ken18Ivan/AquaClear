<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Smart AquaClear | Welcome</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom right, #002f4b, #00bfff);
      color: white;
      overflow-x: hidden;
    }

    header {
      background: url('../Frontend/assets/images/landing-bg.jpg') center/cover no-repeat;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      backdrop-filter: brightness(0.5);
      padding: 0 20px;
    }

    .hero-content {
      background-color: rgba(0, 0, 0, 0.5);
      padding: 50px;
      border-radius: 16px;
      box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
    }

    .hero-content h1 {
      font-size: 3.5rem;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .hero-content p {
      font-size: 1.25rem;
    }

    .btn-cta {
      background: #00bfff;
      border: none;
      font-weight: bold;
      margin-top: 25px;
      padding: 12px 30px;
    }

    .tab-content {
      background-color: rgba(0, 0, 0, 0.5);
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
      margin-top: 20px;
    }

    footer {
      text-align: center;
      padding: 20px;
      background-color: rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
      .hero-content h1 {
        font-size: 2.5rem;
      }
      .hero-content {
        padding: 30px;
      }
    }
  </style>
</head>
<body>

<!-- Hero Section -->
<header>
  <div class="hero-content text-white">
    <h1>Welcome to Smart AquaClear</h1>
    <p>"Purifying Water, Empowering Communities – Sustainably."</p>
    <a href="../SmartAquaclear/Frontend/login.html" class="btn btn-cta">Login to the System</a>
  </div>
</header>

<!-- Tabbed Interface -->
<div class="container mt-5">
  <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="mission-tab" data-bs-toggle="tab" data-bs-target="#mission" type="button" role="tab" aria-controls="mission" aria-selected="true">🌍 Mission</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="background-tab" data-bs-toggle="tab" data-bs-target="#background" type="button" role="tab" aria-controls="background" aria-selected="false">🔬 Background</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="problem-tab" data-bs-toggle="tab" data-bs-target="#problem" type="button" role="tab" aria-controls="problem" aria-selected="false">📌 Problem</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="goals-tab" data-bs-toggle="tab" data-bs-target="#goals" type="button" role="tab" aria-controls="goals" aria-selected="false">🎯 Goals</button>
    </li>
  </ul>
  <div class="tab-content text-white">
    <!-- Mission Section -->
    <div class="tab-pane fade show active" id="mission" role="tabpanel" aria-labelledby="mission-tab">
      <h2>🌍 Our Mission</h2>
      <p>
        Smart AquaClear is built to provide clean, safe, and sustainable water purification through IoT, natural coagulants, and solar power. We empower low-resource areas with modern technology that is affordable, scalable, and real-time.
      </p>
    </div>

    <!-- Research Background Section -->
    <div class="tab-pane fade" id="background" role="tabpanel" aria-labelledby="background-tab">
      <h2>🔬 Research Background</h2>
      <p>
        Many communities still struggle with access to safe drinking water. This project integrates IoT sensors, jackfruit seed coagulants, and solar energy to monitor and purify water in real time. It’s a fusion of nature and innovation.
      </p>
    </div>

    <!-- Problem Statement Section -->
    <div class="tab-pane fade" id="problem" role="tabpanel" aria-labelledby="problem-tab">
      <h2>📌 Problem Statement</h2>
      <p>
        Water contamination in low-income areas poses serious health risks. Traditional purification systems are costly and lack monitoring capabilities. There is a need for a real-time, low-cost solution that can be deployed in underserved locations.
      </p>
    </div>

    <!-- Project Goals Section -->
    <div class="tab-pane fade" id="goals" role="tabpanel" aria-labelledby="goals-tab">
      <h2>🎯 Project Goals</h2>
      <ul class="goals-list">
        <li>✔️ Develop a low-cost water purification system using jackfruit seed as a natural coagulant</li>
        <li>✔️ Utilize IoT for real-time water quality monitoring</li>
        <li>✔️ Implement a solar-powered system for sustainability</li>
        <li>✔️ Provide an interactive, user-friendly dashboard for system management</li>
        <li>✔️ Enable feedback, logging, and maintenance tracking for continuous improvement</li>
      </ul>
    </div>
  </div>
</div>

<footer>
  <small>&copy; 2025 Smart AquaClear | All rights reserved.</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>