//3 element
const mainWrapper = document.querySelector("#wrapper"); //(main wrapper grid)
const sidebar = document.querySelector("#main-sidebar"); //(main wrapper of side bar content)

const sidebarToggle = document.querySelector("#toggle-sidebar"); //toggle sidebar button

if(mainWrapper && sidebar){ // ! null
    sidebarToggle.addEventListener('click', ()=>{
        mainWrapper.classList.toggle("sidebar-collapse");
    });
}
