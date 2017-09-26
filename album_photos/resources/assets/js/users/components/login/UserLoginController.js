class UserDetailController {
    constructor(HttpService, UrlHttpRequest, UtilidadesService, $state){
        this.form = {};
        this.HttpService = HttpService;
        this.UrlHttpRequest = UrlHttpRequest;
        this.UtilidadesService = UtilidadesService;
        this.$state = $state;
    }

    submit(){
        this.HttpService.post({
            url:            this.UrlHttpRequest.LOGIN,
            data:           this.form,
            enviaSession:   false
        })
            .then(()=>{
                this.$state.go("fotosHome");
            })
            .catch(error => {
                this.UtilidadesService.mostrarAlerta({
                    titulo:     "Error",
                    contenido:  error
                })
            });
    }
}

export default ['HttpService','UrlHttpRequest','UtilidadesService','$state',UserDetailController];