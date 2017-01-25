appPages
  .controller('logoutController', [
    '$rootScope',
    '$scope',
    '$auth',
    '$state',
    '$window',
    function($rootScope, $scope, $auth, $state, $window){
      if(!$auth.isAuthenticated())
        $state.go('minimal.login', {}, {location:'replace', reload:true});
      $auth.logout()
        .then(function(){
          $rootScope.setAuth(null);
          $window.location.reload();
          //$state.go('minimal.login', {}, {location:'replace', reload:true});
        });
    }
  ]);
