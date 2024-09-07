<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts for handling modal actions -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Show modal for adding data
            document.getElementById('tambahDataBtn').addEventListener('click', function () {
            event.preventDefault(); // Prevent the default link behavior
            Swal.fire({
                title: 'Tambah Data',
                text: "Apakah Anda yakin ingin menambah data baru?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tambah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                fetch('/datasiswa/create') 
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalBody').innerHTML = html;
                    document.getElementById('dataModalLabel').innerText = 'Tambah Data Siswa';
                    new bootstrap.Modal(document.getElementById('dataModal')).show();
                })
                .catch(error => console.error('Error loading create form:', error));
                }
            });

        });



            // Show modal for editing data
            document.querySelectorAll('.editBtn').forEach(button => {
                button.addEventListener('click', function () {
                    const studentId = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Edit Data',
                        text: "Apakah Anda yakin ingin mengedit data ini?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Edit!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/datasiswa/edit/${studentId}`) // Fetch the edit form for the specific student
                            .then(response => response.text())
                            .then(html => {
                                document.getElementById('modalBody').innerHTML = html; // Load edit form
                                document.getElementById('dataModalLabel').innerText = 'Edit Data Siswa';
                                new bootstrap.Modal(document.getElementById('dataModal')).show();
                            })
                            .catch(error => console.error('Error loading edit form:', error));
                            }
                    });
                    
                });
            });


                 // Alert for "Delete" button
                document.querySelectorAll('.deleteForm').forEach(form => {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault(); // Prevent the form from submitting
                        Swal.fire({
                            title: 'Hapus Data',
                            text: "Apakah Anda yakin ingin menghapus data ini?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit(); // Submit the form
                            }
                        });
                    });
                });
        });
    </script>