/

$(function () {
  'use strict'

  // --- 1. THEME & DEFAULT OPTIONS (Tetap dari Part 1) ---
  const THEME = {
    blue: { primary: 'rgba(60,141,188,0.9)', secondary: 'rgba(60,141,188,0.8)', point: '#3b8bba' },
    gray: { primary: 'rgba(210, 214, 222, 1)', secondary: '#c1c7d1' },
    pieColors: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
  };

  const DEFAULT_OPTIONS = {
    responsive: true,
    maintainAspectRatio: false,
    legend: { display: false }
  };

  // --- 2. CHART ENGINE (Tanggung Jawab: Abstraksi Rendering) ---
  // Fungsi ini "Closed": Tidak perlu diubah-ubah lagi meski chart bertambah.
  const ChartEngine = {
    render: function (config) {
      const $el = $(config.selector);
      if (!$el.length) return;

      const context = $el.get(0).getContext('2d');
      return new Chart(context, {
        type: config.type,
        data: config.data,
        options: $.extend(true, {}, DEFAULT_OPTIONS, config.options || {})
      });
    }
  };

  // --- 3. CHART REGISTRY (Tanggung Jawab: Ekstensi Data) ---
  // Bagian ini "Open": Anda bisa menambah 100 chart di sini tanpa menyentuh ChartEngine.
  const chartsToLoad = [
    {
      id: 'Sales Chart',
      selector: '#salesChart',
      type: 'line',
      data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [
          {
            label: 'Digital Goods',
            backgroundColor: THEME.blue.primary,
            borderColor: THEME.blue.secondary,
            data: [28, 48, 40, 19, 86, 27, 90],
            pointRadius: false
          },
          {
            label: 'Electronics',
            backgroundColor: THEME.gray.primary,
            borderColor: THEME.gray.primary,
            data: [65, 59, 80, 81, 56, 55, 40],
            pointRadius: false
          }
        ]
      },
      options: {
        scales: {
          xAxes: [{ gridLines: { display: false } }],
          yAxes: [{ gridLines: { display: false } }]
        }
      }
    },
    {
      id: 'Browser Share',
      selector: '#pieChart',
      type: 'doughnut',
      data: {
        labels: ['Chrome', 'IE', 'FireFox', 'Safari', 'Opera', 'Navigator'],
        datasets: [{
          data: [700, 500, 400, 600, 300, 100],
          backgroundColor: THEME.pieColors
        }]
      }
    }
  ];

  // --- 4. EXECUTION ---
  // Inisialisasi otomatis semua chart yang terdaftar
  chartsToLoad.forEach(chartConfig => {
    ChartEngine.render(chartConfig);
  });

  // Inisialisasi Map (Karena Mapael bukan ChartJS, kita biarkan terpisah sementara)
  $('#world-map-markers').mapael({
    map: {
      name: "usa_states",
      zoom: { enabled: true, maxLevel: 10 }
    }
  });
});
