// ----------------------
// INITIALIZATION
// ----------------------
window.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('recordsData')) fetchData(); // CRUD page
    if (document.getElementById('dashboard-container')) loadDashboard(); // Dashboard page
    initializeSidebar();
    initializeCounters();
});

// ----------------------
// CRUD: FETCH & RENDER
// ----------------------
async function fetchData() {
    try {
        const res = await fetch('../../Backend/api/read_data.php');
        if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
        const response = await res.json();

        if (!response.success || !Array.isArray(response.data)) {
            throw new Error(response.message || 'Invalid API response');
        }

        const tbody = document.querySelector('#recordsData');
        if (!tbody) return;

        tbody.innerHTML = ''; // Clear existing rows
        response.data.forEach(record => {
            const row = tbody.insertRow();
            row.innerHTML = `
                <td>${record.reading_time || 'N/A'}</td>
                <td>${record.ph || 'N/A'}</td>
                <td>${record.turbidity || 'N/A'}</td>
                <td>${record.temperature || 'N/A'}</td>
                <td>${record.tds || 'N/A'}</td>
                <td>
                    <button class="btn btn-sm btn-warning btn-edit" data-id="${record.quality_id}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-danger btn-delete" data-id="${record.quality_id}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            `;
        });

        attachRecordTableListeners();
    } catch (error) {
        console.error('Fetch Error:', error);
        alert('Error fetching data. Please try again later.');
    }
}

// ----------------------
// CRUD: DELETE
// ----------------------
async function deleteRecord(id) {
    if (!confirm('Are you sure you want to delete this record?')) return;
    try {
        const res = await fetch('../../Backend/api/delete_data.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ quality_id: id })
        });
        if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
        const result = await res.json();

        if (result.success) {
            fetchData(); // Refresh data on successful delete
            alert('Record deleted successfully.');
        } else {
            alert('Delete failed: ' + result.message);
        }
    } catch (error) {
        console.error('Delete Error:', error);
        alert('Error deleting record. Please try again later.');
    }
}

// ----------------------
// CRUD: EDIT (Modal)
// ----------------------
async function editRecord(id) {
    try {
        const res = await fetch(`../../Backend/api/read_single_data.php?id=${id}`);
        if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
        const response = await res.json();

        if (!response.success) throw new Error(response.message);

        // Populate the modal fields with the record data
        const record = response.data;
        document.getElementById('qualityId').value = record.quality_id || ''; // Populate quality_id
        document.getElementById('phValue').value = record.ph || '';
        document.getElementById('turbidityValue').value = record.turbidity || '';
        document.getElementById('tempValue').value = record.temperature || '';
        document.getElementById('tdsValue').value = record.tds || '';

        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('recordModal'));
        modal.show();
    } catch (error) {
        console.error('Edit Record Error:', error);
        alert('Error fetching record details. Please try again later.');
    }
}

// ----------------------
// CRUD: CREATE / UPDATE
// ----------------------
async function saveRecord(event) {
    event.preventDefault();

    const submitButton = document.querySelector('#recordForm button[type="submit"]');
    submitButton.disabled = true; // Disable the button

    const id = document.getElementById('qualityId').value;
    const data = {
        ph: document.getElementById('phValue').value,
        turbidity: document.getElementById('turbidityValue').value,
        temperature: document.getElementById('tempValue').value,
        tds: document.getElementById('tdsValue').value
    };

    console.log('Data being sent:', data); // Debugging log

    const url = id ? '../../Backend/api/update_data.php' : '../../Backend/api/create_data.php';

    try {
        const res = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, ...data })
        });
        if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);

        const result = await res.json();
        if (result.success) {
            fetchData();
            closeModal();
            alert(id ? 'Record updated successfully!' : 'Record created successfully!');
        } else {
            alert(result.message);
        }
    } catch (error) {
        console.error('Save Error:', error);
        alert('Error saving record. Please try again later.');
    } finally {
        submitButton.disabled = false; // Re-enable the button
    }
}

// ----------------------
// MODAL HANDLING
// ----------------------
function openModal() {
    const modal = new bootstrap.Modal(document.getElementById('recordModal'));
    document.getElementById('qualityId').value = ''; // Clear the hidden ID field
    document.getElementById('recordForm').reset(); // Reset the form
    modal.show(); // Show the modal
}

function closeModal() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('recordModal'));
    modal.hide();
}

// ----------------------
// EVENT LISTENERS
// ----------------------
function attachRecordTableListeners() {
    const table = document.getElementById('recordsData');
    if (!table) return;

    table.addEventListener('click', event => {
        const target = event.target;
        const button = target.closest('button');
        if (!button) return;

        const id = button.dataset.id;

        if (button.classList.contains('btn-delete')) {
            deleteRecord(id);
        } else if (button.classList.contains('btn-edit')) {
            editRecord(id);
        }
    });
}

document.getElementById('addRecord')?.addEventListener('click', openModal);
document.getElementById('recordForm')?.addEventListener('submit', saveRecord);

// ----------------------
// UTILITIES
// ----------------------
function initializeSidebar() {
    const sidebarLinks = document.querySelectorAll('.sidebar ul li a');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', () => {
            sidebarLinks.forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        });
    });
}

function initializeCounters() {
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const updateCounter = () => {
            const target = +counter.getAttribute('data-target');
            const current = +counter.innerText;

            const increment = target / 200; // Adjust speed here
            if (current < target) {
                counter.innerText = Math.ceil(current + increment);
                setTimeout(updateCounter, 10);
            } else {
                counter.innerText = target;
            }
        };
        updateCounter();
    });
}