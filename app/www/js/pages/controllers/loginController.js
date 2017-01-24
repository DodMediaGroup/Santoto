appPages
  .controller('loginController', [
    '$rootScope',
    '$scope',
    '$auth',
    '$state',

    '$ionicPopup',

    'indicator',
    function($rootScope, $scope, $auth, $state, $ionicPopup, indicator){
      $scope.login = {};

      $scope.submit = function(){
        indicator.show();
        $auth.login($scope.login)
          .then(function(response){
            if(response.status == 200)
              $state.go('default.materias', {}, {location:'replace', reload:true});
            else{
              $ionicPopup.alert({
                title: 'Error',
                content: 'No se pudo realizar la autenticación.'
              });
            }
          })
          .catch(function(response){
            $ionicPopup.alert({
              title: 'Error',
              content: 'No se pudo realizar la autenticación.'
            });
          })
          .finally(function(){
            indicator.hide();
          });
      }
    }
  ]);
