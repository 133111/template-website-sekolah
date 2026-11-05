const updateModal = document.querySelector('#modal-update');
const updateBtn = document.querySelector('#ok-confirm1');
const cancel = document.querySelector('#cancel');
const h2 = document.querySelector('#h2');
const p = document.querySelector('#p');
const pLong = document.querySelector('#p-long');
const mainBody = document.querySelector(".body");
const svg = {
    succes:  `<svg class="w-6 h-6 text-black" xmlns="http://www.w3.org/2000/svg" class="relative flex items-center justify-center top-[15px]" width="25" height="25"  viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>`,
    fail: `<svg class="w-6 h-6 text-black" xmlns="http://www.w3.org/2000/svg" width="25" height="24"  viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>`,
    color : {
        succes: "!p-2 rounded-[8px] bg-[#4ADE80] shadow-[2px_2px_#08090bfb]",
        fail : "!p-2 rounded-[8px] bg-[#EF4444] shadow-[2px_2px_#08090bfb]"
    }
}
const statusSvg = document.querySelector("#iconStatus");
document.addEventListener('DOMContentLoaded', () => {
    if (typeof dataNew !== 'undefined' && dataNew !== '' && dataNew !== 'nothing') {
        if (dataNew === 'sukses') {
            if (updateModal) updateModal.classList.remove('hidden');
            mainBody.classList.add("!overflow-hidden");
            statusSvg.innerHTML = svg.succes ;
            statusSvg.className = svg.color.succes;
            // statusSvg.className = "modal-icon-badge.success";
            if (updateBtn) {
                updateBtn.addEventListener('click', () => {
                    window.location.href = 'index.php';
                });
            }
        } else if (dataNew === 'gagal' || dataNew === 'error') {
            if (h2) h2.textContent = 'Data Gagal di Update';
            if (pLong) pLong.textContent = 'Gagal mengubah data siswa ke database. Silakan coba lagi.';
            if (updateModal) updateModal.classList.remove('hidden');
            // statusSvg.className = "modal-icon-badge.danger";
            statusSvg.innerHTML = svg.fail ;
            statusSvg.className = svg.color.fail;
            if (updateBtn) {
                updateBtn.addEventListener('click', () => {
                    if (updateModal) updateModal.classList.add('hidden');
                });
            }
        }
    }
    if (cancel && updateModal) {
        cancel.addEventListener('click', () => {
            updateModal.classList.add('hidden');
            mainBody.classList.remove("!overflow-hidden");
        });
    }
});