const titleInput = document.getElementById('task_title');
const titleCount = document.getElementById('title-count');
const searchInput = document.getElementById('task-search');
const noResults = document.getElementById('no-results');

if (titleInput && titleCount) {
    const updateCount = () => {
        titleCount.textContent = titleInput.value.length;
    };

    titleInput.addEventListener('input', updateCount);
    updateCount();
}

if (searchInput) {
    searchInput.addEventListener('input', (event) => {
        const query = event.target.value.toLowerCase().trim();
        const cards = [...document.querySelectorAll('.task-card')];
        let visible = 0;

        cards.forEach((card) => {
            const matches = card.dataset.search.includes(query);
            card.hidden = !matches;

            if (matches) {
                visible += 1;
            }
        });

        if (noResults) {
            noResults.style.display = cards.length && !visible ? 'block' : 'none';
        }
    });
}

const flash = document.querySelector('.flash');

if (flash) {
    setTimeout(() => {
        flash.style.opacity = '0';
        flash.style.transition = 'opacity .35s';

        setTimeout(() => flash.remove(), 350);
    }, 4200);
}
