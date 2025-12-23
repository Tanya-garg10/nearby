(() => {
    const body = document.body;
    if (!body) {
        return;
    }

    const currentPath = window.location.pathname.split('/').pop() || 'index.php';
    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });

    const buildAlert = (message, type = 'success') => {
        const wrapper = document.createElement('div');
        wrapper.innerHTML = `
            <div class="alert alert-${type} alert-glass alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        return wrapper.firstElementChild;
    };

    const showMessage = (message, type = 'success') => {
        const target = document.querySelector('[data-app-alerts]') || document.querySelector('.container');
        if (!target) {
            return;
        }
        const alertEl = buildAlert(message, type);
        target.prepend(alertEl);
        setTimeout(() => {
            const alertInstance = bootstrap.Alert.getOrCreateInstance(alertEl);
            alertInstance.close();
        }, 6000);
    };

    const fetchJSON = async (url, options = {}) => {
        const defaultHeaders = {'Accept': 'application/json'};
        options.headers = options.headers ? {...defaultHeaders, ...options.headers} : defaultHeaders;
        if (options.body && !(options.body instanceof FormData)) {
            options.headers['Content-Type'] = 'application/json';
            options.body = JSON.stringify(options.body);
        }

        const response = await fetch(url, options);
        const data = await response.json().catch(() => ({success: false, message: 'Invalid server response'}));
        if (!response.ok || data.success === false) {
            const errorMessage = data.message || 'Something went wrong';
            throw new Error(errorMessage);
        }
        return data;
    };

    window.NearBy = {
        fetchJSON,
        showMessage
    };
})();
