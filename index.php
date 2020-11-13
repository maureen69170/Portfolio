<?php
    /*avant que l'utilisateur submit ses informations*/
    $firstname = $lastname = $mail = $phone = $message = "";
    $firstnameError = $lastnameError = $mailError = $phoneError = $messageError = "";
    $isSuccess = false;
    $mailTo = "maureen.depresle@gmail.com";

    /*Montre les valeurs que l'utilisateur a submit grace a la value*/
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $firstname = veryfyInput($_POST["firstname"]);
        $lastname = veryfyInput($_POST["lastname"]);
        $mail = veryfyInput($_POST["mail"]);
        $phone = veryfyInput($_POST["phone"]);
        $message = veryfyInput($_POST["message"]);
        $isSuccess = true;
        $mailText = "";

        if(empty($firstname)){
            $firstnameError = "Oubliez pas d'entrer votre prénom !";
            $isSuccess = false;
        }else{
            $mailText .= "Prénom: $firstname\n";
        }

        if(empty($lastname)){
            $lastnameError = "Oubliez pas aussi d'entrer votre nom !";
            $isSuccess = false;
        }else{
            $mailText .= "Nom: $lastname\n";
        }

        if(!isMail($mail)){
            $mailError = "Pour vous répondre ça serait mieux d'avoir un mail valide ;) !";
            $isSuccess = false;
        }else{
            $mailText .= "Mail: $mail\n";
        }

        if(!isPhone($phone)){
            $phoneError = "Le champ prends que des chiffres et des espaces !";
            $isSuccess = false;
        }else{
            $mailText .= "Téléphone: $phone\n";
        }

        if(empty($message)){
            $messageError = "Oops vous n'avez pas rentré votre message !";
            $isSuccess = false;
        }else{
            $mailText .= "Message: $message\n";
        }

        if ($isSuccess){
            $headers = "De: $firstname $lastname <$mail>\r\nReply-To: $mail"; /*l entete du mail et sers pour le repondre
 auto*/
            mail($mailTo, "Quelqu'un cherche a vous contacter sur le portfolio cv", $mailText, $headers);
            $firstname = $lastname = $mail = $phone = $message = ""; /*remets les champs vide apres l envoie du mail*/
        }
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

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="TITLE" content="Portfolio Maureen Depresle">
    <meta name="AUTHOR" content="Maureen Depresle">
    <meta name="DESCRIPTION" content="site cv">
    <meta name="KEYWORDS" content="portfolio, cv, maureen, depresle, maureen depresle">
    <meta name="OWNER" content="Maureen Depresle">
    <meta name="ROBOTS" content="index,all">
    <meta name="Reply-to" content="maureen.depresle@gmail.com">
    <meta name="REVISIT-AFTER" content="1">
    <title>Portfolio CV Maureen Depresle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body data-spy="scroll" data-target="#navbar" data-offset="60">
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars fa-3x"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active topnav-centered">
                    <a class="nav-link" href="#about">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item topnav-centered">
                    <a class="nav-link" href="#skills">compétences</a>
                </li>

                <li class="nav-item topnav-centered">
                    <a class="nav-link" href="#experience">expérience</a>
                </li>

                <li class="nav-item topnav-centered">
                    <a class="nav-link" href="#education">éducation</a>
                </li>

                <li class="nav-item topnav-centered">
                    <a class="nav-link" href="#portfolio">portfolio</a>
                </li>

                <li class="nav-item topnav-centered">
                    <a class="nav-link" href="#contact">contact</a>
                </li>
            </ul>
        </div>
    </nav>


    <section id="about" class="container-fluid <!--progress-bar-striped  progress-bar-animated-->">
        <div class="col-xs8 col-md-4 profile-picture">
            <img src="img/avatar-maureen.png" alt="Avatar Maureen Depresle" class="rounded-circle">
        </div>
        <div class="heading">
            <h1>Maureen Depresle</h1>
            <h3>Développeur Web</h3>
            <a href="documents/cvdev_maureen_depresle_v4.pdf" class="button1">Télécharger le CV</a>
        </div>
    </section>

    <section id="skills">
        <div class="blue-divider"></div>
        <div class="heading2">
            <h2>Compétences</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped  progress-bar-animated" role="progressbar"
                             aria-valuenow="85" aria-valuemin="0"
                             aria-valuemax="100" style="width: 85%">
                            <h6>HTML 85%</h6>
                        </div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped  progress-bar-animated" role="progressbar"
                             aria-valuenow="75" aria-valuemin="0"
                             aria-valuemax="100" style="width: 75%">
                            <h6>CSS 75%</h6>
                        </div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped  progress-bar-animated" role="progressbar"
                             aria-valuenow="50" aria-valuemin="0"
                             aria-valuemax="100" style="width: 50%">
                            <h6>JAVASCRIPT 50%</h6>
                        </div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped  progress-bar-animated" role="progressbar"
                             aria-valuenow="65" aria-valuemin="0"
                             aria-valuemax="100" style="width: 65%">
                            <h6>SQL 65%</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped  progress-bar-animated" role="progressbar"
                             aria-valuenow="55" aria-valuemin="0"
                             aria-valuemax="100" style="width: 55%">
                            <h6>PHP 55%</h6>
                        </div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped  progress-bar-animated" role="progressbar"
                             aria-valuenow="80" aria-valuemin="0"
                             aria-valuemax="100" style="width: 80%">
                            <h6>BOOTSTRAP 80%</h6>
                        </div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped  progress-bar-animated" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0"
                             aria-valuemax="100" style="width: 20%">
                            <h6>SYMFONY 20%</h6>
                        </div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped  progress-bar-animated" role="progressbar"
                             aria-valuenow="30" aria-valuemin="0"
                             aria-valuemax="100" style="width: 30%">
                            <h6>REACT 30%</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="experience">
        <div class="container">
            <div class="white-divider"></div>
            <div class="heading3">
                <h2>Expérience Professionnelle</h2>
            </div>
            <ul class="timeline">
                <li>
                    <div class="timeline-badge">
                        <i class="fas fa-briefcase fa-2x"></i>
                    </div>
                    <div class="timeline-panel-container">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h3>Mission Locale Tarare</h3>
                                <h4>Stage Développeur Web</h4>
                                <p class="text-muted"><small><i class="far fa-clock fa-lg"></i></small> Septembre -
                                    Novembre 2020</p>
                                <div class="timeline-body">
                                    <p>Création du site vitrine <br> pour mettre en lumiere les conseils
                                        consultatifs de jeunes créé par les Missions Locales du département.
                                    </p>
                                    <!--btn lien du site-->
                                    <a href="https://site.ccj.maureen-depresle.fr/" class="button-site">Voir le site
                                        Beta</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="timeline-badge">
                        <i class="fas fa-briefcase fa-2x"></i>
                    </div>
                    <div class="timeline-panel-container-inverted">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h3>Formation Dev</h3>
                                <h4>Stage Développeur Web</h4>
                                <p class="text-muted"><small><i class="far fa-clock fa-lg"></i></small> Février -
                                    Mars 2019</p>
                                <div class="timeline-body">
                                    <p>Voir les notions d'AJAX
                                    </p>
                                    <!--btn lien du site-->
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <section id="education">
        <div class="container">
            <div class="blue-divider"></div>
            <div class="heading4">
                <h2>éducation</h2>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="education-block">
                        <h5>Avril - Décembre 2020</h5>
                        <i class="fas fa-graduation-cap fa-3x"></i>
                        <h3>Simplon Roanne</h3>
                        <h4>Titre Professionnel: <br> Développeur Web et Web Mobile</h4>
                        <div class="blue-divider"></div>
                        <p>Acquisition et utilisation des langages de base,</p>
                        <p>Installer un environnement de développement,</p>
                        <p>Développer le Front-End et la Back-End d’une application mobile,</p>
                        <p>Utiliser et exploiter une base de donnée,</p>
                        <p>Utilisation de Frameworks php et JS</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="education-block">
                        <h5>Octobre 2018 - Avril 2019</h5>
                        <i class="fas fa-graduation-cap fa-3x"></i>
                        <h3>Nepsod Evolution</h3>
                        <h4>Développeur Web ( Non Diplomante )</h4>
                        <div class="blue-divider"></div>
                        <p>Acquisition et utilisation des langages de base,</p>
                        <p>Installer un environnement de développement,</p>
                        <p>Développer le Front-End et la Back-End d’un site web,</p>
                        <p>Utiliser et exploiter une base de donnée</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="portfolio">
        <div class="container">
            <div class="white-divider"></div>
            <div class="heading5">
                <h2>portfolio</h2>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <a href="https://site.ccj.maureen-depresle.fr/" target="_blank">
                        <img src="img/site_ccjd_home.png" alt="Site beta CCJD" class="img-thumbnail">
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="https://instaclone.maureen-depresle.fr/" target="_blank">
                        <img src="img/instalike-tp_home.png" alt="Tp insta like" class="img-thumbnail">
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="https://comparoperators.maureen-depresle.fr/" target="_blank">
                        <img src="img/comparOperator-tp_home.png" alt="Tp comparOperator avec Audrene" class="img-thumbnail">
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <a href="https://minichat.maureen-depresle.fr/" target="_blank">
                        <img src="img/minichat_tp.png" alt="Tp mini chat" class="img-thumbnail">
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="https://site.tp.hosto.maureen-depresle.fr/" target="_blank">
                        <img src="img/hosto_tp_home.png" alt="Tp hosto" class="img-thumbnail">
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="https://site.ccj.maureen-depresle.fr/" target="_blank">
                        <img src="img/site_ccjd_home.png" alt="Site beta CCJD" class="img-thumbnail">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center" id="contact">
        <div class="container">
            <a href="#about">
                <i class="fas fa-chevron-circle-up fa-3x"></i>
            </a>
            <div class="blue-divider"></div>
            <h2>contactez-moi !</h2>
            <div class="row">
                <div class="col-lg-11 col-lg-offset-1">
                    <form  id="contact-form" method="post" role="form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <!--htmlspecialchars permets de contrer une faille XSS-->
                        <div class="row">

                            <div class="col-md-6">
                                <label for="firstname">Prénom<span class="white"> *</span></label>
                                <input type="text" id="firstname" name="firstname" class="form-control"
                                       placeholder="Votre prénom" value="<?= $firstname; ?>">
                                <p class="comments"><?= $firstnameError; ?></p>
                            </div>

                            <div class="col-md-6">
                                <label for="lastname">Nom<span class="white"> *</span></label>
                                <input type="text" id="lastname" name="lastname" class="form-control"
                                       placeholder="Votre nom"  value="<?= $lastname; ?>">
                                <p class="comments"><?= $lastnameError; ?></p>
                            </div>

                            <div class="col-md-6">
                                <label for="mail">Email<span class="white"> *</span></label>
                                <input type="email" id="mail" name="mail" required class="form-control"
                                       placeholder="Votre email" value="<?= $mail; ?>">
                                <p class="comments"><?= $mailError; ?></p>
                            </div>

                            <div class="col-md-6">
                                <label for="phone">Téléphone</label>
                                <input type="tel" id="phone" name="phone" class="form-control"
                                       placeholder="Votre téléphone" value="<?= $phone; ?>">
                                <p class="comments"><?= $phoneError; ?></p>
                            </div>

                            <div class="col-md-12">
                                <label for="message">Message<span class="white"> *</span></label>
                                <textarea name="message" id="message" class="form-control" cols="30" rows="4"
                                          placeholder="Votre message..."><?= $message; ?>"</textarea>
                                <p class="comments"><?= $messageError; ?></p>
                            </div>

                            <div class="col-md-12">
                                <p class="white">* Ces informations sont requises</p>
                            </div>

                            <div class="col-md-12">
                                <input type="submit" class="button-form" value="Envoyer">
                            </div>
                        </div>

                        <p class="thank-you" style="display:  <?php if($isSuccess){
                                                                        echo 'block';
                                                                    }else{
                                                                        echo 'none';
                                                                    }?>">
                            Votre message a bien été envoyé, merci de m'avoir contacté !
                        </p>
                    </form>
                </div>
               <!-- <div class="col-md-6">
                    <div class="timeline-panel-container">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h3>Maureen Depresle</h3>
                                <p>20 Avenue Charles de Gaulle,</p>
                                <p>69170, Tarare.</p>
                                <h5>06 13 20 45 81</h5>
                                <a href="mailto:maureen.depresle@gmail.com">
                                    <i class="fas fa-envelope-open-text fa-3x"></i>
                                </a>
                                <p>
                                    <i class="fas fa-share fa-lg"></i>
                                    Envoyez moi un mail !

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2776.690484573295!2d4.431268415396146!3d45.897503112446955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f464289beb429d%3A0xfdbcc0c8ab909a24!2s20%20Avenue%20Charles%20de%20Gaulle%2C%2069170%20Tarare!5e0!3m2!1sfr!2sfr!4v1605202477416!5m2!1sfr!2sfr"
                            width="600" height="260" frameborder="0" style="border:0;" allowfullscreen=""
                            aria-hidden="false" tabindex="0"></iframe>
                </div>-->
            </div>
        </div>
    </footer>





<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="js/script.js"></script>

</body>
</html>