const neoColors = { //init colors
    border: '#08090B',        // Hitam tebal
    grid: '#D1D5DB',          // Abu-abu netral lembut - cocok neobrutalism
    text: '#08090B',          // Hitam tebal
    primary: '#FDE047',       // Kuning neon
    create: '#22C55E',
    update: '#F59E0B',
    delete: '#EF4444'
};
async function renderChart(){
    try{
        const ctx = document.querySelector('#canvas-chart');
        const respon = await fetch('../api/api_crudStatus.php'); //get from session
        const data = await respon.json();
        const labels = Object.keys(data); //x
        const total = Object.values(data); //y
    if(typeof data !== 'undefined' && data !== null && data){//if exist/truthy
        //create chart from chartjs base class Chart
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, 
                datasets: [{
                    fill : false,
                    label: 'Jumlah Operasi Dalam 24 Jam',
                    data: total, 
                    backgroundColor: [
                        neoColors.create,
                        neoColors.update, 
                        neoColors.delete
                    ],
                    borderColor: neoColors.border,
                    borderWidth: 2,
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
                        position: 'bottom'
                    },
                    backgroundColor: neoColors.primary
                },
                scales: {
                    y: {
                        display: true,
                        border: {
                            color: neoColors.border,
                            width: 2
                        },
                        grid: {
                            color: neoColors.grid,       // Garis grid Y - abu netral lembut
                            lineWidth: 1
                        },
                        ticks: {
                            color: neoColors.text,
                            font: {
                                family: "'Space Grotesk', sans-serif",
                                size: 12,
                                weight: '600'
                            }
                        }
                    },
                    x: {
                        border: {
                            color: neoColors.border,
                            width: 2
                        },
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: neoColors.text, // Warna teks label sumbu X (Tambah, Update, Hapus)
                            font: {
                                family: "'Space Grotesk', sans-serif", 
                                size: 14,                       
                                weight: '700'                    
                            }
                        }
                    }
                }
            }
        });
    }
    }catch(error){
        console.log("error_message: ", error);
    }
}
renderChart();
