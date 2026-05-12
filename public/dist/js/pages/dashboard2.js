
$(function () {
  'use strict'

  const THEME = {
    blue: { primary: 'rgba(60,141,188,0.9)', secondary: 'rgba(60,141,188,0.8)', point: '#3b8bba' },
    gray: { primary: 'rgba(210, 214, 222, 1)', secondary: '#c1c7d1' },
    pieColors: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
  };

  // --- 1. DATASET FACTORY (Tanggung Jawab: Validasi Kontrak/LSP) ---
  const DatasetFactory = {
    // Membuat template dasar yang aman untuk semua jenis chart
    create: function (type, config) {
      const base = {
        label: config.label || '',
        data: config.data || [],
        backgroundColor: config.backgroundColor || 'transparent',
        borderColor: config.borderColor || 'rgba(0,0,0,0.1)'
      };

      // Spesifik untuk tipe Line (Sub-tipe behavior)
      if (type === 'line') {
        return $.extend(base, {
          pointRadius: config.pointRadius || false,
          pointColor: config.pointColor || '#fff',
          pointStrokeColor: config.borderColor,
          pointHighlightFill: '#fff',
          pointHighlightStroke: config.borderColor,
          fill: config.fill || true
        });
      }

      // Spesifik untuk tipe Pie/Doughnut
      if (type === 'doughnut' || type === 'pie') {
        return $.extend(base, {
          backgroundColor: config.colors || THEME.pieColors,
          borderColor: '#fff'
        });
      }

      return base;
    }
  };

  // --- 2. CHART ENGINE (Tetap Konsisten) ---
  const ChartEngine = {
    render: function (config) {
      const $el = $(config.selector);
      if (!$el.length) return;

      // Transformasi data mentah menggunakan Factory sebelum di-render
      const processedDatasets = config.datasets.map(d => 
        DatasetFactory.create(config.type, d)
      );

      return new Chart($el.get(0).getContext('2d'), {
        type: config.type,
        data: { labels: config.labels, datasets: processedDatasets },
        options: $.extend(true, {
          responsive: true,
          maintainAspectRatio: false,
          legend: { display: false }
        }, config.options || {})
      });
    }
  };

  // --- 3. DEFINISI DATA (Lebih bersih tanpa boilerplate) ---
  const chartsToLoad = [
    {
      selector: '#salesChart',
      type: 'line',
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        { label: 'Digital Goods', data: [28, 48, 40, 19, 86, 27, 90], backgroundColor: THEME.blue.primary, borderColor: THEME.blue.secondary },
        { label: 'Electronics', data: [65, 59, 80, 81, 56, 55, 40], backgroundColor: THEME.gray.primary, borderColor: THEME.gray.primary }
      ],
      options: { scales: { xAxes: [{ gridLines: { display: false } }], yAxes: [{ gridLines: { display: false } }] } }
    },
    {
      selector: '#pieChart',
      type: 'doughnut',
      labels: ['Chrome', 'IE', 'FireFox', 'Safari', 'Opera', 'Navigator'],
      datasets: [
        { data: [700, 500, 400, 600, 300, 100] }
      ]
    }
  ];

  // --- 4. EXECUTION ---
  chartsToLoad.forEach(config => ChartEngine.render(config));

  $('#world-map-markers').mapael({
    map: { name: "usa_states", zoom: { enabled: true, maxLevel: 10 } }
  });
});
