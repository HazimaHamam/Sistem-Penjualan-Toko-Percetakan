 <!--begin::Script-->

<!-- OverlayScrollbars -->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>

<!-- Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>

<!-- AdminLTE -->
<script src="{{ asset('js/adminlte.js') }}"></script>

<!-- OverlayScrollbars Config -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sidebarWrapper = document.querySelector('.sidebar-wrapper');
    const isMobile = window.innerWidth <= 992;

    if (sidebarWrapper && window.OverlayScrollbarsGlobal && !isMobile) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
                theme: 'os-theme-light',
                autoHide: 'leave',
                clickScroll: true,
            },
        });
    }
});
</script>

<!-- SortableJS -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
        crossorigin="anonymous"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const sortableEl = document.querySelector('.connectedSortable');

    if (sortableEl) {
        new Sortable(sortableEl, {
            group: 'shared',
            handle: '.card-header',
        });

        sortableEl.querySelectorAll('.card-header').forEach(el => {
            el.style.cursor = 'move';
        });
    }
});
</script>

<!-- ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        crossorigin="anonymous"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const revenueChartEl = document.querySelector('#revenue-chart');
    if (!revenueChartEl) return; // ⛔ STOP jika elemen tidak ada

    const sales_chart_options = {
        series: [
            { name: 'Digital Goods', data: [28, 48, 40, 19, 86, 27, 90] },
            { name: 'Electronics', data: [65, 59, 80, 81, 56, 55, 40] },
        ],
        chart: {
            height: 300,
            type: 'area',
            toolbar: { show: false },
        },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth' },
        xaxis: {
            type: 'datetime',
            categories: [
                '2023-01-01','2023-02-01','2023-03-01',
                '2023-04-01','2023-05-01','2023-06-01','2023-07-01',
            ],
        },
        tooltip: {
            x: { format: 'MMMM yyyy' },
        },
    };

    new ApexCharts(revenueChartEl, sales_chart_options).render();
});
</script>


    <!-- jsVectorMap -->
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
        crossorigin="anonymous"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =======================
       WORLD MAP
    ======================= */
    const worldMapEl = document.getElementById('world-map');
    if (worldMapEl && window.jsVectorMap) {
        new jsVectorMap({
            selector: '#world-map',
            map: 'world',
        });
    }

    /* =======================
       SPARKLINE 1
    ======================= */
    const sparkline1El = document.getElementById('sparkline-1');
    if (sparkline1El && window.ApexCharts) {
        new ApexCharts(sparkline1El, {
            series: [{ data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021] }],
            chart: { type: 'area', height: 50, sparkline: { enabled: true } },
            stroke: { curve: 'straight' },
            fill: { opacity: 0.3 },
            yaxis: { min: 0 },
            colors: ['#DCE6EC'],
        }).render();
    }

    /* =======================
       SPARKLINE 2
    ======================= */
    const sparkline2El = document.getElementById('sparkline-2');
    if (sparkline2El && window.ApexCharts) {
        new ApexCharts(sparkline2El, {
            series: [{ data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921] }],
            chart: { type: 'area', height: 50, sparkline: { enabled: true } },
            stroke: { curve: 'straight' },
            fill: { opacity: 0.3 },
            yaxis: { min: 0 },
            colors: ['#DCE6EC'],
        }).render();
    }

    /* =======================
       SPARKLINE 3
    ======================= */
    const sparkline3El = document.getElementById('sparkline-3');
    if (sparkline3El && window.ApexCharts) {
        new ApexCharts(sparkline3El, {
            series: [{ data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21] }],
            chart: { type: 'area', height: 50, sparkline: { enabled: true } },
            stroke: { curve: 'straight' },
            fill: { opacity: 0.3 },
            yaxis: { min: 0 },
            colors: ['#DCE6EC'],
        }).render();
    }

});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkAll = document.getElementById('checkAll');

    if (!checkAll) return;

    checkAll.addEventListener('click', function () {
        document.querySelectorAll('.checkItem').forEach(cb => {
            cb.checked = this.checked;
        });
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>