
$(function () {
  'use strict'


  const chartStyles = {
    ticks: { fontColor: '#495057', fontStyle: 'bold' },
    gridLines: {
      display: true,
      lineWidth: '4px',
      color: 'rgba(0, 0, 0, .2)',
      zeroLineColor: 'transparent'
    }
  };

  const interactionMode = { mode: 'index', intersect: true };

  const chartUtils = {
    formatToK: (value) => (value >= 1000 ? (value / 1000) + 'k' : value)
  };


  const DataGenerator = {
    createDataset: function(config) {
     
      return {
        label: config.label || '',
        data: config.data || [],
        backgroundColor: config.backgroundColor || 'transparent',
        borderColor: config.borderColor || '#000',
        pointBorderColor: config.borderColor || '#000',
        pointBackgroundColor: config.borderColor || '#000',
        fill: config.fill || false,
        type: config.type || undefined // Bisa Bar atau Line
      };
    }
  };

  const createChart = function ($element, type, chartData, extraYAxisOptions = {}) {
    if (!$element.length) return; 

    return new Chart($element, {
      type: type,
      data: chartData,
      options: {
        maintainAspectRatio: false,
        tooltips: interactionMode,
        hover: interactionMode,
        legend: { display: false },
        scales: {
          yAxes: [{
            gridLines: chartStyles.gridLines,
            ticks: $.extend({ beginAtZero: true }, chartStyles.ticks, extraYAxisOptions)
          }],
          xAxes: [{
            display: true,
            gridLines: { display: false },
            ticks: chartStyles.ticks
          }]
        }
      }
    });
  };


  const salesData = {
    labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
    datasets: [
      DataGenerator.createDataset({
        data: [1000, 2000, 3000, 2500, 2700, 2500, 3000],
        backgroundColor: '#007bff',
        borderColor: '#007bff'
      }),
      DataGenerator.createDataset({
        data: [700, 1700, 2700, 2000, 1800, 1500, 2000],
        backgroundColor: '#ced4da',
        borderColor: '#ced4da'
      })
    ]
  };

  createChart($('#sales-chart'), 'bar', salesData, {
    callback: (val) => '$' + chartUtils.formatToK(val)
  });


  const visitorsData = {
    labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
    datasets: [
      DataGenerator.createDataset({
        type: 'line',
        data: [100, 120, 170, 167, 180, 177, 160],
        borderColor: '#007bff'
      }),
      DataGenerator.createDataset({
        type: 'line',
        data: [60, 80, 70, 67, 80, 77, 100],
        borderColor: '#ced4da'
      })
    ]
  };

  createChart($('#visitors-chart'), null, visitorsData, {
    suggestedMax: 200
  });
});
