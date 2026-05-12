
$(function () {
  'use strict'


  var chartStyles = {
    ticks: {
      fontColor: '#495057',
      fontStyle: 'bold'
    },
    gridLines: {
      display: true,
      lineWidth: '4px',
      color: 'rgba(0, 0, 0, .2)',
      zeroLineColor: 'transparent'
    }
  };

  var interactionMode = {
    mode: 'index',
    intersect: true
  };

  var chartUtils = {
    formatToK: function (value) {
      if (value >= 1000) {
        value /= 1000
        value += 'k'
      }
      return '$' + value
    }
  };


  var createChart = function ($element, type, data, extraYAxisOptions = {}) {
    return new Chart($element, {
      type: type,
      data: data,
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

 
  var salesData = {
    labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
    datasets: [
      {
        backgroundColor: '#007bff',
        borderColor: '#007bff',
        data: [1000, 2000, 3000, 2500, 2700, 2500, 3000]
      },
      {
        backgroundColor: '#ced4da',
        borderColor: '#ced4da',
        data: [700, 1700, 2700, 2000, 1800, 1500, 2000]
      }
    ]
  };


  var salesChart = createChart($('#sales-chart'), 'bar', salesData, {
    callback: chartUtils.formatToK
  });



  var visitorsData = {
    labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
    datasets: [
      {
        type: 'line', // Mixed chart tetap bisa karena didefinisikan di dataset
        data: [100, 120, 170, 167, 180, 177, 160],
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
      },
      {
        type: 'line',
        data: [60, 80, 70, 67, 80, 77, 100],
        backgroundColor: 'transparent',
        borderColor: '#ced4da',
        pointBorderColor: '#ced4da',
        pointBackgroundColor: '#ced4da',
        fill: false
      }
    ]
  };

  var visitorsChart = createChart($('#visitors-chart'), null, visitorsData, {
    suggestedMax: 200
  });
})
