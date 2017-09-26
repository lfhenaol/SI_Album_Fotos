
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import angular from 'angular';
import 'angular-material';
import 'angular-messages';
import 'angular-cookies';
import '@uirouter/angularjs';

import AppController from './AppController';
import Users from './users/Users';
import Fotos from './fotos/Fotos';

export default angular.module('album-photo', [
        'ngMaterial',
        'ngMessages',
        'ngCookies',
        'ui.router',
        Users.name,
        Fotos.name
    ])
    .config([
        '$mdIconProvider',
        '$mdThemingProvider',
        '$stateProvider',
        '$urlServiceProvider',
        ($mdIconProvider,
         $mdThemingProvider,
         $stateProvider,
         $urlServiceProvider) => {
            // Register the user `avatar` icons
            $urlServiceProvider.rules.initial({state:"login"});

            // $urlServiceProvider.rules.otherwise({state:"menu.404"});
            //
            // $stateProvider
            //     .state('menu.404',{
            //         url:        "/404",
            //         component:  "appPaginaNoEncontrada"
            //     });

            $mdThemingProvider.theme('default')
                .primaryPalette('brown')
                .accentPalette('red');
        }
    ])
    .controller('AppController', AppController);
