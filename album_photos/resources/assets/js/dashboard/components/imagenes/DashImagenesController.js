import DashNuevaImagenController from '../mis-albumes/nueva-imagen/DashNuevaImagenController';
import DashComentariosController from './comentarios/DashComentariosController';

class DashImagenesController {
    
        constructor(HttpService,
                    UrlHttpRequest,
                    UtilidadesService,
                    SessionService,
                    $state, 
                    $mdDialog, 
                    $scope){
    
            this.form = {};
            this.HttpService = HttpService;
            this.UrlHttpRequest = UrlHttpRequest;
            this.UtilidadesService = UtilidadesService;
            this.SessionService = SessionService;
            this.$state = $state;
            this.$mdDialog = $mdDialog;
            this.$scope = $scope;
        }
    
        $onInit(){
            this.consultarImagenes();
        }

        agregarFoto(ev) {
            this.$mdDialog.show({
                controller: DashNuevaImagenController,
                controllerAs: "vm",
                templateUrl: 'assets/js/dashboard/components/mis-albumes/nueva-imagen/DashNuevaImagen.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                locals: {
                    albumInfo:  {
                        id: this.idAlbum
                    }
                },
                clickOutsideToClose:false,
                fullscreen: false // Only for -xs, -sm breakpoints.
              })
              .then((answer) => {
                this.consultarImagenes();
              }, () => {
                //
              });
        }
    
        consultarImagenes(){
            this.cargando = true;
            this.HttpService.post({
                url:            this.UrlHttpRequest.CONSULTAR_IMAGENES,
                data:           {id_album: this.idAlbum},
                enviaSession:   true
            })
                .then((response)=>{
                    this.cargando = false;
                    this.fotos = response.resultado;
                })
                .catch(error => {
                    this.cargando = false;
                    this.UtilidadesService.mostrarAlerta({
                        titulo:     "Error",
                        contenido:  error
                    });
                });
        }

        abrirComentarios(foto, ev){
            this.$mdDialog.show({
                controller: DashComentariosController,
                controllerAs: "vm",
                templateUrl: 'assets/js/dashboard/components/imagenes/comentarios/DashComentarios.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                locals: {
                    foto:  foto
                },
                clickOutsideToClose:false,
                fullscreen: true // Only for -xs, -sm breakpoints.
              })
              .then((answer) => {
                //
              }, () => {
                //
              });
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
        DashImagenesController
    ];