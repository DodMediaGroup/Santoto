appPages
  .controller('logoutController', [
    '$rootScope',
    '$scope',
    '$auth',
    '$state',
    function($rootScope, $scope, $auth, $state){
      $auth.logout()
        .then(function(){
          $rootScope.setAuth(null);
          $state.go('minimal.login', {}, {location:'replace', reload:true});
        });
    }
  ]);
