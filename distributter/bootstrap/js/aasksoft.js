function getProduct()
{
    var inputBarcodeScane = $("#inputBarcodeScane").val();
    if (inputBarcodeScane === "")
    {
        alert("Barcode Required");
        return false;
    }
    $.post('System/S_BarcodeScanforSell.php', {inputBarcodeScane: inputBarcodeScane}, function (data) {
        $("#cart_info").show();
        $("#inputBarcodeScane").val("");
        $('#itemInKart').html(data);
    });
    return false;
}
//Search by Keyword//
function search()
{
    var keywork =$("#SearchKeyWord").val();
    $.post('System/S_SearchKeyWord.php', {keywork: keywork}, function (data) {
        
        $('#searchresult').html(data);
    });
    return false;
    
}

function selectProduct(id)
{
    $("#inputBarcodeScane").val(id);
    return false;
}
//End//
function getProduct2()
{
    var inputBarcodeScane = $("#inputBarcodeScane").val();

    $.post('System/S_BarcodeScanforGetStock.php', {inputBarcodeScane: inputBarcodeScane}, function (data) {
        $('#prive1').hide();
        $("#inputBarcodeScane").val("");
        $('#rowprive').html(data);
    });
    return false;
}

function deleteItemFromCart(barcode, qty)
{
    var result = confirm("Want to delete?");
    if (result) {
        $.post("System/S_DeleteItemFromCart.php", {barcode: barcode, qty: qty}, function (data) {
            $("#cart_info").show();
            $("#inputBarcodeScane").val("");
            $('#itemInKart').html(data);
        });
    } else
    {
        alert("Delete Operation Cancel");
    }
}
function CleartKart()
{
    var result = confirm("Want to Clear whole Cart?");
    if (result) {
        $.post("System/S_ClearCart.php", {confirm: "Y"}, function (data) {
            $("#inputBarcodeScane").val("");
            $('#itemInKart').html(data);
        });
    } else
    {
        alert("Clearting Operation Cancel");
    }
}
function closeBillingUserDetail()
{
    $("#printBill").toggle(400);

}
function userDetailShow()
{
    
    var netAmt = parseInt($("#inputNetAmount").val());
    var vat = parseFloat($("#inputVat").val());
    var temp = netAmt * vat;
    var amt=temp/100;
    netAmt = netAmt + amt;
    $("#inputVat").val(amt);
    $("#inputTotalAmount").val(netAmt);
    $("#printBill").toggle(400);

}
function showDialog()
{

    $("#showDialog").show();
}
function setVat()
{
    var vat = $("#inputSetVat").val();
    $.post("System/S_SetVat.php", {vat: vat}, function (data) {
        $("#ms").html(data);
        //$("#setVatFrom").hide();

    });
    return false;
}
function updataProduct()
{

    var inputBarcode = $("#inputbarcode").val();
    var inputPrice = $("#inputPrice").val();
    var inputQuantity = $("#inputQuantity").val();
    var inputPopup = $("#inputPopup").val();
    $.post('System/S_BarcodeScanforUpdateStock.php', {inputBarcode: inputBarcode, inputPrice: inputPrice, inputQuantity: inputQuantity, inputPopup: inputPopup}, function (data) {
        $('#msg').show();
        $('#msg').html(data);
        $("#inputbarcode").val("");
        $("#inputPrice").val("");
        $("#inputQuantity").val("");
        $("#inputPopup").val("");
        $("#inputItem").val("");
        $("#inputBrand").val("");
        $("#inputSize").val("");
        setTimeout(function () {
            $('#msg').hide();
        }, 10000);
    });
    return false;
}
function setNewBarcode(stockid, item)
{

    $.post("System/S_GetNewBarode.php", {stockid: stockid, item: item}, function (data) {
        var id = "#" + stockid + "";
        $("#" + stockid + "").html(data);
    });
}
function setCompanyBarcode(stockid, item)
{
    $("#proudct").text(item);
    $("#inputGetBarcode").focus();
    $("#inputSotckID").val(stockid);
    $("#inputITEM").val(item);
}
function printBarocde(item,img)
{
    
    $("#barcodeproduct").text(item);
    $("#imh").attr('src',img);
}
function printBarcodeDiv(printarea)
{
    var printContents = document.getElementById(printarea).innerHTML;
    var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
function saveCompanyBarcode()
{
    var inputStockID = $("#inputSotckID").val();

    var inputItem = $("#inputITEM").val();
    var inputGetBarcode = $("#inputGetBarcode").val();
    if (inputGetBarcode === "")
    {
        alset("Scan your Barocde");
        return false;
    }
    $.post("System/S_SetCompanyBarode.php", {stockid: inputStockID, item: inputItem, barcode: inputGetBarcode}, function (data) {
        var id = "#" + inputStockID + "";
        $("#" + inputStockID + "").html(data);
        $("#barcodeImage").html(data);
        $("#inputGetBarcode").val("");
    });
    return false;
}
function billPrint()
{
    var inputCustomerName = $("#inputCustomerName").val();
    var inputCustomerEmail = $("#inputCustomerEmail").val();
    var inputCustomerMobile = $("#inputCustomerMobile").val();
    var inputNetAmount = $("#inputNetAmount").val();
    var inputVat = $("#inputVat").val();
    var inputTotalAmount = $("#inputTotalAmount").val();

    if ((inputCustomerName === "") || (inputCustomerMobile === "") || (inputNetAmount === "") || (inputVat === "") || (inputTotalAmount === ""))
    {
        alert("Something is missing try again later");
        return false;
    } else
    {
        var number = /^[0-9]+$/;
        if (inputCustomerMobile.match(number))
        {
            $("#cart_info").hide();
            $("#loading").show();
            $.post("System/S_CalculateBill.php", {inputCustomerName: inputCustomerName,
                inputCustomerEmail: inputCustomerEmail,
                inputCustomerMobile: inputCustomerMobile,
                inputNetAmount: inputNetAmount,
                inputVat: inputVat,
                inputTotalAmount: inputTotalAmount}, function (data) {
                $("#loading").hide();
                $("#itemInKart").html(data);
            });
            return false;
        } else
        {
            alert("Number Only in Mobile number");
            return false;
        }
    }


    return false;
}

function open_in_new_tab_and_reload(url)
{
    //Open in new tab
    window.open(url, '_blank');
    //focus to thet window
    window.focus();
    //reload current page
    location.reload();
}
function getDublicateBill()
{
    $("#loading").show();
    var inputscane = $("#inputBarcodeScane").val();
    $.post("System/S_PrintOldBill.php",{id:inputscane},function (data){
        $("#loading").hide();
        $("#oldBillDetail").html(data);
    });
    return false;
}
function display(start,end)
{
    $("#oldstock").hide();
        $("#loading").show();
    $.post("System/S_StockSplitBulet.php",{start:start,end:end},function(data){
        
        $("#loading").hide();
        $("#stockin").html(data);
        $("#oldstock").show();
    });
}

//upload image
$("#uploadimage").on('submit',(function(e) {
e.preventDefault();
$("#message").empty();
$('#loading').show();
$.ajax({
url: "uploadimage.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
$('#loading').hide();
$("#message").html(data);
}
});
}));

// Function to preview image after validation
$(function() {
$("#file").change(function() {
$("#message").empty(); // To remove the previous error message
var file = this.files[0];
var imagefile = file.type;
var match= ["image/jpeg","image/png","image/jpg"];
if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
{
$('#previewing').attr('src','noimage.png');
$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
return false;
}
else
{
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
}
});
});
function imageIsLoaded(e) {
$("#file").css("color","green");
$('#image_preview').css("display", "block");
$('#previewing').attr('src', e.target.result);
$('#previewing').attr('width', '250px');
$('#previewing').attr('height', '230px');
};