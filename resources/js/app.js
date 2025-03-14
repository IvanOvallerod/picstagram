import './bootstrap';
// If you are using JavaScript/ECMAScript modules:
import Dropzone from "dropzone";
// If you are using an older version than Dropzone 6.0.0,
// then you need to disabled the autoDiscover behaviour here:
Dropzone.autoDiscover = false;

let dropzone = new Dropzone("#dropzone", {
    paramName: "file",
    dictDefaultMessage: "Sube tu imagen",
    dictRemoveFile: "Eliminar",
    // url: "/upload",
    maxFilesize: 2,
    maxFiles: 1,
    uploadMultiple: false,
    // acceptedFiles: "image/*",
    acceptedFiles: ".png,.jpg,.jpeg,.gif,",
    addRemoveLinks: true,
    // headers: {
    //     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    // }
    init: function() {
        if(document.querySelector('[name="image"]').value.trim()) {
            const publishedImage = {};
            publishedImage.size = 12345;
            publishedImage.name = document.querySelector('[name="image"]').value;
            publishedImage.dataURL = `../../img/posts/${publishedImage.name}`;
            this.options.addedfile.call(this, publishedImage);
            this.options.thumbnail.call(this, publishedImage, publishedImage.dataURL);
            publishedImage.previewElement.classList.add('dz-success');
            publishedImage.previewElement.classList.add('dz-complete');
        }
    }
});

dropzone.on('sending', function(file, xhr, formData) {
    formData.append('file', file);
    // console.log(file);
    // console.log(formData);
});

dropzone.on('success', function(file, response) {
    // console.log(response);
    // console.log(response.image);
    // console.log(file);
    document.querySelector('[name="image"]').value = response.image;
});

dropzone.on('error', function(file, response) {
    // console.log(response);
    // console.log(file);
});

dropzone.on('removedfile', function(file) {
    // console.log(file);
    // console.log('removed');
    document.querySelector('[name="image"]').value = '';
});
