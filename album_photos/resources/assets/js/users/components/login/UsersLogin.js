require('./UsersLogin.html');
import UserLoginController from './UserLoginController';

export default {
    name:   "usersLogin",
    config: {
        templateUrl:    "assets/js/users/components/login/UsersLogin.html",
        controller:     UserLoginController,
        controllerAs:   "vm"
    }
}