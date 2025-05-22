import Dropzone from 'dropzone';

Dropzone.autoDiscover = false; // Desactiva la autodetección de Dropzone

document.addEventListener("DOMContentLoaded", function () {
    const dropzoneElement = document.getElementById('dropzone');

    if (dropzoneElement) {
        const dropzone = new Dropzone(dropzoneElement, {
            dictDefaultMessage: 'Sube aquí tu imagen',
            acceptedFiles: '.png,.jpg,.jpeg,.gif',  // Tipos de archivos permitidos
            addRemoveLinks: true,  // Mostrar links para remover archivos
            dictRemoveFile: 'Borrar archivo',  // Mensaje para borrar archivo
            maxFiles: 1,  // Solo permitir un archivo
            uploadMultiple: false,  // No permitir carga de varios archivos a la vez
            init: function () {
                this.on('sending', function (file, xhr, formData) {
                    console.log('Enviando archivo', file);
                    console.log(formData); // Ver el formData antes de enviarlo
                });

                this.on('success', function (file, response) {
                    console.log('Archivo cargado con éxito:', response);
                    // Aquí puedes asignar la URL o nombre del archivo al campo oculto
                    const input = document.querySelector('input[name="imagen"]');
                    input.value = response.imagen;  // Asignamos el nombre de la imagen
                });

                this.on('error', function (file, message) {
                    console.error('Error en el archivo:', message);
                });

                this.on('removedFile', function (file) {
                    console.log('Archivo eliminado:', file);
                });
            }
        });
    }
});




