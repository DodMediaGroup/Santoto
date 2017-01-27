appMaterias
  .controller('materiasDetail', [
    '$rootScope',
    '$scope',
    '$http',
    '$state',
    '$stateParams',

    '$ionicPopup',
    'indicator',

    'API_URL',
    function($rootScope, $scope, $http, $state, $stateParams, $ionicPopup, indicator, API_URL){
      $scope.materia = {};

      $scope.loadMateria = function(){
        indicator.show();
        $http.get(API_URL+'alumnos/materia/'+$stateParams.materia)
          .then(function(response){
            $scope.materia = response.data;
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
