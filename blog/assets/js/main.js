// Handle form submissions with SweetAlert
document.addEventListener('DOMContentLoaded', function() {
    // Handle admin forms (add/edit blog)
    const adminForms = document.querySelectorAll('.admin-form');
    adminForms.forEach(form => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(form);
            const action = form.getAttribute('action') || window.location.href;
            const method = form.getAttribute('method') || 'POST';

            try {
                const response = await fetch(action, {
                    method: method,
                    body: formData
                });
                
                const result = await response.json();

                if (result.status === 'success') {
                    await Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: result.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    window.location.href = 'index.php';
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: result.message
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An unexpected error occurred'
                });
            }
        });
    });

    // Handle delete actions
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const url = btn.getAttribute('href');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f1c40f',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url)
                        .then(response => response.json())
                        .then(result => {
                            if (result.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: result.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                                window.location.reload();
                            }
                        });
                }
            });
        });
    });
});