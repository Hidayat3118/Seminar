{{-- @extends('layouts.layout')

@section('konten')
    <main class="bg-blue-500">
        <x-header />

        <div class="max-w-full mx-auto pt-32 md:pt-48 px-4 bg-blue-500">
            <div class="mx-auto w-[320px] rounded-xl p-4 text-center">
                <h1 class="text-lg md:text-xl font-semibold mb-2 text-white">QR Code and Barcode Scanner</h1>
                <div class="bg-white py-10 rounded-xl h-[350px]">
                    <!-- Petunjuk -->
                    <p class="text-sm mb-4 px-4">
                        Tekan Tombol Scan dan Arahkan Kamera ke Barcode ataupun QR Code
                    </p>

                    <!-- QR Code Contoh -->
                    <div id="coba"
                        class="relative w-[200px] h-[200px] bg-white mx-auto mb-6 flex items-center justify-center rounded-md">
                        <img src="{{ asset('img/sqan.png') }}" alt="QR Code" />
                        <div class="absolute top-0 left-0 w-5 h-5 border-t-4 border-l-4 border-blue-500"></div>
                        <div class="absolute top-0 right-0 w-5 h-5 border-t-4 border-r-4 border-blue-500"></div>
                        <div class="absolute bottom-0 left-0 w-5 h-5 border-b-4 border-l-4 border-blue-500"></div>
                        <div class="absolute bottom-0 right-0 w-5 h-5 border-b-4 border-r-4 border-blue-500"></div>
                    </div>

                    <!-- TEMPAT SCANNER (disembunyikan dulu) -->
                    <div id="reader-container" class="hidden mt-4">
                        <div id="reader" class="w-full"></div>
                    </div>
                </div>

                <!-- Tombol Scan -->
                <button id="start-scan"
                    class="mt-4 font-semibold bg-transparent border-2 border-white text-white py-2 px-8 rounded-full hover:bg-white hover:text-blue-500 transition">
                    SCAN
                </button>
            </div>
        </div>

        <x-footer />
    </main>

    <!-- CDN Html5Qrcode -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <!-- JavaScript Scanner -->
    <script>
        const scanButton = document.getElementById('start-scan');
        const readerContainer = document.getElementById('reader-container');
        const coba = document.getElementById('coba');
        let scanner = null;
        let scanning = false;

        scanButton.addEventListener('click', function() {
            if (!scanning) {
                // Mulai scan
                readerContainer.classList.remove('hidden');
                coba.classList.add('hidden');
                scanButton.textContent = 'BATAL';
                scanButton.classList.remove('border-white', 'text-white', 'hover:text-blue-500');
                scanButton.classList.add('bg-red-500', 'text-white', 'hover:bg-red-600', 'border-transparent');

                if (!scanner) {
                    scanner = new Html5Qrcode("reader");
                }

                Html5Qrcode.getCameras().then(devices => {
                    if (devices && devices.length) {
                        const cameraId = devices[0].id;

                        scanner.start(
                            cameraId, {
                                fps: 10,
                                qrbox: 200
                            },
                            qrCodeMessage => {
                                fetch("{{ route('karcis.scan') }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                        },
                                        body: JSON.stringify({
                                            qr_code: qrCodeMessage
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        alert(data.message); // sukses atau QR sudah dipakai
                                        stopScanning();
                                    })
                                    .catch(error => {
                                        alert("Terjadi kesalahan saat mengirim data.");
                                        console.error("Fetch error:", error);
                                        stopScanning();
                                    });
                            },
                            errorMessage => {
                                console.warn("Scan error:", errorMessage);
                            }
                        );

                        scanning = true;
                    }
                }).catch(err => {
                    console.error("Camera error:", err);
                });

            } else {
                // Berhenti scan saat tombol "BATAL" ditekan
                stopScanning();
            }
        });

        function stopScanning() {
            if (scanner) {
                scanner.stop().then(() => {
                    scanner.clear();
                    readerContainer.classList.add('hidden');
                    coba.classList.remove('hidden');

                    // Reset tombol
                    scanButton.textContent = 'SCAN';
                    scanButton.classList.remove('bg-red-500', 'hover:bg-red-600', 'border-transparent');
                    scanButton.classList.add('border-white', 'text-white', 'hover:text-blue-500');

                    scanning = false;
                }).catch(err => {
                    console.error("Stop error:", err);
                });
            }
        }
    </script>
@endsection --}}

{{-- @extends('layouts.layout')

@section('konten')
    <main class="bg-blue-500">
        <x-header />

        <div class="max-w-full mx-auto pt-32 md:pt-48 px-4 bg-blue-500">
            <div class="mx-auto w-[320px] rounded-xl p-4 text-center">
                <h1 class="text-lg md:text-xl font-semibold mb-2 text-white">QR Code and Barcode Scanner</h1>
                <div class="bg-white py-10 rounded-xl h-[350px]">
                    <p class="text-sm mb-4 px-4">
                        Tekan Tombol Scan dan Arahkan Kamera ke Barcode ataupun QR Code
                    </p>

                    <div id="coba"
                        class="relative w-[200px] h-[200px] bg-white mx-auto mb-6 flex items-center justify-center rounded-md">
                        <img src="{{ asset('img/sqan.png') }}" alt="QR Code" />
                        <div class="absolute top-0 left-0 w-5 h-5 border-t-4 border-l-4 border-blue-500"></div>
                        <div class="absolute top-0 right-0 w-5 h-5 border-t-4 border-r-4 border-blue-500"></div>
                        <div class="absolute bottom-0 left-0 w-5 h-5 border-b-4 border-l-4 border-blue-500"></div>
                        <div class="absolute bottom-0 right-0 w-5 h-5 border-b-4 border-r-4 border-blue-500"></div>
                    </div>

                    <div id="reader-container" class="hidden mt-4">
                        <div id="reader" class="w-full"></div>
                    </div>
                </div>

                <button id="start-scan"
                    class="mt-4 font-semibold bg-transparent border-2 border-white text-white py-2 px-8 rounded-full hover:bg-white hover:text-blue-500 transition">
                    SCAN
                </button>
            </div>
        </div>

        <x-footer />
    </main>

    <!-- CDN Html5Qrcode -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const scanButton = document.getElementById('start-scan');
        const readerContainer = document.getElementById('reader-container');
        const coba = document.getElementById('coba');
        let scanner = null;
        let scanning = false;

        scanButton.addEventListener('click', function() {
            if (!scanning) {
                readerContainer.classList.remove('hidden');
                coba.classList.add('hidden');
                scanButton.textContent = 'BATAL';
                scanButton.classList.remove('border-white', 'text-white', 'hover:text-blue-500');
                scanButton.classList.add('bg-red-500', 'text-white', 'hover:bg-red-600', 'border-transparent');

                if (!scanner) {
                    scanner = new Html5Qrcode("reader");
                }

                Html5Qrcode.getCameras().then(devices => {
                    if (devices && devices.length) {
                        const cameraId = devices[0].id;

                        scanner.start(
                            cameraId, {
                                fps: 10,
                                qrbox: 200
                            },
                            qrCodeMessage => {
                                scanButton.disabled = true;
                                fetch("{{ route('karcis.scan') }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                        },
                                        body: JSON.stringify({
                                            qr_code: qrCodeMessage
                                        })
                                    })
                                    .then(async response => {
                                        const data = await response.json();
                                        if (!response.ok) {
                                            throw new Error(data.message ||
                                            'Terjadi kesalahan');
                                        }

                                        Swal.fire({
                                            title: '✅ Sukses',
                                            html: `<strong>${data.message}</strong><br>Peserta: ${data.nama}<br>Seminar: ${data.seminar}`,
                                            icon: 'success'
                                        });
                                        stopScanning();
                                    })
                                    .catch(error => {
                                        Swal.fire({
                                            title: '❌ Gagal',
                                            text: error.message,
                                            icon: 'error'
                                        });
                                        stopScanning();
                                    })
                                    .finally(() => {
                                        scanButton.disabled = false;
                                    });
                            },
                            errorMessage => {
                                console.warn("Scan error:", errorMessage);
                            }
                        );

                        scanning = true;
                    }
                }).catch(err => {
                    console.error("Camera error:", err);
                    Swal.fire("Gagal Akses Kamera", err.message, "error");
                });

            } else {
                stopScanning();
            }
        });

        function stopScanning() {
            if (scanner) {
                scanner.stop().then(() => {
                    scanner.clear();
                    readerContainer.classList.add('hidden');
                    coba.classList.remove('hidden');

                    scanButton.textContent = 'SCAN';
                    scanButton.classList.remove('bg-red-500', 'hover:bg-red-600', 'border-transparent');
                    scanButton.classList.add('border-white', 'text-white', 'hover:text-blue-500');

                    scanning = false;
                }).catch(err => {
                    console.error("Stop error:", err);
                });
            }
        }
    </script>
@endsection --}}

