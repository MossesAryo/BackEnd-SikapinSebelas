 document.addEventListener("DOMContentLoaded", function() {
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            const revenueChart = new Chart(revenueCtx, {
                type: 'bar',
                data: {
                    labels: ['MPLB', 'AKL', 'MLOG', 'PM', 'RPL', 'DKV', 'TJKT'],
                    datasets: [{
                        label: 'Apresiasi',
                        data: [120, 190, 300, 500, 200, 300, 400],
                        backgroundColor: 'rgba(34, 197, 94, 0.7)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            const expenseCtx = document.getElementById('expenseChart').getContext('2d');
            const expenseChart = new Chart(expenseCtx, {
                type: 'bar',
                data: {
                    labels: ['MPLB', 'AKL', 'MLOG', 'PM', 'RPL', 'DKV', 'TJKT'],
                    datasets: [{
                        label: 'Pelanggaran',
                        data: [100, 150, 250, 300, 180, 200, 350],
                        backgroundColor: 'rgba(239, 68, 68, 0.7)',
                        borderColor: 'rgba(239, 68, 68, 1)',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            document.querySelectorAll('.toggle-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const toggleContainer = this.parentElement;
                    const buttons = toggleContainer.querySelectorAll('.toggle-btn');

                    buttons.forEach(button => {
                        button.classList.remove('bg-white', 'text-blue-500');
                        button.classList.add('text-gray-600');
                    });

                    this.classList.add('bg-white', 'text-blue-500');
                    this.classList.remove('text-gray-600');
                });
            });
        });