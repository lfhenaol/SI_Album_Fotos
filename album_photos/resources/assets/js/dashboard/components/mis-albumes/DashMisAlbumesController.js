class DashMisAlbumesController {

    constructor(HttpService,
                UrlHttpRequest,
                UtilidadesService,
                SessionService,
                $state){

        this.form = {};
        this.HttpService = HttpService;
        this.UrlHttpRequest = UrlHttpRequest;
        this.UtilidadesService = UtilidadesService;
        this.SessionService = SessionService;
        this.$state = $state;
    }

    $onInit(){
        this.consultarAlbumes();
    }

    consultarAlbumes(){
        this.cargando = true;
        this.HttpService.post({
            url:            this.UrlHttpRequest.CONSULTAR_ALBUMES,
            data:           {},
            enviaSession:   true
        })
            .then((response)=>{
                this.cargando = false;
                this.albumes = response.resultado;
            })
            .catch(error => {
                this.cargando = false;
                this.UtilidadesService.mostrarAlerta({
                    titulo:     "Error",
                    contenido:  error
                });
            });
    }

    verFotos(album) {
        this.idAlbum = album.id;
        this.nombreAlbum = album.nombre;
        this.verImagenes = true;
    }

    cerrarFotos(){
        this.verImagenes = false;
    }

}

export default [
    'HttpService',
    'UrlHttpRequest',
    'UtilidadesService',
    'SessionService',
    '$state',
    'AlbumFotosService',
    DashMisAlbumesController
];