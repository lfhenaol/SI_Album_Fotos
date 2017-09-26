function UtilidadesService($mdDialog) {

    return {
        mostrarAlerta:       mostrarAlerta
    };

    function mostrarAlerta({titulo, contenido, event}) {
        $mdDialog.show(
            $mdDialog.alert()
                .parent(angular.element("body"))
                .clickOutsideToClose(true)
                .title(titulo)
                .textContent(contenido)
                .ok("Cerrar")
                .targetEvent(event)
        );
    }
}

export default ['$mdDialog',UtilidadesService];