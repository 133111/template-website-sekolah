// Image preview feature
const previewImg = document.querySelector('#gambarUtama');
const submitChange = document.querySelector('#gambar_button');

if (submitChange && previewImg) {
    submitChange.addEventListener('change', function() {
        const file = this.files[0] || null;
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
}
