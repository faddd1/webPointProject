
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('tambahDataBtn').addEventListener('click', function (event) {
        event.preventDefault();
        
       
        fetch('/teacher/create')
        .then(response => response.text())
        .then(html => {
           
            document.getElementById('modalBody').innerHTML = html;
           
            document.getElementById('dataModalLabel').innerText = 'Tambah Data Guru';
           
            const dataModal = new bootstrap.Modal(document.getElementById('dataModal'));
            dataModal.show();
        })
        .catch(error => console.error('Error loading create form:', error));
    });

      document.querySelectorAll('.editBtn').forEach(button => {
            button.addEventListener('click', function () {
                const teacherId = this.getAttribute('data-id'); 
                
               
                fetch(`teacher/edit/${teacherId}`)
                .then(response => response.text())
                .then(html => {
                  
                    document.getElementById('modalBody').innerHTML = html;
                   
                    document.getElementById('dataModalLabel').innerText = 'Edit Data Guru';
                   
                    const dataModal = new bootstrap.Modal(document.getElementById('dataModal'));
                    dataModal.show();
                })
                .catch(error => console.error('Error loading edit form:', error));
            });
        });

     
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