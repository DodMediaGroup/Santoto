appRecordatorios
  .controller('recordatoriosViewController', [
    '$rootScope',
    '$scope',
    '$http',
    '$state',
    '$stateParams',

    '$ionicPopup',
    'indicator',

    'API_URL',
    function($rootScope, $scope, $http, $state, $stateParams, $ionicPopup, indicator, API_URL){
      $scope.recordatorio = {};

      $scope.loadMateria = function(){
        indicator.show();
        $http.get(API_URL+'alumnos/recordatorio/'+$stateParams.recordatorio)
          .then(function(response){
            $scope.recordatorio = response.data;
          }, function(){
            $ionicPopup.alert({
              title: 'Error',
              content: 'Error en la conexión al servidor. Verifique su conexión a internet.'
            });
          })
          .finally(function(){
            indicator.hide();
          });
      };

      $scope.loadMateria();
    }
  ]);
