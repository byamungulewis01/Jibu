<?php
 $id=$_GET['id'];
require '../Config/Connection.php';
if (isset ($_POST['submit'])  ) {
    $littles = $_POST['littles'];
    $Amount = $_POST['Amount'];
    $Refill = $_POST['Refill'];
    // Image Upload
    $Image=$_FILES['image']['name'];
    $temp_n=$_FILES['image']['tmp_name'];
    $store ="../assets/" .basename($_FILES['image']['name']);
    move_uploaded_file($temp_n, $store);


    $sql = 'UPDATE `water_bottle` SET `Littles`=:Littles , `Amount` =:Amount, `Refill`=:Refill, `Image`=:Image WHERE id=:id';
    $statement = $connection->prepare($sql);
    if ($statement->execute([
        ':Littles' => $littles,
       ':Amount' => $Amount,
      ':Refill' => $Refill, 
      ':Image' => $Image,
      ':id' => $id
      ])) {
       header('Lacation: index.php');
    }

    }
  

 ?>
<?php require 'header.php'; ?>
<!-- Section-->
<section class="py-1">
    <div class="container px-4 px-md-5 mt-5">
        <?php
                   
                    $sql = 'SELECT * FROM `water_bottle` WHERE id=:id';
                    $statement = $connection->prepare($sql);
                    $statement->execute([':id'=> $id]);
                    $Product = $statement->fetchAll(PDO::FETCH_OBJ);
                    ?>
        <?php foreach($Product as $Item): ?>
        <form class="form-inline" method="post" enctype="multipart/form-data">
            <label for="email">New Bottle</label>
            <input type="number" min="3" class="form-control" name="littles" value="<?= $Item->Littles; ?>">
            <label for="email">Amount For New</label>
            <input type="number" min="1" class="form-control" name="Amount" value="<?= $Item->Amount; ?>">
            <label for="email">Refill</label>
            <input type="number" min="1" class="form-control" name="Refill" value="<?= $Item->Refill; ?>">
            <label for="pwd">Bottle type:</label>
            <input type="file" class="form-control" name="image">
            <div class="form-check">

            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
        <?php endforeach; ?>
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
<script src="../js/scripts.js"></script>
</body>

</html>