<?php
ob_start();
include_once 'baza.class.php';
include_once 'greske.php';
include_once 'autcookie.php';
include_once 'preuzmipomak.php';
include_once 'dnevnik.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    $izbornik = "";
if(empty($_SESSION['tipkorisnika']) || $_SESSION['tipkorisnika'] ==  3  ){
    trigger_error("Nemate pravo pristupa stranici", E_USER_ERROR);
}

if($_SESSION['tipkorisnika'] ==  1){
    $izbornik = '<li class = "dropdown">
	<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">Administrator <b class = "caret"></b></a>
		<ul class = "dropdown-menu">
		<li><a href = "zakljucajotkljucaj.php" >Zakljucaj/Otkljucaj korisnike</a></li>
                <li><a href = "konfiguracijaadmin.php" >Konfiguracija admin</a></li>
                 <li><a href = "statistikakoristenja.php" >Statistika koristenja</a></li>
                  <li><a href = "pretrazivanjednevnika.php" >Pretrazivanje dnevnika</a></li>
                  <li><a href = "administratorposaljimail.php" >Slanje notifikacijskog emaila</a></li>
                  <li><a href = "administracijatablica.php" >Crud</a></li>
                  <li><a href = "moderatordohvatpaket.php" >Preuzimanje paketa</a></li>
		 <li><a href = "moderatorstatistikakorisnici.php" >Statistika korisnika</a></li>
                 <li><a href = "moderatorrutamjesta.php" >Dodavanja mjesta u rute</a></li>
                 <li><a href = "moderatorruta.php" >Kreiranje rute</a></li>
                 <li><a href = "moderatoroznacimjesto.php" >Označavanje točke na ruti</a></li>
                 <li><a href = "galerija.php" >Galerija slika</a></li>
                 <li><a href = "registriranirutamjesto.php" >Pretrazivanje rute</a></li>
                 <li><a href = "registriranistatistikaruta.php" >Statistika rute</a></li>
                 <li><a href = "registriranistatistikasluzba.php" >Statistika sluzbe</a></li>
                 <li><a href = "registriranislanje.php" >Slanje paketa</a></li>
                 <li><a href = "usporedivanjeruta.php" >Usporedi rute</a></li>
                </ul>
		</li>';
}
if($_SESSION['tipkorisnika'] ==  2){
    $izbornik = '<li class = "dropdown">
	<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">Moderator <b class = "caret"></b></a>
		<ul class = "dropdown-menu">
		
                  <li><a href = "moderatordohvatpaket.php" >Preuzimanje paketa</a></li>
		 <li><a href = "moderatorstatistikakorisnici.php" >Statistika korisnika</a></li>
                 <li><a href = "moderatorrutamjesta.php" >Dodavanja mjesta u rute</a></li>
                 <li><a href = "moderatorruta.php" >Kreiranje rute</a></li>
                 <li><a href = "moderatoroznacimjesto.php" >Označavanje točke na ruti</a></li>
                 <li><a href = "galerija.php" >Galerija slika</a></li>
                 <li><a href = "registriranirutamjesto.php" >Pretrazivanje rute</a></li>
                 <li><a href = "registriranistatistikaruta.php" >Statistika rute</a></li>
                 <li><a href = "registriranistatistikasluzba.php" >Statistika sluzbe</a></li>
                 <li><a href = "registriranislanje.php" >Slanje paketa</a></li>
                 <li><a href = "usporedivanjeruta.php" >Usporedi rute</a></li>
                </ul>
		</li>';
}

if($_SESSION['tipkorisnika'] ==  3){
    $izbornik = '<li class = "dropdown">
	<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">Reg korisnik <b class = "caret"></b></a>
		<ul class = "dropdown-menu">
		
                 <li><a href = "registriranirutamjesto.php" >Pretrazivanje rute</a></li>
                 <li><a href = "registriranistatistikaruta.php" >Statistika rute</a></li>
                 <li><a href = "registriranistatistikasluzba.php" >Statistika sluzbe</a></li>
                 <li><a href = "registriranislanje.php" >Slanje paketa</a></li>
                 <li><a href = "usporedivanjeruta.php" >Usporedi rute</a></li>
                </ul>
		</li>';
}
$baza = new baza();
$baza->spojiBaza();

