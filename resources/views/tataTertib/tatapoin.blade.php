<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <style>
        .container-custom {
            width: 100%;
            max-width: 600px; /* Limit width on larger screens */
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #333;
            font-size: 35px;
        }
        h6 {
            font-size: 12px;
        }
        h4 {
            font-family: 'Times New Roman', Times, serif;
            font-size: 25px;
            font-weight: 700;
        }
        span{
            font-style: italic;
            font-weight: 600;
        }
        .card {
            border-radius: 15px;
        }
        .card-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
        }
        /* Ensure padding and size on smaller devices */
        @media (max-width: 576px) {
            .container-custom {
                padding: 10px;
            }
            h1 {
                font-size: 24px;
            }
            h4 {
                font-size: 18px;
            }
            h3 {
                font-size: 15px;
            }
            .btn {
                width: 60%;
            }
        }
    </style>
    <div class="container-custom">
        <div class="card">
            <div class="card-body">
                <div class="card-header border-0">
                    <h3 style="font-weight: 400; font-family: 'Times New Roman', Times, serif;">Peraturan dan Tata Tertib</h3>
                    <h4>SMKN 1 KAWALI</h4>
                </div>
                <div class="card mt-3 card-custom">
                    <div class="card-body">
                        <p class="mt-4">Berikut adalah <span>peraturan</span> dan <span>tertib</span> siswa SMK Negeri 1 Kawali.</p>
                        <div class="mt-4">
                            <a href="{{ url('/download/tata-tertib') }}" class="btn btn-danger" id="downloadBtn"><i class="fas fa-file-pdf"></i> Download</a>
                        </div>
                        <div class="card-footer" style="background: #fff;">
                            <h6 class="mt-3" id="academicYear"></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    document.getElementById('downloadBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default action

        Swal.fire({
        title: 'Download Tata Tertib?',
        text: "Anda akan mendownload file Tata Tertib Siswa!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Download'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ url("/download/tata-tertib") }}'; // Laravel route for forced download
            }
        });
    });
</script>



<script>
    // Get the current year
    const currentYear = new Date().getFullYear();
    // Calculate the next year for the academic year range
    const nextYear = currentYear + 1;
    // Update the academic year dynamically
    document.getElementById('academicYear').innerText = `Tahun ajaran ${currentYear}-${nextYear}.`;
</script>
