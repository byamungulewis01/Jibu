
<?php require 'Config/Connection.php'; ?>
<?php
    if (isset($_GET['id'])) {
        # code...
        $id = $_GET['id'];
        $ipAdrr =  $_SERVER['REMOTE_ADDR'];
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
                header('location:index.php?added');
            }
        }
        else {
            # code...
          
            header('location:index.php?exist');
        }
      

    }
?>
<?php include 'header.php'; ?>
<!-- Section-->
<section class="py-1">
    <div class="container px-4 px-lg-5 mt-5">
        <?php if (isset($_GET['added'])) {
            # code...
            echo "<div class='alert alert-info'>Bottle Added To Cart</div>";
        }?>
        <?php if (isset($_GET['exist'])) {
            # code...
            echo "<div class='alert alert-danger'>Bottle Already On Cart</div>";
        }?>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
    
            <?php
                    $sql = 'SELECT * FROM `water_bottle`';
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $Product = $statement->fetchAll(PDO::FETCH_OBJ);
                    ?>
            <?php foreach($Product as $Item): ?>
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
                            Refill <small><?= $Item->Refill; ?></small>
                        </div>
                        <b>Amount </b> :<?= $Item->Amount; ?> Frw
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a class="btn btn-outline-dark mt-auto" href="?id=<?= $Item->id; ?>">Add To Cart</a>

                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
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