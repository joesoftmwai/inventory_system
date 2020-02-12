/**
 * :: LOCALSTORAGE CHECK
 */

 if(localStorage.getItem('dateRange') != null) {
    $('#daterange-btn span').html(localStorage.getItem('dateRange'));
 } else {
    $('#daterange-btn span').html('<i class="fa fa-calendar"></i> Date range <i class="fa fa-caret-down"></i>');
 }




$.ajax({
    url: "ajax/datatable-sales.ajax.php",
    success: function (response) {
        //console.log("response", response);
    }
});
 

$('._product_sales_tables').DataTable({
    "ajax": "ajax/datatable-sales.ajax.php",

    // properties to optimise loading process
    "deferRender": true,
    "retrieve": true,
    "processing": true

});

/**
 * :: ADDING PRODUCTS
 */

$("._product_sales_tables tbody").on("click", "button.addProduct", function () {
    var productId = $(this).attr("productId");
    $(this).removeClass("btn-primary addProduct");
    $(this).addClass("btn-default");

    var _data = new FormData();
    _data.append("productId", productId);

    $.ajax({
        url: 'ajax/products.ajax.php',
        method: "POST",
        data: _data,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {

            var description = response['description'];
            var stock = response['stock'];
            var price = response['selling_price'];


            // checks if the stock is zero
            if (stock == 0) {
                Swal.fire({
                    title: 'There is no stock available',
                    type: 'error',
                    confirmButtonText: 'Close'
                });

                $("button[productId='" + productId + "']").addClass("btn-primary addProduct");

                return;

            }

            $('.new_product').append('\n' +
                '                                    <!--appending new product desc, stock && price-->\n' +
                '                                    <div class="row" style="padding: 5px 15px">\n' +
                '                                    <!--product description-->\n' +
                '                                    <div class="col-xs-6 _description">\n' +
                '                                        <div class="input-group">\n' +
                '                                            <span class="input-group-addon">\n' +
                '                                                <button type="button"\n' +
                '                                                        class="btn btn-danger btn-xs removeProduct" productId="' + productId + '">\n' +
                '                                                    <i class="fa fa-times"></i>\n' +
                '                                                </button>\n' +
                '                                            </span>\n' +
                '                                            <input type="text" class="form-control add_product" name="add_product"\n' +
                '                                                    productId="' + productId + '" value="' + description + '" readonly>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '\n' +
                '                                    <!--product quantity-->\n' +
                '                                    <div class="col-xs-3 _stock">\n' +
                '                                        <input type="number" class="form-control product_quantity" id="product_quantity"\n' +
                '                                               name="product_quantity" min="0"\n' +
                '                                               stock = "' + stock + '" productId = "' + productId + '" newStock="' + Number(stock - 1) + '" value="1">\n' +
                '                                    </div>\n' +
                '\n' +
                '                                    <!--product price-->\n' +
                '                                    <div class="col-xs-3 _price">\n' +
                '                                        <div class="input-group">\n' +
                '                                            <input type="text" class="form-control product_price" id="product_price"\n' +
                '                                                   name="product_price" realPrice="' + price + '"\n' +
                '                                                   value="' + price + '" readonly required>\n' +
                '                                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>\n' +
                '                                        </div>\n' +
                '                                        </div>\n' +
                '                                    </div>');

            // adding total prices
            addingTotalPrices();

            //adding tax
            addTax();

            //grouping products in json format
            listAllProducts();

            /**
             * : format product price
             */
            $(".product_price").number(true, 2);
            $(".new_total_sales").number(true, 2);


        }


    });
});


/**
 * :: WHEN SURFING ACROSS THE TABLE
 */
$("._product_sales_tables").on("draw.dt", function () {

    if (localStorage.getItem("removeProduct") != null) {
        var listProductIds = JSON.parse(localStorage.getItem("removeProduct"));

        for (var i = 0; i < listProductIds.length; i++) {
            $("button.recoverButton[productId='" + listProductIds[i]["productId"] + "']").removeClass("btn-default");
            $("button.recoverButton[productId='" + listProductIds[i]["productId"] + "']").addClass("btn-primary addProduct");

        }
    }
});


/**
 * :: DELETE PRODUCT FROM SALES AND RECOVER BUTTON
 */

