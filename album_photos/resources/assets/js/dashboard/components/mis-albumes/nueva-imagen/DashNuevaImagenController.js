require('./DashNuevaImagen.html');

class DashNuevaImagenController {
    
        constructor(HttpService,
                    UrlHttpRequest,
                    UtilidadesService,
                    SessionService,
                    $state, 
                    $mdDialog, 
                    albumInfo, 
                    AlbumFotosService, 
                    $scope, 
                    $q){
    
            this.form = {};
            this.HttpService = HttpService;
            this.UrlHttpRequest = UrlHttpRequest;
            this.UtilidadesService = UtilidadesService;
            this.SessionService = SessionService;
            this.$state = $state;
            this.$mdDialog = $mdDialog;
            this.albumInfo = albumInfo;
            this.AlbumFotosService = AlbumFotosService;
            this.$scope = $scope;
            this.$q = $q;
            this.optionsCompress = {
                resizeType: 'image/png',
                resizeQuality: 0.5,
                resizeMaxWidth: 1000
              }
        }
    
        $onInit(){
            this.form = {
                id_usuario: this.AlbumFotosService.getIdUsuarioActivo(),
                id_album:   this.albumInfo.id
            }
        }

        submit(){
            this.cargando = true;
            this.createImage(this.form.foto)
            .then((imagen)=>{
                this.form.foto = imagen;
                this.HttpService.post({
                    url:            this.UrlHttpRequest.GUARDAR_IMAGEN,
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
                })
                .catch((error)=>{
                    this.cargando = false;
                    this.UtilidadesService.mostrarAlerta({
                        titulo:     "Error",
                        contenido:  error
                    });
                    this.$mdDialog.cancel({});
                })
            })
            .catch((error)=>{
                this.cargando = false;
                this.UtilidadesService.mostrarAlerta({
                    titulo:     "Error",
                    contenido:  error
                });
            });
        }

        cancelar() {
            this.$mdDialog.cancel();
        }

        cargarUICropper(){
            angular.element(document.querySelector('#foto')).on(
                'change',
                {scope: this.$scope},
                this.handleFileSelect
            );
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

        jicCompress(sourceImgObj, options) {
            
            var outputFormat = options.resizeType;
            var quality = options.resizeQuality * 100 || 70;
            var mimeType = 'image/jpeg';
            if (outputFormat !== undefined && outputFormat === 'png') {
                mimeType = 'image/png';
            }


            var maxHeight = options.resizeMaxHeight || 300;
            var maxWidth = options.resizeMaxWidth || 250;

            var height = sourceImgObj.height;
            var width = sourceImgObj.width;

            // calculate the width and height, constraining the proportions
            if (width > height) {
                if (width > maxWidth) {
                    height = Math.round(height *= maxWidth / width);
                    width = maxWidth;
                }
            } else {
                if (height > maxHeight) {
                    width = Math.round(width *= maxHeight / height);
                    height = maxHeight;
                }
            }

            var cvs = document.createElement('canvas');
            cvs.width = width; //sourceImgObj.naturalWidth;
            cvs.height = height; //sourceImgObj.naturalHeight;
            var ctx = cvs.getContext('2d').drawImage(sourceImgObj, 0, 0, width, height);
            var newImageData = cvs.toDataURL(mimeType, quality / 100);
            return newImageData;
        };

        createImage(url) {
            let defer = this.$q.defer();
            let promise = defer.promise;
            
            let image = new Image();
            let $scope = this.$scope;
            image.onload = function() {
                defer.resolve($scope.vm.jicCompress(image, $scope.vm.optionsCompress));
            };

            image.src = url;

            if(!url){
                defer.reject("Es requerido seleccionar una foto para agregarla");
            }

            return promise;
        };
    }
    
    export default [
        'HttpService',
        'UrlHttpRequest',
        'UtilidadesService',
        'SessionService',
        '$state',
        '$mdDialog',
        'albumInfo',
        'AlbumFotosService',
        '$scope',
        '$q',
        DashNuevaImagenController
    ];