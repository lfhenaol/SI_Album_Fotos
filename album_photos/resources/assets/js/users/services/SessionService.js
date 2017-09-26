function SessionService($cookies) {
    return {
        setSessionID:       setSessionID,
        getSessionID:       getSessionID,
        haySessionActiva:   haySessionActiva,
        borrarSessionID:    borrarSessionID
    };

    /**
     * @name setSessionID
     * @desc Setea el identificador de la sesión de un usuario en el sessionStorage
     * @return {Promise}
     * @param ID Identificador unico de la sesión
     */
    function setSessionID(ID) {
        $cookies.put('g_s3',ID);
    }

    /**
     * @name getSessionID
     * @desc Obtiene el identificador de la sesión de un usuario de el sessionStorage
     * @return {string}
     */
    function getSessionID() {
        console.log($cookies);
        return $cookies.get('g_s3');
    }

    /**
     * @name haySessionActiva
     * @desc Determina si hay una sessión de usuario activa o no
     * @return {boolean}
     */
    function haySessionActiva() {
        return !!getSessionID();
    }

    /**
     * @name borrarSessionID
     * @desc Borra la sesión de usuario de sessionStorage
     */
    function borrarSessionID(){
        $cookies.remove('g_s3');
    }
}

export default ['$cookies', SessionService];