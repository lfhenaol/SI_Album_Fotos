import DashNuevaImagenController from './DashComentarios.html';

class DashImagenesController {
    
        constructor(HttpService,
                    UrlHttpRequest,
                    UtilidadesService,
                    SessionService,
                    $state, 
                    $mdDialog, 
                    $scope, 
                    foto, 
                    AlbumFotosService){
    
            this.form = {};
            this.HttpService = HttpService;
            this.UrlHttpRequest = UrlHttpRequest;
            this.UtilidadesService = UtilidadesService;
            this.SessionService = SessionService;
            this.$state = $state;
            this.$mdDialog = $mdDialog;
            this.$scope = $scope;
            this.foto = foto;
            this.AlbumFotosService = AlbumFotosService;
            this.comentarios = [];
        }
    
        $onInit(){
            this.usuarioActivo = this.AlbumFotosService.getPerfilUsuarioActivo();
        }

        agregarComentario(){
            this.comentarios.push({
                descripcion:    this.form.descripcion,
                fecha:          new Date(),
                avatar:         this.usuarioActivo.avatar,
                nombre:         this.usuarioActivo.nombre
            });

            let data = {
                comentario:    this.form.descripcion,
                id_imagen:      this.foto.id
            };

            this.HttpService.post({
                url:            this.UrlHttpRequest.GUARDAR_COMENTARIO,
                data:           data,
                enviaSession:   true
            })
                .then((response)=>{
                })
                .catch(error => {
                    this.UtilidadesService.mostrarAlerta({
                        titulo:     "Error",
                        contenido:  error
                    });
                });

            this.form.descripcion = "";
        }

        cerrar() {
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
        '$scope',
        'foto',
        'AlbumFotosService',
        DashImagenesController
    ];