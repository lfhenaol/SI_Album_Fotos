require('./DashNuevoAlbum.html');

class DashNuevoAlbumController {
    
        constructor(HttpService,
                    UrlHttpRequest,
                    UtilidadesService,
                    SessionService,
                    $state, 
                    $mdDialog){
    
            this.form = {};
            this.HttpService = HttpService;
            this.UrlHttpRequest = UrlHttpRequest;
            this.UtilidadesService = UtilidadesService;
            this.SessionService = SessionService;
            this.$state = $state;
            this.$mdDialog = $mdDialog;
        }
    
        $onInit(){
        
        }

        submit(){
            this.cargando = true;
            this.HttpService.post({
                url:            this.UrlHttpRequest.NUEVO_ALBUM,
                data:           this.form,
                enviaSession:   true
            })
            .then((response)=>{
                this.cargando = false;
                this.UtilidadesService.mostrarAlerta({
                    titulo:     "Notificación",
                    contenido:  response.mensaje
                });
                this.$mdDialog.hide({});
                this.$state.reload();
            })
            .catch((error)=>{
                this.cargando = false;
                this.UtilidadesService.mostrarAlerta({
                    titulo:     "Error",
                    contenido:  error
                });
                this.$mdDialog.cancel({});
            })
        }

        cancelar() {
            this.$mdDialog.cancel();
        }
    
    }
    
    export default [
        'HttpService',
        'UrlHttpRequest',
        'UtilidadesService',
        'SessionService',
        '$state',
        '$mdDialog',
        DashNuevoAlbumController
    ];