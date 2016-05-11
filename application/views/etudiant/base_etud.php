<!DOCTYPE HTML>
<html>

  <head>
   <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">
   <link href="<?php echo base_url() ?>assets/css/tuto.css" rel="stylesheet">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <script src="<?php echo base_url() ?>assets/js/jquery-2.1.4.min.js"></script>
   
  </head>

  <body>

<div class="container " id="arriere">
  <div class="row ">
     <div class="col-lg-3">
       <img src="<?php echo base_url() ?>assets/images/Esir2.png" class="img-responsive">
     </div>
     <div class="col-lg-4">
        <center><h1 class="center">E.U.V.E</h1></center> 
        <h3>Espace Utilisateur Vélo </h3>
      </div>
      <div class="col-lg-5 text-rigth">
        <h4>Bienvenue  <?php echo $this->session->userdata('infos')[0]['Prenom']." ".$this->session->userdata('infos')[0]['Nom'];?> <a class=" col-xs-offset-2 btn btn-danger square-btn-adjust" href="<?php echo site_url('deconnexion'); ?>">déconnexion</a></h4>
      </div>  
  </div>
</div>


    <div class="container"> 
  <div class="row">
    <nav class="navbar  navbar-inverse responsive"  role="navigation">
    <div class="navbar-collapse collapse">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">ESIR : Projet Vélo Electrique </a>
        </div>
      <ul class="nav nav-tabs col-xs-offset-3">
        <li <?php if($active=="accueil") echo 'class="active"'; ?>><a href="<?php echo site_url('user/accueil'); ?>" >Accueil</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Historique</a>
           <ul class="dropdown-menu">
            <li><a href="">Mois dernier</a></li>
            <li><a href="<?php echo site_url('user/historique'); ?>">Choisir date</a></li>
            <li><a href="">Réinitialiser</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dossier personnel</a>
          <ul class="dropdown-menu">
            <li><a href="">données personnelles</a></li>
            <li><a href="">Mise à jour</a></li>
          </ul>
        </li>
        <li class="dropdown" <?php if($active=="records") echo 'class="active"'; ?>>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mes records</a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('user/Vitesse'); ?>">Vitesse</a></li>
            <li><a href="<?php echo site_url('user/distance'); ?>">Distance</a></li>
          </ul>
        </li>
        <li>
          <a href="#"class="dropdown-toggle" data-toggle="dropdown">Forum</a>
        </li>
      </ul>
    </div> 
  </nav>
  
  </div>
</div>
    <div class="container">
     
      <div class="row col-sm-12">
        <nav class="col-sm-2">          
          <ul class="nav nav-pills nav-stacked">
            <li class="active"> <a href="#"> <span class="glyphicon glyphicon-home"></span> ESIR </a> </li>
            <li> <a href="#"> <span class="glyphicon glyphicon-book"></span> Bibliothèque</a> </li>
            <li> <a href="#"> <span class="glyphicon glyphicon-user"></span> Etudiants </a> </li>
            <li> <a href="#"> <span class="glyphicon glyphicon-user"></span> Enseignants</a> </li>
          </ul>
        </nav>