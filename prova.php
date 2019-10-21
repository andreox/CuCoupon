     In HTML form con barra di ricerca e menu a tendina
     action=$_SERVER['PHP_SELF'] 
     Il codice php genera codice html iterato per ogni risultato della query
     Esempio SELECT * FROM OFFERTE ;
     per il placeholder va la foto
     per card-text va la descrizione
     per small inserisco prezzo scontato
     
     <?php   


      $username = $_POST["username"] ;
      $password = $_POST["password"] ;
      $type = $_POST["type"] ;
    
      $host = "localhost" ;
      $database = "my_cucoupon" ;
      $user = "cucoupon" ;
      $pass = "" ;
    
      $db = mysqli_connect($user , $pass , $host, $database ) or die("Errore nel collegamento");
      $conn = new mysqli( $user , $pass , $host, $database ) ;

      $q = "SELECT * FROM OFFERTE" ;

      $r = $conn->query($q) ;

      if ( $r->num_rows > 0 ) {

          while ( $row = $r->fetch_assoc() ) {


            echo '<div class="col-md-4"> 
            <div class="card mb-4 shadow-sm">"
            <placeholder width="100%" height="225" background="#55595c" color="#eceeef" class="card-img-top" text="Thumbnail"/>
            <div class="card-body">
              <p class="card-text">'.$row["Descrizione"].'</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">'.$row["Percentuale_sconto"].'</small>
              </div>
            </div>
          </div>
        </div>'
          }
      }

      ?>
