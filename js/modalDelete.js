//icon status: 
const icon = {
    succes: `<svg xmlns="http://www.w3.org/2000/svg" class="relative flex items-center justify-center top-[15px]" width="25" height="25"  viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>`,
    error : `<svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"  viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>`
}

const mainModal = document.querySelector('#modal-delete');
const submit = document.querySelector('#delete');
const cancel = document.querySelector('#cancel');
const anchorLink = document.querySelector('#deleteLink');
const spanText = document.querySelector('#span-name');
const h2 = document.querySelector('#h2');
const p = document.querySelector('#p');
const pLong = document.querySelector('#p-long');
const svgBg = document.querySelector("#bg-svg")
const svg = document.querySelector("#svg_delete");

const mainBody = document.querySelector(".overflowBody");
function openDeleteModal(event, url, id, nama){
    event.preventDefault();
    event.stopPropagation();
    mainBody.classList.add("!overflow-hidden");
    mainModal.classList.remove('pointer-events-none', 'opacity-0');
    mainModal.classList.add('opacity-100');
    spanText.textContent = nama;
    const link = url;
    const idData = id;
    const namaData = nama;
    submit.addEventListener('click', ()=>{
        window.location.href = link;
    })

cancel.addEventListener('click', () => {
    mainModal.classList.remove('opacity-100');
    mainBody.classList.remove("!overflow-hidden");
    mainModal.classList.add('opacity-0', 'pointer-events-none');
})

};


/* separate */

function showReturn(dataStatusDelete){
    if(dataStatusDelete !== '' && dataStatusDelete === 'sukses'){
        mainModal.classList.remove('pointer-events-none', 'opacity-0');
            mainModal.classList.add('opacity-100');
                h2.textContent = 'data berhasil dihapus';
                p.textContent = 'data berhasil dihapus di database';
                pLong.textContent = 'Data ini telah berhasil terhapus di database';
                        svgBg.style.backgroundColor = "#22C55E";
                svg.innerHTML = icon.succes;
            cancel.remove();
            submit.addEventListener('click', ()=>{
                window.location.href = 'index.php';
        })
    }else if(dataStatusDelete === 'gagal'){
        mainModal.classList.remove('pointer-events-none', 'opacity-0');
        mainModal.classList.add('opacity-100');
            h2.textContent = 'data Gagal dihapus';
            p.textContent = 'data Gagal dihapus di database';
            pLong.textContent = 'Data yang anda tuju gagal terhapus di dalam database';
                svgBg.style.backgroundColor = "#EF4444";
            svg.innerHTML = icon.error;
        cancel.remove();
        submit.addEventListener('click', ()=>{
            window.location.href = 'index.php';

        })
    }
}
