//clock auto
function updateClock(){
    const now = new Date();
    const hours = String(now.getHours()).padStart(2,"0");
    const minutes = String(now.getMinutes()).padStart(2,"0");
    const secon = String(now.getSeconds()).padStart(2,"0");

    const clockId = document.querySelector("#clock");
    clockId.textContent = `${hours}:${minutes}:${secon}`;
}

updateClock();
setInterval(updateClock, 1000);