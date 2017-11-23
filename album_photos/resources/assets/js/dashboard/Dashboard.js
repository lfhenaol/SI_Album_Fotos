import DashboardConfig from './DashboardConfig';
import FotosHome from './components/home/FotosHome';
import DashMisAlbumes from './components/mis-albumes/DashMisAlbumes';
import DashAlbumesPublicos from './components/albumes-publicos/DashAlbumesPublicos';
import AlbumFotosService from './services/AlbumFotosService';
import DashImagenes from './components/imagenes/DashImagenes';

export default angular.module("dashboard", [])
    .config(DashboardConfig)

    .factory("AlbumFotosService", AlbumFotosService)

    .component(FotosHome.name, FotosHome.config)
    .component(DashMisAlbumes.name, DashMisAlbumes.config)
    .component(DashAlbumesPublicos.name, DashAlbumesPublicos.config)
    .component(DashImagenes.name, DashImagenes.config);