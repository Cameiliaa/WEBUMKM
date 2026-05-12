

$(function () {
  'use strict'

  const BASE_TICKS = { fontColor: '#495057', fontStyle: 'bold', beginAtZero: true };
  const BASE_GRID  = { display: true, lineWidth: '4px', color: 'rgba(0, 0, 0, .2)', zeroLineColor: 'transparent' };
  

  const YAxisInterfaces = {
    standard: () => ({
      gridLines: BASE_GRID,
      ticks: BASE_TICKS
    }),
    withCurrency: () => ({
      gridLines: BASE_GRID,
      ticks: $.extend({}, BASE_TICKS, {
        callback: (value) => '$' + (value >= 1000 ? (value / 1000) + 'k' : value)
      })
    }),
    withMax: (max) => ({
      gridLines: BASE_GRID,
      ticks: $.extend({}, BASE_TICKS, { suggestedMax: max })
    })
  };

  const DatasetBuilders = {
    bar: (data, color) => ({
      type: 'bar',
      data: data,
      backgroundColor: color,
      borderColor: color
    }),
    line: (data, color) => ({
      type: 'line',
      data: data,
      backgroundColor: 'transparent',
      borderColor: color,
      pointBorderColor: color,
      pointBackgroundColor: color,
      fill: false
    })
  };

  const createChart = function ($element, type, labels, datasets, yAxisConfig) {
    if (!$element.length) return;

    return new Chart($element, {
      type: type,
      data: { labels, datasets },
      options: {
        maintainAspectRatio: false,
        legend: { display: false },
        tooltips: { mode: 'index', intersect: true },
        hover: { mode: 'index', intersect: true },
        scales: {
          yAxes: [yAxisConfig],
          xAxes: [{
            display: true,
            gridLines: { display: false },
            ticks: BASE_TICKS
          }]
        }
      }
    });
  };


  const salesDatasets = [
    DatasetBuilders.bar([1000, 2000, 3000, 2500, 2700, 2500, 3000], '#007bff'),
    DatasetBuilders.bar([700, 1700, 2700, 2000, 1800, 1500, 2000], '#ced4da')
  ];

  createChart(
    $('#sales-chart'), 
    'bar', 
    ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'], 
    salesDatasets, 
    YAxisInterfaces.withCurrency()
  );

  // Visitors Chart: Hanya menggunakan Interface Max & Builder Line
  const visitorsDatasets = [
    DatasetBuilders.line([100, 120, 170, 167, 180, 177, 160], '#007bff'),
    DatasetBuilders.line([60, 80, 70, 67, 80, 77, 100], '#ced4da')
  ];

  createChart(
    $('#visitors-chart'), 
    null, 
    ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'], 
    visitorsDatasets, 
    YAxisInterfaces.withMax(200)
  );
});
