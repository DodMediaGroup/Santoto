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
            templateUrl: 'js/materias/views/materia-meta.html',
            controller: 'materiasMetaController'
          }
        },
        authenticate: true
      })
      .state('default.materia-detail', {
        url: '/materias/:materia',
        views: {
          'tab-materias': {
            templateUrl: 'js/materias/views/materia-detail.html',
            controller: 'materiasDetail'
          }
        },
        authenticate: true
      })
  });
