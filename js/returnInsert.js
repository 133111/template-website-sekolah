document.addEventListener('DOMContentLoaded', () => {
    if (typeof dataAdd !== 'undefined' && dataAdd !== '' && dataAdd !== 'nothing') {
        if (dataAdd === 'true') {
            // Gunakan neo-modal untuk success
            window.showNeoModal({
                type: 'success',
                title: 'Data Berhasil Ditambahkan',
                subtitle: 'SIMS - SMK 1 NGAWI',
                message: 'Data siswa baru telah berhasil disimpan ke database.',
                redirect: 'index.php'
            });
        } else if (dataAdd === 'false') {
            // Gunakan neo-modal untuk error
            window.showNeoModal({
                type: 'error',
                title: 'Gagal Menambahkan Data',
                subtitle: 'SIMS - SMK 1 NGAWI',
                message: 'Terjadi kesalahan saat menyimpan data. Pastikan semua kolom terisi dengan benar dan format gambar valid (JPG/PNG, maks 1MB).'
            });
        }
    }
});