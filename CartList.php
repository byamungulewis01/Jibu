<?php require 'Config/Connection.php'; ?>
<?php  $ipAdrr =  $_SERVER['REMOTE_ADDR']; ?>
<?php

    if (isset($_GET['id'])) {
        # code...
        $id = $_GET['id'];
            $sql = 'DELETE FROM `cart` WHERE `bottle_id`=:id AND Client_Host=:Client_Host';
            $statement = $connection->prepare($sql);
            if($statement->execute([':id' => $id,':Client_Host'=>$ipAdrr])){

                header('location:CartList.php');
            }
    }
?>
<?php
  if (isset($_POST['count'])) {
    # code...
        $quantinty = $_POST['quantinty'];
        $Bottle_id = $_POST['Bottle_id'];
        $amount = $_POST['amount'];
        $Total = $amount * $quantinty;
        $sql = 'UPDATE `cart` SET Quantity=:Quantity,TotalAmount=:Total WHERE bottle_id=:bottle_id AND Client_Host=:Client_Host';
        $statement = $connection->prepare($sql);
        if($statement->execute([':Quantity' => $quantinty,':Client_Host'=>$ipAdrr,':bottle_id' => $Bottle_id,':Total'=>$Total])){

            header('location:CartList.php');
        }

}
?>


<?php include 'header.php'; ?>

<!-- Section-->
<section class="py-1">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
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
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="assets/<?= $Item->Image; ?>" style="width: 50%; height: 30%;" />
                    <!-- Product details-->
                    <div class="card-body">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder"><?= $Item->Littles; ?> Littles</h5>
                            <!-- Product price-->
                        
                        </div>
                        <b>Amount </b> :<?= $Item->Amount; ?> Frw
                        <form action="" method="post">
                            <input type="hidden" name="Bottle_id" value="<?= $Item->id; ?>">
                            <input type="hidden" name="amount" value="<?= $Item->Amount; ?>">
                            <input type="number" name="quantinty" min="1"  class="form-control" value="<?= $Item->Quantity; ?>">
                            <input type="submit" value="Count" name="count">
                        </form>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a class="btn btn-danger mt-auto" href="?id=<?= $Item->bottle_id; ?>">Remove To Cart</a>

                        </div>
                    </div>
                </div>
            </div>
            <?php 
        endforeach; ?>
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
                    <p> <a class="btn btn-info mt-auto" href="Checkout.php">Procced Payment</a>
                    </p>
                </div>
        </div>
    </div>
</section>

<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>

</html>