appPages
  .config(function($stateProvider){

    $stateProvider
      .state('minimal.login', {
        url: '/login',
        templateUrl: 'js/pages/views/login.html',
        controller: 'loginController'
      })
      .state('minimal.logout', {
        url: '/logout',
        controller: 'logoutController'
      })
  });
