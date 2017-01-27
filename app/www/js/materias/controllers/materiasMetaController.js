appMaterias
  .controller('materiasMetaController', [
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

      $scope.asignar = function(){
        indicator.show();
        $http.post(API_URL+'alumnos/asignar_meta/'+$scope.materia.id, {
          meta: $scope.materia.meta
        })
          .then(function(response){
            if(response.status == 200){
              $ionicPopup.alert({
                title: 'Hecho',
                content: 'Se asigno la meta a '+$scope.materia.materia.nombre+'.',
                buttons: [{
                  text: 'Ok',
                  type: 'button-positive',
                  onTap: function() {
                    $state.go('default.materias', {}, {location:'replace', reload:true});
                  }
                }]
              });
            }
          }, function(){
            $ionicPopup.alert({
              title: 'Error',
              content: 'No se pudo asignar la nota. Verifique los datos e intente de nuevo.'
            });
          })
          .finally(function(){
            indicator.hide()
          });
      };

      $scope.loadMateria();
    }
  ]);
