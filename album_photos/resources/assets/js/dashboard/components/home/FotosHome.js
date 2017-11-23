require('./FotosHome.html');
import FotosHomeController from './FotosHomeController';

export default {
    name:   "fotosHome",
    config: {
        templateUrl:    "assets/js/dashboard/components/home/FotosHome.html",
        controller:     FotosHomeController,
        controllerAs:   "vm"
    }
}