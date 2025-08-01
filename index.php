<?php
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eneby Vision - Création de sites web intelligents</title>
    <link rel="icon" type="image/png" href="./images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.10.18/build/spline-viewer.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
            scroll-behavior: smooth;
        }
        
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0);}
            50% { transform: translateY(-16px);}
        }
        .animate-bounce-slow { animation: bounce-slow 3s infinite; }
        @keyframes float {
            0%, 100% { transform: translateY(0);}
            50% { transform: translateY(-10px);}
        }
        .animate-float { animation: float 4s ease-in-out infinite; }
        /* Bloque le scroll horizontal sur toute la page */
        html, body {
            overflow-x: hidden !important;
        }
        
        .gradient-text {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .spline-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.3;
        }
        
        .hero-section {
            position: relative;
            overflow: hidden;
        }
        
        .feature-card {
            background: rgba(30, 41, 59, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .testimonial-card {
            background: rgba(30, 41, 59, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .team-card {
            transition: all 0.3s ease;
        }
        
        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        

        
        
        @media (max-width: 768px) {
            .process-step:not(:last-child):after {
                display: none;
            }
        }
        
        .nav-link {
            position: relative;
        }
        
        .nav-link:after {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover:after {
            width: 100%;
        }
        
        .btn-primary {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3), 0 4px 6px -2px rgba(59, 130, 246, 0.1);
        }
        
        .btn-secondary {
            border: 1px solid #3b82f6;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: rgba(59, 130, 246, 0.1);
            transform: translateY(-2px);
        }

        
 
        /* Carrousel responsive styles */
        @media (max-width: 768px) {
            /* Cache les icônes et le bloc d'illustration dans le carrousel */
            #features-carousel h3 > i,
            #features-carousel .relative.flex.items-center.justify-center {
                display: none !important;
            }
            /* Centre les titres, sous-titres et contenu du carrousel */
            #features-carousel h3,
            #features-carousel p,
            #features-carousel ul,
            #features-carousel a {
                text-align: center !important;
                justify-content: center !important;
            }
            #features-carousel ul {
                align-items: center !important;
            }
            /* Force la grille à une colonne */
            #features-carousel .grid {
                grid-template-columns: 1fr !important;
                box-shadow: none !important;
                border: none !important;
            }
            /* Permet le scroll horizontal du carrousel uniquement sur mobile */
            #features-carousel {
                overflow-x: auto !important;
                scroll-snap-type: x mandatory;
                -webkit-overflow-scrolling: touch;
            }
            #features-carousel > div {
                scroll-snap-align: start;
            }
            #features-carousel > div {
                min-height: 520px !important;
                max-height: 520px !important;
                display: flex;
                align-items: stretch;
            }
            #features-carousel .grid {
                min-height: 520px !important;
                max-height: 520px !important;
                height: 100% !important;
                align-items: stretch;
            }
        }
        html, body {
            overflow-x: hidden !important;
        }
        /* Footer mobile ultra-compact */
        @media (max-width: 767px) {
            footer .grid,
            footer .border-t + div.flex { display: none !important; }
            footer { padding-top: 0 !important; padding-bottom: 0 !important; }
            footer .flex.flex-col.items-center.justify-center.text-center { padding-top: 12px !important; padding-bottom: 12px !important; }
        }



        #contact {
            margin-top: 50px; /* Ajout d'une marge supplémentaire pour éloigner davantage les sections */
        }

        #process {
            margin-bottom: 100px; /* Ajout d'une marge plus grande pour éloigner la section Processus de la section Contact */
        }
    </style>
    
</head>
<body class="min-h-screen">
    
    <!-- Navigation -->
    <nav class="fixed w-full bg-slate-900/80 backdrop-blur-md z-50 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="text-2xl font-bold gradient-text">Eneby Vision</span>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-8">
                            <a href="#" class="nav-link text-slate-200 hover:text-white px-3 py-2">Accueil</a>
                            <a href="#services" class="nav-link text-slate-200 hover:text-white px-3 py-2">Services</a>
                            <a href="#portfolio" class="nav-link text-slate-200 hover:text-white px-3 py-2">Portfolio</a>
                            <a href="#contact" class="nav-link text-slate-200 hover:text-white px-3 py-2">Contact</a>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <a href="#contact" class="btn-primary text-white px-6 py-2 rounded-full font-medium">Démarrer un projet</a>
                </div>
                <div class="-mr-2 flex md:hidden">
                    <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-white hover:bg-slate-700 focus:outline-none">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-slate-200 hover:text-white hover:bg-slate-700">Accueil</a>
                <a href="#services" class="block px-3 py-2 rounded-md text-base font-medium text-slate-200 hover:text-white hover:bg-slate-700">Services</a>
                <a href="#portfolio" class="block px-3 py-2 rounded-md text-base font-medium text-slate-200 hover:text-white hover:bg-slate-700">Portfolio</a>
                <a href="#contact" class="block px-3 py-2 rounded-md text-base font-medium text-slate-200 hover:text-white hover:bg-slate-700">Contact</a>
                <a href="#contact" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-blue-500 to-purple-500">Démarrer un projet</a>
            </div>
        </div>
    </nav>

  <!-- HERO SECTION -->
