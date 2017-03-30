/**
 * Created by sajjad on 3/30/17.
 */


function readURL(input, id_element_to_preview) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id_element_to_preview).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}