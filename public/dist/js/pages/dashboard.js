
const DashboardData = {
  getVisitors: () => ({
    'US': 398, 'SA': 400, 'CA': 1000, 'DE': 500, 'FR': 760,
    'CN': 300, 'AU': 700, 'BR': 600, 'IN': 800, 'GB': 320, 'RU': 3000
  }),
  
  getSalesData: () => ({
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label: 'Digital Goods',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        data: [28, 48, 40, 19, 86, 27, 90]
      },
      {
        label: 'Electronics',
        backgroundColor: 'rgba(210, 214, 222, 1)',
        borderColor: 'rgba(210, 214, 222, 1)',
        data: [65, 59, 80, 81, 56, 55, 40]
      }
    ]
  }),

  getPieData: () => ({
    labels: ['Instore Sales', 'Download Sales', 'Mail-Order Sales'],
    datasets: [{
      data: [30, 12, 20],
      backgroundColor: ['#f56954', '#00a65a', '#f39c12']
    }]
  })
};


const UIManager = {
  init() {
    this.setupSortables();
    this.setupEditors();
    this.setupPickers();
    this.setupScrollbars();
  },

  setupSortables() {
    // Dashboard widgets sortable
    $('.connectedSortable').sortable({
      placeholder: 'sort-highlight',
      connectWith: '.connectedSortable',
      handle: '.card-header, .nav-tabs',
      forcePlaceholderSize: true,
      zIndex: 999999
    }).find('.card-header, .nav-tabs-custom').css('cursor', 'move');

    // Todo list sortable
    $('.todo-list').sortable({
      placeholder: 'sort-highlight',
      handle: '.handle',
      forcePlaceholderSize: true,
      zIndex: 999999
    });
  },

  setupEditors() {
    $('.textarea').summernote();
    $('.knob').knob();
  },

  setupPickers() {
    // Date Range Picker
    $('.daterange').daterangepicker({
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
      },
      startDate: moment().subtract(29, 'days'),
      endDate: moment()
    }, (start, end) => {
      window.alert(`You chose: ${start.format('MMMM D, YYYY')} - ${end.format('MMMM D, YYYY')}`);
    });

    // Calendar
    $('#calendar').datetimepicker({
      format: 'L',
      inline: true
    });
  },

  setupScrollbars() {
    $('#chat-box').overlayScrollbars({ height: '250px' });
  }
};

// -------------------------------------------------------------------------
// COMMIT 1: REFACTOR SRP - DECOMPOSING VISUALIZATION MANAGER
// -------------------------------------------------------------------------

class WorldMapRenderer {
  render(data) {
    $('#world-map').vectorMap({
      map: 'usa_en',
      backgroundColor: 'transparent',
      regionStyle: {
        initial: { fill: 'rgba(255, 255, 255, 0.7)', stroke: 'rgba(0,0,0,.2)', 'stroke-width': 1 }
      },
      series: {
        regions: [{
          values: data,
          scale: ['#ffffff', '#0154ad'],
          normalizeFunction: 'polynomial'
        }]
      }
    });
  }
}

class SalesChartRenderer {
  render(data) {
    const ctx = document.getElementById('revenue-chart-canvas').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: data,
      options: { maintainAspectRatio: false, responsive: true, legend: { display: false } }
    });
  }
}

class PieChartRenderer {
  render(data) {
    const ctx = $('#sales-chart-canvas').get(0).getContext('2d');
    new Chart(ctx, {
      type: 'doughnut',
      data: data,
      options: { maintainAspectRatio: false, responsive: true, legend: { display: false } }
    });
  }
}

class SparklineRenderer {
  render() {
    const config = { width: 80, height: 50, lineColor: '#92c1dc', endColor: '#ebf4f9' };
    
    new Sparkline($("#sparkline-1")[0], config).draw([1000, 1200, 920, 927, 931, 1027, 819, 930, 1021]);
    new Sparkline($("#sparkline-2")[0], config).draw([515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921]);
    new Sparkline($("#sparkline-3")[0], config).draw([15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21]);
  }
}

// VisualizationManager sekarang mengorkestrasikan renderer spesifik
class VisualizationManager {
  constructor(dataService) {
    this.dataService = dataService;
    this.mapRenderer = new WorldMapRenderer();
    this.salesRenderer = new SalesChartRenderer();
    this.pieRenderer = new PieChartRenderer();
    this.sparklineRenderer = new SparklineRenderer();
  }

  renderAll() {
    this.mapRenderer.render(this.dataService.getVisitors());
    this.salesRenderer.render(this.dataService.getSalesData());
    this.pieRenderer.render(this.dataService.getPieData());
    this.sparklineRenderer.render();
  }
}

$(function () {
  'use strict';

  // Inisialisasi UI
  UIManager.init();

  // Inisialisasi Chart dengan Dependency Injection
  const viz = new VisualizationManager(DashboardData);
  viz.renderAll();
});
