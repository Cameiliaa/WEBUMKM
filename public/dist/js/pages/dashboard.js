/**
 * Refactored Dashboard Module
 * Principles: SOLID (SRP, OCP)
 * Author: Gemini (Adaptive AI)
 */

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

// 3. VISUALIZATION MANAGER (Bertanggung jawab atas Grafik & Map)
class VisualizationManager {
  constructor(dataService) {
    this.dataService = dataService;
  }

  renderAll() {
    this.renderWorldMap();
    this.renderSalesChart();
    this.renderPieChart();
    this.renderSparklines();
  }

  renderWorldMap() {
    const visitors = this.dataService.getVisitors();
    $('#world-map').vectorMap({
      map: 'usa_en',
      backgroundColor: 'transparent',
      regionStyle: {
        initial: { fill: 'rgba(255, 255, 255, 0.7)', stroke: 'rgba(0,0,0,.2)', 'stroke-width': 1 }
      },
      series: {
        regions: [{
          values: visitors,
          scale: ['#ffffff', '#0154ad'],
          normalizeFunction: 'polynomial'
        }]
      },
      onRegionLabelShow: (e, el, code) => {
        if (visitors[code]) el.html(`${el.html()}: ${visitors[code]} new visitors`);
      }
    });
  }

  renderSalesChart() {
    const ctx = document.getElementById('revenue-chart-canvas').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: this.dataService.getSalesData(),
      options: { maintainAspectRatio: false, responsive: true, legend: { display: false } }
    });
  }

  renderPieChart() {
    const ctx = $('#sales-chart-canvas').get(0).getContext('2d');
    new Chart(ctx, {
      type: 'doughnut',
      data: this.dataService.getPieData(),
      options: { maintainAspectRatio: false, responsive: true, legend: { display: false } }
    });
  }

  renderSparklines() {
    const config = { width: 80, height: 50, lineColor: '#92c1dc', endColor: '#ebf4f9' };
    
    const s1 = new Sparkline($("#sparkline-1")[0], config);
    s1.draw([1000, 1200, 920, 927, 931, 1027, 819, 930, 1021]);

    const s2 = new Sparkline($("#sparkline-2")[0], config);
    s2.draw([515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921]);

    const s3 = new Sparkline($("#sparkline-3")[0], config);
    s3.draw([15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21]);
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