<section class="hero-section pt-24 pb-28 relative min-h-screen bg-cover bg-center md:bg-none" style="background-image: url('./images/bghero.svg');">
  <div class="absolute inset-0 w-full h-full z-0">
    <!-- Fond animé mobile -->
    <div class="hero-animated-bg-mobile md:hidden">
      <div class="neon-center"></div>
    </div>

    <!-- Overlay noir mobile -->
    <div class="hero-overlay-mobile md:hidden bg-black/60 absolute inset-0"></div>

    <!-- Vidéo affichée sur tablette+ (≥768px) -->
    <video
      src="./video/hero.mp4"
      autoplay
      loop
      muted
      playsinline
      class="hidden md:block w-full h-full object-cover"
    ></video>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 relative z-20 flex items-center h-full">
    <div class="lg:grid lg:grid-cols-2 lg:gap-24 items-center w-full">
      <div class="mt-16 md:mt-10 text-center lg:text-left max-w-3xl mx-auto lg:mx-0 px-4">
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold leading-tight md:leading-[1.2] mb-8 sm:mb-10">
          <span class="text-white md:gradient-text">Création de site internet pour PME</span>
        </h1>
        <p class="text-base sm:text-lg md:text-xl text-slate-300 mb-8 sm:mb-12">
          Eneby Vision réalise votre site vitrine professionnel, optimisé SEO et facile à gérer. Boostez votre visibilité simplement !
        </p>
        <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center lg:justify-start mt-4">
          <a href="#contact" class="btn-primary text-white px-8 py-3 rounded-full font-medium text-base sm:text-lg">
            Démarrer un projet
          </a>
          <a href="#services" class="btn-secondary text-blue-400 px-8 py-3 rounded-full font-medium text-base sm:text-lg">
            Nos services
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
    <!-- Nos Forces Section -->
    <section class="py-10 md:py-12 bg-gradient-to-b from-black via-[#0f172a] to-slate-800/50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8 md:mb-10">
          <h2 class="text-3xl md:text-4xl font-bold mb-4">Pourquoi choisir Eneby Vision ?</h2>
          <p class="text-lg text-slate-400 max-w-2xl mx-auto">Nous combinons expertise technique et créativité pour des solutions web sur mesure.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-4 md:gap-6">
          <div class="feature-card rounded-xl p-6 md:p-8 transition-all duration-300 hover:border-blue-500/30 flex flex-col items-center">
            <div class="w-14 h-14 rounded-full bg-blue-900/30 flex items-center justify-center mb-4">
              <i class="fas fa-shipping-fast text-2xl text-blue-400"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2 text-center">Création et livraison express</h3>
            <p class="text-slate-400 text-center">Votre site web conçu et mis en ligne dans des délais courts pour booster rapidement votre visibilité.</p>
          </div>
          <div class="feature-card rounded-xl p-6 md:p-8 transition-all duration-300 hover:border-purple-500/30 flex flex-col items-center">
            <div class="w-14 h-14 rounded-full bg-purple-900/30 flex items-center justify-center mb-4">
              <i class="fas fa-eye text-2xl text-purple-400"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2 text-center">Visibilité augmentée</h3>
            <p class="text-slate-400 text-center">Chaque site est conçu pour être performant, rapide et visible sur Google, même avec un petit budget.</p>
          </div>
          <div class="feature-card rounded-xl p-6 md:p-8 transition-all duration-300 hover:border-indigo-500/30 flex flex-col items-center">
            <div class="w-14 h-14 rounded-full bg-indigo-900/30 flex items-center justify-center mb-4">
              <i class="fas fa-user-friends text-2xl text-indigo-400"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2 text-center">Accompagnement</h3>
            <p class="text-slate-400 text-center">Formation offerte pour gérer votre site facilement et maintenance pour assurer son bon fonctionnement.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-8 md:py-12 bg-slate-800/50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8 md:mb-10">
          <h2 class="text-3xl md:text-4xl font-bold mb-4">Nos Services</h2>
          <p class="text-lg text-slate-400 max-w-2xl mx-auto">Des solutions adaptées à chaque besoin pour propulser votre présence en ligne.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-4 md:gap-6">
          <div class="card-hover bg-slate-900 rounded-xl overflow-hidden border border-slate-800 flex flex-col h-full">
            <div class="p-6 md:p-8 flex-1 flex flex-col">
              <div class="w-14 h-14 rounded-full bg-blue-900/30 flex items-center justify-center mb-4">
                <i class="fas fa-desktop text-2xl text-blue-400"></i>
              </div>
              <h3 class="text-xl font-semibold mb-2">Site One Page</h3>
              <p class="text-slate-400 mb-4">Valorisez efficacement votre activité avec un site clair et professionnel.</p>
              <ul class="space-y-2 mb-6">
                <li class="flex items-center text-slate-400">
                  <i class="fas fa-check-circle text-blue-400 mr-2"></i>
                  Présentation impactante
                </li>
                <li class="flex items-center text-slate-400">
                  <i class="fas fa-check-circle text-blue-400 mr-2"></i>
                  Intégration responsive
                </li>
                <li class="flex items-center text-slate-400">
                  <i class="fas fa-check-circle text-blue-400 mr-2"></i>
                  Formulaire de contact
                </li>
                <li class="flex items-center text-slate-400">
                  <i class="fas fa-check-circle text-blue-400 mr-2"></i>
                  Optimisation SEO
                </li>
              </ul>
              <a href="#contact" class="inline-flex items-center justify-center gap-2 w-full py-3 rounded-lg font-medium bg-gradient-to-r from-blue-500 to-purple-500 text-white hover:from-blue-600 hover:to-purple-600 transition mt-auto">
                <span>En savoir plus</span>
                <i class="fas fa-arrow-right"></i>
              </a>
            </div>
          </div>
          <div class="card-hover bg-slate-900 rounded-xl overflow-hidden border border-blue-500/30 flex flex-col h-full">
            <div class="p-6 md:p-8 flex-1 flex flex-col">
              <div class="w-14 h-14 rounded-full bg-purple-900/30 flex items-center justify-center mb-4">
                <i class="fas fa-layer-group text-2xl text-purple-400"></i>
              </div>
              <h3 class="text-xl font-semibold mb-2">Site Multi-Pages</h3>
              <p class="text-slate-400 mb-4">Développez votre présence en ligne avec un site complet.</p>
              <ul class="space-y-2 mb-6">
                <li class="flex items-center text-slate-400">
                  <i class="fas fa-check-circle text-purple-400 mr-2"></i>
                  Navigation claire
                </li>
                <li class="flex items-center text-slate-400">
                  <i class="fas fa-check-circle text-purple-400 mr-2"></i>
                  CMS intégré
                </li>
                <li class="flex items-center text-slate-400">
                  <i class="fas fa-check-circle text-purple-400 mr-2"></i>
                  Référencement optimisé
                </li>
                <li class="flex items-center text-slate-400">
                  <i class="fas fa-check-circle text-purple-400 mr-2"></i>
                  Formation incluse
                </li>
              </ul>
              <a href="#contact" class="inline-flex items-center justify-center gap-2 w-full py-3 rounded-lg font-medium bg-gradient-to-r from-purple-500 to-indigo-500 text-white hover:from-purple-600 hover:to-indigo-600 transition mt-auto">
                <span>En savoir plus</span>
                <i class="fas fa-arrow-right"></i>
              </a>
            </div>
          </div>
          <div class="card-hover bg-slate-900 rounded-xl overflow-hidden border border-slate-800 flex flex-col h-full">
            <div class="p-6 md:p-8 flex-1 flex flex-col">
              <div class="w-14 h-14 rounded-full bg-indigo-900/30 flex items-center justify-center mb-4">
                <i class="fas fa-paint-brush text-2xl text-indigo-400"></i>
              </div>
              <h3 class="text-xl font-semibold mb-2">Site Sur Mesure</h3>
              <p class="text-slate-400 mb-4">Un site entièrement personnalisé selon vos besoins spécifiques.</p>
              <ul class="space-y-2 mb-6">
                <li class="flex items-center text-slate-400">
                  <i class="fas fa-check-circle text-indigo-400 mr-2"></i>
                  Fonctions personnalisées
                </li>
                <li class="flex items-center text-slate-400">
                  <i class="fas fa-check-circle text-indigo-400 mr-2"></i>
                  Design unique
                </li>
                <li class="flex items-center text-slate-400">
                  <i class="fas fa-check-circle text-indigo-400 mr-2"></i>
                  Accompagnement dédié
                </li>
                <li class="flex items-center text-slate-400">
                  <i class="fas fa-check-circle text-indigo-400 mr-2"></i>
                  SEO avancé
                </li>
              </ul>
              <a href="#contact" class="inline-flex items-center justify-center gap-2 w-full py-3 rounded-lg font-medium bg-gradient-to-r from-indigo-500 to-blue-500 text-white hover:from-indigo-600 hover:to-blue-600 transition mt-auto">
                <span>En savoir plus</span>
                <i class="fas fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Responsive Section -->
    <section class="py-12 md:py-16 bg-gradient-to-b from-slate-900 to-slate-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10 items-center">
      <!-- COLONNE TEXTE -->
      <div>
        <h2 class="text-3xl md:text-4xl font-bold mb-6">100% Responsive</h2>
        <p class="text-lg text-slate-400 mb-8">
          Pour une TPE ou une PME, chaque visite compte. C’est pourquoi nous concevons des sites web optimisés pour tous les supports. Responsive, rapides et intuitifs, nos sites augmentent votre visibilité en ligne tout en offrant une image professionnelle dès la première impression.
        </p>
        <div class="grid grid-cols-2 gap-4">
          <div class="flex items-center">
            <i class="fas fa-check-circle text-blue-400 mr-2"></i>
            <span class="text-slate-300">Adaptation aux petits écrans</span>
          </div>
          <div class="flex items-center">
            <i class="fas fa-check-circle text-blue-400 mr-2"></i>
            <span class="text-slate-300">Chargement rapide</span>
          </div>
          <div class="flex items-center">
            <i class="fas fa-check-circle text-blue-400 mr-2"></i>
            <span class="text-slate-300">Navigation intuitive</span>
          </div>
          <div class="flex items-center">
            <i class="fas fa-check-circle text-blue-400 mr-2"></i>
            <span class="text-slate-300">Compatibilité tout navigateur</span>
          </div>
        </div>
      </div>
      
      <!-- COLONNE VISUEL -->
      <div class="relative flex items-center justify-center">
        <div class="relative bg-slate-800/80 rounded-2xl p-2 shadow-xl border border-blue-700/30 w-full">
          <!-- GIF mobile -->
          <img
            src="/video/iphone.gif"
            alt="Animation mobile"
            class="block md:hidden w-full h-auto object-contain rounded-2xl"
          />
          <!-- Vidéo tablette+ -->
          <video
            src="/video/iphone.mp4"
            autoplay
            loop
            muted
            playsinline
            class="hidden md:block w-full h-auto object-contain rounded-2xl"
          ></video>
        </div>
      </div>
      
    </div>
  </div>
