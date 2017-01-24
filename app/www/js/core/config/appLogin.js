appCore
  .config([
    '$authProvider',
    'API_URL',
    function($authProvider, API_URL){
      // Parametros de configuración Satellizer
      $authProvider.withCredentials = false;
      $authProvider.loginUrl = API_URL+"login/";
      $authProvider.tokenName = 'token';
      $authProvider.tokenPrefix = 'santoto';
      $authProvider.tokenHeader = 'Authorization';
    }
  ]);
