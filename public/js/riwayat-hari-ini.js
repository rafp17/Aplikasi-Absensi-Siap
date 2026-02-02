async function loadRiwayatHariIni() {
    const res = await fetch(window.routeToday);
    const data = await res.json();

    const list = document.getElementById("riwayatHariIni");
    list.innerHTML = "";

    if (data.length === 0) {
        list.innerHTML = "<li>Belum ada upload hari ini</li>";
        return;
    }

    data.forEach(file => {
        const jam = new Date(file.uploaded_at).toLocaleTimeString('id-ID');
        list.innerHTML += `
        <li>📄 ${file.nama_file} <small>(${file.jenis} - ${file.alasan}) → ${jam}</small></li>`;
    });
}

// const routeToday = "{{ route('usulan.files.today') }}";
const routeSuccessFlag = localStorage.getItem("upload_success");

if (routeSuccessFlag === "true") {
    loadRiwayatHariIni();
    localStorage.removeItem("upload_success");
}

document.addEventListener("DOMContentLoaded", loadRiwayatHariIni);

if (routeSuccessFlag === "true") {
    loadRiwayatHariIni();
    localStorage.removeItem("upload_success");
}

document.addEventListener("DOMContentLoaded", loadRiwayatHariIni);