</section>
                </div>
            </div>
        </div>
    </section>

<!-- Features Carousel -->
<section id="features" class="py-24 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 relative">
  <div class="absolute inset-0 pointer-events-none">
    <div class="w-96 h-96 bg-gradient-to-br from-blue-600/20 via-purple-600/10 to-transparent rounded-full blur-3xl absolute -top-32 -left-32"></div>
    <div class="w-96 h-96 bg-gradient-to-br from-indigo-600/20 via-blue-600/10 to-transparent rounded-full blur-3xl absolute -bottom-32 -right-32"></div>
  </div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="text-center mb-20">
      <h2 class="text-4xl md:text-5xl font-extrabold mb-4 text-white drop-shadow-lg">Fonctionnalités Avancées</h2>
      <p class="text-lg text-slate-100 max-w-2xl mx-auto">Des fonctionnalités pensées pour vous.</p>
    </div>

    <!-- Desktop / Tablette Carousel -->
    <div class="hidden md:block">
      <div class="relative overflow-x-hidden overflow-y-visible">
        <div id="features-carousel" class="flex transition-transform duration-700 ease-in-out">
          <!-- Slide 1 -->
          <div class="min-w-full px-2 md:px-8">
            <div
              class="grid md:grid-cols-2 gap-12 items-center bg-gradient-to-br from-blue-900/60 to-slate-900/80
                     rounded-3xl shadow-2xl border border-blue-700/20 p-10 md:p-16 relative overflow-hidden"
            >
              <div>
                <h3 class="text-3xl font-bold mb-4 text-blue-300 flex items-center gap-2">
                  <i class="fas fa-robot text-blue-400 text-2xl"></i>
                  Chatbot Avancé
                </h3>
                <p class="text-slate-300 mb-8 text-lg">
                  Un chatbot intelligent qui répond à vos clients 24h/24, simplifie le contact et vous fait gagner un temps précieux.
                </p>
                <ul class="space-y-4 mb-10">
                  <li class="flex items-center text-slate-200">
                    <span class="w-6 h-6 flex items-center justify-center bg-blue-800/40 rounded-full mr-3">
                      <i class="fas fa-check text-blue-400"></i>
                    </span>
                    Réponses en temps réel
                  </li>
                  <li class="flex items-center text-slate-200">
                    <span class="w-6 h-6 flex items-center justify-center bg-blue-800/40 rounded-full mr-3">
                      <i class="fas fa-check text-blue-400"></i>
                    </span>
                    Personnalisable selon votre activité
                  </li>
                  <li class="flex items-center text-slate-200">
                    <span class="w-6 h-6 flex items-center justify-center bg-blue-800/40 rounded-full mr-3">
                      <i class="fas fa-check text-blue-400"></i>
                    </span>
                    Prise de rendez-vous intégrée
                  </li>
                </ul>
              </div>
              <div class="relative flex items-center justify-center">
                <div class="absolute -inset-8 bg-gradient-to-tr from-blue-500/40 via-purple-500/20 to-transparent
                            rounded-3xl blur-2xl z-0"></div>
                <div class="relative bg-slate-800/80 rounded-2xl p-2 h-80 w-80 flex items-center justify-center
                            shadow-xl border border-blue-700/20">
                  <i class="fas fa-robot text-8xl text-blue-400 opacity-40 animate-bounce-slow"></i>
                </div>
              </div>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="min-w-full px-2 md:px-8">
            <div
              class="grid md:grid-cols-2 gap-12 items-center bg-gradient-to-br from-purple-900/60 to-slate-900/80
                     rounded-3xl shadow-2xl border border-purple-700/20 p-10 md:p-16 relative overflow-hidden"
            >
              <div>
                <h3 class="text-3xl font-bold mb-4 text-purple-300 flex items-center gap-2">
                  <i class="fas fa-lock text-purple-400 text-2xl"></i>
                  Portail Client
                </h3>
                <p class="text-slate-300 mb-8 text-lg">
                  Pilotez votre contenu en toute autonomie, sans aucune compétence technique. Créez, mettez à jour et programmez vos contenus depuis un seul endroit.
                </p>
                <ul class="space-y-4 mb-10">
                  <li class="flex items-center text-slate-200">
                    <span class="w-6 h-6 flex items-center justify-center bg-purple-800/40 rounded-full mr-3">
                      <i class="fas fa-check text-purple-400"></i>
                    </span>
                    Tableau de bord épuré
                  </li>
                  <li class="flex items-center text-slate-200">
                    <span class="w-6 h-6 flex items-center justify-center bg-purple-800/40 rounded-full mr-3">
                      <i class="fas fa-check text-purple-400"></i>
                    </span>
                    Gestion intuitive
                  </li>
                  <li class="flex items-center text-slate-200">
                    <span class="w-6 h-6 flex items-center justify-center bg-purple-800/40 rounded-full mr-3">
                      <i class="fas fa-check text-purple-400"></i>
                    </span>
                    Édition en ligne instantanée
                  </li>
                </ul>
              </div>
              <div class="relative flex items-center justify-center">
                <div class="absolute -inset-8 bg-gradient-to-tr from-purple-500/40 via-indigo-500/20 to-transparent
                            rounded-3xl blur-2xl z-0"></div>
                <div class="relative bg-slate-800/80 rounded-2xl p-2 h-80 w-80 flex items-center justify-center
                            shadow-xl border border-purple-700/20">
                  <i class="fas fa-lock text-8xl text-purple-400 opacity-40 animate-pulse"></i>
                </div>
              </div>
            </div>
          </div>

          <!-- Slide 3 -->
          <div class="min-w-full px-2 md:px-8">
            <div
              class="grid md:grid-cols-2 gap-12 items-center bg-gradient-to-br from-indigo-900/60 to-slate-900/80
                     rounded-3xl shadow-2xl border border-indigo-700/20 p-10 md:p-16 relative overflow-hidden"
            >
              <div>
                <h3 class="text-3xl font-bold mb-4 text-indigo-300 flex items-center gap-2">
                  <i class="fas fa-calendar-alt text-indigo-400 text-2xl"></i>
                  Planification en Ligne
                </h3>
                <p class="text-slate-300 mb-8 text-lg">
                  Offrez à vos visiteurs un parcours ultra-fluide : du formulaire à la confirmation du rendez-vous en quelques clics.
                </p>
                <ul class="space-y-4 mb-10">
                  <li class="flex items-center text-slate-200">
                    <span class="w-6 h-6 flex items-center justify-center bg-indigo-800/40 rounded-full mr-3">
                      <i class="fas fa-check text-indigo-400"></i>
                    </span>
                    Formulaire sur-mesure
                  </li>
                  <li class="flex items-center text-slate-200">
                    <span class="w-6 h-6 flex items-center justify-center bg-indigo-800/40 rounded-full mr-3">
                      <i class="fas fa-check text-indigo-400"></i>
                    </span>
                    Alertes à chaque demande
                  </li>
                  <li class="flex items-center text-slate-200">
                    <span class="w-6 h-6 flex items-center justify-center bg-indigo-800/40 rounded-full mr-3">
                      <i class="fas fa-check text-indigo-400"></i>
                    </span>
                    Synchronisation avec Google Agenda, Outlook, etc.
                  </li>
                </ul>
              </div>
              <div class="relative flex items-center justify-center">
                <div class="absolute -inset-8 bg-gradient-to-tr from-indigo-500/40 via-blue-500/20 to-transparent
                            rounded-3xl blur-2xl z-0"></div>
                <div class="relative bg-slate-800/80 rounded-2xl p-2 h-80 w-80 flex items-center justify-center
                            shadow-xl border border-indigo-700/20">
                <i class="fas fa-calendar-alt text-8xl text-indigo-400 opacity-40 animate-float"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Carousel Controls -->
        <div class="flex justify-center mt-14 space-x-4">
          <button id="features-carousel-btn-left" onclick="moveCarousel(-1)"
            class="w-12 h-12 rounded-full bg-slate-800/80 border border-slate-700 flex items-center justify-center hover:bg-blue-700/40 hover:scale-110 transition shadow-lg">
            <i class="fas fa-chevron-left text-2xl text-slate-300"></i>
          </button>
          <button id="features-carousel-btn-right" onclick="moveCarousel(1)"
            class="w-12 h-12 rounded-full bg-slate-800/80 border border-slate-700 flex items-center justify-center hover:bg-blue-700/40 hover:scale-110 transition shadow-lg">
            <i class="fas fa-chevron-right text-2xl text-slate-300"></i>
          </button>
        </div>

        <!-- Carousel Dots -->
        <div class="flex justify-center mt-6 space-x-3">
          <div class="flex bg-slate-900/70 px-4 py-2 rounded-full shadow-lg backdrop-blur-sm items-center gap-3">
            <button class="carousel-dot w-5 h-5 rounded-full bg-blue-500/30 border-2 border-blue-500"
              onclick="moveCarouselTo(0)"></button>
            <button class="carousel-dot w-5 h-5 rounded-full bg-purple-500/30 border-2 border-purple-500"
              onclick="moveCarouselTo(1)"></button>
            <button class="carousel-dot w-5 h-5 rounded-full bg-indigo-500/30 border-2 border-indigo-500"
              onclick="moveCarouselTo(2)"></button>
          </div>
        </div>
      </div>
    </div>