var removeProductId = [];
localStorage.removeItem("removeProduct");

$(".sales_form").on("click", "button.removeProduct", function () {

    $(this).parent().parent().parent().parent().remove();

    var productId = $(this).attr("productId");
    // store in the local storage the id we want to delete

    if (localStorage.getItem("removeProduct") == null) {
        removeProductId = [];
    } else {
        removeProductId.concat(localStorage.getItem("removeProduct"));
    }

    removeProductId.push({"productId": productId});
    localStorage.setItem("removeProduct", JSON.stringify(removeProductId));

    $("button.recoverButton[productId='" + productId + "']").removeClass("btn-default");
    $("button.recoverButton[productId='" + productId + "']").addClass("btn-primary addProduct");

    if ($(".new_product").children().length == 0) {

        $("#new_total_sales").val(0);
        $("#total_sales").val(0);
        $("#new_tax_sales").val(0);
        $("#new_total_sales").attr("total", 0);

    } else {
        // adding total prices
        addingTotalPrices();

        //adding tax
        addTax();

        //grouping products in json format
        listAllProducts();
    }

});


/**
 * :: ADDING PRODUCT USING THE ADD BUTTON FOR SMALL DEVICES
 */

var productNum = 0;
$(".btnAddProduct").click(function () {

    productNum++;

    var _data = new FormData();
    _data.append("bringProducts", "ok");

    $.ajax({
        url: 'ajax/products.ajax.php',
        method: "post",
        data: _data,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {

            $('.new_product').append('\n' +
                '                                    <!--appending new product desc, stock && price-->\n' +
                '                                    <div class="row" style="padding: 5px 15px">\n' +
                '                                    <!--product description-->\n' +
                '                                    <div class="col-xs-6 _description">\n' +
                '                                        <div class="input-group">\n' +
                '                                            <span class="input-group-addon">\n' +
                '                                                <button type="button"\n' +
                '                                                        class="btn btn-danger btn-xs removeProduct" productId>\n' +
                '                                                    <i class="fa fa-times"></i>\n' +
                '                                                </button>\n' +
                '                                            </span>\n' +
                '                                            <select class="form-control newProductDescription add_product" productId="" id="product' + productNum + '" name="newProductDescription" required> ' +
                '                                               <option value="0">Select products</option>\n' +
                '                                            </select>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '\n' +
                '                                    <!--product quantity-->\n' +
                '                                    <div class="col-xs-3  _stock">\n' +
                '                                        <input type="number" class="form-control product_quantity" id="product_quantity"\n' +
                '                                               name="product_quantity" min="0"\n' +
                '                                               stock="" productId="" newStock="" value="1">\n' +
                '                                    </div>\n' +
                '\n' +
                '                                    <!--product price-->\n' +
                '                                    <div class="col-xs-3 _price">\n' +
                '                                        <div class="input-group">\n' +
                '                                            <input type="text"  class="form-control product_price" id="product_price"\n' +
                '                                                   name="product_price" realPrice=" " \n' +
                '                                                   value="" readonly required>\n' +
                '                                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>\n' +
                '                                        </div>\n' +
                '                                        </div>\n' +
                '                                    </div>');

            response.forEach(functionForEach);

            function functionForEach(item, index) {
                if (item.stock != 0) {
                    $("#product" + productNum).append('<option productId="' + item.id + '" value="' + item.description + '">' + item.description + '</option>\n');
                }


            }


            // adding total prices
            addingTotalPrices();

            //adding tax
            addTax();

            //grouping products in json format
            listAllProducts();

        }

    });
});


/**
 * :: ON SELECTING THE PRODUCT
 */

$(".sales_form").on("change", "select.newProductDescription", function () {
    var productName = $(this).val();

    var product_price = $(this).parent().parent().parent().children("._price").children().children("#product_price");
    var product_quantity = $(this).parent().parent().parent().children("._stock").children("#product_quantity");


    var _data = new FormData();
    _data.append("productName", productName);

    $.ajax({
        url: 'ajax/products.ajax.php',
        method: "post",
        data: _data,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {

            $(product_quantity).attr("stock", response["stock"]);
            $(product_quantity).attr("newStock", Number(response["stock"]) - 1);
            $(product_quantity).attr("productId", response["id"]);
            $(product_price).val(response["selling_price"]);
            $(product_price).attr("realPrice", response["selling_price"]);

            //adding total prices
            addingTotalPrices();

            //adding tax
            addTax();

            //grouping products in json format
            listAllProducts();

            /**
             * : format product price
             */
            $(".product_price").number(true, 2);
            $(".new_total_sales").number(true, 2);

        }
    });

});


