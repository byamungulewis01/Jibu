<?php require 'Config/conn.php'; ?>
<?php require 'header.php'; ?>
<?php

    if (isset($_GET['id'])) {
        # code...
        $id = $_GET['id'];
            $sql = 'DELETE FROM `cart` WHERE `bottle_id`=:id AND Client_Host=:Client_Host';
            $statement = $connection->prepare($sql);
            if($statement->execute([':id' => $id,':Client_Host'=>$ipAdrr])){

                header('location:cart.php');
            }
       }
      ?>
      <?php
            if (isset($_GET['refi_plus'])) {
              $bottle = $_GET['bottle'];
            $cart_id = $_GET['refi_plus'];
            $amount = $_GET['amount'];
            $quant = $_GET['quant'];
            $balanc = $_GET['total'];
            $quantinty = $quant + 1;
            $Total2 = $balanc + $amount;

            $sql1 = 'SELECT id,quantity FROM water_bottle WHERE id=?';
            $stmt = $connection->prepare($sql1);
            $stmt->execute([$bottle]);
            while($data=$stmt->fetch(PDO::FETCH_ASSOC))
            $Q_st = $data['quantity']; 
            if ($Q_st == 0) {
              echo '<script>swal("Sorry for us", "No More Bottles in the Store");</script>';
            } else {
             
            $sql = 'UPDATE `cart` SET refill_quantity=?,TotalAmount=? WHERE cart_id=?';
            $statement = $connection->prepare($sql);
            if($statement->execute([$quantinty,$Total2,$cart_id]))
            {  
              $remain = $Q_st - 1;
              $sql1 = 'UPDATE water_bottle SET quantity=? WHERE id=?';
              $stmt = $connection->prepare($sql1);
              $stmt->execute([$remain,$bottle]);
            }  
            }
           
          }
       ?>
      <?php
            if (isset($_GET['add'])) {
              $bottle = $_GET['bottle'];
            $cart_id = $_GET['add'];
            $amount = $_GET['amount'];
            $quant = $_GET['quant'];
            $balanc = $_GET['total'];
            $quantinty = $quant + 1;
            $Total = $balanc + $amount;
           
           
            $sql1 = 'SELECT id,quantity FROM water_bottle WHERE id=?';
            $stmt = $connection->prepare($sql1);
            $stmt->execute([$bottle]);
            while($data=$stmt->fetch(PDO::FETCH_ASSOC))
            $Q_st = $data['quantity']; 
            if ($Q_st == 0) {
              echo '<script>swal("Sorry for us", "No More Bottles in the Store");</script>';
            } else {
                $sql = 'UPDATE `cart` SET Quantity=?,TotalAmount=? WHERE cart_id=?';
                $statement = $connection->prepare($sql);
                if($statement->execute([$quantinty,$Total,$cart_id]))
                {   
                  $remain = $Q_st - 1;
                  $sql1 = 'UPDATE water_bottle SET quantity=? WHERE id=?';
                  $stmt = $connection->prepare($sql1);
                  $stmt->execute([$remain,$bottle]);
                } 
              }
          }
       ?>
      <?php
          if (isset($_GET['minus'])) {
            $bottle = $_GET['bottle'];
          $cart_id = $_GET['minus'];
          $amount = $_GET['amount'];
          $quant = $_GET['quant'];
          $balanc = $_GET['total'];
          if ($quant > 0) {
            $quantinty = $quant - 1;
            $Total = $balanc - $amount;
            $sql = 'UPDATE `cart` SET Quantity=?,TotalAmount=? WHERE cart_id=?';
            $statement = $connection->prepare($sql);
            if($statement->execute([$quantinty,$Total,$cart_id]))
            {
              $sql1 = 'SELECT id,quantity FROM water_bottle WHERE id=?';
              $stmt = $connection->prepare($sql1);
              $stmt->execute([$bottle]);
              while($data=$stmt->fetch(PDO::FETCH_ASSOC))
              $Q_st = $data['quantity'];   
              $remain = $Q_st + 1;
              $sql1 = 'UPDATE water_bottle SET quantity=? WHERE id=?';
              $stmt = $connection->prepare($sql1);
              $stmt->execute([$remain,$bottle]);
            }  
          } 
          else {
            header('location:cart.php');
          }
        }
      ?>
      <?php
          if (isset($_GET['refi_min'])) {
            $bottle = $_GET['bottle'];
          $cart_id = $_GET['refi_min'];
          $amount = $_GET['amount'];
          $quant = $_GET['quant'];
          $balanc = $_GET['total'];
          if ($quant > 0) {
            $quantinty = $quant - 1;
            $Total = $balanc - $amount;
            $sql = 'UPDATE `cart` SET refill_quantity=?,TotalAmount=? WHERE cart_id=?';
            $statement = $connection->prepare($sql);
            if($statement->execute([$quantinty,$Total,$cart_id]))
            {
              $sql1 = 'SELECT id,quantity FROM water_bottle WHERE id=?';
              $stmt = $connection->prepare($sql1);
              $stmt->execute([$bottle]);
              while($data=$stmt->fetch(PDO::FETCH_ASSOC))
              $Q_st = $data['quantity'];   
              $remain = $Q_st + 1;
              $sql1 = 'UPDATE water_bottle SET quantity=? WHERE id=?';
              $stmt = $connection->prepare($sql1);
              $stmt->execute([$remain,$bottle]);
              
            }  
          } 
          else {
            header('location:cart.php');
          }
        }
      ?>
