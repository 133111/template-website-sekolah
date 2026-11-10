//set 'pie chart' for guru page
const neoColors = { //init colors
    border: '#08090B',       
    grid: '#D1D5DB',         
    text: '#08090B',          
    primary: '#FDE047',      
    create: '#22C55E',
    update: '#F59E0B',
    delete: '#EF4444'
};
const mainCanvas = document.querySelector("#graphCrud-guru");
if(mainCanvas){
    async function getDataApi(){
        try{
            //get
            const data = await fetch("../api/apiChartGuru.php");
            if(!data && data === null && data === undefined) throw new Error();
            const res = await data.json();
            const keys = Object.keys(res); //key 
            const total = Object.values(res); //value
            if(typeof data !== undefined && data && data !== null){
                const paramsChart = {
                    //parameter
                    type: 'doughnut',
                    data: {
                        labels: keys, 
                        datasets: [{
                            fill : true,
                            label: 'Jumlah Operasi Dalam 24 Jam',
                            data: total, //contains data
                            backgroundColor: [
                                neoColors.create,
                                neoColors.update, 
                                neoColors.delete
                            ],
                            borderColor: neoColors.border,
                            spacing: 8,
                            borderRadius: 9,
                            borderWidth: 4,
                            color: '#334155',
                            font: {
                                family: "'Space Grotesk', sans-serif", 
                                size: 13,                     
                                weight: '500'
                            }
                            }]
                    },
                    options: {
                        responsive: true, 
                            plugins: {
                                legend: {
                                    display: false 
                                }
                        },
                        scales: {
                            y: {
                                display: false
                            },
                            x: {
                                display: false
                            }
                        }
                    }
                };
                //set instance
                let mainCtx = new Chart(mainCanvas, paramsChart); // -> main place && data to build
                if(!mainCtx) throw new Error(`chartError`);
            };
        }catch(err){
            console.warn(`error message: ${err.message}`);
            return ;
        }
        
    }
    getDataApi(); // all in 1
}