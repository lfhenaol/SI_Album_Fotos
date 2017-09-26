function FotosConfig($stateProvider) {
    $stateProvider
        .state("fotosHome",{
            url:        "/fotos",
            component:  "fotosHome"
        });
}

export default ['$stateProvider', FotosConfig];