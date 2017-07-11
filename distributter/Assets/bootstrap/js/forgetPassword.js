$(document).ready(function(){
    $("#inputsendRequest").click(function (){
        var email=$("#inputEmailRequest").val();
        $.post("System/SendRequest",{email:email},function (data){
            $("#message").html(data);
        });
    });
});