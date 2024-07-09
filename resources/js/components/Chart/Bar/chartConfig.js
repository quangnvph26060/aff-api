export const data = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
        {
            label: 'F1',
            backgroundColor: '#8C57FF',
            borderColor: '#8C57FF',
            data: [40, 20, 12, 39, 10, 40, 39],
            borderWidth: 1,
        },
        {
            label: 'F2',
            backgroundColor: '#16B1FF',
            borderColor: '#16B1FF',
            data: [34, 23, 15, 37, 11, 42, 38],
            borderWidth: 1,
        },
        {
            label: 'F3',
            backgroundColor: '#56CA00',
            borderColor: '#56CA00',
            data: [45, 19, 14, 32, 9, 35, 41],
            borderWidth: 1,
        },
        {
            label: 'F4',
            backgroundColor: '#FFB400',
            borderColor: '#FFB400',
            data: [38, 22, 17, 40, 13, 47, 36],
            borderWidth: 1,
        },
        {
            label: 'F5',
            backgroundColor: '#FF4C51',
            borderColor: '#FF4C51',
            data: [41, 21, 16, 35, 12, 39, 34],
            borderWidth: 1,
        },
    ],
    title: 'Chart Title',
}

export const options = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            labels: {
                color: '#FFF', // Set legend text color to white
            },
        },
    },
    scales: {
        x: {
            ticks: {
                color: '#FFF', // Set x-axis text color to white
            },
            grid: {
                color: '#71717a', // Set grid line color, optional
            },
        },
        y: {
            ticks: {
                color: '#FFF', // Set y-axis text color to white
            },
            grid: {
                color: '#71717a', // Set grid line color, optional
            },
        },
    },
}