<!-- Mobile Carousel -->
<div class="md:hidden">
    <div
        id="features-carousel-mobile"
        class="flex overflow-x-auto snap-x snap-mandatory gap-6 pb-6 px-4"
        style="-webkit-overflow-scrolling: touch;"
    >
        <!-- Slide 1 -->
        <div class="bg-slate-900/80 rounded-2xl p-6 flex-shrink-0 flex flex-col items-center justify-between
                    border border-blue-700/20 shadow-xl w-72 max-w-xs snap-center mx-auto"
             style="scroll-snap-align: center; min-width: 80vw; max-width: 320px;">
            <div class="w-12 h-12 rounded-full bg-blue-900/30 flex items-center justify-center mb-4">
            <i class="fas fa-robot text-xl text-blue-400"></i>
            </div>
            <h3 class="text-lg font-semibold mb-2">Chatbot Avancé</h3>
            <p class="text-slate-400 text-center text-sm mb-2">
            Un assistant intelligent qui répond à vos clients 24h/24 et simplifie la prise de contact.
            </p>
        </div>
        <!-- Slide 2 -->
        <div class="bg-slate-900/80 rounded-2xl p-6 flex-shrink-0 flex flex-col items-center justify-between
                    border border-purple-700/20 shadow-xl w-72 max-w-xs snap-center mx-auto"
             style="scroll-snap-align: center; min-width: 80vw; max-width: 320px;">
            <div class="w-12 h-12 rounded-full bg-purple-900/30 flex items-center justify-center mb-4">
            <i class="fas fa-lock text-xl text-purple-400"></i>
            </div>
            <h3 class="text-lg font-semibold mb-2">Portail Client</h3>
            <p class="text-slate-400 text-center text-sm mb-2">
            Gérez vos contenus facilement et en toute autonomie grâce à un espace sécurisé et intuitif.
            </p>
        </div>
        <!-- Slide 3 -->
        <div class="bg-slate-900/80 rounded-2xl p-6 flex-shrink-0 flex flex-col items-center justify-between
                    border border-indigo-700/20 shadow-xl w-72 max-w-xs snap-center mx-auto"
             style="scroll-snap-align: center; min-width: 80vw; max-width: 320px;">
            <div class="w-12 h-12 rounded-full bg-indigo-900/30 flex items-center justify-center mb-4">
            <i class="fas fa-envelope-open-text text-xl text-indigo-400"></i>
            </div>
            <h3 class="text-lg font-semibold mb-2">Formulaire de Contact</h3>
            <p class="text-slate-400 text-center text-sm mb-2">
            Un formulaire simple pour être contacté et permettre à vos clients de prendre rendez-vous en ligne.
            </p>
        </div>
    </div>

    <!-- Dots mobile -->
    <div id="features-carousel-mobile-dots" class="flex justify-center mt-4 space-x-2">
        <button class="w-3 h-3 rounded-full bg-blue-500 opacity-80"></button>
        <button class="w-3 h-3 rounded-full bg-purple-500 opacity-40"></button>
        <button class="w-3 h-3 rounded-full bg-indigo-500 opacity-40"></button>
    </div>