@extends('layouts.layout')

@section('konten')
    <main class="bg-blue-500">
        <x-header />

        <div class="max-w-full mx-auto pt-32 md:pt-48 px-4 bg-blue-500">
            <div class="mx-auto w-[320px] rounded-xl p-4 text-center">
                <h1 class="text-lg md:text-xl font-semibold mb-2 text-white">QR Code and Barcode Scanner</h1>
                <div class="bg-white py-10 rounded-xl h-[350px]">
                    <!-- Petunjuk -->
                    <p class="text-sm mb-4 px-4">
                        Tekan Tombol Scan dan Arahkan Kamera ke Barcode ataupun QR Code
                    </p>

                    <!-- QR Code Contoh -->
                    <div id="coba"
                        class="relative w-[200px] h-[200px] bg-white mx-auto mb-6 flex items-center justify-center rounded-md">
                        <img src="{{ asset('img/sqan.png') }}" alt="QR Code" />
                        <div class="absolute top-0 left-0 w-5 h-5 border-t-4 border-l-4 border-blue-500"></div>
                        <div class="absolute top-0 right-0 w-5 h-5 border-t-4 border-r-4 border-blue-500"></div>
                        <div class="absolute bottom-0 left-0 w-5 h-5 border-b-4 border-l-4 border-blue-500"></div>
                        <div class="absolute bottom-0 right-0 w-5 h-5 border-b-4 border-r-4 border-blue-500"></div>
                    </div>

                    <!-- TEMPAT SCANNER (disembunyikan dulu) -->
                    <div id="reader-container" class="hidden mt-4">
                        <div id="reader" class="w-full"></div>
                    </div>
                </div>

                <!-- Tombol Scan -->
                <button id="start-scan"
                    class="mt-4 font-semibold bg-transparent border-2 border-white text-white py-2 px-8 rounded-full hover:bg-white hover:text-blue-500 transition">
                    SCAN
                </button>
            </div>
        </div>

        <x-footer />
    </main>

    <!-- CDN Html5Qrcode -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const scanButton = document.getElementById('start-scan');
        const readerContainer = document.getElementById('reader-container');
        const coba = document.getElementById('coba');
        let scanner = null;
        let scanning = false;
        let hasScanned = false;

        scanButton.addEventListener('click', function() {
            if (!scanning) {
                readerContainer.classList.remove('hidden');
                coba.classList.add('hidden');
                scanButton.textContent = 'BATAL';
                scanButton.classList.remove('border-white', 'text-white', 'hover:text-blue-500');
                scanButton.classList.add('bg-red-500', 'text-white', 'hover:bg-red-600', 'border-transparent');

                if (!scanner) {
                    scanner = new Html5Qrcode("reader");
                }

                Html5Qrcode.getCameras().then(devices => {
                    if (devices && devices.length) {
                        const cameraId = devices[0].id;

                        scanner.start(
                            cameraId, {
                                fps: 10,
                                qrbox: 200
                            },
                            qrCodeMessage => {
                                if (hasScanned) return; // cegah multiple alert
                                hasScanned = true;
                                scanButton.disabled = true;

                                // Stop scanner duluan biar kamera berhenti
                                stopScanning();

                                fetch("{{ route('karcis.scan') }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                        },
                                        body: JSON.stringify({
                                            qr_code: qrCodeMessage
                                        })
                                    })
                                    .then(async response => {
                                        const data = await response.json();
                                        if (!response.ok) {
                                            throw new Error(data.message ||
                                            'Terjadi kesalahan');
                                        }

                                        Swal.fire({
                                            title: '✅ Sukses',
                                            html: `<strong>${data.message}</strong><br>Peserta: ${data.nama}<br>Seminar: ${data.seminar}`,
                                            icon: 'success'
                                        }).then(() => {
                                            hasScanned = false;
                                        });
                                    })
                                    .catch(error => {
                                        Swal.fire({
                                            title: '❌ Gagal',
                                            text: error.message,
                                            icon: 'error'
                                        }).then(() => {
                                            hasScanned = false;
                                        });
                                    })
                                    .finally(() => {
                                        scanButton.disabled = false;
                                    });
                            },
                            errorMessage => {
                                // Tidak perlu alert di sini agar tidak spam saat kamera idle
                                console.warn("Scan error:", errorMessage);
                            }
                        );

                        scanning = true;
                    }
                }).catch(err => {
                    console.error("Camera error:", err);
                    Swal.fire("Gagal Akses Kamera", err.message, "error");
                });

            } else {
                stopScanning();
            }
        });

        function stopScanning() {
            if (scanner) {
                scanner.stop().then(() => {
                    scanner.clear();
                    readerContainer.classList.add('hidden');
                    coba.classList.remove('hidden');

                    scanButton.textContent = 'SCAN';
                    scanButton.classList.remove('bg-red-500', 'hover:bg-red-600', 'border-transparent');
                    scanButton.classList.add('border-white', 'text-white', 'hover:text-blue-500');

                    scanning = false;
                }).catch(err => {
                    console.error("Stop error:", err);
                });
            }
        }
    </script>


    {{-- <!-- CDN Html5Qrcode -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <!-- JavaScript Scanner -->
    <script>
        const scanButton = document.getElementById('start-scan');
        const readerContainer = document.getElementById('reader-container');
        const coba = document.getElementById('coba');
        let scanner = null;
        let scanning = false;

        scanButton.addEventListener('click', function() {
            if (!scanning) {
                // Mulai scan
                readerContainer.classList.remove('hidden');
                coba.classList.add('hidden');
                scanButton.textContent = 'BATAL';
                scanButton.classList.remove('border-white', 'text-white', 'hover:text-blue-500');
                scanButton.classList.add('bg-red-500', 'text-white', 'hover:bg-red-600', 'border-transparent');

                if (!scanner) {
                    scanner = new Html5Qrcode("reader");
                }

                Html5Qrcode.getCameras().then(devices => {
                    if (devices && devices.length) {
                        const cameraId = devices[0].id;

                        scanner.start(
                            cameraId, {
                                fps: 10,
                                qrbox: 200
                            },
                            qrCodeMessage => {
                                stopScanning(); // pastikan scanner berhenti dulu

                                // Kirim ke back-end
                                fetch("{{ route('karcis.scan') }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                        },
                                        body: JSON.stringify({
                                            qr_code: qrCodeMessage
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        setTimeout(() => {
                                                alert(data.message);
                                            },
                                            200
                                            ); // biar scanner sudah benar-benar berhenti sebelum alert
                                    })
                                    .catch(error => {
                                        setTimeout(() => {
                                            alert("Terjadi kesalahan saat mengirim data.");
                                            console.error("Fetch error:", error);
                                        }, 200);
                                    });
                            },
                            errorMessage => {
                                console.warn("Scan error:", errorMessage);
                            }
                        );

                        scanning = true;
                    }
                }).catch(err => {
                    console.error("Camera error:", err);
                });

            } else {
                // Batal scan
                stopScanning();
            }
        });

        function stopScanning() {
            if (scanner) {
                scanner.stop().then(() => {
                    scanner.clear();
                    readerContainer.classList.add('hidden');
                    coba.classList.remove('hidden');

                    // Reset tombol
                    scanButton.textContent = 'SCAN';
                    scanButton.classList.remove('bg-red-500', 'hover:bg-red-600', 'border-transparent');
                    scanButton.classList.add('border-white', 'text-white', 'hover:text-blue-500');

                    scanning = false;
                }).catch(err => {
                    console.error("Stop error:", err);
                });
            }
        }
    </script> --}}
@endsection
