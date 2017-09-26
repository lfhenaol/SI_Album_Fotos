function UsersConfig($stateProvider) {
    $stateProvider
        .state('login', {
            url:        "/login",
            component:  "usersLogin"
        })
}

export default ['$stateProvider', UsersConfig];