class UserDetailController {
    constructor(HttpService, 
        UrlHttpRequest, 
        UtilidadesService, 
        $state, 
        SessionService, 
        $scope){
        
        this.$scope = $scope;
        this.form = {};
        this.HttpService = HttpService;
        this.UrlHttpRequest = UrlHttpRequest;
        this.UtilidadesService = UtilidadesService;
        this.$state = $state;
        this.SessionService = SessionService;
    }

    $onInit() {
        if(this.SessionService.haySessionActiva()) return this.$state.go("fotosHome");
        angular.element(document.querySelector('#fileInput')).on(
            'change',
            {scope: this.$scope},
            this.handleFileSelect
        );
    }

    submit(){
        this.cargando = true;
        this.HttpService.post({
            url:            this.UrlHttpRequest.REGISTRO,
            data:           this.form,
            enviaSession:   false
        })
            .then((response)=>{
                this.cargando = false;
                this.UtilidadesService.mostrarAlerta({
                    titulo:     "Notificación",
                    contenido:  response.mensaje
                })  
                this.$state.reload();
            })
            .catch(error => {
                this.cargando = false;
                this.UtilidadesService.mostrarAlerta({
                    titulo:     "Error",
                    contenido:  error
                });
            });
    }

    handleFileSelect(evt) {
        let file = evt.currentTarget.files[0];
        let reader = new FileReader();
        let scope = evt.data.scope;
        reader.onload =  (evt) => {
          scope.$apply(($scope) => {
            scope.vm.myImage=evt.target.result;
          });
        };
        reader.readAsDataURL(file);
    }
}

export default [
    'HttpService',
    'UrlHttpRequest',
    'UtilidadesService',
    '$state', 
    'SessionService',
    '$scope',
    UserDetailController
];