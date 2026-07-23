<<<<<<< HEAD
const homepage = document.querySelector('[data-homepage-search]');

if (homepage) {
    const destinationInput = homepage.querySelector('[data-destination-input]');

    homepage.querySelectorAll('.destination-chip').forEach((chip) => {
        chip.addEventListener('click', () => {
            destinationInput.value = chip.dataset.destination;
            destinationInput.focus();
        });
    });

    homepage.querySelectorAll('[data-counter-plus], [data-counter-minus]').forEach((button) => {
        button.addEventListener('click', () => {
            const name = button.dataset.counterPlus || button.dataset.counterMinus;
            const input = homepage.querySelector(`[data-counter="${name}"]`);
            const min = name === 'children' ? 0 : 1;
            const direction = button.dataset.counterPlus ? 1 : -1;
            input.value = Math.max(min, Number(input.value) + direction);
        });
    });

    homepage.querySelectorAll('.service-tab').forEach((tab) => {
        tab.addEventListener('click', () => {
            homepage.querySelectorAll('.service-tab').forEach((item) => {
                item.classList.remove('active', 'bg-white', 'text-slate-950', 'shadow-xl');
                item.classList.add('bg-white/10', 'text-white/80');
            });
            tab.classList.add('active', 'bg-white', 'text-slate-950', 'shadow-xl');
            tab.classList.remove('bg-white/10', 'text-white/80');
        });
    });
}
=======
// Inapin Interactive Application Helpers

document.addEventListener('DOMContentLoaded', () => {
    // Dark mode toggle handler
    const themeToggleBtns = document.querySelectorAll('.theme-toggle-btn');
    themeToggleBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('inapin-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('inapin-theme', 'dark');
            }
        });
    });

    // Auto-dismiss alerts after 5 seconds if desired
    const alerts = document.querySelectorAll('.auto-dismiss-toast');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            alert.style.transition = 'all 0.3s ease';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
});
>>>>>>> ae83ba3 (UI/UX overhaul and design updates)