<div class="container-fluid">

  <section class="py-5">
    <h2 class="h5 text-uppercase mb-4">Shopping cart</h2>
    <div class="row">
      <div class="col-lg-9 mb-4 mb-lg-0">
        <!-- CART TABLE-->
        <div class="table-responsive mb-4">

          <table class="table text-nowrap">
            <thead style="background-color: skyblue;">
              <tr>
                <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Product</strong></th>
                <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Price</strong></th>
                <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">New Bottle</strong></th>
                <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Price</strong></th>
                <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Refill</strong></th>
                <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Total</strong></th>
                <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase"></strong></th>
              </tr>
            </thead>
            <tbody class="border-0">
              <?php                  
                   $sql = 'SELECT * FROM `water_bottle` INNER JOIN cart ON water_bottle.id = cart.bottle_id AND cart.Client_Host=:Client_Host';
                   $statement = $connection->prepare($sql);
                   $statement->execute([':Client_Host' => $ipAdrr]);
                   $Product = $statement->fetchAll(PDO::FETCH_OBJ);
                   $countRow = $statement->rowCount();
                   if ($countRow < 0) {
                       # code...
                   }
                   ?>
              <?php foreach($Product as $Item):
               ?>
              <tr>
                <th class="ps-0 py-3 border-light" scope="row">
                  <div class="d-flex align-items-center"><a class="reset-anchor d-block animsition-link" href=""><img
                        src="Images/<?= $Item->Image; ?>" alt="..." width="70" /></a>
                    <div class="ms-3"><strong class="h6"><a class="reset-anchor animsition-link"
                          href=""><?= $Item->Littles; ?> Littles</a></strong></div>
                  </div>
                </th>
                <td class="p-3 align-middle border-light">
                  <p class="mb-0 small"><?= $Item->Amount; ?> FRW</p>
                </td>
              
                <td class="p-3 align-middle border-light">
                  <div class="border d-flex align-items-center justify-content-between px-3"><span
                      class="small text-uppercase text-gray headings-font-family">Quantity</span>
                    <div class="quantity">
                      <a href="?minus=<?= $Item->cart_id; ?>&amount=<?= $Item->Amount; ?>&quant=<?= $Item->Quantity; ?>&total=<?= $Item->TotalAmount; ?>&bottle=<?= $Item->bottle_id; ?>">
                      <i class="fas fa-caret-left"></i></a>
                      <input class="form-control form-control-sm border-0 shadow-0 p-0" type="text" value="<?= $Item->Quantity; ?>" />
                      <a href="?add=<?= $Item->cart_id; ?>&amount=<?= $Item->Amount; ?>&quant=<?= $Item->Quantity; ?>&total=<?= $Item->TotalAmount; ?>&bottle=<?= $Item->bottle_id; ?>">
                      <i class="fas fa-caret-right"></i></a>
                    </div>
                  </div>
                </td>
               
                <td class="p-3 align-middle border-light">
                  <p class="mb-0 small"><?= $Item->Refill; ?> FRW</p>
                </td>
                <td class="p-3 align-middle border-light">
                  <div class="border d-flex align-items-center justify-content-between px-3"><span
                      class="small text-uppercase text-gray headings-font-family">Quantity</span>
                    <div class="quantity">

                      <a
                        href="?refi_min=<?= $Item->cart_id; ?>&amount=<?= $Item->Refill; ?>&quant=<?= $Item->refill_quantity; ?>&total=<?= $Item->TotalAmount; ?>&bottle=<?= $Item->bottle_id; ?>"><i
                          class="fas fa-caret-left"></i></a>
                      <input class="form-control form-control-sm border-0 shadow-0 p-0" type="text"
                        value="<?= $Item->refill_quantity; ?>" />
                      <a href="?refi_plus=<?= $Item->cart_id; ?>&amount=<?= $Item->Refill; ?>&quant=<?= $Item->refill_quantity; ?>&total=<?= $Item->TotalAmount; ?>&bottle=<?= $Item->bottle_id; ?>"><i
                          class="fas fa-caret-right"></i></a>
                    </div>
                  </div>
                </td>
                <td class="p-3 align-middle border-light">
                  <p class="mb-0 small"><?= $Item->TotalAmount; ?> FRW</p>
                </td>
                <td class="p-3 align-middle border-light"><a class="reset-anchor" href="?id=<?= $Item->bottle_id; ?>"><i
                      class="fas fa-trash-alt small text-muted"></i></a></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>


      </div>
      <!-- ORDER TOTAL-->
      <div class="col-lg-3">

        <div class="card border-0 rounded-0 p-lg-4 bg-light">
          <div class="card-body">
            <h5 class="text-uppercase mb-4">Cart total</h5>
            <ul class="list-unstyled mb-0">
              <?php
                       $sql = 'SELECT SUM(TotalAmount) AS Total FROM `cart` WHERE Client_Host=:Client_Host';
                       $statement = $connection->prepare($sql);
                       $statement->execute([':Client_Host' =>$ipAdrr]);
                       while($data=$statement->fetch(PDO::FETCH_ASSOC))
                       $TotalAmount = $data['Total'];
                      
                      
                    ?>
              <li class="d-flex align-items-center justify-content-between"><strong
                  class="text-uppercase small font-weight-bold">Total</strong><span
                  class="text-muted small"><?= $TotalAmount; ?> Rwf</span></li>
              <li class="border-bottom my-2"></li>
              <li class="d-flex align-items-center justify-content-between"><strong
                  class="text-uppercase small font-weight-bold">Bonus 4%</strong><span
                  class="text-muted small"><?php $threfy = ($TotalAmount * 4)/100; echo $threfy;?> Rwf</span></li>
              <li class="border-bottom my-2"></li>
              <li class="d-flex align-items-center justify-content-between mb-4"><strong
                  class="text-uppercase small font-weight-bold">Total
                  Balance</strong><span><del><?= $TotalAmount; ?></del> |
                  <?php $balance = $TotalAmount - $threfy; echo $balance?> Frw</span></li>
              <li>
              </li>
            </ul>
          </div>
        </div>
      </div>    
    </div>
    
  </section>
      <!-- CART NAV-->
      <div class="bg-light px-4 py-3">
          <div class="row align-items-center text-center">
            <div class="col-md-6 mb-3 mb-md-0 text-md-start"><a class="btn btn-link p-0 text-dark btn-sm"
                href="index.php"><i class="fas fa-long-arrow-alt-left me-2"> </i>Continue shopping</a></div>
            <div class="col-md-6 text-md-end"><a class="btn btn-outline-dark btn-sm" href="checkout.php">Procceed to
                checkout<i class="fas fa-long-arrow-alt-right ms-2"></i></a></div>
          </div>
        </div>
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
    ajax.onload = function (e) {
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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
  integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</div>
</body>

</html>