<?php

	$username = $_POST["username"] ;
    $password = $_POST["password"] ;
    $nome = $_POST["nome"] ;
    $tipologia = $_POST["tipologia"] ;
    $descrizione = $_POST["desc"] ;
    $addr = $_POST["addr"];
    $civico = $_POST["civico"];
    $piva = $_POST["piva"] ;
    $fax = $_POST["fax"] ;
    $comune = $_POST["comune"] ;
    $catena = $_POST["catena"] ;

	$latitude = 103.4;
    $longitude = 2.5 ;
    $host = "localhost" ;
    $database = "my_cucoupon" ;
    $user = "cucoupon" ;
    $pass = "" ;
    
    $db = mysqli_connect($user , $pass , $host, $database ) or die("Errore nel collegamento");

    $conn = new mysqli( $user , $pass , $host, $database ) ;
    
   	$q1 = "SELECT Codice FROM COMUNI WHERE Nome = '".$comune."'" ;
    $r1 = $conn->query($q1) ;
    
    if ( $r1->num_rows > 0 ) {
    
    	while ( $row = $r1->fetch_assoc() ) {
        	
            $cod_com = $row["Codice"] ;
            
          }
          
    }
    
    $q = "INSERT INTO NEGOZI VALUES('$username' , '$password' , '$nome' , '$tipologia' , '$descrizione' , '$addr' , '$civico', '$catena' , '$piva', '$fax', $latitude , $longitude , $cod_com )";
    
    if ($conn->query($q) === TRUE) {
    
    	header("Location : /index.html") ;
	} 
    else {
    
    	echo "Error: " . $q . "<br>" . $conn->error;
	}

    ?>