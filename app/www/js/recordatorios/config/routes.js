appRecordatorios
  .config(function($stateProvider){

    $stateProvider
      .state('default.recordatorios', {
        url: '/recordatorios',
        views: {
          'tab-recordatorios': {
            templateUrl: 'js/recordatorios/views/recordatorios.html',
            controller: 'recordatoriosController'
          }
        },
        authenticate: true
      })
      .state('default.recordatorios-agregar', {
        url: '/recordatorios/agregar',
        views: {
          'tab-recordatorios': {
            templateUrl: 'js/recordatorios/views/recordatorio-add.html',
            controller: 'recordatoriosCreateController'
          }
        },
        authenticate: true
      })
      .state('default.recordatorios-view', {
        url: '/recordatorios/ver/:recordatorio',
        views: {
          'tab-recordatorios': {
            templateUrl: 'js/recordatorios/views/recordatorios-view.html',
            controller: 'recordatoriosViewController'
          }
        },
        authenticate: true
      })
  });
