import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Initialize Alpine.js
Alpine.start();

// Enhanced Dark Mode Management
class DarkModeManager {
    constructor() {
        this.init();
        this.setupEventListeners();
    }

    init() {
        // Check for saved dark mode preference or default to system preference
        const savedTheme = localStorage.getItem('darkMode');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme === 'true' || (savedTheme === null && prefersDark)) {
            this.enableDarkMode();
        } else {
            this.disableDarkMode();
        }
    }

    enableDarkMode() {
        document.documentElement.classList.add('dark');
        localStorage.setItem('darkMode', 'true');
        this.updateToggleIcons();
    }

    disableDarkMode() {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('darkMode', 'false');
        this.updateToggleIcons();
    }

    toggle() {
        const isDark = document.documentElement.classList.contains('dark');
        
        if (isDark) {
            this.disableDarkMode();
        } else {
            this.enableDarkMode();
        }
    }

    updateToggleIcons() {
        // Force update toggle button states
        const toggleButtons = document.querySelectorAll('[onclick="toggleDarkMode()"]');
        toggleButtons.forEach(button => {
            const isDark = document.documentElement.classList.contains('dark');
            button.setAttribute('data-dark-mode', isDark);
        });
    }

    setupEventListeners() {
        // Listen for system preference changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            const savedTheme = localStorage.getItem('darkMode');
            if (!savedTheme) {
                if (e.matches) {
                    this.enableDarkMode();
                } else {
                    this.disableDarkMode();
                }
            }
        });
    }
}

// Initialize Dark Mode Manager
const darkModeManager = new DarkModeManager();

// Global dark mode toggle function
window.toggleDarkMode = function() {
    darkModeManager.toggle();
};

// Filter and Search Management
class FilterManager {
    constructor() {
        this.searchTerm = '';
        this.selectedDate = '';
        this.sortBy = 'date_asc';
        this.init();
    }

    init() {
        this.setupFilterButtons();
        this.setupSearchFunctionality();
        this.setupDateFilter();
        this.setupSortFilter();
    }

