appRecordatorios
  .controller('recordatoriosCreateController', [
    '$rootScope',
    '$scope',
    '$http',
    '$state',

    '$ionicPopup',
    'indicator',

    'API_URL',
    function($rootScope, $scope, $http, $state, $ionicPopup, indicator, API_URL){
      $scope.init = function(){
        var dateNow = new Date();
        $scope.fecha = new Date(dateNow.getFullYear(), dateNow.getMonth(), (dateNow.getDate() + 1), dateNow.getHours(), dateNow.getMinutes());
        $scope.recordatorio = { };
        $scope.materias = [];
      };

      $scope.createMateria = function(){
        var inputDate = $('#recordatorio_date').val();
        inputDate = inputDate.split('T');
        $scope.fecha = new Date(inputDate[0] + ' ' + inputDate[1]);

        indicator.show();
        $scope.recordatorio.fecha = $scope.fecha.getTime();
        $http.post(API_URL+'alumnos/recordatorios_create', $scope.recordatorio)
          .then(function(response){
            if(response.status == 200){
              $state.go('default.recordatorios', {}, {location:'replace', reload:true});
            }
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

      $scope.$on('$ionicView.beforeEnter', function(){
        $scope.init();
        $scope.loadMaterias();
      });
    }
  ]);
