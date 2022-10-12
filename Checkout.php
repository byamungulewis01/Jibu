<?php require 'Config/Connection.php'; ?>
<?php  $ipAdrr =  $_SERVER['REMOTE_ADDR']; ?>

<?php include 'header.php'; ?>

<!-- Section-->
<section class="py-1">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-6 gx-lg-5 row-cols-5 row-cols-md-5 row-cols-xl-4 justify-content-center">
        <div class="card">
                    <?php
                       $sql = 'SELECT SUM(TotalAmount) AS Total FROM `cart` WHERE Client_Host=:Client_Host';
                       $statement = $connection->prepare($sql);
                       $statement->execute([':Client_Host' =>$ipAdrr]);
                       while($data=$statement->fetch(PDO::FETCH_ASSOC)){
                       $Total = $data['Total'];
                       }
                      
                    ?>
                    <h3>Balance To Pay</h3>
                    <p>Amount : <?php echo $Total; ?></p>
     
                    </p>
                </div>
            <div class="col mb-5">
                <div class="card h-100">
                    <div class="card-body">
                     
                        <form action="" method="post">
                            
                            <input type="text" name="names" class="form-control" placeholder="Names">

                            <input type="number" name="phone" min="1"  class="form-control" value="">
                            <input type="text" name="Address" class="form-control" placeholder="Your Address">
                            
                            <input type="submit" value="Order" name="Order">
                        </form>
                    </div>
                    <!-- Product actions-->
                   
                </div>
            </div>       
        </div>
    </div>
</section>
<?php
  if (isset($_POST['Order'])) {
    # code...
        $names = $_POST['names'];
        $phone = $_POST['phone'];
        $Address = $_POST['Address'];
        $date = date("Y/m/d");
        $sql = 'SELECT * FROM `water_bottle` INNER JOIN cart ON water_bottle.id = cart.bottle_id AND cart.Client_Host=:Client_Host';
        $statement = $connection->prepare($sql);
        $statement->execute([':Client_Host' => $ipAdrr]);
        while($data=$statement->fetch(PDO::FETCH_ASSOC)){
            $Product[] = $data['Littles'].' Littles ['.$data['Quantity'].']';
            }
            $ListOfOrder = implode(', ',$Product);

            $sql = 'INSERT INTO `order`(`names`, `phone`, `Address`, `ListOfOrder`, `Total_Amount`, `Date`)
             VALUES (:names, :phone, :Address, :ListOfOrder, :Total_Amount, :Date)';
            $statement = $connection->prepare($sql);
            if($statement->execute([
                ':names' => $names, ':phone' => $phone, ':Address' => $Address,
                 ':ListOfOrder' => $ListOfOrder, ':Total_Amount' => $Total, ':Date' => $date
            ])){
                $sql = 'DELETE FROM cart WHERE Client_Host=:Client_Host';
                $statement = $connection->prepare($sql);
                if($statement->execute([':Client_Host'=>$ipAdrr])){
    
                    header('location:index.php');
                }
            }
        

}
?>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>

</html>