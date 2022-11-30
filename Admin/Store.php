<?php 
require_once 'top-layout.php';
 ?>
<?php require_once 'header.php'; ?>
<?php
 if (isset($_GET['delete'])) {
    $bottle_id = $_GET['delete'];
  
    try {
      $sql = 'DELETE FROM `water_bottle` WHERE id = ?';
      $stmt = $connection->prepare($sql);
      if($stmt->execute([$bottle_id]))
      {      
          header("Location: Store.php?Deleted");
    } 
  }
  catch (PDOException $e) {
       echo $e->getMessage();
      header("Location: Store.php?error");
    }
     
   }
 ?>
<div class="button-edu-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <?php
            if (isset($_GET['edit'])) {
                $bottle_id = $_GET['edit'];
            ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="button-ad-wrap res-mg-b-30">
                    <div class="alert-title">
                        <h2>Edit Bottle</h2>

                    </div>
                    <?php
                    $sql = 'SELECT * FROM `water_bottle` WHERE id=?';
                    $statement = $connection->prepare($sql);
                    $statement->execute([$bottle_id]);
                    $Product = $statement->fetchAll(PDO::FETCH_OBJ);
                    ?>
                    <?php foreach($Product as $Item): ?>
                    <form action="config/EditStore.php" method="post"
                        class="dropzone dropzone-custom needsclick add-professors" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                <label for="">Littles</label>
                                    <input type="hidden" name="id" value="<?= $bottle_id; ?>">
                                    <input name="littles" type="text" class="form-control"
                                        value="<?= $Item->Littles; ?>">
                                </div>
                                <div class="form-group">
                                <label for="">New bottle Amount</label>
                                    <input name="Amount" type="number" min="1" class="form-control"
                                        value="<?= $Item->Amount; ?>" required>
                                </div>
                                <div class="form-group">
                                <label for="">Refill Amount</label>
                                    <input name="Refill" type="number" min="1" class="form-control"
                                        value="<?= $Item->Refill; ?>" required>
                                </div>
                                <div class="form-group">
                                <label for="">Bottle image</label>
                                    <input type="file" id="file" onchange="return fileValidation()" class="form-control"
                                        name="image" required>
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="payment-adress">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light"
                                        name="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
                }
               elseif (isset($_GET['quant'])) {
                    $bottle_id = $_GET['quant'];
                ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="button-ad-wrap res-mg-b-30">
                    <div class="alert-title">
                        <h2>Update Quantity</h2>

                    </div>
                    <?php
                        $sql = 'SELECT * FROM `water_bottle` WHERE id=?';
                        $statement = $connection->prepare($sql);
                        $statement->execute([$bottle_id]);
                        $Product = $statement->fetchAll(PDO::FETCH_OBJ);
                        ?>
                    <?php foreach($Product as $Item): ?>
                    <form action="config/EditQuantity.php" method="post"
                        class="dropzone dropzone-custom needsclick add-professors" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?= $bottle_id; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input name="quantity" type="number" min="1" class="form-control"
                                        value="<?= $Item->quantity; ?>" required>
                                </div>


                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="payment-adress">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light"
                                        name="submit">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
                
                    }
            else {
            ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="button-ad-wrap res-mg-b-30">
                    <div class="alert-title">
                        <h2>Add Bottle</h2>

                    </div>
                    <form action="config/AddBottle.php" method="post" enctype="multipart/form-data"
                        class="dropzone dropzone-custom needsclick add-professors">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input name="littles" type="number" min="1" class="form-control"
                                        placeholder="Bottle Littles" required>
                                </div>
                                <div class="form-group">
                                    <input name="Amount" type="number" min="1" class="form-control" placeholder="Amount"
                                        required>
                                </div>
                                <div class="form-group">
                                    <input name="Refill" type="number" min="1" class="form-control" placeholder="Refill"
                                        required>
                                </div>
                                <div class="form-group">
                                    <input name="quantity" type="number" min="1" class="form-control"
                                        placeholder="Quantity" required>
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="image" id="file"
                                        onchange="return fileValidation()" class="form-control" name="image" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="payment-adress">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light"
                                        name="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            
                }
            ?>

            <div class="col-lg-9 col-md-6 col-sm-6 col-xs-12">
                <?php if(isset($_GET['Deleted'])) { ?>
                <div class="alert alert-warning">Deleted Successful</div>
                <?php } ?>
                <?php if(isset($_GET['updated'])) { ?>
                <div class="alert alert-success">Updated Successful</div>
                <?php } ?>
                <div class="row">

                    <?php
                    $sql = 'SELECT * FROM `water_bottle`';
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $Product = $statement->fetchAll(PDO::FETCH_OBJ);
                    ?>
                    <?php foreach($Product as $Item): ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-3">
                        <div class="courses-inner res-mg-t-30 dk-res-t-pro-30">
                            <div class="courses-title">
                                <img src="../Images/<?= $Item->Image; ?>" alt="">
                                <h2><?= $Item->Littles; ?> Littles</h2>
                            </div>
                            <div class="course-des">
                                <p><span><i class="fa fa-money"></i></span> <b>Amount:</b> <?= $Item->Amount; ?></p>
                                <p><span><i class="fa fa fa-shopping-basket"></i></span>
                                    <b>Refill:</b><?= $Item->Refill; ?> | <b>Qantity:</b><?= $Item->quantity; ?></p>

                            </div>
                            <div class="product-buttons">
                                <a href="?quant=<?= $Item->id; ?>" class="btn btn-primary btn-sm">Quantity</a>
                                <a href="?edit=<?= $Item->id; ?>" class="btn btn-info btn-sm">Edit</a>
                                <a href="?delete=<?= $Item->id; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<?php require_once 'bottom-layout.php'; ?>