    setupFilterButtons() {
        // Fix untuk tombol filter yang tidak bekerja
        const filterButtons = document.querySelectorAll('[data-filter]');
        
        if (filterButtons.length > 0) {
            filterButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const filterType = button.getAttribute('data-filter');
                    this.applyQuickFilter(filterType);
                });
            });
        }

        // Alternative setup untuk button tanpa data-filter
        const todayBtn = document.querySelector('.filter-today, [class*="today"]');
        const weekBtn = document.querySelector('.filter-week, [class*="week"]');
        const availableBtn = document.querySelector('.filter-available, [class*="available"]');

        if (todayBtn) {
            todayBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.applyQuickFilter('today');
            });
        }

        if (weekBtn) {
            weekBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.applyQuickFilter('week');
            });
        }

        if (availableBtn) {
            availableBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.applyQuickFilter('available');
            });
        }
    }

    setupSearchFunctionality() {
        const searchInput = document.querySelector('[x-model="searchTerm"]') || 
                           document.querySelector('input[placeholder*="Cari"]');
        
        if (searchInput) {
            searchInput.addEventListener('input', this.debounce((e) => {
                this.searchTerm = e.target.value.toLowerCase();
                this.filterResults();
            }, 300));
        }
    }

    setupDateFilter() {
        const dateFilter = document.querySelector('[x-model="selectedDate"]') || 
                          document.querySelector('input[type="date"]');
        
        if (dateFilter) {
            dateFilter.addEventListener('change', (e) => {
                this.selectedDate = e.target.value;
                this.filterResults();
            });
        }
    }

    setupSortFilter() {
        const sortSelect = document.querySelector('[x-model="sortBy"]') || 
                          document.querySelector('select');
        
        if (sortSelect) {
            sortSelect.addEventListener('change', (e) => {
                this.sortBy = e.target.value;
                this.sortResults();
            });
        }
    }

    applyQuickFilter(type) {
        const today = new Date().toISOString().split('T')[0];
        const weekFromNow = new Date();
        weekFromNow.setDate(weekFromNow.getDate() + 7);
        
        const dateFilter = document.querySelector('[x-model="selectedDate"]') || 
                          document.querySelector('input[type="date"]');
        
        switch(type) {
            case 'today':
                if (dateFilter) {
                    dateFilter.value = today;
                    this.selectedDate = today;
                    this.filterResults();
                }
                break;
            case 'week':
                if (dateFilter) {
                    const endOfWeek = new Date();
                    endOfWeek.setDate(endOfWeek.getDate() + 7);
                    dateFilter.value = endOfWeek.toISOString().split('T')[0];
                    this.selectedDate = endOfWeek.toISOString().split('T')[0];
                    this.filterResults();
                }
                break;
            case 'available':
                this.filterAvailableOnly();
                break;
        }
    }

    filterAvailableOnly() {
        const cards = document.querySelectorAll('[data-available-quota]');
        cards.forEach(card => {
            const quota = parseInt(card.getAttribute('data-available-quota'));
            if (quota <= 0) {
                card.style.opacity = '0.3';
                card.style.pointerEvents = 'none';
                card.style.filter = 'grayscale(50%)';
            } else {
                card.style.opacity = '1';
                card.style.pointerEvents = 'auto';
                card.style.filter = 'none';
            }
        });
    }

    filterResults() {
        const cards = document.querySelectorAll('.group, [data-test-card]');
        
        cards.forEach(card => {
            let shouldShow = true;
            
            // Search filter
            if (this.searchTerm) {
                const cardText = card.textContent.toLowerCase();
                shouldShow = shouldShow && cardText.includes(this.searchTerm);
            }
            
            // Date filter
            if (this.selectedDate) {
                const cardDate = card.querySelector('[data-test-date]');
                if (cardDate) {
                    const testDate = cardDate.getAttribute('data-test-date');
                    shouldShow = shouldShow && (testDate === this.selectedDate);
                }
            }
            
            // Apply visibility
            if (shouldShow) {
                card.style.display = '';
                card.classList.add('animate-fade-in');
            } else {
                card.style.display = 'none';
                card.classList.remove('animate-fade-in');
            }
        });
        
        this.updateResultsCount();
    }

    sortResults() {
        const container = document.querySelector('.grid');
        if (!container) return;
        
        const cards = Array.from(container.children);
        
        cards.sort((a, b) => {
            switch(this.sortBy) {
                case 'date_asc':
                    return this.compareDates(a, b, false);
                case 'date_desc':
                    return this.compareDates(a, b, true);
                case 'name_asc':
                    return this.compareNames(a, b, false);
                case 'name_desc':
                    return this.compareNames(a, b, true);
                case 'quota_desc':
                    return this.compareQuota(a, b, true);
                case 'quota_asc':
                    return this.compareQuota(a, b, false);
                default:
                    return 0;
            }
        });
        
        // Re-append sorted cards
        cards.forEach(card => container.appendChild(card));
    }

    compareDates(a, b, desc = false) {
        const dateA = a.querySelector('[data-test-date]')?.getAttribute('data-test-date') || '';
        const dateB = b.querySelector('[data-test-date]')?.getAttribute('data-test-date') || '';
        
        const result = new Date(dateA) - new Date(dateB);
        return desc ? -result : result;
    }

    compareNames(a, b, desc = false) {
        const nameA = a.querySelector('h3')?.textContent || '';
        const nameB = b.querySelector('h3')?.textContent || '';
        
        const result = nameA.localeCompare(nameB);
        return desc ? -result : result;
    }

    compareQuota(a, b, desc = false) {
        const quotaA = parseInt(a.getAttribute('data-available-quota') || '0');
        const quotaB = parseInt(b.getAttribute('data-available-quota') || '0');
        
        const result = quotaA - quotaB;
        return desc ? -result : result;
    }

    updateResultsCount() {
        const visibleCards = document.querySelectorAll('.group:not([style*="display: none"]), [data-test-card]:not([style*="display: none"])');
        const countElement = document.querySelector('[data-results-count]');
        
        if (countElement) {
            countElement.textContent = `${visibleCards.length} Test Ditemukan`;
        }
    }

    debounce(func, wait, immediate) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                timeout = null;
                if (!immediate) func(...args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func(...args);
        };
    }
}

