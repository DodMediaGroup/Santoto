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

      $scope.setMateria = function(inMateria){
        var notaAcomulado = 0;
        var notaPorCompletar = 0;
        var porcFalta = 0;

        var cortesCompletos = 0;

        $.each(inMateria.cortes, function(index, corte){
          if(corte.registro) {
            var porcentaje = ((corte.registro.nota * corte.porcentaje) / inMateria.meta);
            notaAcomulado += porcentaje;
            notaPorCompletar += ((inMateria.meta - corte.registro.nota) * corte.porcentaje / 100);

            cortesCompletos++;
          }
          else
            porcFalta += corte.porcentaje;
          corte.calculo = {
            esperado: inMateria.meta
          };
        });
        $.each(inMateria.cortes, function(index, corte){
          var cortePorc = ((100 * corte.porcentaje) / porcFalta);
          if(!corte.registro){
            var notaActual = (inMateria.meta * corte.porcentaje / 100);
            corte.calculo.porcentaje = cortePorc;
            notaActual += notaPorCompletar * corte.calculo.porcentaje / 100;

            corte.calculo.esperado = notaActual * 100 / corte.porcentaje;
          }
        });

        $scope.materia = inMateria;
      };

      $scope.loadMateria = function(){
        indicator.show();
        $http.get(API_URL+'alumnos/materia/'+$stateParams.materia)
          .then(function(response){
            $scope.setMateria(response.data);
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

      $scope.enviarNota = function(corte, nota){
        indicator.show();
        $http.post(API_URL+'alumnos/nota_corte/'+$scope.materia.id, {
          corte: corte.id,
          nota: nota
        })
          .then(function(response){
            $scope.setMateria(response.data);
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

      $scope.asignarCorte = function(corte){
        $ionicPopup.show({
          template: '<input type="number" min=0.0 max="{{ materia.materia.nota_maxima }}" step=0.1 ng-model="materia.new_nota" required>',
          title: corte.nombre,
          subTitle: 'Ingrese la nota para '+corte.nombre,
          scope: $scope,
          buttons: [
            { text: 'Cancelar' },
            {
              text: '<b>Guardar</b>',
              type: 'button-positive',
              onTap: function(e) {
                if (!$scope.materia.new_nota) {
                  //don't allow the user to close unless he enters wifi password
                  e.preventDefault();
                } else {
                  $scope.enviarNota(corte, $scope.materia.new_nota);
                }
              }
            }
          ]
        });
      };

      $scope.$on('$ionicView.beforeEnter', function(){
        $scope.loadMateria();
      });
    }
  ]);
