class AppleDashboard {
    constructor() {
        this.initCharts();
        this.bindEvents();
        this.startLiveUpdates();
    }

    initCharts() {
        // Performance Chart
        const performanceCtx = document.getElementById('performanceChart').getContext('2d');
        this.performanceChart = new Chart(performanceCtx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Performance',
                    data: [65, 78, 66, 89, 76, 87, 95],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.7)'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.7)'
                        }
                    }
                }
            }
        });

        // Activity Chart
        const activityCtx = document.getElementById('activityChart').getContext('2d');
        this.activityChart = new Chart(activityCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'User Activity',
                    data: [1200, 1900, 1500, 2100, 1800, 2400],
                    backgroundColor: 'rgba(118, 75, 162, 0.8)',
                    borderColor: '#764ba2',
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.7)'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.7)'
                        }
                    }
                }
            }
        });
    }

    bindEvents() {
        // Menu item clicks
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', () => {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                item.classList.add('active');
                
                // Add ripple effect
                this.createRippleEffect(item);
            });
        });

        // Search functionality
        const searchInput = document.querySelector('.search-box input');
        searchInput.addEventListener('input', (e) => {
            this.handleSearch(e.target.value);
        });

        // Mobile menu toggle (you can add a hamburger menu later)
        this.addMobileSupport();
    }

    createRippleEffect(element) {
        const ripple = document.createElement('span');
        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;

        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple');

        element.style.position = 'relative';
        element.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    handleSearch(query) {
        // Implement search functionality
        console.log('Searching for:', query);
        // You can add actual search logic here
    }

    addMobileSupport() {
        // Add touch support for mobile devices
        document.addEventListener('touchstart', function() {}, { passive: true });
        
        // Handle window resize
        window.addEventListener('resize', this.debounce(() => {
            this.handleResponsiveLayout();
        }, 250));
    }

    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    handleResponsiveLayout() {
        if (window.innerWidth <= 1024) {
            // Add mobile-specific adjustments
            document.body.classList.add('mobile-view');
        } else {
            document.body.classList.remove('mobile-view');
        }
    }

    startLiveUpdates() {
        // Simulate live data updates
        setInterval(() => {
            this.updateLiveData();
        }, 5000);
    }

    updateLiveData() {
        // Update chart data randomly for demo purposes
        const newData = this.performanceChart.data.datasets[0].data.map(value => {
            return Math.max(0, value + Math.random() * 20 - 10);
        });
        
        this.performanceChart.data.datasets[0].data = newData;
        this.performanceChart.update('none');
        
        // Update stats cards randomly
        this.updateStatsCards();
    }

    updateStatsCards() {
        const stats = document.querySelectorAll('.stat-content h3');
        stats.forEach(stat => {
            const current = parseInt(stat.textContent.replace(/[^0-9]/g, ''));
            const change = Math.floor(Math.random() * 100) - 25;
            const newValue = Math.max(0, current + change);
            stat.textContent = newValue.toLocaleString();
        });
    }
}

// Initialize dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new AppleDashboard();
});

// Add CSS for ripple effect
const style = document.createElement('style');
style.textContent = `
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);