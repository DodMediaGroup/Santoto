appMaterias
  .config(function($stateProvider){

    $stateProvider
      .state('default.materias', {
        url: '/materias',
        templateUrl: 'js/materias/views/materias.html',
        authenticate: true
      })
  });
