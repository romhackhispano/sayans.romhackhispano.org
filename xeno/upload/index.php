<?php require_once("maxUpload.class.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Proyecto de Traducción Xenogears</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link href="../css/css_v6.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="ombre_top"></div>

<div id="container">

  <div id="entete">
    <div style="float:left;"><img src="../css/logo.jpg" /></div>
    <img src="../css/header.jpg" />
  </div>

  <div id="main_nav">
    <ul>
      <li><a href="../index.html">Inicio</a></li>
      <li><a href="../traduccion.html">Traducción</a></li>
      <li class="avecsouscat"><a href="">El juego</a>
        <ul>
	  <li><a href="../b_personajes.html"><img src="../css/flecha.jpg" /> Batalla con personajes</a></li>
	  <li><a href="../b_gears.html"><img src="../css/flecha.jpg" /> Batalla con Gears</a></li>
	  <li><a href="../s_juego.html"><img src="../css/flecha.jpg" /> Sobre el juego</a></li>
	  <li><a href="../s_personajes.html"><img src="../css/flecha.jpg" /> Personajes</a></li>
	  <li><a href="../s_gears.html"><img src="../css/flecha.jpg" /> Gears</a></li>
	  <li><a href="../m_info.html"><img src="../css/flecha.jpg" /> Más información</a></li>
	</ul>
      </li>
      <li class="contact"><a href="mailto:magimaster_2@yahoo.com">Contacto</a></li>
    </ul>
    <p style="text-align:center;margin-top:20px;"><a href="http://foro.romhackhispano.org/"><img src="../css/fororh.jpg" /><br/>Foro de Romhacking Hispano</a></p>
  </div>

  <div id="contenu">
    <?php
      $myUpload = new maxUpload(); 
      //$myUpload->setUploadLocation(getcwd().DIRECTORY_SEPARATOR);
      $myUpload->uploadFile();
    ?>
  </div>
</div>

</body>
</html>
