// Toggle between table view and card view
document.getElementById('toggleViewBtn').addEventListener('click', function() {
    var tableView = document.getElementById('tableView');
    var cardView = document.getElementById('cardView');
    
    if (tableView.classList.contains('active-view')) {
        tableView.classList.remove('active-view');
        cardView.classList.add('active-view');
        this.textContent = 'Switch to Table View';
    } else {
        cardView.classList.remove('active-view');
        tableView.classList.add('active-view');
        this.textContent = 'Switch to Card View';
    }
});

// Handle edit button click
document.getElementById("editBtn").addEventListener("click", function () {
    const tableView = document.getElementById('tableView');
    const cardView = document.getElementById('cardView');
    const isEditing = !document.body.classList.contains('editing');
    
    document.body.classList.toggle('editing', isEditing);
    
    if (tableView.classList.contains('active-view')) {
        handleTableViewEdit(isEditing);
    } else {
        handleCardViewEdit(isEditing);
    }
});

function handleTableViewEdit(isEditing) {
    const table = document.getElementById("userTable");
    const rows = table.rows;
    
    for (let i = 0; i < rows.length; i++) {
        if (isEditing) {
            if (i === 0) {
                const th = document.createElement("th");
                th.textContent = "Select";
                rows[i].insertBefore(th, rows[i].firstChild);
                
                const thConfirm = document.createElement("th");
                thConfirm.textContent = "Confirm";
                rows[i].appendChild(thConfirm);
            } else {
                const td = document.createElement("td");
                const checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.className = "select-checkbox";
                checkbox.name = "selectedUsers[]";
                checkbox.value = rows[i].cells[0].textContent;
                td.appendChild(checkbox);
                rows[i].insertBefore(td, rows[i].firstChild);
                
                const tdConfirm = document.createElement("td");
                const confirmButton = document.createElement("button");
                confirmButton.textContent = "Confirm";
                confirmButton.className = "confirm-button";
                confirmButton.addEventListener("click", function() {
                    handleConfirmClick(this);
                });
                tdConfirm.appendChild(confirmButton);
                rows[i].appendChild(tdConfirm);
            }
        } else {
            rows[i].removeChild(rows[i].firstChild);
            rows[i].removeChild(rows[i].lastChild);
        }
    }
}

function handleCardViewEdit(isEditing) {
    const cards = document.querySelectorAll('.user-card');
    
    cards.forEach(card => {
        if (isEditing) {
            const userId = card.querySelector('h3').textContent.split(': ')[1];
            const checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.className = "select-checkbox";
            checkbox.name = "selectedUsers[]";
            checkbox.value = userId;
            
            const confirmButton = document.createElement("button");
            confirmButton.textContent = "Confirm";
            confirmButton.className = "confirm-button";
            confirmButton.addEventListener("click", function() {
                handleConfirmClick(this);
            });
            
            card.insertBefore(checkbox, card.firstChild);
            card.appendChild(confirmButton);
        } else {
            card.removeChild(card.querySelector('.select-checkbox'));
            card.removeChild(card.querySelector('.confirm-button'));
        }
    });
}

function handleConfirmClick(button) {
    let userId;
    if (button.closest('tr')) {
        // Table view
        const row = button.closest("tr");
        const checkbox = row.querySelector('input[type="checkbox"]');
        if (checkbox && checkbox.checked) {
            userId = checkbox.value;
        }
    } else {
        // Card view
        const card = button.closest('.user-card');
        const checkbox = card.querySelector('input[type="checkbox"]');
        if (checkbox && checkbox.checked) {
            userId = checkbox.value;
        }
    }
    
    if (userId) {
        window.location.href = `../playerList/edit.php?user_id=${encodeURIComponent(userId)}`;
    } else {
        alert("Please select a user to edit.");
    }
}



// Handle delete button click
document.getElementById("deleteBtn").addEventListener("click", function () {
    const tableView = document.getElementById('tableView');
    const cardView = document.getElementById('cardView');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    const deleteModal = document.getElementById('deleteModal');

const isDeleting = !document.body.classList.contains('deleting');

    let userIdToDelete = null;
    
    document.body.classList.toggle('deleting', isDeleting);
    
    if (tableView.classList.contains('active-view')) {
        handleTableViewDelete(isDeleting);
    } else {
        handleCardViewDelete(isDeleting);
    }
});
function handleTableViewDelete(isDeleting) {
    const table = document.getElementById("userTable");
    const rows = table.rows;
    
    for (let i = 0; i < rows.length; i++) {
        if (isDeleting) {
            if (i === 0) {
                const th = document.createElement("th");
                th.textContent = "Select";
                rows[i].insertBefore(th, rows[i].firstChild);
                
                const thConfirm = document.createElement("th");
                thConfirm.textContent = "Confirm";
                rows[i].appendChild(thConfirm);
            } else {
                const td = document.createElement("td");
                const checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.className = "select-checkbox";
                checkbox.name = "selectedUsers[]";
                checkbox.value = rows[i].cells[0].textContent;
                td.appendChild(checkbox);
                rows[i].insertBefore(td, rows[i].firstChild);
                
                const tdConfirm = document.createElement("td");
                const confirmButton = document.createElement("button");
                confirmButton.textContent = "Confirm";
                confirmButton.className = "confirm-button";
                confirmButton.addEventListener("click", function() {
                    handleConfirmClickD(this);
                });
                tdConfirm.appendChild(confirmButton);
                rows[i].appendChild(tdConfirm);
            }
        } else {
            rows[i].removeChild(rows[i].firstChild);
            rows[i].removeChild(rows[i].lastChild);
        }
    }
}
function handleCardViewDelete(isDeleting) {
    const cards = document.querySelectorAll('.user-card');
    
    cards.forEach(card => {
        if (isDeleting) {
            const userId = card.querySelector('h3').textContent.split(': ')[1];
            const checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.className = "select-checkbox";
            checkbox.name = "selectedUsers[]";
            checkbox.value = userId;
            
            const confirmButton = document.createElement("button");
            confirmButton.textContent = "Confirm";
            confirmButton.className = "confirm-button";
            confirmButton.addEventListener("click", function() {
                handleConfirmClickD(this);
            });
            
            card.insertBefore(checkbox, card.firstChild);
            card.appendChild(confirmButton);
        } else {
            card.removeChild(card.querySelector('.select-checkbox'));
            card.removeChild(card.querySelector('.confirm-button'));
        }
    });
}
function handleConfirmClickD(button) {
    let userId;
    if (button.closest('tr')) {
        // Table view
        const row = button.closest("tr");
        const checkbox = row.querySelector('input[type="checkbox"]');
        if (checkbox && checkbox.checked) {
            userId = checkbox.value;
        }
    } else {
        // Card view
        const card = button.closest('.user-card');
        const checkbox = card.querySelector('input[type="checkbox"]');
        if (checkbox && checkbox.checked) {
            userId = checkbox.value;
        }
    }
    
    if (userId) {
        window.location.href = `../playerList/delete.php?user_id=${encodeURIComponent(userId)}`;
    } else {
        alert("Please select a user to delete.");
    }
}
