appMaterias
  .config(function($stateProvider){

    $stateProvider
      .state('default.materias', {
        url: '/materias',
        views: {
          'tab-materias': {
            templateUrl: 'js/materias/views/materias.html',
            controller: 'materiasController'
          }
        },
        authenticate: true
      })
      .state('default.materia-asignar-meta', {
        url: '/materias/asignar-meta/:materia',
        views: {
          'tab-materias': {
            templateUrl: 'js/materias/views/materia-meta.html'
          }
        },
        authenticate: true
      })
  });