</div>
</section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-20 bg-slate-800/50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-3xl md:text-4xl font-bold mb-4">Nos Réalisations</h2>
          <p class="text-lg text-slate-400 max-w-2xl mx-auto">Découvrez quelques-uns de nos projets.</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
   <!-- Project 1 -->
    <div class="card-hover bg-slate-900 rounded-xl overflow-hidden border border-slate-800">
        <div class="h-48 bg-gradient-to-br from-blue-900/30 to-purple-900/30 flex items-center justify-center">
            <i class="fas fa-chalkboard-teacher text-6xl text-blue-400 opacity-30"></i>
        </div>
        <div class="p-6">
            <h3 class="text-xl font-semibold mb-2">Plateforme de Formation</h3>
            <p class="text-slate-400 text-sm mb-4">Site web dédié à la formation en ligne, avec gestion des cours, espace apprenant et suivi personnalisé.</p>
            <div class="flex flex-wrap gap-2 mb-4">
                <span class="text-xs bg-blue-900/30 text-blue-400 px-3 py-1 rounded-full">Espace Apprenti</span>
                <span class="text-xs bg-indigo-900/30 text-indigo-400 px-3 py-1 rounded-full">FAQ</span>
            </div>
            <a href="./site-example/formapro.html" class="text-blue-400 hover:text-blue-300 text-sm font-medium flex items-center">
                Voir le projet <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>

    <!-- Project 2 -->
    <div class="card-hover bg-slate-900 rounded-xl overflow-hidden border border-slate-800">
        <div class="h-48 bg-gradient-to-br from-purple-900/30 to-indigo-900/30 flex items-center justify-center">
            <i class="fas fa-hammer text-6xl text-purple-400 opacity-30"></i>
        </div>
        <div class="p-6">
            <h3 class="text-xl font-semibold mb-2">Site Menuisier Premium</h3>
            <p class="text-slate-400 text-sm mb-4">Site vitrine pour un menuisier, avec galerie de réalisations, prise de rendez-vous et demande de devis en ligne.</p>
            <div class="flex flex-wrap gap-2 mb-4">
                <span class="text-xs bg-purple-900/30 text-purple-400 px-3 py-1 rounded-full">Formulaire Devis</span>
                <span class="text-xs bg-indigo-900/30 text-indigo-400 px-3 py-1 rounded-full">Galerie Photo</span>
            </div>
            <a href="./site-example/menuisier.html" class="text-blue-400 hover:text-blue-300 text-sm font-medium flex items-center">
                Voir le projet <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>

    <!-- Project 3 -->
    <div class="card-hover bg-slate-900 rounded-xl overflow-hidden border border-slate-800">
        <div class="h-48 bg-gradient-to-br from-blue-900/30 to-purple-900/30 flex items-center justify-center">
            <i class="fas fa-cut text-6xl text-blue-400 opacity-30"></i>
        </div>
        <div class="p-6">
            <h3 class="text-xl font-semibold mb-2">Salon de Coiffure Moderne</h3>
            <p class="text-slate-400 text-sm mb-4">Site vitrine pour salon de coiffure avec prise de rendez-vous en ligne, carrousel de prix et galerie photo.</p>
            <div class="flex flex-wrap gap-2 mb-4">
                <span class="text-xs bg-purple-900/30 text-purple-400 px-3 py-1 rounded-full">Booking</span>
                <span class="text-xs bg-indigo-900/30 text-indigo-400 px-3 py-1 rounded-full">Carrousel Prix</span>
            </div>
            <a href="./site-example/coiffure.html" class="text-blue-400 hover:text-blue-300 text-sm font-medium flex items-center">
                Voir le projet <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</div>

        <div class="text-center mt-12">
          <a href="gallerie.html" class="btn-secondary inline-flex items-center px-8 py-3 rounded-full font-medium">
            Voir tous nos projets <i class="fas fa-arrow-right ml-2"></i>
          </a>
        </div>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Ce qu'ils disent de nous</h2>
                <p class="text-lg text-slate-400 max-w-2xl mx-auto">Nos clients partagent leur expérience avec Eneby Vision.</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="testimonial-card rounded-xl p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-full bg-blue-900/30 flex items-center justify-center mr-4">
                            <i class="fas fa-user text-xl text-blue-400"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Alexandre M.</h4>
                            <p class="text-sm text-slate-500">Coiffeur</p>
                        </div>
                    </div>
                    <p class="text-slate-400 italic">
                        "Avec Eneby Vision, j’ai enfin un site à l’image de mon salon. Mes clientes peuvent prendre rendez-vous en ligne en quelques clics. Service très professionnel."
                    </p>
                    <div class="flex mt-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                </div>
                
                <div class="testimonial-card rounded-xl p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-full bg-purple-900/30 flex items-center justify-center mr-4">
                            <i class="fas fa-user text-xl text-purple-400"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Nathalie L.</h4>
                            <p class="text-sm text-slate-500">Cuisiniste</p>
                        </div>
                    </div>
                    <p class="text-slate-400 italic">
                        "Grâce à Eneby, mon site met en avant mes cuisines sur mesure avec un design épuré et des visuels de qualité. Le chatbot est un réel gain de temps"
                    </p>
                    <div class="flex mt-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                </div>
                
                <div class="testimonial-card rounded-xl p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-full bg-indigo-900/30 flex items-center justify-center mr-4">
                            <i class="fas fa-user text-xl text-indigo-400"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Thomas D.</h4>
                            <p class="text-sm text-slate-500">Plombier</p>
                        </div>
                    </div>
                    <p class="text-slate-400 italic">
                        "Eneby Vision a permis à mon entreprise d’accroître sa visibilité. Leur équipe, toujours à l’écoute, a parfaitement concrétisé mes idées."
                    </p>
                    <div class="flex mt-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star-half-alt text-yellow-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="py-20 bg-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Notre Équipe</h2>
                <p class="text-lg text-slate-400 max-w-2xl mx-auto">Une équipe à votre écoute pour mener à bien vos projets web.</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 max-w-4xl mx-auto">
                <div class="team-card bg-slate-900 rounded-xl p-8 text-center border border-slate-800">
                    <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-user-tie text-5xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Emmanuel Lethiec</h3>
                    <p class="text-blue-400 font-medium mb-4">Développeur</p>
                    <p class="text-slate-400 mb-6">
                        Expert en création de site web, Emmanuel supervise chaque projet pour garantir qualité et performance.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="#contact" class="text-slate-400 hover:text-blue-400">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>
                
                <div class="team-card bg-slate-900 rounded-xl p-8 text-center border border-slate-800">
                    <div class="w-32 h-32 rounded-full bg-gradient-to-br from-purple-500 to-indigo-500 mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-paint-brush text-5xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Dora Blanchard</h3>
                    <p class="text-purple-400 font-medium mb-4">Designer</p>
                    <p class="text-slate-400 mb-6">
                        Dora crée pour chaque projet une identité visuelle unique, moderne et adaptée à votre image.
                    </p>
                    <div class="flex justify-center space-x-4">                     
                        <a href="#contact" class="text-slate-400 hover:text-purple-400">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="process" class="pt-24 pb-0 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 relative">
        <div class="absolute inset-0 pointer-events-none">
            <div class="w-96 h-96 bg-gradient-to-br from-blue-600/20 via-purple-600/10 to-transparent rounded-full blur-3xl absolute -top-32 -left-32"></div>
            <div class="w-96 h-96 bg-gradient-to-br from-indigo-600/20 via-blue-600/10 to-transparent rounded-full blur-3xl absolute -bottom-32 -right-32"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-4 text-white drop-shadow-lg">Notre Processus</h2>
                <p class="text-lg text-slate-100 max-w-2xl mx-auto">Un parcours fluide pour un site efficace</p>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-center md:items-stretch gap-10 max-w-6xl mx-auto">
                <!-- Step 1 -->
                <div class="process-step flex flex-col items-center text-center bg-slate-900/60 rounded-2xl shadow-xl border border-blue-700/20 px-6 py-10 relative transition hover:scale-105 hover:border-blue-500/40">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500/30 to-blue-900/30 flex items-center justify-center mb-4 shadow-lg">
                        <span class="text-blue-400 font-bold text-2xl">1</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-blue-200">Brief & Analyse</h3>
                    <p class="text-slate-300 text-sm">
                        Nous étudions vos besoins, votre marché et vos objectifs pour définir un projet sur mesure.
                    </p>
                </div>
                <!-- Step 2 -->
                <div class="process-step flex flex-col items-center text-center bg-slate-900/60 rounded-2xl shadow-xl border border-purple-700/20 px-6 py-10 relative transition hover:scale-105 hover:border-purple-500/40">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-purple-500/30 to-purple-900/30 flex items-center justify-center mb-4 shadow-lg">
                        <span class="text-purple-400 font-bold text-2xl">2</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-purple-200">Design & Prototype</h3>
                    <p class="text-slate-300 text-sm">
                        Nous réalisons des maquettes fidèles à votre image, soumises à votre validation.
                    </p>
                </div>
                <!-- Step 3 -->
                <div class="process-step flex flex-col items-center text-center bg-slate-900/60 rounded-2xl shadow-xl border border-indigo-700/20 px-6 py-10 relative transition hover:scale-105 hover:border-indigo-500/40">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-500/30 to-indigo-900/30 flex items-center justify-center mb-4 shadow-lg">
                        <span class="text-indigo-400 font-bold text-2xl">3</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-indigo-200">Développement & Intégration</h3>
                    <p class="text-slate-300 text-sm">
                        Nous intégrons des technologies modernes et des fonctionnalités clés.
                    </p>
                </div>
                <!-- Step 4 -->
                <div class="process-step flex flex-col items-center text-center bg-slate-900/60 rounded-2xl shadow-xl border border-blue-700/20 px-6 py-10 relative transition hover:scale-105 hover:border-blue-500/40">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500/30 to-blue-900/30 flex items-center justify-center mb-4 shadow-lg">
                        <span class="text-blue-400 font-bold text-2xl">4</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-blue-200">Tests & Optimisation</h3>
                    <p class="text-slate-300 text-sm">
                        Nous vérifions ergonomie, performance et compatibilité, puis ajustons chaque détail.
                    </p>
                </div>
                <!-- Step 5 -->
                <div class="process-step flex flex-col items-center text-center bg-slate-900/60 rounded-2xl shadow-xl border border-purple-700/20 px-6 py-10 relative transition hover:scale-105 hover:border-purple-500/40">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-purple-500/30 to-purple-900/30 flex items-center justify-center mb-4 shadow-lg">
                        <span class="text-purple-400 font-bold text-2xl">5</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-purple-200">Livraison & Suivi</h3>
                    <p class="text-slate-300 text-sm">
                        Nous déployons votre site et assurons maintenance, mises à jour et évolutions.
                    </p>
                </div>
            </div>
            <!-- Decorative connectors for desktop (removed) -->
        </div>
    </section>

