<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <style>
       .container-custom {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .h-custom {
            font-family: 'Poppins', sans-serif;
            color: #000;

        }
        .h-custom {
            font-size: 30px;
            font-weight: 900;
        }
        /* h4 {
            font-weight: 700;
            font-size: 23px;
            margin-bottom: 20px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);

        } */
        h4 {
            font-family: 'Poppins', sans-serif; 
            font-size: 20px; 
            font-weight: 800; 
            color: #000; 
            letter-spacing: 1.5px; 
            text-transform: uppercase; 
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); 
            margin-bottom: 15px; 
            transition: all 0.3s ease; 
        }

        /* Optional hover effect */
        h4:hover {
            color: #3498db; /* Change color on hover */
            text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.4); /* Enhance the shadow on hover */
            transform: scale(1.05); /* Slightly enlarge on hover */
        }
        h6{
            font-size: 12px;
            color: #000;
        }
        span {
            font-style: italic;
            font-weight: 600;
            color: #000000;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);

        }
        .card {
            border-radius: 15px;
            background-color: #fff;
        }
        .card-custom {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .btn {
            background-color: #ed1212;
            border-color: #e74c3c;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 30px;
            border-radius: 30px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }
        .card-footer {
            margin-top: 20px;
        }
        .card-footer {
            color: #7f8c8d;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-style: italic;
        }

        @media (max-width: 576px) {
            .h-custom {
                font-size: 16px;
            }
            h4 {
                font-size: 18px;
            }
            .btn {
                width: 60%; /* Reduce the button width for mobile */
                padding: 8px 20px; /* Adjust padding for smaller screens */
            }
        }
    </style>
    <div class="container-custom">
        <div class="card card-custom">
            <div class="card-body">
                <div class="card-header border-0">
                    <h1 class="h-custom"><i class="fas fa-gavel"></i> Peraturan dan Tata Tertib</h1>
                    <h4>SMKN 1 KAWALI</h4>
                </div>
                <p class="mt-4">
                    Berikut adalah <span>peraturan</span> dan <span>tata tertib</span> siswa SMK Negeri 1 Kawali.
                </p>
                <div class="mt-4">
                    <a href="{{ url('/download/tata-tertib') }}" class="btn btn-danger" id="downloadBtn">
                        <i class="fas fa-file-pdf"></i> Download
                    </a>
                </div>
                <div class="card-footer">
                    <h6 id="academicYear"></h6>
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
