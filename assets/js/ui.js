const facilityIconMap = {
    'Wi-Fi': 'bi-wifi',
    'Food': 'bi-basket',
    'Water': 'bi-droplet',
    'Electricity': 'bi-lightning-charge',
    'Parking': 'bi-car-front',
    'CCTV': 'bi-camera-video',
    'Power Backup': 'bi-battery-charging'
};

const badges = {
    Male: 'bg-primary',
    Female: 'bg-danger',
    Family: 'bg-warning'
};

const buildFacilityIcons = (facilities = []) => {
    if (!facilities.length) {
        return '<span class="small text-muted">Facilities info coming soon</span>';
    }
    return facilities.map(facility => {
        const icon = facilityIconMap[facility] || 'bi-check-circle';
        return `
            <span class="facility-icon" title="${facility}">
                <i class="bi ${icon}"></i>
            </span>
        `;
    }).join('');
};

export const buildAccommodationCard = (item) => {
    const verifiedBadge = Number(item.is_verified) ? '<span class="badge badge-verified"><i class="bi bi-patch-check-fill me-1"></i>Owner Verified</span>' : '';
    const allowedBadge = badges[item.allowed_for] || 'bg-success';
    const monthlyRent = Number(item.monthly_rent) || 0;

    return `
        <div class="col-md-6 col-xl-4">
            <div class="glass-card h-100 p-4 d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <span class="badge ${allowedBadge} bg-opacity-75 text-white mb-2">Allowed: ${item.allowed_for}</span>
                        <h3 class="h5 fw-semibold mb-0">${item.title}</h3>
                        <span class="text-muted small">${item.type} · ${item.location}</span>
                    </div>
                    ${verifiedBadge}
                </div>
                <p class="fw-semibold text-success mb-3">₹${monthlyRent.toLocaleString()}</p>
                <p class="text-muted small flex-grow-1">${item.description || 'Owner will update description soon.'}</p>
                <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                    ${buildFacilityIcons(item.facilities)}
                </div>
                <div class="d-flex gap-2">
                    <a class="btn btn-outline-light flex-fill" href="details.php?id=${item.id}">View Details</a>
                    <button class="btn btn-primary flex-fill" data-contact-id="${item.id}">Contact Owner</button>
                </div>
            </div>
        </div>
    `;
};

export const renderResults = (container, cardMarkupList) => {
    container.innerHTML = cardMarkupList.join('');
    container.querySelectorAll('[data-contact-id]').forEach(button => {
        button.addEventListener('click', async (event) => {
            const id = button.getAttribute('data-contact-id');
            button.disabled = true;
            button.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
            try {
                const result = await NearBy.fetchJSON('api/contact/request.php', {
                    method: 'POST',
                    body: {accommodation_id: id}
                });
                NearBy.showMessage(result.message);
            } catch (error) {
                NearBy.showMessage(error.message, 'danger');
            } finally {
                button.disabled = false;
                button.innerHTML = 'Contact Owner';
            }
        });
    });
};
