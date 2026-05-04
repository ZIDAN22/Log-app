window.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const sidebarToggle = document.getElementById('sidebarToggle');
    const persisted = localStorage.getItem('sidebarCollapsed') === 'true';

    if (persisted) {
        body.classList.add('sidebar-collapsed');
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', () => {
            const isCollapsed = body.classList.toggle('sidebar-collapsed');
            localStorage.setItem('sidebarCollapsed', isCollapsed);
        });
    }

    function initializeCharts() {
        const stockPieCtx = document.getElementById('stockPieChart');
        const deliveryTrendCtx = document.getElementById('deliveryTrendChart');

        if (stockPieCtx && window.Chart) {
            new Chart(stockPieCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Stok Aman', 'Stok Rendah', 'Akan Habis'],
                    datasets: [{
                        data: [62, 24, 14],
                        backgroundColor: ['#0ea5e9', '#f59e0b', '#ef4444'],
                        borderWidth: 0,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#475569',
                            },
                        },
                    },
                },
            });
        }

        if (deliveryTrendCtx && window.Chart) {
            new Chart(deliveryTrendCtx, {
                type: 'line',
                data: {
                    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                    datasets: [{
                        label: 'Pengiriman',
                        data: [82, 94, 88, 103, 97, 115, 108],
                        borderColor: '#0ea5e9',
                        backgroundColor: 'rgba(14, 165, 233, 0.16)',
                        fill: true,
                        tension: 0.35,
                        pointRadius: 3,
                        pointBackgroundColor: '#0ea5e9',
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            ticks: { color: '#64748b' },
                            grid: { display: false },
                        },
                        y: {
                            ticks: { color: '#64748b' },
                            grid: { color: 'rgba(148, 163, 184, 0.16)' },
                        },
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                },
            });
        }
    }

    if (window.Chart) {
        initializeCharts();
    } else {
        window.addEventListener('load', initializeCharts);
    }
});
