// preview gambar sebelum di-upload
function previewImage(input, previewId) {
    const file = input.files[0];
    const preview = document.getElementById(previewId);
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}

// konfirmasi sebelum hapus (optional jika tidak pakai inline onclick)
function confirmDelete(url) {
    if (confirm("Yakin ingin menghapus produk ini?")) {
        window.location.href = url;
    }
}

// contoh penggunaan: attach ke input file di create/edit
// <input type="file" onchange="previewImage(this, 'previewImg')">
// <img id="previewImg" width="100">
