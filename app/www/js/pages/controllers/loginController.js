appPages
  .controller('loginController', [
    '$rootScope',
    '$scope',
    '$auth',
    '$state',
    '$window',

    '$ionicPopup',

    'indicator',
    function($rootScope, $scope, $auth, $state, $window, $ionicPopup, indicator){
      $scope.login = {};

      $scope.submit = function(){
        indicator.show();
        $auth.login($scope.login)
          .then(function(response){
            if(response.status == 200)
              $window.location.reload();
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
