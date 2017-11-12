class UserDetailController {
    constructor(HttpService, UrlHttpRequest, UtilidadesService, $state, SessionService){
        this.form = {};
        this.HttpService = HttpService;
        this.UrlHttpRequest = UrlHttpRequest;
        this.UtilidadesService = UtilidadesService;
        this.$state = $state;
        this.SessionService = SessionService;
    }

    $onInit() {
        if(this.SessionService.haySessionActiva()) return this.$state.go("dashboardHome.misAlbumes");
    }

    submit(){
        this.cargando = true;
        this.HttpService.post({
            url:            this.UrlHttpRequest.LOGIN,
            data:           this.form,
            enviaSession:   false
        })
            .then((response)=>{
                this.cargando = false;
                this.$state.go("dashboardHome.misAlbumes");
                this.SessionService.setSessionID(response.session);
            })
            .catch(error => {
                this.cargando = false;
                this.UtilidadesService.mostrarAlerta({
                    titulo:     "Error",
                    contenido:  error
                })
            });
    }
}

export default ['HttpService','UrlHttpRequest','UtilidadesService','$state', 'SessionService',UserDetailController];