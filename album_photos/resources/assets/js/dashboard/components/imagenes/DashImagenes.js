require('./DashImagenes.html');
import DashImagenesController from './DashImagenesController';

export default {
    name:   "dashImagenes",
    config: {
        templateUrl:    "assets/js/dashboard/components/imagenes/DashImagenes.html",
        controller:     DashImagenesController,
        controllerAs:   "vm",
        bindings: {
            filtro:         "<",
            idAlbum:        "<",
            onCerrarFotos:  "&",
            visibilidad:    "@"
        }
    }
}