<!-- Contact Section -->
<section id="contact" class="pt-0 pb-16 sm:pb-20 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-12 items-center">

      <!-- Texte + infos -->
      <div class="flex flex-col items-center md:items-start text-center md:text-left mb-10 md:mb-0">
        <h2 class="text-3xl md:text-4xl font-bold mb-4 md:mb-6">
          Prêt à démarrer votre projet ?
        </h2>
        <p class="text-lg text-slate-400 mb-6 md:mb-8 max-w-lg">
          Contactez-nous pour discuter de votre projet et obtenir un devis personnalisé.
          Notre équipe est à votre écoute pour concrétiser vos idées digitales.
        </p>

        <!-- Infos de contact mobile -->
        <div class="w-full md:hidden space-y-4 bg-slate-800/50 rounded-lg p-4 border border-slate-700 mb-3">
          <div class="flex items-center space-x-3">
            <i class="fas fa-envelope text-blue-400 w-6 text-lg"></i>
            <a href="mailto:contact@enebyvision.com" class="text-slate-200 text-sm">contact@enebyvision.com</a>
          </div>
          <div class="flex items-center space-x-3">
            <i class="fas fa-phone-alt text-purple-400 w-6 text-lg"></i>
            <a href="tel:+33782067635" class="text-slate-200 text-sm">+33 7 82 06 76 35</a>
          </div>
        </div>

        <!-- Infos Desktop -->
        <div class="hidden md:grid grid-cols-1 space-y-6 w-full max-w-xs">
          <div class="flex items-start">
            <div class="w-10 h-10 rounded-full bg-blue-900/30 flex items-center justify-center">
              <i class="fas fa-envelope text-blue-400"></i>
            </div>
            <div class="ml-4 text-left">
              <h3 class="text-sm font-semibold text-slate-300 mb-1">Email</h3>
              <p class="text-sm text-slate-400">contact@enebyvision.com</p>
            </div>
          </div>
          <div class="flex items-start">
            <div class="w-10 h-10 rounded-full bg-purple-900/30 flex items-center justify-center">
              <i class="fas fa-phone-alt text-purple-400"></i>
            </div>
            <div class="ml-4 text-left">
              <h3 class="text-sm font-semibold text-slate-300 mb-1">Téléphone</h3>
              <p class="text-sm text-slate-400">+33 7 82 06 76 35</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Formulaire -->


