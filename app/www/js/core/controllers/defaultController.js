appCore
  .controller('defaultController', [
    '$rootScope',
    '$scope',
    '$http',
    '$state',

    '$ionicPopup',

    'API_URL',
    function($rootScope, $scope, $http, $state, $ionicPopup, API_URL){
      $scope.user = {};

      if($rootScope.getAuth() != null)
        $scope.user = $rootScope.getAuth();
      else{
        $http.get(API_URL+'alumnos/current_alumno/')
          .then(function(response){
            $rootScope.setAuth(response.data);
            $scope.user = $rootScope.getAuth();
          }, function(){
            $ionicPopup.alert({
              title: 'Error',
              content: 'No fue posible cargar los datos.',
              buttons: [{
                text: 'Ok',
                type: 'button-positive',
                onTap: function() {
                  $state.go('minimal.logout', {}, {location:'replace', reload:true});
                }
              }]
            });
          });
      }
    }
  ]);
