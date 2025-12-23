import { buildAccommodationCard, renderResults } from './ui.js';

const formSelectors = ['#dashboardSearch', '#advancedSearch'];

const fetchResults = async (params) => {
    const url = new URL('api/accommodations/search.php', window.location.href);
    Object.entries(params).forEach(([key, value]) => {
        if (Array.isArray(value)) {
            value.forEach(item => url.searchParams.append(key + '[]', item));
        } else if (value) {
            url.searchParams.set(key, value);
        }
    });

    const response = await fetch(url.toString(), {headers: {'Accept': 'application/json'}});
    const data = await response.json();
    if (!data.success) {
        throw new Error(data.message || 'Unable to fetch results');
    }
    return data.data;
};

const initSearchForm = (selector) => {
    const form = document.querySelector(selector);
    if (!form) {
        return;
    }

    const resultsContainer = document.querySelector('#searchResults');

    const handleSearch = async () => {
        const formData = new FormData(form);
        const params = {};
        formData.forEach((value, key) => {
            if (key.endsWith('[]')) {
                const arrayKey = key.slice(0, -2);
                params[arrayKey] = params[arrayKey] || [];
                params[arrayKey].push(value);
            } else {
                params[key] = value;
            }
        });

        try {
            resultsContainer.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-success" role="status"></div><p class="text-muted small mt-2">Searching...</p></div>';
            const results = await fetchResults(params);
            if (!results.length) {
                resultsContainer.innerHTML = '<div class="text-center py-5 text-muted">No accommodations match your filters yet.</div>';
                return;
            }
            renderResults(resultsContainer, results.map(buildAccommodationCard));
        } catch (error) {
            resultsContainer.innerHTML = '';
            NearBy.showMessage(error.message, 'danger');
        }
    };

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        handleSearch();
    });

    form.addEventListener('reset', () => {
        setTimeout(handleSearch, 150);
    });

    handleSearch();
};

formSelectors.forEach(initSearchForm);
