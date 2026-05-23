

$(function () {
  'use strict'


  const CONFIG = {
    STYLE: {
      ticks: { fontColor: '#495057', fontStyle: 'bold', beginAtZero: true },
      grid: { display: true, lineWidth: '4px', color: 'rgba(0, 0, 0, .2)', zeroLineColor: 'transparent' }
    },
    INTERACTION: { mode: 'index', intersect: true }
  };


  const DataProvider = {
    getSalesData: () => ({
      labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
      datasets: [
        { label: 'This Year', data: [1000, 2000, 3000, 2500, 2700, 2500, 3000], color: '#007bff' },
        { label: 'Last Year', data: [700, 1700, 2700, 2000, 1800, 1500, 2000], color: '#ced4da' }
      ]
    }),
    getVisitorsData: () => ({
      labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
      datasets: [
        { label: 'Current', data: [100, 120, 170, 167, 180, 177, 160], color: '#007bff' },
        { label: 'Old', data: [60, 80, 70, 67, 80, 77, 100], color: '#ced4da' }
      ]
    })
  };


  const ChartRenderer = {
    // Builder untuk Dataset (LSP & ISP)
    buildDataset: (type, item) => ({
      type: type,
      data: item.data,
      label: item.label,
      backgroundColor: type === 'bar' ? item.color : 'transparent',
      borderColor: item.color,
      pointBackgroundColor: item.color,
      pointBorderColor: item.color,
      fill: false
    }),


    getYAxis: (variant, param) => {
      const base = { gridLines: CONFIG.STYLE.grid, ticks: CONFIG.STYLE.ticks };
      if (variant === 'currency') {
        base.ticks.callback = (v) => '$' + (v >= 1000 ? (v / 1000) + 'k' : v);
      } else if (variant === 'max') {
        base.ticks.suggestedMax = param;
      }
      return base;
    }
  };


  const ChartEngine = {
    render: ($el, type, data, yAxisVariant, yApiParam) => {
      if (!$el.length) return;

      const datasets = data.datasets.map(item => 
        ChartRenderer.buildDataset(type || item.type, item)
      );

      return new Chart($el, {
        type: type,
        data: { labels: data.labels, datasets: datasets },
        options: {
          maintainAspectRatio: false,
          legend: { display: false },
          tooltips: CONFIG.INTERACTION,
          hover: CONFIG.INTERACTION,
          scales: {
            yAxes: [ChartRenderer.getYAxis(yAxisVariant, yApiParam)],
            xAxes: [{ display: true, gridLines: { display: false }, ticks: CONFIG.STYLE.ticks }]
          }
        }
      });
    }
  };


  const App = {
    init: function() {
      this.setupSalesChart();
      this.setupVisitorsChart();
    },

    setupSalesChart: function() {
      const data = DataProvider.getSalesData();
      ChartEngine.render($('#sales-chart'), 'bar', data, 'currency');
    },

    setupVisitorsChart: function() {
      const data = DataProvider.getVisitorsData();
      // Mengirim 'line' secara implisit melalui tipe data jika perlu
      data.datasets = data.datasets.map(d => ({ ...d, type: 'line' }));
      ChartEngine.render($('#visitors-chart'), null, data, 'max', 200);
    }
  };


  App.init();
});