if(isset($_POST['btnDodajRutu'])){
$prolaz  = TRUE;
$vrijemeDostave = $_POST['vrijemedostava'];
$kilometraza = $_POST['kilometraza'];
$cijena = $_POST['cijena'];
$sluzba = $_POST['selectSluzba'];
$polaziste = $_POST['selectPolaziste'];
$odrediste = $_POST['selectOdrediste'];
$tip = $_POST['selectTip'];
$naziveRute = $_POST['nazivrute'];
$sluzba = $_POST['selectSluzba'];
$upit = "INSERT INTO ruta (vrijemeDostava, kilometraza, polaziste, odrediste, tip, kurirskaSluzba, cijena, naziv)
        values ('$vrijemeDostave', '$kilometraza', '$polaziste', '$odrediste', '$tip', '$sluzba', '$cijena', '$naziveRute')";
if($baza->ostaliUpiti($upit)){
    upisiLog("Rad s bazom", "test");
}
else{
     trigger_error("Pogreska prilikom kreiranja rute", E_USER_ERROR);
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>bootstrap</title>
  <meta charset="UTF-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">

  <link href = "css/bootstrap.min.css" rel = "stylesheet" >
  <link href = "css/style.css" rel = "stylesheet">
   
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
 <link href="http://datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css" />  
 <script src = "js/bootstrap.js"></script>
<script type="text/javascript" src ="js/jquery.cookie.js"></script>
<script type ="text/javascript" src = "js/jquery.js"></script>
<script type="text/javascript" src ="js/registracija.js"></script>

  
</head>

<body>
	<div class = "navbar navbar-inverse navbar-static-top ">
		<div class="container">
			<a href = "#" class = "navbar-brand">eDostava</a>
                        
			<button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
				<span class = "icon-bar"></span>
				<span class = "icon-bar"></span>
				<span class = "icon-bar"></span>
			</button>

			<div class = "collapse navbar-collapse navHeaderCollapse">

				<ul class = "nav navbar-nav navbar-right">
					<li class = "active"><a href = "#">Home</a></li>
                                        <li><a href = "privatno/korisniciprivatno.php" >Korisnici privatno</a></li>
                                        <li><a href = "neregistrirankorisnik.php" >Neregistrairani korisnik</a></li>
                                        <?php echo $izbornik; ?>
					<li><a href = "#">Registracija</a></li>
					<li><a href = "#contact" data-toggle = "modal">Prijava</a></li>
                                        <li><a href = "odjava.php" >Odjava</a></li>
				</ul>
			</div>



		</div>
	</div>
<div class= "container">
	<div class = "row text-center">
		<div class = "col-lg-11">
                    <form class = "form-horizontal" id="dodavanjerute" name = "dodavanjerute" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST"  enctype="multipart/form-data">
		<div class  = "modal-header text-center ">
			<h2> Kreiranje rute</h2>
		</div>
                        
                        <div class = "form-group">
				<label for = "vrijemedostava" class = "col-lg-5 control-label">Vrijeme dostave:</label>

				<div  class = "col-lg-4">
					
					<input type = "text" class = "form-control" id = "vrijemedostava" name = "vrijemedostava">
					
				</div>
			</div>
                        
                         <div class = "form-group">
				<label for = "kilometraza" class = "col-lg-5 control-label">Kilometraza:</label>

				<div  class = "col-lg-4">
					
					<input type = "text" class = "form-control" id = "kilometraza" name = "kilometraza">
					
				</div>
			</div>
                         <div class = "form-group">
				<label for = "nazivrute" class = "col-lg-5 control-label">Naziv rute:</label>

				<div  class = "col-lg-4">
					
					<input type = "text" class = "form-control" id = "nazivrute" name = "nazivrute">
					
				</div>
			</div>
                        <div class = "form-group">
				<label for = "cijena" class = "col-lg-5 control-label">Cijena:</label>

				<div  class = "col-lg-4">
					
					<input type = "text" class = "form-control" id = "cijena" name = "cijena">
					
				</div>
			</div>
                        
                        <div class = "form-group" id = "polaziste" name ="polaziste">
                            <label for = "selectPolaziste" class = "col-lg-5 control-label">Polaziste:</label>
                        </div>
                        <div class = "form-group" id = "odrediste" name ="odrediste">
                             <label for = "selectOdrediste" class = "col-lg-5 control-label">Odrediste:</label>
                        </div>
                        <div class = "form-group" id = "tipdostave" name ="tipdostave">
                            <label for = "selectTip" class = "col-lg-5 control-label">Tip dostave:</label>
                        </div>
                        <div class = "form-group" id = "kurirskasluzba" name ="kurirskasluzba">
                            <label for = "selectSluzba" class = "col-lg-5 control-label">Kurirska sluzba:</label>
                        </div>
                        
                        <button type='submit' id = 'btnDodajRutu'  name='btnDodajRutu' class='btn btn-success' >Dodaj rutu</button>
                    </form>
                </div>
		

</div> 
</div> 
 
    <div class = "navbar navbar-inverse navbar-fixed-bottom">
		<div class = "container">
			<p class = "navbar-text">random text</p>
			<a href = "http://www.youtube.com" class = "navbar-button btn-danger btn pull-right">Subscribe on youtube</a>
		</div>

	</div>


  


</body>
</html>
