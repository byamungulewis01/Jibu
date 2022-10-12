<?php
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


    $sql = 'INSERT INTO `water_bottle`(`Littles`, `Amount`, `Refill`, `Image`) 
    VALUES (:Littles, :Amount, :Refill, :Image)';
    $statement = $connection->prepare($sql);
    if ($statement->execute([
        ':Littles' => $littles,
       ':Amount' => $Amount,
      ':Refill' => $Refill, 
      ':Image' => $Image
      ])) {
       $message ="<div class='alert alert-success'>Bottle Added</div>";
    }

    }
    else {
        # code...
        $message ="";
    }

 ?>
<?php require 'header.php'; ?>
        <!-- Section-->
        <section class="py-1" >
            <div class="container px-4 px-md-5 mt-5">
                <?php echo $message; ?>
            <form class="form-inline" method="post" enctype="multipart/form-data">
  <label for="email">New Bottle</label>
  <input type="number" min="3" class="form-control" name="littles" placeholder="New Bottle Little">
  <label for="email">Amount For New</label>
  <input type="number" min="1" class="form-control" name="Amount"  placeholder="Amount For New Bottle">
  <label for="email">Refill</label>
  <input type="number" min="1" class="form-control" name="Refill"  placeholder="Amount For New Bottle">
  <label for="pwd">Bottle type:</label>
  <input type="file" class="form-control" name="image" >
  <div class="form-check">
  
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
    </body>
</html>
