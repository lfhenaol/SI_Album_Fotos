function AlbumFotosService() {
    let idUsuarioActivo;
    let pefilUsuarioActivo;

    return {
        setPerfilUsuarioActivo: setPerfilUsuarioActivo,
        getPerfilUsuarioActivo: getPerfilUsuarioActivo,
        setIdUsuarioActivo:    setIdUsuarioActivo,
        getIdUsuarioActivo:    getIdUsuarioActivo
    }

    function setPerfilUsuarioActivo(perfil){
        this.pefilUsuarioActivo = perfil;
    }

    function getPerfilUsuarioActivo(){
        return this.pefilUsuarioActivo;
    }

    function setIdUsuarioActivo(state) {
        this.idUsuarioActivo = state;
    }

    function getIdUsuarioActivo(state) {
        return this.idUsuarioActivo;
    }
}

export default AlbumFotosService;