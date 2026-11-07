// Memuat potongan HTML saat halaman sedang diparse (urutan & event load tetap normal).
// Harus dijalankan lewat server lokal (mis. VS Code Live Server / php -S / XAMPP).
function include(path) {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", path, false);
  xhr.send();
  if (xhr.status === 200 || xhr.status === 0) {
    document.write(xhr.responseText);
  } else {
    console.error("Gagal memuat " + path);
  }
}
