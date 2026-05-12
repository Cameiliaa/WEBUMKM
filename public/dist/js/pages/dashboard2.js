

$(function () {
  'use strict';


  const THEME = {
    colors: {
      blue: { primary: 'rgba(60,141,188,0.9)', secondary: 'rgba(60,141,188,0.8)', point: '#3b8bba' },
      gray: { primary: 'rgba(210, 214, 222, 1)', secondary: '#c1c7d1' },
      palette: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
    }
  };


  const DashboardData = {
    getSalesData: () => ({
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        { label: 'Digital Goods', data: [28, 48, 40, 19, 86, 27, 90], theme: 'blue' },
        { label: 'Electronics', data: [65, 59, 80, 81, 56, 55, 40], theme: 'gray' }
      ]
    }),
    getBrowserData: () => ({
      labels: ['Chrome', 'IE', 'FireFox', 'Safari', 'Opera', 'Navigator'],
      datasets: [{ data: [700, 500, 400, 600, 300, 100], theme: 'palette' }]
    }),
    getMapConfig: () => ({ selector: '#world-map-markers', mapName: 'usa_states' })
  };

  -
  const DatasetBuilder = {
    build: function(type, item) {
      const isLine = type === 'line';
      const colorSet = THEME.colors[item.theme] || { primary: '#d2d6de' };

      return {
        label: item.label || '',
        data: item.data,
        backgroundColor: isLine ? colorSet.primary : (item.theme === 'palette' ? THEME.colors.palette : colorSet.primary),
        borderColor: isLine ? colorSet.secondary : '#fff',
        pointRadius: false,
        pointColor: colorSet.point || colorSet.primary,
        fill: isLine,
      
        pointStrokeColor: colorSet.secondary,
        pointHighlightFill: '#fff',
        pointHighlightStroke: colorSet.secondary
      };
    }
  };


  const ChartRenderer = {
    render: function(selector, type, data) {
      const $el = $(selector);
      if (!$el.length) return;

      const context = $el.get(0).getContext('2d');
      const processedDatasets = data.datasets.map(d => DatasetBuilder.build(type, d));

      return new Chart(context, {
        type: type,
        data: { labels: data.labels, datasets: processedDatasets },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: { display: false },
          scales: type === 'line' ? {
            xAxes: [{ gridLines: { display: false } }],
            yAxes: [{ gridLines: { display: false } }]
          } : {}
        }
      });
    }
  };

  const MapRenderer = {
    render: function(selector, name) {
      const $el = $(selector);
      if ($el.length) {
        $el.mapael({
          map: { name: name, zoom: { enabled: true, maxLevel: 10 } }
        });
      }
    }
  };


  const DashboardApp = {
    init: function(dataService, chartEngine, mapEngine) {
      // Inisialisasi Sales Chart
      chartEngine.render('#salesChart', 'line', dataService.getSalesData());

      // Inisialisasi Pie Chart
      chartEngine.render('#pieChart', 'doughnut', dataService.getBrowserData());

      // Inisialisasi Map
      const mapConf = dataService.getMapConfig();
      mapEngine.render(mapConf.selector, mapConf.mapName);
    }
  };

  
  DashboardApp.init(DashboardData, ChartRenderer, MapRenderer);

});
