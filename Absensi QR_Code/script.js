// --- BAGIAN LOGIN ---
if (document.getElementById('loginForm')) {
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const user = document.getElementById('username').value;
        console.log("Login sukses untuk: " + user);
        window.location.href = 'Dashboard.html'; 
    });
}

// --- BAGIAN KAMERA ABSENSI ---
function mulaiAbsen() {
    const video = document.getElementById('video');
    const cameraArea = document.getElementById('cameraArea');

    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" } })
            .then(function (stream) {
                // Munculkan kotak kamera
                cameraArea.classList.remove('d-none');
                
                // Masukkan aliran kamera ke video
                video.srcObject = stream;
                video.play();
                
                // Scroll halus ke bawah agar kamera terlihat
                window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
            })
            .catch(function (error) {
                alert("Gagal akses kamera. Pastikan izin kamera diizinkan di browser.");
            });
    } else {
        alert("Browser Anda tidak mendukung akses kamera.");
    }
}