import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone_imagen = new Dropzone("#dropzone-imagen", {
    dictDefaultMessage: "Upload your image here",
    acceptedFiles: ".png, .jpg. jpeg",
    addRemoveLinks: true,
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (document.querySelector('[name="image"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name =
                document.querySelector('[name="image"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(
                this,
                imagenPublicada,
                `/uploads/img/${imagenPublicada.name}`
            );

            imagenPublicada.previewElement.classlist.add(
                "dz-success",
                "dz-complete"
            );
        }
    },
});

dropzone_imagen.on("success", function (file, response) {
    document.querySelector('[name="image"]').value = response.imagen;
});
dropzone_imagen.on('removedfile', function() {
    document.querySelector('[name="image"]').value = '';
})

const dropzone_video = new Dropzone("#dropzone-video", {
    dictDefaultMessage: "Upload your video here",
    acceptedFiles: ".mp4",
    addRemoveLinks: true,
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (document.querySelector('[name="video"]').value.trim()) {
            const videoPublicado = {};
            videoPublicado.size = 1234;
            videoPublicado.name =
                document.querySelector('[name="video"]').value;

            this.options.addedfile.call(this, videoPublicado);
            this.options.thumbnail.call(
                this,
                videoPublicado,
                `/uploads/video/${videoPublicado.name}`
            );

            videoPublicado.previewElement.classlist.add(
                "dz-success",
                "dz-complete"
            );
        }
    },
});
dropzone_video.on("success", function (file, response) {
    document.querySelector('[name="video"]').value = response.video;
});
dropzone_imagen.on('removedfile', function() {
    document.querySelector('[name="video"]').value = '';
})