<form class="space-y-5" action="send.php" method="POST">

  <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">


  <input type="text" name="website" style="display:none" autocomplete="off">

  <div>
    <label for="name" class="block text-sm font-medium text-slate-300 mb-1">Nom complet</label>
    <input type="text" id="name" name="name" required
      class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded text-slate-200 text-base
             focus:outline-none focus:ring-2 focus:ring-blue-500"
      placeholder="Votre nom">
  </div>
  <div>
    <label for="email" class="block text-sm font-medium text-slate-300 mb-1">
      Email <span class="text-red-500">*</span>
    </label>
    <input type="email" id="email" name="email" required
      class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded text-slate-200 text-base
             focus:outline-none focus:ring-2 focus:ring-blue-500"
      placeholder="votre@email.com">
  </div>
  <div>
    <label for="phone" class="block text-sm font-medium text-slate-300 mb-1">
      Téléphone <span class="text-red-500">*</span>
    </label>
    <input type="tel" id="phone" name="phone" required
      class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded text-slate-200 text-base
             focus:outline-none focus:ring-2 focus:ring-purple-500"
      placeholder="+33 6 12 34 56 78">
  </div>
  <div>
    <label for="project" class="block text-sm font-medium text-slate-300 mb-1">Type de projet</label>
    <select id="project" name="project"
      class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded text-slate-200 text-base
             focus:outline-none focus:ring-2 focus:ring-blue-500">
      <option>Sélectionnez une option</option>
      <option>Site Vitrine</option>
      <option>Site Multi-Pages</option>
      <option>Solution IA</option>
      <option>Autre</option>
    </select>
  </div>
  <div>
    <label for="message" class="block text-sm font-medium text-slate-300 mb-1">Message</label>
    <textarea id="message" name="message" rows="4"
      class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded text-slate-200 text-base
             focus:outline-none focus:ring-2 focus:ring-blue-500"
      placeholder="Décrivez votre projet..."></textarea>
  </div>
  <button type="submit"
    class="btn-primary w-full py-3 rounded font-medium text-base flex items-center justify-center">
    Envoyer <i class="fas fa-paper-plane ml-2"></i>
  </button>
