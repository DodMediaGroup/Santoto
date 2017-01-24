appCore
  .controller('settingsController', [
    '$rootScope',
    '$scope',

    'localStorageService',
    function($rootScope, $scope, localStorageService){
      $rootScope.getAuth = function(){
        return localStorageService.get('auth');
      };
      $rootScope.setAuth = function($user){
        $rootScope.auth = $user;
        localStorageService.set('auth', $rootScope.auth);
      };
      if($rootScope.getAuth() == null){
        $rootScope.setAuth(null);
      }
      $rootScope.auth = $rootScope.getAuth();
    }
  ]);
