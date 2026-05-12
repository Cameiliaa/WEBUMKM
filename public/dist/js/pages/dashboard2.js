
$(function () {
  'use strict'


  const THEME = {
    blue: {
      primary: 'rgba(60,141,188,0.9)',
      secondary: 'rgba(60,141,188,0.8)',
      point: '#3b8bba'
    },
    gray: {
      primary: 'rgba(210, 214, 222, 1)',
      secondary: '#c1c7d1'
    },
    pieColors: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
  };


  const DEFAULT_OPTIONS = {
    responsive: true,
    maintainAspectRatio: false,
    legend: { display: false }
  };


  const initSalesChart = function () {
    const canvas = $('#salesChart').get(0).getContext('2d');
    
    const data = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label: 'Digital Goods',
          backgroundColor: THEME.blue.primary,
          borderColor: THEME.blue.secondary,
          pointColor: THEME.blue.point,
          data: [28, 48, 40, 19, 86, 27, 90],
          pointRadius: false
        },
        {
          label: 'Electronics',
          backgroundColor: THEME.gray.primary,
          borderColor: THEME.gray.primary,
          pointColor: THEME.gray.secondary,
          data: [65, 59, 80, 81, 56, 55, 40],
          pointRadius: false
        }
      ]
    };

    const options = $.extend(true, {}, DEFAULT_OPTIONS, {
      scales: {
        xAxes: [{ gridLines: { display: false } }],
        yAxes: [{ gridLines: { display: false } }]
      }
    });

    return new Chart(canvas, { type: 'line', data: data, options: options });
  };


  const initPieChart = function () {
    const canvas = $('#pieChart').get(0).getContext('2d');
    
    const data = {
      labels: ['Chrome', 'IE', 'FireFox', 'Safari', 'Opera', 'Navigator'],
      datasets: [{
        data: [700, 500, 400, 600, 300, 100],
        backgroundColor: THEME.pieColors
      }]
    };

    return new Chart(canvas, { type: 'doughnut', data: data, options: DEFAULT_OPTIONS });
  };


  const initWorldMap = function () {
    $('#world-map-markers').mapael({
      map: {
        name: "usa_states",
        zoom: { enabled: true, maxLevel: 10 }
      }
    });
  };

  // --- EXECUTION ---
  initSalesChart();
  initPieChart();
  initWorldMap();
});
