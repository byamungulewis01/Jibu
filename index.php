<?php require 'Config/conn.php'; ?>
<?php require 'header.php'; ?>   
<?php
    if (isset($_GET['id'])) {
        # code...
        $id = $_GET['id'];
        $Quantity = 1;

        $sql = 'SELECT * FROM `cart` WHERE bottle_id=:id AND Client_Host=:ipAdrr';
        $statement = $connection->prepare($sql);
        $statement->execute([':id' =>$id,':ipAdrr'=>$ipAdrr]);
        $row = $statement->rowCount();
        if ($row == null) {
            # code...
            $sql = 'SELECT * FROM `water_bottle` WHERE id=:id';
            $statement = $connection->prepare($sql);
            $statement->execute([':id' =>$id]);
            while($data=$statement->fetch(PDO::FETCH_ASSOC)){
            $amount = $data['Amount'];
          }
            #Insert
            $sql = 'INSERT INTO `cart`(`bottle_id`,`Client_Host`,`Quantity`,`TotalAmount`) 
            VALUES (:bottle_id,:Client_Host,:Quantity,:TotalAmount)';
            $statement = $connection->prepare($sql);
            if($statement->execute([
                ':bottle_id' => $id,
                ':Client_Host' => $ipAdrr,
                ':Quantity' => $Quantity,
                ':TotalAmount' => $amount
                ])){
                  echo '<script>window.location=" index.php?add";</script>';
            }
        }
        else {
          echo '<script>window.location=" index.php?exist";</script>';
        
        }

    }
?>

      <!-- HERO SECTION-->
      <!-- <section class="hero pb-3 bg-cover bg-center d-flex align-items-center"  style="background: url(Images/hero.jpg)">
          <div class="container py-5">
            <div class="row px-3 px-lg-5">
              <div class="col-lg-6">
                <p class="text-muted small text-uppercase mb-2">New Inspiration 2020</p>
                <h1 class="h2 text-uppercase mb-3">20% off on new season</h1><a class="btn btn-info" href="shop.html">Browse collections</a>
              </div>
            </div>
          </div>
        </section>
         -->
      <div class="container">
      <?php  if(isset($_GET['add'])) {?>
                        <?php echo '<script>swal("Good job!", "Bottles Added to cart", "success");</script>'; ?>
                   <?php } ?>
      <?php  if(isset($_GET['exist'])) {?>
              <?php echo '<script>swal("Opppps!!", "Bottle Arleady existy on cart", "Existy");</script>'; ?>
                   <?php } ?>
     
        <!-- TRENDING PRODUCTS-->

        <section class="py-5">
          
          <header>
            <p class="small text-muted small text-uppercase mb-1">Jibu rwanda Fresh Water</p>
            <h2 class="h5 text-uppercase mb-4">Top trending products</h2>
         
          </header>
          <div class="row">
            <!-- PRODUCT-->
            <?php
                    $sql = 'SELECT * FROM `water_bottle` WHERE quantity > 0';
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $Product = $statement->fetchAll(PDO::FETCH_OBJ);
                    ?>
                    <?php foreach($Product as $Item): ?>
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="product text-center">
                <div class="position-relative mb-3">
                  <div class="badge text-white bg-"></div><img class="img-fluid w-100" src="Images/<?= $Item->Image; ?>" alt="...">
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-info" href="?id=<?= $Item->id; ?>">Add to cart</a></li>
                    
                    </ul>
                  </div>
                </div>
                <h6>Amount : <small><?= $Item->Amount; ?> RWF</small></h6>
                <p class="small text-muted">Refill : <?= $Item->Refill; ?> RWF</p>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </section>
    
      </div>
      <footer class="bg-dark text-white">
      
          <div class="border-top pt-4" style="border-color: #044a72 !important">
            <div class="row">
              <div class="col-md-6 text-center text-md-start">
                <p class="small text-muted mb-0">&copy; 2022 All rights.</p>
              </div>
              <div class="col-md-6 text-center text-md-end">
                <p class="small text-muted mb-0">Jibu rwanda<a class="text-white reset-anchor" href="#">jibu</a></p>
                <!-- If you want to remove the backlink, please purchase the Attribution-Free License. See details in readme.txt or license.txt. Thanks!-->
              </div>
            </div>
          </div>
        </div>
       
      </footer>
      <!-- JavaScript files-->
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="vendor/glightbox/js/glightbox.min.js"></script>
      <script src="vendor/nouislider/nouislider.min.js"></script>
      <script src="vendor/swiper/swiper-bundle.min.js"></script>
      <script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
      <script src="js/front.js"></script>
      <script>
        // ------------------------------------------------------- //
        //   Inject SVG Sprite - 
        //   see more here 
        //   https://css-tricks.com/ajaxing-svg-sprite/
        // ------------------------------------------------------ //
        function injectSvgSprite(path) {
        
            var ajax = new XMLHttpRequest();
            ajax.open("GET", path, true);
            ajax.send();
            ajax.onload = function(e) {
            var div = document.createElement("div");
            div.className = 'd-none';
            div.innerHTML = ajax.responseText;
            document.body.insertBefore(div, document.body.childNodes[0]);
            }
        }
        // this is set to BootstrapTemple website as you cannot 
        // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
        // while using file:// protocol
        // pls don't forget to change to your domain :)
        injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
        
      </script>
      <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </div>
  </body>
</html>