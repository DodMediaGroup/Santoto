appCore
  .config(function($stateProvider, $urlRouterProvider){

    /** Default Route **/
    $urlRouterProvider.otherwise('login');

    $stateProvider
      .state('default', {
        abstract: true,
        url: '',
        templateUrl: 'js/core/views/layouts/default.html',
        controller: 'defaultController'
      })
      .state('minimal', {
        abstract: true,
        url: '',
        templateUrl: 'js/core/views/layouts/minimal.html'
      })
  });
