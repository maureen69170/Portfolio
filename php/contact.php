<?php
/*avant que l'utilisateur submit ses informations les valeurs sont a vide*/
$array = array("firstname" => "", "lastname" => "", "mail" => "", "phone" => "", "message" => "", "firstnameError" =>
    "", "lastnameError" => "", "mailError" => "", "phoneError" => "", "messageError" => "",  "isSuccess" => false);


$mailTo = "maureen.depresle@gmail.com";

/*Montre les valeurs que l'utilisateur a submit grace a la value*/
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $array["firstname"] = veryfyInput($_POST["firstname"]);
    $array["lastname"] = veryfyInput($_POST["lastname"]);
    $array["mail"] = veryfyInput($_POST["mail"]);
    $array["phone"] = veryfyInput($_POST["phone"]);
    $array["message"] = veryfyInput($_POST["message"]);
    $array["isSuccess"] = true;
    $mailText = "";

    if(empty($array["firstname"])){
        $array["firstnameError"] = "Oubliez pas d'entrer votre prénom !";
        $array["isSuccess"] = false;
    }else{
        $mailText .= "Prénom: {$array["firstname"]}\n";/*les acolades specifie a php que c est une variable c est a
    la place de la concat */
    }

    if(empty($array["lastname"])){
        $array["lastnameError"] = "Oubliez pas aussi d'entrer votre nom !";
        $array["isSuccess"] = false;
    }else{
        $mailText .= "Nom: {$array["lastname"]}\n";
    }

    if(!isMail($array["mail"])){
        $array["mailError"] = "Pour vous répondre ça serait mieux d'avoir un mail valide ;) !";
        $array["isSuccess"] = false;
    }else{
        $mailText .= "Mail: {$array["mail"]}\n";
    }

    if(!isPhone($array["phone"])){
        $array["phoneError"] = "Le champ prends que des chiffres et des espaces !";
        $array["isSuccess"] = false;
    }else{
        $mailText .= "Téléphone: {$array["phone"]}\n";
    }

    if(empty($array["message"])){
        $array["messageError"] = "Oops vous n'avez pas rentré votre message !";
        $array["isSuccess"] = false;
    }else{
        $mailText .= "Message: {$array["message"]}\n";
    }

    if ($array["isSuccess"]){
        $headers = "De: {$array["firstname"]} {$array["lastname"]} <{$array["mail"]}>}\r\nReply-To: 
        {$array["message"]}"; /*l entete du mail et sers pour le repondre auto*/
        mail($mailTo, "Quelqu'un cherche a vous contacter sur le portfolio cv", $mailText, $headers);
    }

    echo json_encode($array); /*encode le tableau en json et permets la recuperation des donnees dans le result
 ensuite*/
}


function isPhone($var){
    /*expression reguliere qui permet de verifier si c est un numero de tel en comparant et en revoyant true ou
    false*/
    return preg_match("/^[0-9 ]*$/", $var);
    /*le pattern compare que ça soit un chiffre entre 0 et 9 ou un espace qui est permit grace a l'etoile et l
    etoile permet de repeter ça plusieur fois ou 0 fois si c est pas valide*/

}

function isMail($var){
    return filter_var($var, FILTER_VALIDATE_EMAIL);/*compare la variable a un filter de validation d'email et
    renvoie true si email valide et false si ça ne l est pas*/
}

/*function qui permets de verifier les inputs et les nettoient */
function veryfyInput($var){
    $var = trim($var); /*enleve les espaces supplementaire, les retours a la ligne...*/
    $var = stripslashes($var); /*permets d'enlever les / */
    $var = htmlspecialchars($var);

    return $var;
}
?>