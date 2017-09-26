import FotosConfig from './FotosConfig';
import FotosHome from './home/FotosHome';

export default angular.module("fotos", [])
    .config(FotosConfig)
    .component(FotosHome.name, FotosHome.config);