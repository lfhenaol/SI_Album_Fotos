function UsersConfig($stateProvider) {
    $stateProvider
        .state('login', {
            url:        "/login",
            component:  "usersLogin"
        })
        .state('registro', {
            url:        "/registro",
            component:  "usersRegistro"
        })
}

export default ['$stateProvider', UsersConfig];