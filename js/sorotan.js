//highlight content menu
//init
document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM loaded");
    const currentPath = window.location.pathname ;
    let currentPage = getEndPoint(currentPath);
    if(currentPage && currentPage !== "undefined"){
        highlight(currentPage);
    }
})

//getter function -> element content menu getter
function getEndPoint(path){
    const part = path.split("/").filter(anchor => anchor && anchor !== "" && anchor !== "undefined"); // raw
    const index = part.length - 1;  
    if(index && part){
        const endPoint = part[index];
        const urlList = { 
            "siswa": "siswa", 
            "guru": "guru",
            "profile-admin": "profile-admin",
            "daftar-admin": "daftar-admin",
            "laporan": "laporan",
            "pengaturan": "pengaturan"
        }//data
        return urlList[endPoint] || urlList["siswa"]; //set fallback
    }
}
//setter function -> endpoint 
function highlight(path){
    //reset active class
    const allContentMenu = document.querySelectorAll(".content-menu .anchor");
    allContentMenu.forEach(link => {
        if(link && link !== "undefined"){
            link.classList.remove("active"); //reset condition
        }
    })
    //get main anchor via selector 1 ell
    const getMainAnchor = document.querySelector(`a[onclick*="window.__sorotan='${path}'"]`);
    if(getMainAnchor){
        const parentOfAnchor = getMainAnchor.closest(".content-menu");
        if(parentOfAnchor){
            parentOfAnchor.classList.add("active"); //call main class lighter
        }
    }
}