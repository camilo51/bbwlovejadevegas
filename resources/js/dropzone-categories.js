import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const imagen_categorie = new Dropzone("#dropzone-imagen-categorie", {
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

imagen_categorie.on("success", function (file, response) {
    document.querySelector('[name="image"]').value = response.imagen;
});
imagen_categorie.on('removedfile', function() {
    document.querySelector('[name="image"]').value = '';
})