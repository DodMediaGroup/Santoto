appRecordatorios
  .controller('recordatoriosController', [
    '$rootScope',
    '$scope',
    '$http',

    '$ionicPopup',
    'indicator',

    'API_URL',
    function($rootScope, $scope, $http, $ionicPopup, indicator, API_URL){
      $scope.recordatorios = [];

      $scope.loadRecordatorios = function(){
        indicator.show();
        $http.get(API_URL+'alumnos/recordatorios')
          .then(function(response){
            $scope.recordatorios = response.data;
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
        $scope.loadRecordatorios();
      });
    }
  ]);
