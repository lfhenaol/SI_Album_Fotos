class FotosHomeController {
    constructor(HttpService, UrlHttpRequest, UtilidadesService){
        this.form = {};
        this.HttpService = HttpService;
        this.UrlHttpRequest = UrlHttpRequest;
        this.UtilidadesService = UtilidadesService;
    }

    $onInit(){
        this.consultarPerfil();
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
            })
            .catch(error => {
                this.UtilidadesService.mostrarAlerta({
                    titulo:     "Error",
                    contenido:  error
                })
            });
    }
}

export default ['HttpService','UrlHttpRequest','UtilidadesService',FotosHomeController];