const host = location.origin + "/api/";
export default {
    "REGISTRO":             host + "usuario/registro",
    "LOGIN":                host + "usuario/login",
    "PERFIL":               host + "usuario/validar-sesion",
    "NUEVO_ALBUM":          host + "album/crear-album",
    "CONSULTAR_ALBUMES":    host + "album/consultar-albumes",
    "LISTAR_ALBUMES":       host + "album/listar-albumes"
}