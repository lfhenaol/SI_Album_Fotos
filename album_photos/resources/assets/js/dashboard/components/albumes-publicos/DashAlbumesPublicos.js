require('./DashAlbumesPublicos.html');
import DashAlbumesPublicosController from './DashAlbumesPublicosController';

export default {
    name:   "dashAlbumespublicos",
    config: {
        templateUrl:    "assets/js/dashboard/components/albumes-publicos/DashAlbumesPublicos.html",
        controller:     DashAlbumesPublicosController,
        controllerAs:   "vm"
    }
}