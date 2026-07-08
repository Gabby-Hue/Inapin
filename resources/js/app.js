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
