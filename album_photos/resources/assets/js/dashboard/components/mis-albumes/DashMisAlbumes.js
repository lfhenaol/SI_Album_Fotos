require('./DashMisAlbumes.html');
import DashMisAlbumesController from './DashMisAlbumesController';

export default {
    name:   "dashMisalbumes",
    config: {
        templateUrl:    "assets/js/dashboard/components/mis-albumes/DashMisAlbumes.html",
        controller:     DashMisAlbumesController,
        controllerAs:   "vm"
    }
}