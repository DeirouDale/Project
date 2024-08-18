document.addEventListener('DOMContentLoaded', function () {
    const createTableBtn = document.getElementById('create-table-btn');
    const createTableModal = new bootstrap.Modal(document.getElementById('createTableModal'));
    const createTableForm = document.getElementById('create-table-form');
    const tableContainer = document.querySelector('.container-Dashboard');
    const saveChangesBtn = document.getElementById('save-button');
    const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
    const boxInfo = document.getElementById('box-info'); // Added to target the box-info section

    // Show the Create Table modal when the button is clicked
    createTableBtn.addEventListener('click', function () {
        createTableModal.show();
    });

    // Handle form submission
    createTableForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission
    
        // Validate if date is selected
        const tableDate = document.getElementById('table-date').value;
        if (!tableDate) {
            alert('Please select a date.');
            return;
        }
    
        const [date, month, year] = tableDate.split('-').reverse();
        document.getElementById('year-display').innerText = year;
        document.getElementById('month-display').innerText = new Date(year, month - 1).toLocaleString('default', { month: 'long' });
        document.getElementById('day-display').innerText = date;
    
        // Prepare data for submission
        const data = new FormData();
        data.append('table_date', tableDate);
        data.append('year', year);
        data.append('month', month);
        data.append('day', date);
    
        fetch('sessions_1.php', { // Adjust the URL as necessary
            method: 'POST',
            body: data
        })
        .then(response => response.text())
        .then(result => {
            console.log(result);
            tableContainer.style.display = 'block'; // Show the table container
            createTableModal.hide();
            createTableBtn.style.display = 'none'; // Hide the button
            document.getElementById('create-table-header').style.display = 'none'; // Hide the header
            boxInfo.style.display = 'none'; // Hide the box-info section
        })
        .catch(error => console.error('Error:', error));
    });
    

    // Handle cell editing
    const tableContent = document.getElementById('table-content');
    tableContent.addEventListener('dblclick', function (event) {
        if (event.target.hasAttribute('data-name')) {
            event.target.contentEditable = 'true';
            event.target.focus();
        }
    });

    // Get all editable cells
    const cells = document.querySelectorAll('[contenteditable="true"]');

    cells.forEach(function(cell) {
        cell.addEventListener('blur', function() {
            const cellData = {
                id: this.dataset.id,
                name: this.dataset.name,
                value: this.textContent
            };
            updateCell(cellData);
        });
    });

    // Function to send data to the server
    function updateCell(data) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_table_1.php', true); // Adjust URL if needed
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Update successful');
            } else {
                console.log('Update failed');
            }
        };
        xhr.send(JSON.stringify(data));
    }

    // Show confirmation modal before saving
    if (saveChangesBtn) {
        saveChangesBtn.addEventListener('click', function() {
            confirmationModal.show();
        });
    }

    // Handle confirmation button
    document.getElementById('confirm-save').addEventListener('click', function() {
        cells.forEach(function(cell) {
            const cellData = {
                id: cell.dataset.id,
                name: cell.dataset.name,
                value: cell.textContent
            };
            updateCell(cellData);
        });

        // Show success modal after saving
        setTimeout(function() {
            confirmationModal.hide();
            successModal.show();
        }, 500); // Adjust the delay if necessary
    });
});
