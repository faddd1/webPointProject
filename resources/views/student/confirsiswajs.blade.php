<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Scripts for handling modal actions -->
<script>
    
    document.addEventListener('DOMContentLoaded', function () {
    // Show modal for adding data
    document.getElementById('tambahDataBtn').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default link behavior
        
        // Fetch form langsung tanpa konfirmasi
        fetch('/datasiswa/create')
        .then(response => response.text())
        .then(html => {
            // Load content to modal body
            document.getElementById('modalBody').innerHTML = html;
            // Change modal title
            document.getElementById('dataModalLabel').innerText = 'Tambah Data Siswa';
            // Show modal
            const dataModal = new bootstrap.Modal(document.getElementById('dataModal'));
            dataModal.show();
        })
        .catch(error => console.error('Error loading create form:', error));
    });

    document.querySelectorAll('.showBtn').forEach(button => {
        button.addEventListener('click', function () {
            const studentId = this.getAttribute('data-id');
            fetch(`/datasiswa/show/${studentId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalBody').innerHTML = html;
                    document.getElementById('dataModalLabel').innerText = 'Detail Data Siswa';
                    new bootstrap.Modal(document.getElementById('dataModal')).show();
                })
                .catch(error => console.error('Error loading data:', error));
        });
    });


        document.querySelectorAll('.editBtn').forEach(button => {
            button.addEventListener('click', function () {
                const studentId = this.getAttribute('data-id'); // Get student ID from button
                
                // Fetch the edit form for the specific student
                fetch(`/datasiswa/edit/${studentId}`)
                .then(response => response.text())
                .then(html => {
                    // Load the form into the modal body
                    document.getElementById('modalBody').innerHTML = html;
                    // Set the modal title
                    document.getElementById('dataModalLabel').innerText = 'Edit Data Siswa';
                    // Show the modal
                    const dataModal = new bootstrap.Modal(document.getElementById('dataModal'));
                    dataModal.show();
                })
                .catch(error => console.error('Error loading edit form:', error));
            });
        });
        
        // Alert for "Delete" button
        document.querySelectorAll('.deleteForm').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Hapus Data',
                    text: "Apakah Anda yakin ingin menghapus data ini?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });

</script>
