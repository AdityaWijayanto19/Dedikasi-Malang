<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dedikasi Jember - Welcome</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        :root {
            --primary-yellow: #ffc107; /* Warna utama kuning */
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
            --gray-color: #95a5a6;
            --white-color: #ffffff;
            --section-bg: #f9f9f9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-color);
            background-color: var(--white-color);
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Header & Navigation */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 1rem 0;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: top 0.3s;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--dark-color);
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        
        .nav-logo i {
            color: var(--primary-yellow);
            margin-right: 10px;
        }

        .nav-menu {
            list-style: none;
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            text-decoration: none;
            color: var(--dark-color);
            font-weight: 500;
            position: relative;
            transition: color 0.3s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--primary-yellow);
            transition: width 0.3s;
        }

        .nav-link:hover {
            color: var(--primary-yellow);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-toggle {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: var(--white-color);
        }

        .hero-logo i {
            font-size: 5rem;
            margin-bottom: 1rem;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .hero .social-icons {
            margin-top: 2rem;
            display: flex;
            gap: 1.5rem;
        }

        .hero .social-icons a {
            color: var(--white-color);
            font-size: 1.5rem;
            transition: color 0.3s, transform 0.3s;
        }

        .hero .social-icons a:hover {
            color: var(--primary-yellow);
            transform: translateY(-5px);
        }
        
        .scroll-down {
            position: absolute;
            bottom: 30px;
            font-size: 2rem;
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            60% {
                transform: translateY(-10px);
            }
        }

        /* General Section Styling */
        .section {
            padding: 6rem 0;
        }
        
        .section:nth-child(even) {
            background-color: var(--section-bg);
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            width: 80px;
            height: 4px;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--primary-yellow);
        }

        .grid-2-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }
        
        /* Profile Section */
        #profile .profile-img {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        #profile h3 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        #profile p {
            line-height: 1.8;
        }
        
        /* Vision & Mission Section */
        #vision-mission h3 {
             font-size: 1.8rem;
             margin-bottom: 1.5rem;
             color: var(--primary-yellow);
        }
        
        #vision-mission ul {
            list-style: none;
        }
        
        #vision-mission li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        
        #vision-mission li i {
            color: var(--primary-yellow);
            margin-right: 15px;
            margin-top: 5px;
        }

        /* Team Section */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .team-member {
            text-align: center;
            background: var(--white-color);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--primary-yellow);
            margin-bottom: 1rem;
        }

        .team-member h4 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .team-member p {
            color: var(--gray-color);
        }
        
        /* SDGs Section */
        .sdg-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 2rem;
            text-align: center;
        }
        
        .sdg-item {
            background: var(--white-color);
            padding: 2rem;
            border-radius: 15px;
        }
        
        .sdg-item i {
            font-size: 3rem;
            color: var(--primary-yellow);
            margin-bottom: 1rem;
        }
        
        /* Roadmap Section */
        .roadmap-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }
        
        .roadmap-card {
            background: var(--white-color);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }
        
        .roadmap-card:hover {
            transform: scale(1.05);
        }
        
        .roadmap-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .roadmap-card-content {
            padding: 1.5rem;
        }
        
        .roadmap-card-content h4 {
            font-size: 1.2rem;
        }
        
        /* CTA Button */
        .btn {
            display: inline-block;
            background-color: var(--primary-yellow);
            color: var(--dark-color);
            padding: 0.8rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn:hover {
            background-color: #e6ac00;
            transform: translateY(-3px);
        }
        
        /* Footer */
        .footer {
            background-color: var(--dark-color);
            color: var(--light-color);
            padding: 4rem 0 2rem;
            text-align: center;
        }
        
        .footer-logo {
             font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }
        
        .footer-logo i {
            color: var(--primary-yellow);
        }
        
        .footer-socials {
            margin: 2rem 0;
        }
        
        .footer-socials a {
            color: var(--light-color);
            font-size: 1.5rem;
            margin: 0 1rem;
            transition: color 0.3s;
        }
        
        .footer-socials a:hover {
            color: var(--primary-yellow);
        }
        
        .footer-copyright {
            border-top: 1px solid var(--gray-color);
            padding-top: 2rem;
            margin-top: 2rem;
            font-size: 0.9rem;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu {
                position: fixed;
                top: 0;
                right: -100%;
                width: 70%;
                height: 100vh;
                background-color: var(--white-color);
                flex-direction: column;
                justify-content: center;
                align-items: center;
                box-shadow: -5px 0 15px rgba(0,0,0,0.1);
                transition: right 0.4s ease-in-out;
            }
            
            .nav-menu.active {
                right: 0;
            }
            
            .nav-toggle {
                display: block;
                z-index: 1001; /* Must be on top */
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .grid-2-col {
                grid-template-columns: 1fr;
            }
            
            #profile .profile-img {
                order: -1; /* Display image on top on mobile */
            }
        }
        
        /* Scroll Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
    </style>
</head>
<body>

    <!-- Header -->
    <header class="header" id="header">
        <nav class="navbar container">
            <a href="#" class="nav-logo">
                <i class="fas fa-leaf"></i> Dedikasi Jember
            </a>
            <ul class="nav-menu" id="nav-menu">
                <li><a href="#hero" class="nav-link">Beranda</a></li>
                <li><a href="#profile" class="nav-link">Profil</a></li>
                <li><a href="#vision-mission" class="nav-link">Visi & Misi</a></li>
                <li><a href="#team" class="nav-link">Tim</a></li>
                <li><a href="#roadmap" class="nav-link">Kegiatan</a></li>
                <li><a href="#contact" class="nav-link">Kontak</a></li>
            </ul>
            <div class="nav-toggle" id="nav-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </nav>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero" id="hero">
            <div class="hero-logo">
                <i class="fas fa-seedling"></i>
            </div>
            <h1>DEDIKASI JEMBER</h1>
            <p>Ruang Kolaboratif Pemuda untuk Pembangunan Berkelanjutan</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            <a href="#profile" class="scroll-down"><i class="fas fa-chevron-down"></i></a>
        </section>

        <!-- Profile Section -->
        <section class="section fade-in" id="profile">
            <div class="container grid-2-col">
                <div>
                    <h2 class="section-title">Profil Dedikasi Jember</h2>
                    <h3>Meningkatkan Kepedulian, Menumbuhkan Empati</h3>
                    <p>
                        Dedikasi Jember merupakan ruang kolaboratif bagi pemuda-pemudi Indonesia untuk meningkatkan kepedulian, menumbuhkan empati, serta mengasah kepekaan sosial terhadap masyarakat dan lingkungan. Melalui berbagai aksi pengabdian yang berkelanjutan, Dedikasi Jember mendorong lahirnya kontribusi nyata generasi muda demi tercapainya pembangunan masyarakat yang inklusif dan berdaya.
                    </p>
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=2070&auto=format&fit=crop" alt="Volunteers" class="profile-img">
                </div>
            </div>
        </section>
        
        <!-- Vision & Mission Section -->
        <section class="section fade-in" id="vision-mission">
            <div class="container grid-2-col">
                 <div>
                    <h3>Visi</h3>
                    <p>Menciptakan wadah untuk mendorong pemuda-pemudi Indonesia menjadi garda terdepan perubahan guna memberikan kebermanfaatan bagi masyarakat melalui program pengabdian.</p>
                </div>
                <div>
                    <h3>Misi</h3>
                    <ul>
                        <li><i class="fas fa-check-circle"></i>Melaksanakan program kerja melalui berbagai bidang kegiatan yang relevan.</li>
                        <li><i class="fas fa-check-circle"></i>Menjalin hubungan dengan stakeholder terkait untuk kegiatan yang harmonis.</li>
                        <li><i class="fas fa-check-circle"></i>Memberdayakan masyarakat sekitar dalam setiap program kegiatan.</li>
                        <li><i class="fas fa-check-circle"></i>Memberdayakan potensi pemuda-pemudi melalui inovasi dan komitmen.</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="section fade-in" id="team">
            <div class="container">
                <h2 class="section-title">Tim Dedikasi Jember</h2>
                <div class="team-grid">
                    <!-- Team Member 1 -->
                    <div class="team-member">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=1888&auto=format&fit=crop" alt="Team Member 1">
                        <h4>Uli Maratul Azizah</h4>
                        <p>Leader</p>
                    </div>
                    <!-- Team Member 2 -->
                    <div class="team-member">
                        <img src="https://images.unsplash.com/photo-1554151228-14d9def656e4?q=80&w=1886&auto=format&fit=crop" alt="Team Member 2">
                        <h4>Adele Ekia</h4>
                        <p>Finance</p>
                    </div>
                    <!-- Team Member 3 -->
                    <div class="team-member">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=1887&auto=format&fit=crop" alt="Team Member 3">
                        <h4>Moh Bagus Zainur R.</h4>
                        <p>Project Planner</p>
                    </div>
                    <!-- Team Member 4 -->
                    <div class="team-member">
                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=1961&auto=format&fit=crop" alt="Team Member 4">
                        <h4>Siti Kholifah</h4>
                        <p>Public Relations</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- SDGs Section -->
        <section class="section fade-in" id="sdgs">
            <div class="container">
                <h2 class="section-title">Bidang Dedikasi & SDGs</h2>
                 <p style="text-align: center; max-width: 800px; margin: -2rem auto 3rem auto;">
                    Dedikasi Jember terfokus dalam berbagai bidang pengabdian yang terarah dengan tujuan keberlanjutan yang sering disebut SDGs.
                </p>
                <div class="sdg-grid">
                    <div class="sdg-item"><i class="fas fa-graduation-cap"></i><h4>Pendidikan</h4></div>
                    <div class="sdg-item"><i class="fas fa-heartbeat"></i><h4>Kesehatan</h4></div>
                    <div class="sdg-item"><i class="fas fa-users"></i><h4>Sosial</h4></div>
                    <div class="sdg-item"><i class="fas fa-leaf"></i><h4>Lingkungan</h4></div>
                    <div class="sdg-item"><i class="fas fa-landmark"></i><h4>Kebudayaan</h4></div>
                    <div class="sdg-item"><i class="fas fa-lightbulb"></i><h4>Kreatif</h4></div>
                </div>
            </div>
        </section>

        <!-- Roadmap Section -->
        <section class="section fade-in" id="roadmap">
            <div class="container">
                <h2 class="section-title">Roadmap Kegiatan</h2>
                <div class="roadmap-grid">
                    <div class="roadmap-card">
                        <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2070&auto=format&fit=crop" alt="Kegiatan 1">
                        <div class="roadmap-card-content">
                            <h4>Dedikasi Batch 1</h4>
                            <p>Warna-Warni Ekspresi</p>
                        </div>
                    </div>
                     <div class="roadmap-card">
                        <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2070&auto=format&fit=crop" alt="Kegiatan 2">
                        <div class="roadmap-card-content">
                            <h4>Dedikasi Batch 2</h4>
                            <p>Belajar dan Berkreasi untuk Bumi</p>
                        </div>
                    </div>
                     <div class="roadmap-card">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2070&auto=format&fit=crop" alt="Kegiatan 3">
                        <div class="roadmap-card-content">
                            <h4>Dedikasi Batch 3</h4>
                            <p>Dedikasi Merajut Mimpi</p>
                        </div>
                    </div>
                     <div class="roadmap-card">
                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=2232&auto=format&fit=crop" alt="Kegiatan 4">
                        <div class="roadmap-card-content">
                            <h4>Dedikasi Batch 4</h4>
                            <p>Dedikasi Batik Indonesia</p>
                        </div>
                    </div>
                </div>
                <div style="text-align: center; margin-top: 3rem;">
                    <a href="#" class="btn">Lihat Semua Kegiatan</a>
                </div>
            </div>
        </section>
        
        <!-- Contact/Registration Section -->
        <section class="section fade-in" id="contact">
            <div class="container" style="text-align: center;">
                 <h2 class="section-title">Daftar Kegiatan</h2>
                 <p style="margin-bottom: 2rem;">Jadilah bagian dari perubahan. Daftarkan dirimu sekarang!</p>
                 <a href="#" class="btn">Informasi Kegiatan</a>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-logo">
                <i class="fas fa-leaf"></i> Dedikasi Jember
            </div>
            <div class="footer-socials">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
            <div class="footer-copyright">
                &copy; <span id="year"></span> Dedikasi Jember. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Navigation
            const navToggle = document.getElementById('nav-toggle');
            const navMenu = document.getElementById('nav-menu');

            navToggle.addEventListener('click', () => {
                navMenu.classList.toggle('active');
                // Change icon to 'X' when menu is open
                navToggle.innerHTML = navMenu.classList.contains('active') ? '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
            });
            
            // Close menu when a link is clicked
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    navMenu.classList.remove('active');
                    navToggle.innerHTML = '<i class="fas fa-bars"></i>';
                });
            });

            // Hide header on scroll down, show on scroll up
            let lastScrollY = window.scrollY;
            const header = document.getElementById('header');

            window.addEventListener('scroll', () => {
                if (lastScrollY < window.scrollY) {
                    header.style.top = '-80px';
                } else {
                    header.style.top = '0';
                }
                lastScrollY = window.scrollY;
            });

            // Scroll Animation
            const fadeInElements = document.querySelectorAll('.fade-in');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            fadeInElements.forEach(el => {
                observer.observe(el);
            });

            // Set current year in footer
            document.getElementById('year').textContent = new Date().getFullYear();
        });
    </script>
</body>
</html>