/**
 * :: MODIFY QUANTITY
 */

$(".sales_form").on("change", "input.product_quantity", function () {
    var price = $(this).parent().parent().children("._price").children().children(".product_price");
    var finalPrice = $(this).val() * price.attr("realPrice");

    price.val(finalPrice);

    var newStock = Number($(this).attr("stock")) - Number($(this).val());
    $(this).attr("newStock", newStock);

    if (Number($(this).val()) > Number($(this).attr("stock"))) {

        // quantity exceeds stock go back to initial value
        $(this).val(1);
        finalPrice = $(this).val() * price.attr("realPrice");
        price.val(finalPrice);

        Swal.fire({
            title: 'The quantity is over the available stock',
            text: 'There is only ' + $(this).attr("stock") + ' Units remaining',
            type: 'error',
            confirmButtonText: 'Close'
        });
    }

    //adding total prices
    addingTotalPrices();

    //adding tax
    addTax();

    //grouping products in json format
    listAllProducts();
});

/**
 * :: ADDING ALL PRODUCTS PRICES
 */

function addingTotalPrices() {
    var itemPrice = $(".product_price");
    var arrayTotalPrices = [];

    for (var i = 0; i < itemPrice.length; i++) {
        arrayTotalPrices.push(Number($(itemPrice[i]).val()));
    }

    function addingArrayTotalPrices(total, number) {
        return total + number;
    }

    var addingTotals = arrayTotalPrices.reduce(addingArrayTotalPrices);

    $("#new_total_sales").val(addingTotals);
    $("#total_sales").val(addingTotals);
    $("#new_total_sales").attr("total", addingTotals);

}


/**
 * :: ADDING TAX
 */
function addTax() {
    var tax = $("#new_tax_sales").val();
    var totalPrice = $("#new_total_sales").attr("total");

    var taxPrice = Number(totalPrice * tax / 100);

    var totalTaxedPrice = Number(totalPrice) + Number(taxPrice);

    $("#new_total_sales").val(totalTaxedPrice);
    $("#total_sales").val(totalTaxedPrice);

    $("#new_tax_price").val(taxPrice);
    $("#new_net_price").val(totalPrice);

}

/**
 * :: WHEN TAX CHANGES
 */

$("#new_tax_sales").change(function () {
    //adding tax
    addTax();
});


/**
 * :: SELECT PAYMENT METHOD
 */

$("#new_payment_mode").change(function () {
    var mode = $(this).val();


    if (mode == "Cash") {

        $(this).parent().parent().removeClass('col-xs-6');
        $(this).parent().parent().addClass('col-xs-4');

        $(this).parent().parent().parent().children(".payment_mode_boxes").html('<div class="col-xs-4">\n' +
            ' <div class="input-group">\n' +
            '  <input type="text" class="form-control new_cash_value" id="new_cash_value" name="new_cash_value" placeholder="0000" required>\n' +
            '  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>\n' +
            ' </div>\n' +
            '</div>\n' +
            '<div class="col-xs-4 captureChangeCash">\n' +
            ' <div class="input-group">\n' +
            '  <input type="text" class="form-control new_change_value" id="new_change_value" name="new_change_value" placeholder="0000" required>\n' +
            '  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>\n' +
            ' </div>\n' +
            '</div>');

        $("#new_cash_value").number(true, 2);
        $("#new_change_value").number(true, 2);

        // new payment method
        new_payment_method();


    } else {
        $(this).parent().parent().removeClass('col-xs-4');
        $(this).parent().parent().addClass('col-xs-6');
        $(this).parent().parent().parent().children(".payment_mode_boxes").html('<div class="col-xs-6">\n' +
            ' <div class="input-group">\n' +
            '  <input type="text" class="form-control new_transaction_code" id="new_transaction_code" name="new_transaction_code"  placeholder="Transaction Code" required>\n' +
            '  <span class="input-group-addon"><i class="fa fa-lock"></i></span>\n' +
            ' </div>\n' +
            '</div>');

    }

});

