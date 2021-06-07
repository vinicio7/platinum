<?php
    //LIBRERIAS NECESARIAS PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../assets/phpmailer/src/Exception.php';
    require '../assets/phpmailer/src/PHPMailer.php';
    require '../assets/phpmailer/src/SMTP.php';

    if (!empty($_POST ['client_name'])) 
    {
        //recibe datos
        $client_name = utf8_decode($_POST['client_name']);
        $client_last = utf8_decode($_POST['client_last']);
        $client_phon = utf8_decode($_POST['client_phon']);
        $client_addr = utf8_decode($_POST['client_addr']);
        $client_mail = utf8_decode($_POST['client_mail']);
        $client_text = utf8_decode($_POST['client_text']);
        $client_name = $client_name . " " .  $client_last;
        $client_date = utf8_decode(date('d-m-Y'));

        // build message body
        $body = '
        <html>
        <head>
            <title>Sistema Inmobiliario</title>
            <link href="http://sistemagnet.xyz/propiedadesplatinum/assets/css/all.css" rel="stylesheet" type="text/css" />
            <link href="https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css" rel="stylesheet" type="text/css" />
        </head>
        <body aria-readonly="false" style="cursor: auto;">
        <table border="0" cellpadding="0" cellspacing="0" style="width:100.0%">
            <tbody>
                <tr>
                    <td style="width:100.0%">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:620px">
                        <tbody>
                            <tr>
                                <td style="width:620px">
                                <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:100.0%">
                                    <tbody>
                                        <tr>
                                            <td style="height:80px; width:30px" bgcolor="black">&nbsp;</td>
                                            <td style="height:80px" bgcolor="black"><img src="http://sistemagnet.xyz/propiedadesplatinum/assets/images/logos/2.png" style="height:80px; width:250px" /></td>
                                            <td style="height:80px; width:30px" bgcolor="black">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="width:30px">&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td style="width:30px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="width:30px">&nbsp;</td>
                                            <td>
                                            <h1><span style="font-family:trebuchet ms,helvetica,sans-serif">Tienes una nueva notificacion</span></h1>
                                            </td>
                                            <td style="width:30px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="width:30px">&nbsp;</td>
                                            <td>
                                            <hr /></td>
                                            <td style="width:30px">&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
        
                                <div>&nbsp;</div>
                                &nbsp;
        
                                <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:100.0%">
                                    <tbody>
                                        <tr>
                                            <td style="width:30px">&nbsp;</td>
                                            <td>
                                            <table border="0" cellpadding="0" cellspacing="0" style="height:105px; width:549px">
                                                <tbody>
                                                    <tr>
                                                        <td style="width:85px"><img src="http://sistemagnet.xyz/propiedadesplatinum/assets/images/logos/user.png" style="height:57px; width:57px" /></td>
                                                        <td style="width:458px"><h2><span style="font-size:18px"><span style="font-family:trebuchet ms,helvetica,sans-serif"><strong>Datos del Contacto</strong></span></span></h2></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:85px"><strong><span style="font-family:trebuchet ms,helvetica,sans-serif">Nombre</span></strong></td>
                                                        <td style="width:458px">
                                                        <div>
                                                        <div><span>'.$client_name.'</span></div>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:85px"><span style="font-family:trebuchet ms,helvetica,sans-serif"><strong>Email</strong></span></td>
                                                        <td style="width:458px">
                                                        <div>
                                                        <div><a href="mailto:'.$client_mail.'">'.$client_mail.'</a></div>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:85px"><strong><span style="font-family:trebuchet ms,helvetica,sans-serif">Fecha</span></strong></td>
                                                        <td style="width:458px">
                                                        <div>
                                                        <div><span>'.$client_date.'</span></div>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:85px"><strong><span style="font-family:trebuchet ms,helvetica,sans-serif">Direccion</span></strong></td>
                                                        <td style="width:458px">
                                                        <div>
                                                        <div><span>'.$client_addr.'</span></div>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:85px"><strong><span style="font-family:trebuchet ms,helvetica,sans-serif">Telefono</span></strong></td>
                                                        <td style="width:458px">'.$client_phon.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:85px"><strong><span style="font-family:trebuchet ms,helvetica,sans-serif">Mensaje</span></strong></td>
                                                        <td style="width:458px">'.$client_text.'</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </td>
                                            <td style="width:30px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="width:30px">&nbsp;</td>
                                            <td></td>
                                            <td style="width:30px">&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br><br>

                                <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:100.0%" bgcolor="black">
                                    <tbody>
                                        <tr>
                                            <td style="height:80px; width:30px">&nbsp;</td>
                                            <td style="height:70px; text-align: center;"><img src="http://sistemagnet.xyz/propiedadesplatinum/assets/images/logos/2.png" style="height:70px; width:200px" /></td>
                                            <td style="height:80px; width:30px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>
                                            <table align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="black">
                                                <tbody>
                                                    <tr>
                                                        <td style="width:30px"><img src="http://sistemagnet.xyz/propiedadesplatinum/assets/images/logos/rface.png" style="height:25px; width:25px" /></td>
                                                        <td style="width:30px">&nbsp;</td>
                                                        <td style="width:30px"><img src="http://sistemagnet.xyz/propiedadesplatinum/assets/images/logos/rtwit.png" style="height:25px; width:25px" /></td>
                                                        <td style="width:30px">&nbsp;</td>
                                                        <td style="width:30px"><img src="http://sistemagnet.xyz/propiedadesplatinum/assets/images/logos/ryout.png" style="height:25px; width:25px" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
        
                                            <div>&nbsp;</div>
                                            </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr align="center">
                                            <td>&nbsp;</td>
                                            <td style="color:white">Si ya no deseas notificaciones puedes: <a href="http://sistemagnet.xyz/propiedadesplatinum/public/unsuscribe.php">darte de baja</a> del sistema.</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
        
                                <div>&nbsp;</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
        
                    <div>&nbsp;</div>
                    </td>
                </tr>
            </tbody>
        </table>
        </body>
        </html>
        ';
    
        //CONFIGURACION PHPMailer
        $smtpUsername = "info@propiedadesplatinum.com";
        $smtpPassword = "SistemaInmobiliario7";

        //DATOS PARA ENVIAR CORREO
        $mail = new PHPMailer;
        $mail->isSMTP(); 
        $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
        $mail->Host = "propiedadesplatinum.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
        $mail->Port = 465; // TLS only
        $mail->SMTPSecure = 'ssl'; // tls - ssl 
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        $mail->setFrom   ("info@propiedadesplatinum.com", "Propiedades Platinum");  //DE INFO
        $mail->addAddress("info@propiedadesplatinum.com", "Propiedades Platinum");  //PARA INFO
        $mail->addAddress($client_mail, $client_name);                              //Add a recipient (CLIENTE)
        $mail->Subject = 'Sistema Inmobiliario';
        $mail->msgHTML($body); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
        // Attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Add attachments

        if (!$mail->send()) 
        {
            //$msg = 'Sorry, something went wrong. Please try again later.';
        }
        else 
        {
            //$msg = 'Message sent! Thanks for contacting us.';
        }
    } 
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Sistema Inmobiliario</title>
    </head>
    <body>
        <h1>Déjanos tus comentarios</h1>
        <form action="mail_test.php" method="POST" role="form" class="f1 pt-0 pb-0" autocomplete="off" enctype="multipart/form-data"/>
            <div class="row">
                <div class="form-form col-12 col-md-4 mb-3 mb-md-0 custom-inputs">
                    <label for="" class="placeholder-label">Nombre:</label>
                    <input type="text" class="form-control placeholder-input" placeholder="Escribe tu nombre" name="client_name">
                </div>
                <div class="form-form col-12 col-md-4 mb-3 mb-md-0 custom-inputs">
                    <label for="" class="placeholder-label">Apellido:</label>
                    <input type="text" class="form-control placeholder-input" placeholder="Escribe tu apellido" name="client_last">
                </div>
                <div class="form-form col-12 col-md-4 mb-3 mb-md-0 custom-inputs">
                    <label for="" class="placeholder-label">Teléfono:</label>
                    <input type="text" class="form-control placeholder-input" placeholder="Escribe tu Teléfono" name="client_phon">
                </div>
            </div>
            <div class="row mt-0 mt-md-3">
                <div class="form-form col-12 col-md-8 mb-3 mb-md-0 custom-inputs">
                    <label for="" class="placeholder-label">Dirección:</label>
                    <input type="text" class="form-control placeholder-input" placeholder="Escribe tu Dirección" name="client_addr">
                </div>
                <div class="form-form col-12 col-md-4 mb-3 mb-md-0 custom-inputs">
                    <label for="" class="placeholder-label">eMail:</label>
                    <input type="text" class="form-control placeholder-input" placeholder="Escribe tu Correo Electrónico" name="client_mail">
                </div>
            </div>
            <div class="row mt-0 mt-md-3">
                <div class="form-form col-12 custom-inputs">
                    <label for="" class="placeholder-label-textarea">Comentario</label>
                    <textarea type="text" rows="3" class="form-control placeholder-textarea" placeholder="Escribe tu Comentario"  name="client_text"></textarea>
                </div>
            </div>
            <div class="row mt-0 mt-md-3">
                <div class="form-form col-6 col-md-2 custom-inputs m-0 mt-3 mt-md-0 ml-auto">
                    <button type="submit" class="btn btn-primary btn-block text-white btn-search">Enviar</button>
                </div>
            </div>
        </form>
    </body>
</html>