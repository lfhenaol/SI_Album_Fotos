function HttpService($http,
                     SessionService,
                     $q,
                     $state) {

    return {
        post:       post,
        upload:     upload,
        getSync:    getSync,
        postSync:   postSync
    };

    /**
     * @name post
     * @desc Define la solicitud http post, para su reusabilidad en otros módulos
     * @param {string} url Define la url del servicio al cual se desea realizar la solicitud
     * @param {Object} data Define los parámetros que necesita el servicio para ejecutarse y devolver una respuesta
     * @param {boolean} enviaSession swicth para enviar o no la cabecera de session
     * @return {Promise}
     */
    function post({url,data,enviaSession}) {
        //Envia la cabecera session por defecto

        let defered = $q.defer();
        let promise = defered.promise;

        let config = {
            headers: {
                'Content-Type': 'application/json',
                'Accept': '*/*'
            }
        };

        console.log("Usuario logueado con SESSION: " +  SessionService.getSessionID());

        //Se captura el session id de las cookies y si exsiste, se pone el header SESSION
        if (SessionService.haySessionActiva() && enviaSession) {
            console.log("Usuario logueado con SESSION: " +  SessionService.getSessionID());
            config.headers.LSI = SessionService.getSessionID();
        }

        console.log(url);
        console.log(data);

        $http.post(url, data, config)
            .then(function (response) {
                console.log(response.data);
                if (typeof response.data === 'object') {
                    if (typeof response.data.fault !== 'undefined') {
                        defered.reject(response.data.fault.message.replace(/\\n/g,'<br />')); // Modal: Ocurrio un error
                    } else if (response.data.codigo === "" || response.data.codigo === '0') {
                        defered.resolve(response.data);
                    } else if (response.data.codigo === '210') {
                        $state.go("login");
                        SessionService.borrarSessionID();
                        defered.reject(response.data.mensaje.replace(/\\n/g,'<br />'));
                    } else {
                        defered.reject(response.data.mensaje.replace(/\\n/g,'<br />'));
                    }
                } else {
                    //Elimina sintax HTML
                    let regex = /(<([^>]+)>)/ig;
                    let body = response.data.toString();
                    let result = body.replace(regex, ' ');
                    result = result.replace(/\\n/g,'<br />');
                    defered.reject(result); // Error
                }
            })
            .catch(function (response) {
                defered.reject("No se pudo establecer la conexión con el servidor o no hay acceso a Internet"); // Error
            });

        return promise;
    }

    /**
     * @name getSync
     * @desc Ejecuta una solicitud ajax de tipo GET sincrónica
     * @param url
     * @param enviaSesion
     * @return {XMLHttpRequest}
     */
    function getSync({url, enviaSesion}) {
        let request = new XMLHttpRequest();

        request.open('GET',url, false);

        if(enviaSesion){
            request.setRequestHeader('JSESSIONID',SessionService.getSessionID());
        }

        request.send(null);

        // Se parsea la respuesta del servicio
        let response = angular.fromJson(request.response);

        //Si el aprendiz no tiene una sesión válida se saca de la aplicación
        if(response.codigo !== "0"){
            $state.go("home");
            SessionService.borrarSessionID();
        }

        return request;
    }

    /**
     * @name getSync
     * @desc Ejecuta una solicitud ajax de tipo GET sincrónica
     * @param url
     * @param enviaSesion
     * @return {XMLHttpRequest}
     */
    function postSync({url,data, enviaSesion}) {
        let request = new XMLHttpRequest();

        request.open('POST',url, false);
        request.setRequestHeader("Content-type","application/json");

        if(enviaSesion){
            request.setRequestHeader('SESSION',SessionService.getSessionID());
        }

        request.send(JSON.stringify(data));

        // Se parsea la respuesta del servicio
        let response = angular.fromJson(request.response);

        //Si el aprendiz no tiene una sesión válida se saca de la aplicación
        if(response.codigo !== "0"){
            $state.go("home");
            SessionService.borrarSessionID();
        }

        return request;
    }

    /**
     * @name upload
     * @desc Define la solicitud de subir archivos usando ng-file-upload
     * @param url {string}
     * @param data {Object} Define los datos que espera el servidor
     * @param headers {Object} Define las cabeceras que espera el servidor
     * @return {Promise}
     */
    function upload({url,data, headers}) {
        return Upload.upload({
            url: url,
            data: data,
            headers: headers // only for html5
        });
    }
}

export default ['$http','SessionService','$q','$state',HttpService];