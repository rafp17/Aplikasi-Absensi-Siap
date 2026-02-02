async function loadFileTerkirim() {
    const res = await fetch("{{ route('usulan.files') }}");
    const data = await res.json();

    const list = document.getElementById("listFileTerkirim");
    list.innerHTML = "";

    data.forEach(file => {
        list.innerHTML += `
        <li>📄 <a href="/storage/${file.path_file}" target="_blank">${file.nama_file}</a>
            <small>(${file.jenis} - ${file.alasan})</small>
        </li>`;
    });
}

document.addEventListener("DOMContentLoaded", loadFileTerkirim);
