// Load the custom app ES6 modules
//
// import UsersDataService from './services/UsersDataService';
//
// import UsersList from './components/list/UsersList';
// import UserDetails from './components/details/UserDetails';

import UsersLogin from './components/login/UsersLogin';

import SessionService from './services/SessionService';
import HttpService from  './services/HttpService';
import UtilidadesService from './services/UtilidadesService';
import UrlHttpRequest from './services/UrlHttpRequest';
import UsersConfig from './UsersConfig';

// Define the Angular 'users' module

export default angular
  .module("users", ['ngMaterial'])
  //
  // .component(UsersList.name, UsersList.config)
  // .component(UserDetails.name, UserDetails.config)

  // .service("UsersDataService", UsersDataService);
    .config(UsersConfig)

    .component(UsersLogin.name, UsersLogin.config)

    .service("SessionService", SessionService)
    .service("HttpService", HttpService)
    .service("UtilidadesService",UtilidadesService)

    .constant("UrlHttpRequest",UrlHttpRequest)
