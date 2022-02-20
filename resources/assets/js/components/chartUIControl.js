CreateDashboardSummaryChart = function (x, totalBrand, totalCategory, totalModel, totalWarranty) {
    const TheChart = new Chart(x, {
        type: 'doughnut',
        data: {
            labels: ['Merek', 'Kategori', 'Model', 'Garansi'],
            datasets: [{
                label: 'Total Data',
                data: [
                    totalBrand,
                    totalCategory,
                    totalModel,
                    totalWarranty
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
};