/**
 * :: CHANGE IN CASH
 */

$(".sales_form").on("change", "input.new_cash_value", function () {
    var cash = $(this).val();
    var change = Number(cash) - Number($("#new_total_sales").val());

    var newChangeCash = $(this).parent().parent().parent().children('.captureChangeCash').children().children('.new_change_value');

    newChangeCash.val(change);
});

/**
 * :: CHANGE IN TRANSACTION
 */
$(".sales_form").on("change", "input#new_transaction_code", function () {

    // new payment method
    new_payment_method();

});



/**
 * :: LIST ALL THE PRODUCTS
 */

function listAllProducts() {
    var listProducts = [];

    var description = $(".add_product");
    var quantity = $(".product_quantity");
    var price = $(".product_price");


    for (var i = 0; i < description.length; i++) {
        listProducts.push({
            "id": $(quantity[i]).attr("productId"),
            "description": $(description[i]).val(),
            "quantity": $(quantity[i]).val(),
            "stock": $(quantity[i]).attr("newStock"),
            "price": $(price[i]).attr("realPrice"),
            "total": $(price[i]).val()

        });
    }

    // console.log("listProducts", JSON.stringify(listProducts));

    $("#_listProducts").val(JSON.stringify(listProducts));

}

/**
 * :: LIST METHOD PAYMENT
 */

function new_payment_method() {

    if ($("#new_payment_mode").val() == "Cash") {
        $(".listPaymentMethod").val("Cash");
    } else {
        $(".listPaymentMethod").val($("#new_payment_mode").val() +"-"+ $("#new_transaction_code").val());
    }

    console.log("something happened");

}


/**
 * :: DELETE SALE
 */
$("._tables").on('click', '.btnDeleteSale', function(){
    var saleId = $(this).attr("saleId");

    console.log("saleId", saleId);

    Swal.fire({
        title: 'Are you sure you want to delete the selected sale ??',
        text: 'If no sure you can cancel the action',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: "Cancel",
        confirmButtonText: "Ok"
    }).then((result) => {
        if (result.value) {
            window.location="index.php?route=sales&saleId="+saleId;
        }
    });
});

/**
 * :: PRINT BILL
 */

 $("._tables").on('click', '.btnPrintBill', function(){
     var saleCode = $(this).attr('saleCode');
     window.open("extensions/tcpdf/pdf/bill.php?code="+saleCode, "_blank");
 });


 /**
  * :: DATE RANGE PICKER
  */

// Date range as a button
$('#daterange-btn').daterangepicker(
{
    ranges   : {
    'Today'       : [moment(), moment()],
    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
},
function (start, end) {
    $('#daterange-btn span').html(start.format('MMMM DD, YYYY') + ' - ' + end.format('MMMM DD, YYYY'))

    var startDate = start.format('YYYY-MM-DD');
    var endDate = end.format('YYYY-MM-DD');
    var dateRange =  $('#daterange-btn span').html();
  
    localStorage.setItem('dateRange', dateRange);
    window.location = "index.php?route=sales&startDate="+startDate+"&endDate="+endDate;
}
)

/**
 * :: CANCEL DATE RANGE
 */

 $('.daterangepicker .range_inputs .cancelBtn').on('click', function() {
    localStorage.removeItem('dateRange');
    localStorage.clear();
    window.location = 'sales';
 }) ;

 /**
  * :: CAPTURE TODAY
  */
 $('.daterangepicker .ranges li').on('click', function() {

     var todayText = $(this).attr('data-range-key');
     if(todayText=="Today") {
        var date = new Date();
        var year = date.getFullYear();
        var month = date.getMonth()+1;
        var day = date.getDate();
        var today = (year+'-'+month+'-'+day);

        if(month < 10) {
            var today = (year+'-0'+month+'-'+day);
        } else if(day < 10) {
            var today = (year+'-'+month+'-0'+day);
        } else if(month < 10 && day < 10) {
            var today = (year+'-0'+month+'-0'+day);
        } else {
            var today = (year+'-'+month+'-'+day);
        }


        localStorage.setItem("dateRange", "Today");

        window.location="index.php?route=sales&startDate="+today+"&endDate="+today;
     }

 }) ;








