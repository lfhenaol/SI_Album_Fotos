const host = location.origin + "/api/";
export default {
    "REGISTRO":             host + "usuario/registro",
    "LOGIN":                host + "usuario/login",
    "PERFIL":               host + "usuario/validar-sesion",
    "NUEVO_ALBUM":          host + "album/crear-album",
    "CONSULTAR_ALBUMES":    host + "album/consultar-albumes",
    "LISTAR_ALBUMES":       host + "album/listar-albumes",
    "GUARDAR_IMAGEN":       host + "imagen/guardar-imagen",
    "CONSULTAR_IMAGENES":   host + "imagen/consultar-imagenes-album",
    "GUARDAR_COMENTARIO":   host + "comentario/guardar-comentario"
}