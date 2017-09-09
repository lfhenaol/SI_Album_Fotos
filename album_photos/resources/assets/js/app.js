
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import angular from 'angular';
import 'angular-material';

import AppController from './AppController';
import Users from './users/Users';

export default angular.module('album-photo', ['ngMaterial'])
    .config(($mdIconProvider, $mdThemingProvider) => {
        // Register the user `avatar` icons

        $mdThemingProvider.theme('default')
            .primaryPalette('brown')
            .accentPalette('red');
    })
    .controller('AppController', AppController);
