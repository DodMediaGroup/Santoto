appCore
  .run([
    '$rootScope',
    '$state',
    '$auth',
    function($rootScope, $state, $auth){
      $rootScope.$on('$stateChangeStart', function(e, toState, toParams, fromState, fromParams){
        if(toState.authenticate){
          var isLogin = toState.name == 'minimal.login';
          if(isLogin)
            return;
          if(!$auth.isAuthenticated()){
            e.preventDefault();
            $state.go('minimal.login', {}, {location:'replace', reload:true});
          }
        }
        else{
          if($auth.isAuthenticated()){
            var isLogout = toState.name == 'minimal.logout';
            if(!isLogout){
              e.preventDefault();
              $state.go('default.materias', {}, {location:'replace', reload:true});
            }
          }
        }
      });
    }
  ]);
