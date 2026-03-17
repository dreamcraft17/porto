<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dozer Napitupulu — AI-Driven Full Stack Developer</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:wght@300;400;500;600;700;800;900&family=jetbrains+mono:wght@300;400;500;600;700;800&family=space+grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Devicon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    
    <style>
        :root {
            --neon-cyan: #00ffff;
            --neon-purple: #a855f7;
            --neon-pink: #ec4899;
            --dark-bg: #0a0a0f;
            --dark-surface: #1a1a2e;
            --dark-card: #16213e;
            --text-primary: #ffffff;
            --text-secondary: #94a3b8;
            --accent-gradient: linear-gradient(135deg, #00ffff, #a855f7, #ec4899);
            --border-glow: rgba(0, 255, 255, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--dark-bg);
            color: var(--text-primary);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Animated Background */
        .ai-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: 
                radial-gradient(ellipse at top left, rgba(0, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at bottom right, rgba(168, 85, 247, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at center, rgba(236, 72, 153, 0.05) 0%, transparent 50%);
            animation: backgroundShift 20s ease-in-out infinite;
        }

        @keyframes backgroundShift {
            0%, 100% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(5deg) scale(1.1); }
        }

        /* Neural Network Animation */
        .neural-network {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.3;
        }

        .neural-particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: var(--neon-cyan);
            border-radius: 50%;
            animation: float 15s infinite ease-in-out;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            25% { transform: translateY(-20px) translateX(10px); }
            50% { transform: translateY(10px) translateX(-10px); }
            75% { transform: translateY(-10px) translateX(20px); }
        }

        /* Navigation */
        .nav-ai {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 1.5rem 2rem;
            background: rgba(10, 10, 15, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-glow);
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-ai {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--accent-gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .logo-icon::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        .nav-link:hover {
            color: var(--neon-cyan);
            background: rgba(0, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .nav-link.active {
            color: var(--text-primary);
            background: rgba(0, 255, 255, 0.15);
            border: 1px solid var(--border-glow);
        }

        /* Hero Section */
        .hero-ai {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6rem 2rem 4rem;
            position: relative;
        }

        .hero-content {
            max-width: 1400px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-text {
            animation: slideInLeft 1s ease-out;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .status-badge-ai {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: rgba(0, 255, 0, 0.1);
            border: 1px solid rgba(0, 255, 0, 0.3);
            border-radius: 50px;
            color: #00ff00;
            font-weight: 500;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .status-badge-ai::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 0, 0.2), transparent);
            animation: statusPulse 2s infinite;
        }

        @keyframes statusPulse {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #00ff00;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.2); }
        }

        .hero-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(3rem, 8vw, 6rem);
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .hero-subtitle {
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 2rem;
            font-family: 'JetBrains Mono', monospace;
        }

        .typing-text {
            color: var(--neon-cyan);
            font-weight: 700;
        }

        .hero-description {
            font-size: 1.125rem;
            color: var(--text-secondary);
            margin-bottom: 3rem;
            max-width: 500px;
            line-height: 1.8;
        }

        .hero-cta {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-ai {
            padding: 1rem 2rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-ai {
            background: var(--accent-gradient);
            color: white;
            box-shadow: 0 4px 20px rgba(0, 255, 255, 0.3);
        }

        .btn-primary-ai:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 255, 255, 0.5);
        }

        .btn-secondary-ai {
            background: transparent;
            color: var(--text-primary);
            border: 2px solid var(--border-glow);
        }

        .btn-secondary-ai:hover {
            background: rgba(0, 255, 255, 0.1);
            border-color: var(--neon-cyan);
            transform: translateY(-3px);
        }

        /* Hero Visual */
        .hero-visual {
            position: relative;
            animation: slideInRight 1s ease-out;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .ai-card {
            background: linear-gradient(135deg, rgba(22, 33, 62, 0.8), rgba(26, 26, 46, 0.8));
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-glow);
            border-radius: 24px;
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }

        .ai-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, transparent, var(--neon-cyan), transparent, var(--neon-purple), transparent);
            animation: rotate 10s linear infinite;
            opacity: 0.1;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .ai-card-content {
            position: relative;
            z-index: 1;
        }

        .code-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }

        .code-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .dot-red { background: #ff5f56; }
        .dot-yellow { background: #ffbd2e; }
        .dot-green { background: #27c93f; }

        .code-content {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem;
            line-height: 1.6;
            color: var(--text-secondary);
        }

        .code-line {
            margin-bottom: 0.5rem;
            opacity: 0;
            animation: fadeInCode 0.5s ease-out forwards;
        }

        .code-line:nth-child(1) { animation-delay: 0.1s; }
        .code-line:nth-child(2) { animation-delay: 0.2s; }
        .code-line:nth-child(3) { animation-delay: 0.3s; }
        .code-line:nth-child(4) { animation-delay: 0.4s; }
        .code-line:nth-child(5) { animation-delay: 0.5s; }

        @keyframes fadeInCode {
            to {
                opacity: 1;
                transform: translateX(0);
            }
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
        }

        .code-keyword { color: var(--neon-purple); }
        .code-function { color: var(--neon-cyan); }
        .code-string { color: #00ff00; }
        .code-comment { color: #64748b; font-style: italic; }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            background: rgba(0, 255, 255, 0.1);
            border: 1px solid var(--border-glow);
            border-radius: 12px;
            padding: 1rem;
            animation: float 6s ease-in-out infinite;
            backdrop-filter: blur(10px);
        }

        .floating-element:nth-child(1) {
            top: -20px;
            right: -20px;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            bottom: -20px;
            left: -20px;
            animation-delay: 2s;
        }

        .tech-stack-ai {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 2rem;
        }

        .tech-badge-ai {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(0, 255, 255, 0.1);
            border: 1px solid var(--border-glow);
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--neon-cyan);
            transition: all 0.3s ease;
        }

        .tech-badge-ai:hover {
            background: rgba(0, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 255, 255, 0.3);
        }

        /* Social Links */
        .social-ai {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .social-link-ai {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link-ai:hover {
            background: var(--accent-gradient);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 255, 255, 0.4);
        }

        /* Mobile Responsive */
        @media (max-width: 968px) {
            .hero-content {
                grid-template-columns: 1fr;
                gap: 2rem;
                text-align: center;
            }

            .nav-links {
                display: none;
            }

            .hero-cta {
                justify-content: center;
            }

            .social-ai {
                justify-content: center;
            }

            .ai-card {
                padding: 2rem;
            }
        }

        @media (max-width: 640px) {
            .hero-ai {
                padding: 4rem 1rem 2rem;
            }

            .hero-title {
                font-size: 3rem;
            }

            .hero-subtitle {
                font-size: 1.5rem;
            }

            .btn-ai {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- AI Background -->
    <div class="ai-background"></div>
    
    <!-- Neural Network Animation -->
    <div class="neural-network" id="neuralNetwork"></div>

    <!-- Navigation -->
    <nav class="nav-ai">
        <div class="nav-container">
            <a href="#" class="logo-ai">
                <div class="logo-icon">DN</div>
                Dozer.AI
            </a>
            <ul class="nav-links">
                <li><a href="#home" class="nav-link active">Home</a></li>
                <li><a href="#about" class="nav-link">About</a></li>
                <li><a href="#projects" class="nav-link">Projects</a></li>
                <li><a href="#skills" class="nav-link">Skills</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-ai" id="home">
        <div class="hero-content">
            <div class="hero-text">
                <div class="status-badge-ai">
                    <span class="status-dot"></span>
                    AI-Enhanced Development
                </div>
                
                <h1 class="hero-title">
                    Dozer Napitupulu
                </h1>
                
                <h2 class="hero-subtitle">
                    <span class="typing-text" id="typingText">Full Stack Developer</span>
                </h2>
                
                <p class="hero-description">
                    Crafting intelligent digital experiences with AI-powered development. 
                    Specializing in scalable web applications, mobile solutions, and 
                    cutting-edge technology integration.
                </p>
                
                <div class="hero-cta">
                    <a href="#projects" class="btn-ai btn-primary-ai">
                        <i class="fas fa-rocket"></i>
                        View Projects
                    </a>
                    <a href="#contact" class="btn-ai btn-secondary-ai">
                        <i class="fas fa-terminal"></i>
                        Connect
                    </a>
                </div>
                
                <div class="social-ai">
                    <a href="https://github.com/dozernapitupulu" target="_blank" class="social-link-ai">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/dozernapitupulu/" target="_blank" class="social-link-ai">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://twitter.com/dozernapitupulu" target="_blank" class="social-link-ai">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="mailto:dozernapitupulu@gmail.com" class="social-link-ai">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
            
            <div class="hero-visual">
                <div class="ai-card">
                    <div class="floating-element">
                        <i class="fas fa-brain"></i> AI-Powered
                    </div>
                    <div class="floating-element">
                        <i class="fas fa-code"></i> Clean Code
                    </div>
                    
                    <div class="ai-card-content">
                        <div class="code-header">
                            <div class="code-dot dot-red"></div>
                            <div class="code-dot dot-yellow"></div>
                            <div class="code-dot dot-green"></div>
                            <span style="margin-left: 1rem; color: var(--text-secondary); font-family: 'JetBrains Mono', monospace;">developer.js</span>
                        </div>
                        
                        <div class="code-content">
                            <div class="code-line">
                                <span class="code-keyword">const</span> developer = {
                            </div>
                            <div class="code-line">
                                &nbsp;&nbsp;<span class="code-function">name</span>: <span class="code-string">"Dozer Napitupulu"</span>,
                            </div>
                            <div class="code-line">
                                &nbsp;&nbsp;<span class="code-function">role</span>: <span class="code-string">"Full Stack Developer"</span>,
                            </div>
                            <div class="code-line">
                                &nbsp;&nbsp;<span class="code-function">skills</span>: [<span class="code-string">".NET"</span>, <span class="code-string">"Laravel"</span>, <span class="code-string">"Flutter"</span>],
                            </div>
                            <div class="code-line">
                                &nbsp;&nbsp;<span class="code-function">aiEnhanced</span>: <span class="code-keyword">true</span>
                            </div>
                            <div class="code-line">
                                };
                            </div>
                        </div>
                        
                        <div class="tech-stack-ai">
                            <div class="tech-badge-ai">
                                <i class="fab fa-dotnet"></i> .NET
                            </div>
                            <div class="tech-badge-ai">
                                <i class="fab fa-laravel"></i> Laravel
                            </div>
                            <div class="tech-badge-ai">
                                <i class="fab fa-react"></i> React
                            </div>
                            <div class="tech-badge-ai">
                                <i class="fab fa-python"></i> Python
                            </div>
                            <div class="tech-badge-ai">
                                <i class="fas fa-database"></i> SQL
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Typing animation
        const roles = [
            "Full Stack Developer",
            "AI Enthusiast", 
            "Mobile App Developer",
            "Cloud Architect",
            "Problem Solver"
        ];
        
        let roleIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let typingSpeed = 100;
        
        function typeRole() {
            const currentRole = roles[roleIndex];
            const typingElement = document.getElementById('typingText');
            
            if (!isDeleting) {
                typingElement.textContent = currentRole.substring(0, charIndex + 1);
                charIndex++;
                
                if (charIndex === currentRole.length) {
                    isDeleting = true;
                    typingSpeed = 2000; // Pause at complete word
                } else {
                    typingSpeed = 100;
                }
            } else {
                typingElement.textContent = currentRole.substring(0, charIndex - 1);
                charIndex--;
                typingSpeed = 50;
                
                if (charIndex === 0) {
                    isDeleting = false;
                    roleIndex = (roleIndex + 1) % roles.length;
                    typingSpeed = 500; // Pause before new word
                }
            }
            
            setTimeout(typeRole, typingSpeed);
        }
        
        // Start typing animation
        typeRole();
        
        // Generate neural network particles
        function createNeuralNetwork() {
            const network = document.getElementById('neuralNetwork');
            const particleCount = 50;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'neural-particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 15 + 's';
                particle.style.animationDuration = (15 + Math.random() * 10) + 's';
                network.appendChild(particle);
            }
        }
        
        // Initialize neural network
        createNeuralNetwork();
        
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Add scroll effect to navigation
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('.nav-ai');
            if (window.scrollY > 50) {
                nav.style.background = 'rgba(10, 10, 15, 0.95)';
                nav.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.3)';
            } else {
                nav.style.background = 'rgba(10, 10, 15, 0.8)';
                nav.style.boxShadow = 'none';
            }
        });
    </script>
</body>
</html>
