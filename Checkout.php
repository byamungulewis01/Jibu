<?php require 'Config/conn.php'; ?>
<?php require 'header.php'; ?>
<?php
  if (isset($_POST['Order'])) {
    # code...
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $mobileno = $_POST['mobileno'];
        $Address = $_POST['Address'];
        $date = date("Y/m/d");
        if (!preg_match('/^\d{10}$/', $mobileno)) {
          echo '<script>swal("Error!", "Number must be 10 Digital", "fail");</script>';
        }
        else{
      
        // Find List of Order
        $sql = 'SELECT * FROM `water_bottle` INNER JOIN cart ON water_bottle.id = cart.bottle_id AND cart.Client_Host=:Client_Host';
        $statement = $connection->prepare($sql);
        $statement->execute([':Client_Host' => $ipAdrr]);
        while($data=$statement->fetch(PDO::FETCH_ASSOC)){
            $Product[] = $data['Littles'].'L ['.$data['Quantity'].'] Refill :['.$data['refill_quantity'].']';
            }
            $ListOfOrder = implode(', ',$Product);
        // End Of List of Order
        // Find Total Amount to Pay
        $sql = 'SELECT SUM(TotalAmount) AS Total FROM `cart` WHERE Client_Host=:Client_Host';
        $statement = $connection->prepare($sql);
        $statement->execute([':Client_Host' =>$ipAdrr]);
        while($data=$statement->fetch(PDO::FETCH_ASSOC))
        $TotalAmount = $data['Total'];   
        $threfy = ($TotalAmount * 4)/100;
        $balance = $TotalAmount - $threfy;

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://opay-api.oltranz.com/opay/paymentrequest',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
          "telephoneNumber" : "25'.$mobileno.'",
          "amount" : '.$balance.',
          "organizationId" : "6af87ea4-ced1-44f8-aea1-75098962e0e4",
          "description" : "Jibu Rwanda project",
          "callbackUrl" : "http://myonlineprints.com/payments/callback",
          "transactionId" :"'.time()
        .'"}',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $res = json_decode($response);
        if($res->description == "THE PAYER DOES NOT HAVE SUFFICIENT FUNDS ON HIS/HER ACCOUNT") {
          echo '<script>swal("Ooops!", "You do not have Enought Amount", "fail");</script>';
      }
      else{
       // End Of Balance
            if ($TotalAmount == 0) {
              echo '<script>swal("Ooops!", "You Have nothing in cart", "fail");</script>';
              echo '<script>window.location="index.php";</script>';
            } else {
              $sql = 'INSERT INTO `order`(`fname`, `lname`, `email`, `mobileno`, `Address`, `ListOfOrder`, `Total_Amount`, `Date`) 
              VALUES (?,?,?,?,?,?,?,?)';
              $statement = $connection->prepare($sql);
              if($statement->execute([$fname,$lname,$email,$mobileno,$Address,$ListOfOrder,$balance,$date])){
                  $sql = 'DELETE FROM cart WHERE Client_Host=:Client_Host';
                  $statement = $connection->prepare($sql);
                  if($statement->execute([':Client_Host'=>$ipAdrr])){
  
                    echo '<script>swal("Good job!", "You clicked the button!", "success");</script>';
                    echo '<script>window.location="index.php";</script>';
                  }
              }
            }
      }     
    }
}
?>
<div class="container">

  <section class="py-5">
    <!-- BILLING ADDRESS-->
    <h2 class="h5 text-uppercase mb-4">Billing details</h2>
    <div class="row">
      <div class="col-lg-7">
        <form action="" method="post">
          <div class="row gy-3">
            <div class="col-lg-6">
              <label class="form-label text-sm text-uppercase" for="firstName">First name </label>
              <input name="fname" class="form-control form-control" type="text" id="firstName"
                placeholder="Enter your first name" required>
            </div>
            <div class="col-lg-6">
              <label class="form-label text-sm text-uppercase" for="lastName">Last name </label>
              <input name="lname" class="form-control form-control" type="text" id="lastName"
                placeholder="Enter your last name" required>
            </div>
           <div class="col-lg-12">
              <label class="form-label text-sm text-uppercase" for="address">Address</label>
              <input name="Address" class="form-control form-control" type="text" id="address"
                placeholder="House number and street name" required>
            </div>
            <div class="col-lg-6">
              <label class="form-label text-sm text-uppercase" for="email">Email address </label>
              <input name="email" class="form-control form-control" type="email" id="email"
                placeholder="e.g. Jason@example.com" >
            </div>
            <div class="col-lg-6">
              <label class="form-label text-sm text-uppercase" for="phone">Phone number </label>
              <input name="mobileno" class="form-control form-control" type="number" 
                placeholder="07XXXXXXXX" required>
            </div>

            <div class="col-lg-12 form-group">
              <button name="Order" class="btn btn-info" type="submit">Place order</button>
            </div>
          </div>
        </form>
      </div>
      <!-- ORDER TOTAL-->
      <div class="col-lg-5">

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
                  <?php $balance = $TotalAmount - $threfy; echo $balance; ?> Frw</span></li>
              <li>
              </li>
            </ul>
          </div>
        </div>
        <!-- CART NAV-->
        <div class="bg-light px-4 py-3">
          <div class="row align-items-center text-center">
            <div class="col-md-6 mb-3 mb-md-0 text-md-start"><a class="btn btn-link p-0 text-dark btn-sm"
                href="cart.php"><i class="fas fa-long-arrow-alt-left me-2"> </i>Back to Cart</a></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<   <footer class="bg-dark text-white">
      
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

<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
  integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</div>
</body>

</html>