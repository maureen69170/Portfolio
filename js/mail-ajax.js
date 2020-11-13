$(function (){
    $('#contact-form').submit(function (event){
        event.preventDefault();/*permets d enlever le comportement par defaut du form*/
        $('.comments').empty();/*remet les commentaires a vide*/
        var postdata = $('#contact-form').serialize();

        $.ajax({
            type: 'POST',
            url: 'php/contact.php',
            data: postdata,
            dataType: 'json',
            success: function (result){
                console.log(result);
                if (result.isSuccess){
                    $('#contact-form').append("<p class='thank-you'>Votre message a bien été envoyé, merci de m'avoir contacté !</p>")
                    $('#contact-form')[0].reset();
                    console.log(result);
                }else {
                    $("#firstname + .comments").html(result.firstnameError);
                    $("#lastname + .comments").html(result.lastnameError);
                    $("#mail + .comments").html(result.mailError);
                    $("#phone + .comments").html(result.phoneError);
                    $("#message + .comments").html(result.messageError);
                    console.log(result);
                }
            }
        });
    });
})
/*
console.log(result);*/
