function DashboardConfig($stateProvider) {
    $stateProvider
        .state("dashboardHome",{
            url:        "/",
            component:  "fotosHome"
        })
        .state("dashboardHome.misAlbumes",{
            url:        "mis-albumes",
            component:  "dashMisalbumes"
        })
        .state("dashboardHome.albumesPublicos",{
            url:        "albumes-publicos",
            component:  "dashAlbumespublicos"
        });
}

export default ['$stateProvider', DashboardConfig];