class AppleLogin {
    constructor() {
        this.init();
        this.createParticles();
    }

    init() {
        this.togglePassword = document.getElementById('togglePassword');
        this.passwordInput = document.getElementById('password');
        this.loginForm = document.getElementById('loginForm');
        this.loginButton = document.getElementById('loginButton');
        this.notification = document.getElementById('notification');

        this.bindEvents();
        console.log('AppleLogin initialized'); // DEBUG
    }

    bindEvents() {
        this.togglePassword.addEventListener('click', () => this.togglePasswordVisibility());
        this.loginForm.addEventListener('submit', (e) => this.handleLogin(e));
        this.addInputAnimations();
    }

    togglePasswordVisibility() {
        const type = this.passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        this.passwordInput.setAttribute('type', type);
        this.togglePassword.style.transform = 'translateY(-50%) scale(0.9)';
        setTimeout(() => {
            this.togglePassword.style.transform = 'translateY(-50%) scale(1)';
        }, 150);
    }

    async handleLogin(e) {
        e.preventDefault();
        console.log('Login attempt started'); // DEBUG
        
        this.setLoadingState(true);
        
        try {
            const formData = new FormData(this.loginForm);
            console.log('Form data:', { // DEBUG
                username: formData.get('username'),
                password: formData.get('password'),
                remember: formData.get('remember')
            });
            
            const response = await fetch('login.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            console.log('Response status:', response.status); // DEBUG
            
            // Sprawdź czy odpowiedź jest JSON
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                const data = await response.json();
                console.log('Response data:', data); // DEBUG
                
                if (data.success) {
                    this.showNotification('Login successful! Redirecting...', 'success');
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1500);
                } else {
                    this.showNotification(data.message, 'error');
                }
            } else {
                // Jeśli nie dostałeś JSON, przekieruj ręcznie
                console.log('Non-JSON response, redirecting manually');
                window.location.href = 'dashboard.php';
            }
        } catch (error) {
            console.error('Login error:', error);
            this.showNotification('Connection error. Please try again.', 'error');
        } finally {
            this.setLoadingState(false);
        }
    }

    setLoadingState(loading) {
        if (loading) {
            this.loginButton.classList.add('loading');
            this.loginButton.disabled = true;
        } else {
            this.loginButton.classList.remove('loading');
            this.loginButton.disabled = false;
        }
    }

    showNotification(message, type = 'info') {
        this.notification.textContent = message;
        this.notification.className = 'notification';
        
        if (type === 'success') {
            this.notification.style.background = 'rgba(48, 209, 88, 0.1)';
            this.notification.style.borderColor = 'rgba(48, 209, 88, 0.3)';
        } else if (type === 'error') {
            this.notification.style.background = 'rgba(255, 59, 48, 0.1)';
            this.notification.style.borderColor = 'rgba(255, 59, 48, 0.3)';
        }
        
        this.notification.classList.add('show');
        setTimeout(() => {
            this.notification.classList.remove('show');
        }, 3000);
    }

    addInputAnimations() {
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.style.transform = 'translateY(-2px)';
            });
            input.addEventListener('blur', () => {
                input.parentElement.style.transform = 'translateY(0)';
            });
            input.addEventListener('input', () => {
                this.validateInput(input);
            });
        });
    }

    validateInput(input) {
        if (input.value.length > 0) {
            input.style.borderColor = 'rgba(48, 209, 88, 0.3)';
        } else {
            input.style.borderColor = 'rgba(255, 255, 255, 0.1)';
        }
    }

    createParticles() {
        const container = document.getElementById('particles');
        const particleCount = 30;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            const size = Math.random() * 4 + 1;
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            const delay = Math.random() * 6;
            const duration = Math.random() * 4 + 4;
            
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${posX}%`;
            particle.style.top = `${posY}%`;
            particle.style.animationDelay = `${delay}s`;
            particle.style.animationDuration = `${duration}s`;
            particle.style.opacity = Math.random() * 0.3 + 0.1;
            
            container.appendChild(particle);
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new AppleLogin();
});

// Reszta kodu pozostaje bez zmian...
document.addEventListener('mousemove', (e) => {
    const particles = document.querySelector('.particles-container');
    const x = (window.innerWidth - e.pageX * 2) / 100;
    const y = (window.innerHeight - e.pageY * 2) / 100;
    particles.style.transform = `translateX(${x}px) translateY(${y}px)`;
});

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        document.querySelectorAll('input').forEach(input => input.blur());
    }
});

window.addEventListener('load', () => {
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.8s ease-in-out';
    setTimeout(() => {
        document.body.style.opacity = '1';
    }, 100);
});

window.addEventListener('load', () => {
    const urlParams = new URLSearchParams(window.location.search);
    
    if (urlParams.has('error')) {
        const message = urlParams.get('error') === 'invalid_credentials' 
            ? 'Invalid username or password' 
            : 'An error occurred';
        
        const notification = document.getElementById('notification');
        if (notification) {
            notification.textContent = message;
            notification.style.background = 'rgba(255, 59, 48, 0.1)';
            notification.style.borderColor = 'rgba(255, 59, 48, 0.3)';
            notification.classList.add('show');
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }
    }
    
    if (urlParams.has('logout') && urlParams.get('logout') === 'success') {
        const notification = document.getElementById('notification');
        if (notification) {
            notification.textContent = 'Logged out successfully';
            notification.style.background = 'rgba(48, 209, 88, 0.1)';
            notification.style.borderColor = 'rgba(48, 209, 88, 0.3)';
            notification.classList.add('show');
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }
    }
});