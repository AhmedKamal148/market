$(function () {
    /*************************************************************/
    /******************** A-jax Search **************************/

    /*   $('#searchProduct').on('keyup',function ()
       {
           $value = $(this).val();
           $.ajax({});}) ;
    */

    /*************************************************************/

    /*************************************************************/
    /******************** Preview Image **************************/

    $('#image').change(function () {

        if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
        s
    });


    /*************************************************************/


});

