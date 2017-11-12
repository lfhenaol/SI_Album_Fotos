require('./UserRegister.html');
import UserRegisterController from './UserRegisterController';

export default {
    name:   "usersRegistro",
    config: {
        templateUrl:    "assets/js/users/components/registro/UserRegister.html",
        controller:     UserRegisterController,
        controllerAs:   "vm"
    }
}