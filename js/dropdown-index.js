const mainMenu = document.querySelector('#main-menu');
const subMenu = document.querySelector('#sub-menu');

mainMenu.addEventListener('click', (e)=>{
    e.stopPropagation();
    if(mainMenu && subMenu){
        subMenu.classList.toggle('hidden');
    }

})

document.addEventListener('click', ()=>{
    if(!subMenu.classList.contains('hidden')){
        subMenu.classList.add('hidden');
    }
})