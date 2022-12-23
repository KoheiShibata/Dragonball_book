const ctx = document.getElementById('myChart');
const jsonData = JSON.parse(ctx.dataset.character)

var myChart = new Chart(ctx, {
    type: 'radar',
    data: {
        labels: ['attack', 'defense', 'ability', 'popularity',],
        datasets: [{
            label: 'ステータス',
            data: [jsonData.attack, jsonData.defense, jsonData.ability, jsonData.popularity,],
            backgroundColor: "rgba(255,0,0,0.5)",
            borderColor: "#E70012",
            borderWidth: 2,
        }]
    },
    options: {
        responsive: true,
        scales: {
            r: {
                min: 0,
                max: 10,
                //背景色
                backgroundColor: 'snow',
                //グリッドライン
                grid: {
                    color: 'orange',
                },
                //アングルライン
                angleLines: {
                    color: 'orange',
                },
                //各項目のラベル
                pointLabels: {
                    color: 'orange',
                },
                ticks: {
                    stepSize: 2 //目盛間隔
                }

            },
        },
    },
});