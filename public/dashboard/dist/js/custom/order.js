$(document).ready(function () {

    // Add Product Btn
    $('.add-product-btn').click(function (e) {
        e.preventDefault();
        let name = $(this).data('name');// Product Name
        let id = $(this).data('id'); // Product ID
        let price = $(this).data('price');// product Price

        /*
        *  <input type="hidden" name="products_id[]" value="${id}"/> <!-- Return Products ID's -->
        */

        //The Order Content
        let html = `<tr id="orderRow">
                     <td>${name}</td>
                     <td><input type="number" name="products[${id}][quantity]" class="form-control input-sm product-quantity"  min="1" value="1" /></td>
                     <td id="price" data-price="${price}">${price}</td>
                     <td>
                         <a href="#" class="btn btn-danger" id="deleteOrder" data-id="${id}">
                            <i class="fas fa-trash"></i>
                         </a>
                     </td>
                    </tr>`; // end Of  Order Content

        $(this).removeClass('btn-success').addClass('btn-default disabled');//Remove Success Class From Add Button  At Categories Coulmn
        /************************************************************/
        //Remove <tr> No Data Found </tr> When Added Order
        $('.rowDataFound').fadeOut(600, function () {
            $(this).remove()
        });
        $('#tBody').append(html);
        /************************************************************/

        // Call To calcTotalPrice() Function When Add Product
        calcTotalPrice();

    });// end of add product btn

    /************************************************************/
    // When I Press On Delete Button => Remove This Row Then Add Class Btn-success To Add Button
    $('body').on('click', '#deleteOrder', function (e) {
        e.preventDefault();

        let id = $(this).data('id');

        $("#product-" + id).removeClass('btn-default disabled').addClass('btn-success');

        $(this).closest('tr').remove();
        /**
         *  Call To calcTotalPrice() Function When Remove Product
         */
        calcTotalPrice();

    });
    /************************************************************/
    //Calac Total Price If Quantity Changed
    $('body').on('change', '.product-quantity', function (e) {
        let quantity = parseInt($(this).val());
        let productPrice = $(this).closest('tr').find('#price');
        let totalPrice = parseInt(productPrice.data('price')) * quantity;
        productPrice.html(totalPrice);

        calcTotalPrice();

    })
    /************************************************************/

    /****************** Functions ************************/
    /**
     * CalcTotalPrice() =>
     * loop on all td has a price id
     * then get html() form that
     *
     */
    function calcTotalPrice() {
        let price = 0;
        $('#orderRow #price').each(function (index) {
            price += parseInt($(this).html());
        });
        $('#totalCost').html(price);
        /************************************************************/

        // Make Button Submit Is Disabled Or Not , When Price > 0
        if (price > 0) {
            $('#add-order-btn').removeClass('disabled');
        } else {
            $('#add-order-btn').addClass('disabled');

        }
    }

})

