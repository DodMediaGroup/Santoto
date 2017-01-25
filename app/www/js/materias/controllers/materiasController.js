appMaterias
  .controller('materiasController', [
    '$rootScope',
    '$scope',
    '$http',

    '$ionicPopup',
    'indicator',

    'API_URL',
    function($rootScope, $scope, $http, $ionicPopup, indicator, API_URL){
      $scope.materias = [];

      $scope.loadMaterias = function(){
        indicator.show();
        $http.get(API_URL+'alumnos/materias')
          .then(function(response){
            $scope.materias = response.data;
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

      $scope.loadMaterias();
    }
  ]);
