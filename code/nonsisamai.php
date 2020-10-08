<?php
	session_start();
?>

<html>
	<head>
    	<title> CuCoupon </title>
    	<meta charset="8-utf">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        
        <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles.css">
    </head>
<body>
<header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About</h4>
          <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contact</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white">Follow on Twitter</a></li>
            <li><a href="#" class="text-white">Like on Facebook</a></li>
            <li><a href="#" class="text-white">Email me</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <strong>CuCoupon - Clienti</strong>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<main role="main">

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="font-weight-light">Cliente</h1>
        <p class="lead text-muted">Benvenuto <?php echo $_SESSION['user'] ; ?>, ecco le offerte disponibili.</p>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
        	<p>
				<input name="search" class="form-control form-control-lg" type="text" placeholder="Inserire nome prodotto"><br>
				<input name="comune" class="form-control form-control-lg" type="text" placeholder="Comune"><br>
				<input name="categoria" class="form-control form-control-lg" type="text" placeholder="Categoria">
				<input name ="submit" type="submit" value="Cerca" class="btn btn-primary my-2"/>
        	</p>
        </form>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
        <?php   

              $host = "localhost" ;
              $database = "my_cucoupon" ;
              $user = "cucoupon" ;
              $pass = "" ;

              $db = mysqli_connect($user , $pass , $host, $database ) or die("Errore nel collegamento");
              $conn = new mysqli( $user , $pass , $host, $database ) ;
		 	if ( !isset($_POST["submit"]) ) {
              $q = "SELECT O.Descrizione AS O_DESCR , P.Nome AS P_NOME, P.Descrizione AS P_DESCR , O.Percentuale_sconto AS SCONTO, I.Foto AS FOTO , P1.Prezzo_originale AS ORIG, P1.Prezzo_scontato AS DISC
              		FROM OFFERTE O, PRODOTTI P, PROMOZIONI P1, IMMAGINI I
                    WHERE O.Codice = P1.CodOfferta AND P.Codice = P1.CodProdotto AND P.Codice = I.CodProdotto" ;

              $r = $conn->query($q) ;

              if ( $r->num_rows > 0 ) {

                  while ( $row = $r->fetch_assoc() ) {

                    echo '<div class="col-md-4">
                    <div class="text-white bg-dark mb-3">
                    <placeholder width="100%" height="225" background="#55595c" color="#eceeef" class="card-img-top" text="Thumbnail"/>
                    <div class="card-header">'.$row["P_NOME"].'</div>
                    <img height="300" width="150" class="card-img-top" src="data:image/jpeg;base64,'.base64_encode( $row["FOTO"] ).'"/>
                    <div class="card-body">
                      <p class="card-text">'.$row["P_DESCR"].'<br>
                      <del>'.$row["ORIG"].'</del>  '.$row["DISC"].'</p>
                       <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-outline-secondary">Acquista</button>
                        </div>
                        <small class="text-muted">'.$row["SCONTO"].'%</small>
                      </div>
                    </div>
                  </div>
                  </div>' ;
                  }
              }
            }
			
            else {
            
            	$nomeprod = $_POST["search"] ;
            	$q = "SELECT O.Descrizione AS O_DESCR , P.Nome AS P_NOME, P.Descrizione AS P_DESCR , O.Percentuale_sconto AS SCONTO, I.Foto AS FOTO , P1.Prezzo_originale AS ORIG, P1.Prezzo_scontato AS DISC
              		FROM OFFERTE O, PRODOTTI P, PROMOZIONI P1, IMMAGINI I
                    WHERE O.Codice = P1.CodOfferta AND P.Codice = P1.CodProdotto AND P.Codice = I.CodProdotto AND P.Nome LIKE '%$nomeprod%'" ;
            	
                $r = $conn->query($q) ;
                
                
                if ( $r->num_rows > 0 ) {

                    while ( $row = $r->fetch_assoc() ) {

                      echo '<div class="col-md-4">
                      <div class="text-white bg-dark mb-3">
                      <placeholder width="100%" height="225" background="#55595c" color="#eceeef" class="card-img-top" text="Thumbnail"/>
                      <div class="card-header">'.$row["P_NOME"].'</div>
                      <img height="300" width="150" class="card-img-top" src="data:image/jpeg;base64,'.base64_encode( $row["FOTO"] ).'"/>
                      <div class="card-body">
                        <p class="card-text">'.$row["P_DESCR"].'<br>
                        <del>'.$row["ORIG"].'</del>  '.$row["DISC"].'</p>
                         <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Acquista</button>
                          </div>
                          <small class="text-muted">'.$row["SCONTO"].'%</small>
                        </div>
                      </div>
                    </div>
                    </div>' ;
                    }
                }
              }
        ?>

      </div>
    </div>
  </div>

</main>

<footer class="text-muted py-5">
  <div class="container">
    <p class="float-right mb-1">
      <a href="#">Back to top</a>
    </p>
    <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
  </div>
</footer>