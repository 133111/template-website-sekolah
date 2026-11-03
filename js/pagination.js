// globals
const paginationMain = document.querySelector('#pagination-main');
let maxButtonPerPage = 5 ; 
let currentStartLoop = 0; //init for loop -> extracted
let totalNavigate = 0; // extracted
let getPageActive = "";  //extracted
let pageNumber = 1; //anchor based
let link = "";
const iconPagination = {
    left: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" /></svg>`,
    right: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>`
};

//init arrow rendering functions
function renderArrowLeft(){
    let arrowLeft = document.createElement('div');
    arrowLeft.className = "arrowLeft bg-[#ECEFF1] !hover:bg-red-600 w-[20px] h-[22px] rounded-[6px] cursor-pointer";
    arrowLeft.innerHTML = `
        ${iconPagination.left}
        `;
    return arrowLeft;
}
function renderArrowRight(){
    let arrowRight = document.createElement('div');
    arrowRight.className = "arrowRight z-50 bg-[#ECEFF1] !hover:bg-[#d7dadd] w-[20px] h-[22px] rounded-[6px] cursor-pointer";
    arrowRight.innerHTML = `
        ${iconPagination.right}
    `;
    return arrowRight;
}

//init anchor number create function 
function renderAnchor(pageNumber){
    let anchor = document.createElement('a');
    pageNumber = Number(pageNumber);
    anchor.className = "main-anchor-pagination text-center !bg-[#ebeef0] !hover:bg-[#d7dadd] w-[25px] h-[25px] rounded-[6px] cursor-pointer"
        anchor.href = `?page=${pageNumber}`;
            anchor.textContent = `${pageNumber}`;
                anchor.style.backgroundColor = (getPageActive == pageNumber) ? "#16a34a" : "#22c55e";
    return anchor ;
}
//main function one for all caller
async function getPaginationApi(){
    try{
        let api = await fetch(`../api/api_pagination.php`);
        let data = await api.json(); //main data js
        if(!api.ok && data.status !== true && data){
            throw new Error();
        };
        //extraction globals section  :
            totalNavigate = data.navigate; 
            getPageActive = data.pageActive;        
            currentStartLoop = data.start ;
    }
    catch(Error){
        console.log(`api problems at: ${Error}`)
    };

    renderPaginationUi();
}

function renderPaginationUi(){
    //init arrows symbol
    let arrowLeft = renderArrowLeft();
    let arrowRight = renderArrowRight();
    paginationMain.innerHTML = "";
    paginationMain.appendChild(arrowLeft);
    let currentEndLoop = Math.min((currentStartLoop + 5) - 1, totalNavigate) ; 
    for(let page = currentStartLoop; page <= currentEndLoop; page ++){
        let anchor = renderAnchor(page);
        if(anchor){
            paginationMain.appendChild(anchor);
        }
    }
    paginationMain.appendChild(arrowRight);
    attachedAnchorEvent(arrowRight, arrowLeft);
}

function attachedAnchorEvent(arrowRight, arrowLeft){
    //arrowLeft service event
    arrowLeft.addEventListener("click", (e) => {
        if(currentStartLoop){
            currentStartLoop = currentStartLoop - maxButtonPerPage ;
            if(currentStartLoop < 1){
                currentStartLoop = 1;
            }
            renderPaginationUi();
        }
    })
    //arrowRight service event
    arrowRight.addEventListener("click", (e) => {
        let currentEndLoop = Math.min((currentStartLoop + maxButtonPerPage) - 1, totalNavigate) ;
        if(currentEndLoop){
            currentStartLoop = currentEndLoop + 1 ;
            if(currentEndLoop === totalNavigate){
                modalEndLoop();
                currentStartLoop = 1; //reset counter to init
            }
            renderPaginationUi();
        }
    })
}

function modalEndLoop(){
    //wrapper modal
    const icon = {
        close_x: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>`,
        okButton : ``
    }
    let modalWrapper = document.createElement("div");
        modalWrapper.className = "wrapperModal-end transition-opacity duration-500 backdrop-blur-md fixed flex items-center justify-center z-[100] bg-[#08090B]/65  inset-0"; //main parent element
        modalWrapper.id = "mainWrapperHasEnd";
        modalWrapper.id = "modalWrapperEndLoop";
        modalWrapper.innerHTML = `
            <div class="mainModalEnd bg-white w-[90%] max-w-[420px] rounded-[16px] border-2 border-[#08090B] shadow-[6px_6px_0px_#08090B] flex flex-col gap-4" style="padding:24px 26px">
                <div class="modal1 flex items-center gap-[14px]">
                    <div class="svg-notif-icons-delete flex justify-center items-center shrink-0">
                        <div id="bg-svg" class="bg-[#FF4D6D] flex items-center justify-center w-12 h-12 rounded-[10px] border-2 border-[#08090B] shadow-[1px_1px_0px_#08090B]">
                            <svg class="text-white" xmlns="http://www.w3.org/2000/svg" id="svg_delete" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                        </div>
                    </div>
                    <div class="header">
                        <h2 id="h2" class="text-[17px] font-extrabold text-[#08090B]">Data Mencapai Batas!</h2>
                        <p id="p" class="text-[11px] font-semibold text-[#6B7280] uppercase tracking-[0.5px]">SIMS- SMK 1 NGAWI</p>
                    </div>
                </div>
                <div class="modal2 bg-[#F8F9FA] border border-[#08090B] rounded-[8px] flex items-center !h-[5rem] !p-[8px] px-[14px] py-[10px]">
                    <p class="text-[13.5px] leading-[1.5] font-medium text-[#374151]" id="p-long">Data telah mencapai batas, klik OK untuk kembali</p>
                </div>
                <div class="modal3 button-section cursor-pointer !h-[2rem] flex justify-end items-end text-center mt-1 !z-[150]">
                    <a href="" id="okButton" class="cursor-pointer btn-OK bg-[#22C55E] !z-[200] border-2 border-[#08090B] shadow-[3px_3px_0px_#08090B] hover:shadow-[4px_5px_0px_#08090B] hover:-translate-x-px hover:-translate-y-px active:shadow-[1px_1px_0px_#08090B] active:translate-x-px active:translate-y-px transition-all duration-150 text-white font-bold text-[13px] rounded-[8px] px-5 py-[9px] min-w-[6rem]"> OK </a>
                </div>
            </div>
        `;
        document.body.appendChild(modalWrapper);
        const mainOk = document.querySelector("#okButton");
        mainOk.addEventListener("click", (e) => {
            // idMainModal.classList.toggle("pointer-events-auto hidden");
            e.preventDefault();
            modalWrapper.remove();
        })
    return modalWrapper; //return element
}
//call main function
getPaginationApi();