<?php

	$username = $_POST["username"] ;
    $password = $_POST["password"] ;
    $nome = $_POST["nome"] ;
    $cognome = $_POST["cognome"] ;
    $mail = $_POST["email"] ;
    $comune = $_POST["comune"] ;
    
    $host = "localhost" ;
    $database = "my_cucoupon" ;
    
    $user = "cucoupon" ;
    $pass = "" ;
    $db = mysqli_connect($user , $pass , $host, $database ) or die("Errore nel collegamento");
    //mysqli_select_db($database, $db) or die("Errore") ;
    echo "Connessione avvenuta con successo" ;
    $conn = new mysqli( $user , $pass , $host, $database ) ;
    
   	$q1 = "SELECT Codice FROM COMUNI WHERE Nome = '".$comune."'" ;
    $r1 = $conn->query($q1) ;
    
    if ( $r1->num_rows > 0 ) {
    
    	while ( $row = $r1->fetch_assoc() ) {
        	
            $cod_com = $row["Codice"] ;
            
          }
          
    }
    $q = "INSERT INTO CLIENTI VALUES('$username' , '$password' , '$nome' , '$cognome' , '$mail' , NULL, $cod_com )";
    
    if ($conn->query($q) === TRUE) {
    	
        header("Location: /index.html");
	} else {
    echo "Error: " . $q . "<br>" . $conn->error;
}

    ?>