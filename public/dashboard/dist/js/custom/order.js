/********************* Global Variables  *********************/
let Order_Cost = 0.00;
let Product_Cost = 0.00;
let Product_Quantity = 1;

/************* End Of Global Variables  *********************/


$(document).ready(function () {
    // when click on add-product-btn
    $('.add-product-btn').on('click', function (e) {

        e.preventDefault();

        // Get Product Data When Click On Product-btn
        var productName = $(this).data('name'),
            productId = $(this).data('id'),
            productPrice = $(this).data('price'),
            html = `<tr id="productRow-${productId}">
                        <td>${productName}</td>
                        <td>
                            <input type="number" name="product[quantity]"  class="form-control-sm quantity" min="1" value="1">
                        </td>
                        <td id="product_price-${productId}" class="product_price">${productPrice}</td>
                        <td><button class="btn btn-danger remove-product-btn" data-id="${productId}" ><i class=" fas fa-trash-restore "></i></button></td>
                   </tr>`;

        $('#order-list').append(html); // end of append Order-row ===> (html) to order-list


        $(this).removeClass('btn-success').addClass('btn-default disabled'); // end of remove btn-success then add btn-default to add-product-ptn


        /***************** Call Functions And Define Variables ********************/
        let productPriceElements = document.querySelectorAll('.product_price'); // Get  All Product Price <td> To Calc Total Order Cost

        calcProductCost(productId, productPrice); // Call of calcProductCost

        printProductCost(Product_Cost); //Call of printProductCost

        printOrderCost(productPriceElements);//Call of printOrderCost

        addOrderAvailability(); // Call Of addOrderAvailability


        /***************** End Of Call Functions ********************/


        /************************ Events **************************/
        $('input.quantity').on('change', function (e) {
            Product_Quantity = e.target.value;

            calcProductCost(productId, productPrice);   // Call of calcProductCost
            printProductCost(productId, Product_Cost);  //Call of printProductCost
            printOrderCost(productPriceElements);  //Call of printOrderCost
            addOrderAvailability(); // Call Of addOrderAvailability

        }); // end of  on change quantity

        $('.remove-product-btn').on('click', function (e) {
            e.preventDefault();
            let id = $(this).data('id');

            $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success').removeAttr('disabled');
            $(this).closest('tr').remove(); // remove Product-row


            let productPriceElements = document.querySelectorAll('.product_price'); // Get  All Product Price <td> To Calc Total Order Cost
            printOrderCost(productPriceElements);//Call of printOrderCost
            addOrderAvailability(); // Call Of addOrderAvailability

        });//end of remove-product-btn

        /********************* End of Events *********************/

    });//end of add-product-btn


    $(document).on('click', 'disabled', function (e) {
        e.preventDefault();
    }); // end of disabled btn

});//end of document ready


/********************* Functions *********************/

function calcProductCost(productID, productPrice) {
    let productQuantity = $('#productRow-' + productID).find('.quantity').val();
    Product_Cost = (productPrice * productQuantity).toFixed(2);
} //end of calcProductCost Function

function printProductCost(product_id, Product_Cost) {
    $('#product_price-' + product_id).text(Product_Cost)
} // end of PrintProductCost function

function printOrderCost(productPriceElements) {
    for (let i = 0; i < productPriceElements.length; i++) {
        Order_Cost += parseFloat(productPriceElements[i].textContent);
    }
    $('#totalOrderCost').text(Order_Cost.toFixed(2));
    Order_Cost = 0;
}// end of printOrderCost function

function addOrderAvailability() {

    if ($('#totalOrderCost').text() > 0) {

        $('#add-order-btn').removeClass('disabled')
    } else {
        $('#add-order-btn').addClass('disabled');
    }
}

/************* End Of Functions *********************/

