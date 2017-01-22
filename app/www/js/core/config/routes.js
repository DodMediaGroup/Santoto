appCore
  .config(function($stateProvider, $urlRouterProvider){

    /** Default Route **/
    $urlRouterProvider.otherwise('login');

    $stateProvider
      .state('minimal', {
        abstract: true,
        url: '',
        templateUrl: 'js/core/views/layouts/minimal.html'
      })
  });
