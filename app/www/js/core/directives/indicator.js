appCore
  .directive('indicator', ['$rootScope', '$timeout', function ($rootScope, $timeout) {
    return {
      restrict: 'E',
      replace: true,
      template: '<div class="indicator__loading"></div>',
      link: function($scope, iElm, iAttrs) {
        $timeout(function () {
          var $spinner = angular.element(iElm);

          /** show loading indicator */
          $rootScope.$on('$stateChangeStart', function () {
            $spinner.addClass('show');
          });

          /** hide loading indicator */
          $rootScope.$on('$stateChangeSuccess', function () {
            $spinner.removeClass('show');
          });
        });
      }
    };
  }])

  .service('indicator', [function(){
    var indicator = $("#app-content").find(".indicator__loading");

    this.show = function(){
      indicator.addClass('show');
    };
    this.hide = function(){
      indicator.removeClass('show');
    };
  }]);
