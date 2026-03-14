<script>
document.addEventListener('DOMContentLoaded', () => {

    /* ── Chart ── */
    const ctx  = document.getElementById('ordersChart');
    const skel = document.getElementById('chartSkel');

    if (ctx) {
        setTimeout(() => {
            // Fade out skeleton
            if (skel) {
                skel.style.transition = 'opacity .3s';
                skel.style.opacity = '0';
                setTimeout(() => skel.remove(), 300);
            }
            // Fade in canvas
            ctx.style.display = 'block';
            ctx.style.opacity = '0';
            ctx.style.transition = 'opacity .45s ease';
            setTimeout(() => ctx.style.opacity = '1', 60);

            const c2d   = ctx.getContext('2d');
            const grad  = c2d.createLinearGradient(0, 0, 0, 250);
            grad.addColorStop(0,    'rgba(124,109,250,.22)');
            grad.addColorStop(0.6,  'rgba(124,109,250,.05)');
            grad.addColorStop(1,    'rgba(124,109,250,0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartLabels ?? []),
                    datasets: [{
                        data: @json($chartData ?? []),
                        borderColor: '#7c6dfa',
                        backgroundColor: grad,
                        fill: true,
                        tension: 0.44,
                        borderWidth: 2.5,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#0f0e0c',
                        pointHoverBorderColor: '#7c6dfa',
                        pointHoverBorderWidth: 2.5,
                    }]
                },
                options: {
                    responsive: true,
                    animation: { duration: 1000, easing: 'easeInOutQuart' },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e1c18',
                            titleColor: '#6b665e',
                            bodyColor: '#f5f3ef',
                            padding: 14,
                            borderRadius: 12,
                            borderColor: 'rgba(255,255,255,.07)',
                            borderWidth: 1,
                            titleFont: { size: 11, family: 'DM Sans, sans-serif' },
                            bodyFont:  { size: 14, weight: '700', family: 'DM Sans, sans-serif' },
                            displayColors: false,
                            callbacks: {
                                title: i  => i[0].label,
                                label: c  => c.parsed.y === 0
                                    ? 'Tidak ada pesanan'
                                    : c.parsed.y + ' pesanan masuk',
                            }
                        }
                    },
                    interaction: { mode: 'index', intersect: false },
                    scales: {
                        x: {
                            grid:   { display: false },
                            border: { display: false },
                            ticks:  {
                                color: '#6b665e',
                                font:  { size: 11 },
                                maxTicksLimit: 7,
                                maxRotation: 0,
                                autoSkip: true,
                            }
                        },
                        y: {
                            beginAtZero: true,
                            border: { display: false },
                            grid:   { color: 'rgba(255,255,255,.04)', drawTicks: false },
                            ticks:  {
                                color: '#6b665e',
                                font:  { size: 11 },
                                stepSize: 1,
                                padding: 10,
                                callback: v => Number.isInteger(v) ? v : '',
                            }
                        }
                    }
                }
            });
        }, 750);
    }

    /* ── Table row toggle ── */
    document.querySelectorAll('.tbl-row').forEach(row => {
        row.addEventListener('click', function () {
            const was = this.classList.contains('active');
            document.querySelectorAll('.tbl-row.active').forEach(r => r.classList.remove('active'));
            if (!was) this.classList.add('active');
        });
    });

});
</script>