// Copy to clipboard functionality
window.copyToClipboard = function(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success feedback
        const button = event.target.closest('button');
        if (button) {
            const originalHTML = button.innerHTML;
            button.innerHTML = `
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            `;
            setTimeout(() => {
                button.innerHTML = originalHTML;
            }, 2000);
        }
    }).catch(function(err) {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
    });
};

// Mobile menu toggle
window.toggleMobileMenu = function() {
    const mobileMenu = document.getElementById('mobileMenu');
    if (mobileMenu) {
        mobileMenu.classList.toggle('hidden');
    }
};

// Enhanced DOM Ready Handler
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Filter Manager
    new FilterManager();

    // Enhanced file input handling
    const fileInputs = document.querySelectorAll('input[type="file"]');
    
    fileInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const fileName = file.name;
                const fileSize = (file.size / 1024 / 1024).toFixed(2);
                const maxNameLength = 30;
                const displayName = fileName.length > maxNameLength 
                    ? fileName.substring(0, maxNameLength) + '...' 
                    : fileName;
                
                let infoDiv = input.parentNode.querySelector('.file-info');
                if (!infoDiv) {
                    infoDiv = document.createElement('div');
                    infoDiv.className = 'file-info mt-2 p-2 bg-gray-50 dark:bg-gray-700 rounded text-sm text-gray-600 dark:text-gray-300';
                    input.parentNode.appendChild(infoDiv);
                }
                
                infoDiv.innerHTML = `
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>${displayName} (${fileSize} MB)</span>
                    </div>
                `;
            }
        });
    });

    // Enhanced form submission handling
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                const originalText = submitBtn.innerHTML;
                submitBtn.disabled = true;
                
                // Check if button uses Alpine.js x-show for loading state
                const hasAlpineLoading = submitBtn.querySelector('[x-show]');
                
                if (!hasAlpineLoading) {
                    submitBtn.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    `;
                }
                
                // Re-enable button after 10 seconds as fallback
                setTimeout(() => {
                    submitBtn.disabled = false;
                    if (!hasAlpineLoading) {
                        submitBtn.innerHTML = originalText;
                    }
                }, 10000);
            }
        });
    });

    // Add loading states to booking buttons
    const bookingButtons = document.querySelectorAll('a[href*="booking.show"]');
    bookingButtons.forEach(button => {
        button.addEventListener('click', function() {
            const loadingOverlay = document.getElementById('loading-overlay');
            if (loadingOverlay) {
                loadingOverlay.classList.remove('hidden');
            }
        });
    });

    // Smooth scroll for anchor links (mobile optimization)
    if (window.innerWidth <= 768) {
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
    }

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
                // Stop observing once animated
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe cards for animations
    document.querySelectorAll('.group, .card, .feature-card').forEach(card => {
        observer.observe(card);
    });

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('[role="alert"]');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateX(100%)';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 5000);
    });

    // Handle resize events with debounce
    const handleResize = debounce(() => {
        // Re-initialize filter if needed
        const filterManager = window.filterManager;
        if (filterManager) {
            filterManager.updateResultsCount();
        }
    }, 250);

    window.addEventListener('resize', handleResize);

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Toggle dark mode with Ctrl/Cmd + D
        if ((e.ctrlKey || e.metaKey) && e.key === 'd') {
            e.preventDefault();
            toggleDarkMode();
        }
        
        // Focus search with Ctrl/Cmd + F
        if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
            const searchInput = document.querySelector('[x-model="searchTerm"]');
            if (searchInput) {
                e.preventDefault();
                searchInput.focus();
            }
        }
    });

    // Performance optimization: Debounce function
    function debounce(func, wait, immediate) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                timeout = null;
                if (!immediate) func(...args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func(...args);
        };
    }
});

// Handle page visibility changes
document.addEventListener('visibilitychange', function() {
    if (document.visibilityState === 'visible') {
        // Refresh any real-time data if needed
        const refreshButton = document.querySelector('[data-refresh]');
        if (refreshButton) {
            // Auto-refresh logic could go here
        }
    }
});
