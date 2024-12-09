let currentPage = 1;
const limit = 10;
let sortField = 'userName';
let sortOrder = 'asc';

document.getElementById('prevPage').addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        loadUsers();
    }
});

document.getElementById('nextPage').addEventListener('click', () => {
    currentPage++;
    loadUsers();
});

document.querySelectorAll('.sort').forEach(header => {
    header.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default anchor behavior
        sortField = this.getAttribute('data-sort');
        sortOrder = this.getAttribute('data-order') === 'asc' ? 'desc' : 'asc';
        this.setAttribute('data-order', sortOrder);
        loadUsers();
    });
});

function loadUsers() {
    fetch(`get-users.php?page=${currentPage}&limit=${limit}&sort=${sortField}&order=${sortOrder}`)
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#userTable tbody');
            tbody.innerHTML = '';
            data.users.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
          <td class="py-1"><img src="../../uploads/${user.photo}" alt="image" /></td>
          <td>${user.userName}</td>
          <td>${user.email}</td>
          <td>${user.age}</td>
          <td>${user.created_at}</td>
          <td>${user.updated_at}</td>
          <td>
            <a href="#" class="btn btn-primary edit-user" data-id="${user.id}" data-username="${user.userName}" data-email="${user.email}" data-age="${user.age}">Edit</a>
            <button class="btn btn-danger delete-user" data-id="${user.id}">Delete</button>
          </td>
        `;
                tbody.appendChild(row);
            });

            // Add event listeners for delete buttons
            document.querySelectorAll('.delete-user').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const id = this.getAttribute('data-id');
                    if (confirm('Are you sure you want to delete this user?')) {
                        fetch('delete-user.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ id: id })
                        })
                            .then(response => response.json())  // Ensure you parse the response as JSON
                            .then(data => {
                                console.log(data);  // Log the response for debugging
                                if (data.success) {
                                    event.target.closest('tr').remove(); // Remove the row dynamically
                                } else {
                                    alert('Error deleting user: ' + (data.message || 'Unknown error')); // Display any message from the server
                                }
                            })
                            .catch(error => {
                                console.error(error);  // Log any errors in the fetch process
                                alert('Error deleting user: ' + error.message);
                            });

                    }
                });
            });
            document.querySelectorAll('.ban-user').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');
                    if (confirm('Are you sure you want to ban this user?')) {
                        fetch(`../../Controller/UserController.php?action=ban&id=${userId}`, {
                            method: 'POST'
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('User has been banned successfully.');
                                    this.style.display = 'none';
                                    document.querySelector(`.unban-user[data-id="${userId}"]`).style.display = 'inline-block';
                                } else {
                                    alert('Failed to ban the user.');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            });

            document.querySelectorAll('.unban-user').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');
                    if (confirm('Are you sure you want to unban this user?')) {
                        fetch(`../../Controller/UserController.php?action=unban&id=${userId}`, {
                            method: 'POST'
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('User has been unbanned successfully.');
                                    this.style.display = 'none';
                                    document.querySelector(`.ban-user[data-id="${userId}"]`).style.display = 'inline-block';
                                } else {
                                    alert('Failed to unban the user.');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            });
        });
}

loadUsers();

document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#userTable tbody tr');

    rows.forEach(row => {
        const cells = row.querySelectorAll('td:not(.py-1)');
        const match = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(searchValue));
        row.style.display = match ? '' : 'none';
    });
});