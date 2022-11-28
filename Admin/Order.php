<?php 
require_once 'top-layout.php';
 ?>
<?php require_once 'header.php'; ?>
<?php
 if (isset($_GET['submit'])) {
    # code...
    $id = $_GET['submit'];
    $sql = 'UPDATE `order` SET status=1 WHERE `Order_id`=:id';
    $statement = $connection->prepare($sql);
    if($statement->execute([':id' => $id])){

        header('location:Order.php');
    }
 }
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="product-status-wrap drp-lst">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>N<sup>0</sup></th>
                                <th>Customer names</th>
                                <th>email</th>
                                <th>Mobile no</th>
                                <th>Address</th>
                                <th>List Of Customer Order</th>
                                <th>Amount Payed</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                    $sql = 'SELECT * FROM `order` WHERE status=0';
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $Orders = $statement->fetchAll(PDO::FETCH_OBJ);
                    $count = 1;
                    ?>
                            <?php foreach($Orders as $Order): ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?=  $Order->fname; ?> <?=  $Order->lname; ?></td>
                                <td><?=  $Order->email; ?></td>
                                <td><?=  $Order->mobileno; ?></td>
                                <td><?=  $Order->Address; ?></td>
                                <td><?=  $Order->ListOfOrder; ?></td>
                                <td><?=  $Order->Total_Amount; ?> Rwf</td>
                                <td><?=  $Order->Date; ?></td>
                                <td><a href="?submit=<?= $Order->Order_id; ?>">submited</a></td>
                            </tr>
                            <?php $count+=1; endforeach; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<?php require_once 'bottom-layout.php'; ?>