export const data = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
        {
            label: 'Dataset 1',
            backgroundColor: '#8C57FF',
            data: [50, 25, 12, 48, 90, 76, 42],
        },
        {
            label: 'Dataset 2',
            backgroundColor: '#16B1FF',
            data: [21, 84, 24, 75, 37, 65, 34],
        },
        {
            label: 'Dataset 3',
            backgroundColor: '#56CA00',
            data: [41, 52, 24, 74, 23, 21, 32],
        },
    ],
}

export const options = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        tooltip: {
            mode: 'index',
            intersect: false,
        },
        legend: {
            labels: {
                color: '#FFF',
            },
        },
    },
    scales: {
        x: {
            stacked: true,
            ticks: {
                color: '#FFF',
            },
            grid: {
                color: '#71717a',
            },
        },
        y: {
            stacked: true,
            ticks: {
                color: '#FFF',
            },
            grid: {
                color: '#71717a',
            },
        },
    },
}
