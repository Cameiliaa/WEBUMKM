$(function () {
  'use strict'

  
  const chartConfig = {
    ticksStyle: {
      fontColor: '#495057',
      fontStyle: 'bold'
    },
    mode: 'index',
    intersect: true,
    gridLines: {
      display: true,
      lineWidth: '4px',
      color: 'rgba(0, 0, 0, .2)',
      zeroLineColor: 'transparent'
    }
  }

  const createChartOptions = (customYAxisTicks = {}) => ({
    maintainAspectRatio: false,
    tooltips: { mode: chartConfig.mode, intersect: chartConfig.intersect },
    hover: { mode: chartConfig.mode, intersect: chartConfig.intersect },
    legend: { display: false },
    scales: {
      yAxes: [{
        gridLines: chartConfig.gridLines,
        ticks: $.extend({ beginAtZero: true }, chartConfig.ticksStyle, customYAxisTicks)
      }],
      xAxes: [{
        display: true,
        gridLines: { display: false },
        ticks: chartConfig.ticksStyle
      }]
    }
  })


  const initSalesChart = () => {
    const $salesChart = $('#sales-chart')
    if (!$salesChart.length) return

    const salesOptions = createChartOptions({
      callback: function (value) {
        return value >= 1000 ? '$' + (value / 1000) + 'k' : '$' + value
      }
    })

    new Chart($salesChart, {
      type: 'bar',
      data: {
        labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
        datasets: [
          { backgroundColor: '#007bff', borderColor: '#007bff', data: [1000, 2000, 3000, 2500, 2700, 2500, 3000] },
          { backgroundColor: '#ced4da', borderColor: '#ced4da', data: [700, 1700, 2700, 2000, 1800, 1500, 2000] }
        ]
      },
      options: salesOptions
    })
  }

 
  const initVisitorsChart = () => {
    const $visitorsChart = $('#visitors-chart')
    if (!$visitorsChart.length) return

    const visitorsOptions = createChartOptions({ suggestedMax: 200 })

    new Chart($visitorsChart, {
      data: {
        labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
        datasets: [
          {
            type: 'line',
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
      },
      options: visitorsOptions
    })
  }

  // 5. Eksekusi
  initSalesChart()
  initVisitorsChart()
})