</form>

    </div>
  </div>
</section>
<script src="./chatbot.js"></script>

<!-- ====== FOOTER ====== -->
<footer class="bg-slate-900 border-t border-slate-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Version desktop (écran ≥ md) -->
    <div class="hidden md:grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
      <div>
        <h3 class="text-lg font-semibold text-slate-200 mb-4">Eneby Vision</h3>
        <p class="text-sm text-slate-400">
          Création de sites web intelligents combinant design élégant et tech avancées.
        </p>
      </div>
      <div>
        <h3 class="text-lg font-semibold text-slate-200 mb-4">Services</h3>
        <ul class="space-y-2">
          <li><a href="#services" class="text-sm text-slate-400 hover:text-blue-400">Sites Vitrine</a></li>
          <li><a href="#services" class="text-sm text-slate-400 hover:text-blue-400">Multi-Pages</a></li>
          <li><a href="#services" class="text-sm text-slate-400 hover:text-blue-400">Sur Mesure</a></li>
        </ul>
      </div>
      <div>
        <h3 class="text-lg font-semibold text-slate-200 mb-4">Liens utiles</h3>
        <ul class="space-y-2">
          <li><a href="#portfolio" class="text-sm text-slate-400 hover:text-blue-400">Portfolio</a></li>
          <li><a href="#process" class="text-sm text-slate-400 hover:text-blue-400">Processus</a></li>
          <li><a href="#contact" class="text-sm text-slate-400 hover:text-blue-400">Contact</a></li>
        </ul>
      </div>
      <div>
        <h3 class="text-lg font-semibold text-slate-200 mb-4">Légal</h3>
        <ul class="space-y-2">
          <li><a href="legal.html#mentions-legales" class="text-sm text-slate-400 hover:text-blue-400">Mentions légales</a></li>
          <li><a href="legal.html#politique-confidentialite" class="text-sm text-slate-400 hover:text-blue-400">Confidentialité</a></li>
          <li><a href="legal.html#cgv" class="text-sm text-slate-400 hover:text-blue-400">CGV</a></li>
          <li><a href="legal.html#cookies" class="text-sm text-slate-400 hover:text-blue-400">Cookies</a></li>
        </ul>
      </div>
    </div>

    <!-- Version mobile (écran < md) -->
    <div class="md:hidden flex flex-col items-center justify-center text-center py-6 px-2">
      <h3 class="text-lg font-semibold text-slate-200 mb-2">Eneby Vision</h3>
      <p class="text-xs text-slate-400 mb-4 max-w-xs">Création de sites web intelligents.</p>
      <div class="flex space-x-6 mb-2">
        <a href="#" class="text-slate-500 hover:text-blue-400 text-xl" aria-label="LinkedIn">
          <i class="fab fa-linkedin-in"></i>
        </a>
      </div>
       <div class="flex flex-wrap justify-center gap-2 text-[10px]">
    <a href="legal.html#mentions-legales"
       class="text-slate-400 hover:text-blue-400 underline">
       Mentions légales
    </a>
    <span class="text-slate-500">•</span>
    <a href="legal.html#politique-confidentialite"
       class="text-slate-400 hover:text-blue-400 underline">
       Politique de confidentialité
    </a>
    <span class="text-slate-500">•</span>
    <a href="legal.html#cgv"
       class="text-slate-400 hover:text-blue-400 underline">
       CGV
    </a>
    <span class="text-slate-500">•</span>
    <a href="legal.html#cookies"
       class="text-slate-400 hover:text-blue-400 underline">
       Cookies
    </a>
  </div>
      <p class="text-[11px] text-slate-500 mt-2">© Eneby Vision</p>
    </div>

  </div>
</footer>
<!-- ====== FIN FOOTER ====== -->

    <script src="main.js"></script>
</body>
</html>