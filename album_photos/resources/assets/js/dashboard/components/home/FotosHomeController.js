import DashNuevoAlbumController from '../mis-albumes/nuevo-album/DashNuevoAlbumController';

class FotosHomeController {

    constructor(HttpService,
                UrlHttpRequest,
                UtilidadesService,
                SessionService,
                $state, 
                $mdDialog,
                $scope, 
                AlbumFotosService){

        this.form = {};
        this.HttpService = HttpService;
        this.UrlHttpRequest = UrlHttpRequest;
        this.UtilidadesService = UtilidadesService;
        this.SessionService = SessionService;
        this.$state = $state;
        this.$mdDialog = $mdDialog;
        this.$scope = $scope;
        this.AlbumFotosService = AlbumFotosService;
    }

    $onInit(){
        this.consultarPerfil();
    }

    agregarAlbum(ev) {
        this.$mdDialog.show({
            controller: DashNuevoAlbumController,
            controllerAs: "vm",
            templateUrl: 'assets/js/dashboard/components/mis-albumes/nuevo-album/DashNuevoAlbum.html',
            parent: angular.element(document.body),
            targetEvent: ev,
            clickOutsideToClose:true,
            fullscreen: this.$scope.customFullscreen // Only for -xs, -sm breakpoints.
          })
          .then((answer) => {
            this.$scope.status = 'You said the information was "' + answer + '".';
          }, () => {
            this.$scope.status = 'You cancelled the dialog.';
          });
    }

    consultarPerfil(){
        this.existePerfil = false;
        this.HttpService.post({
            url:            this.UrlHttpRequest.PERFIL,
            data:           this.form,
            enviaSession:   true
        })
            .then((response)=>{
                this.existePerfil = true;
                this.perfil = response.datos;
                this.AlbumFotosService.setIdUsuarioActivo(this.perfil.id);
                this.AlbumFotosService.setPerfilUsuarioActivo(response.datos);
                this.$state.go("dashboardHome.misAlbumes");
            })
            .catch(error => {
                this.UtilidadesService.mostrarAlerta({
                    titulo:     "Error",
                    contenido:  error
                })
            });
    }

    cerrarSesion(){
        this.SessionService.borrarSessionID();
        this.$state.go("login");
    }
}

export default [
    'HttpService',
    'UrlHttpRequest',
    'UtilidadesService',
    'SessionService',
    '$state',
    '$mdDialog',
    '$scope',
    'AlbumFotosService',
    FotosHomeController
];