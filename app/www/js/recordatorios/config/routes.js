appRecordatorios
  .config(function($stateProvider){

    $stateProvider
      .state('default.recordatorios', {
        url: '/recordatorios',
        views: {
          'tab-recordatorios': {
            templateUrl: 'js/recordatorios/views/recordatorios.html'
          }
        },
        authenticate: true
      })
  });
