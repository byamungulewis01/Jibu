<?php 
require_once 'top-layout.php';
 ?>
<?php require_once 'header.php'; ?>
<div class="button-edu-area mg-b-15">
    <div class="container-fluid">
        <?php
                    $sql = 'SELECT * FROM `customer_ideas`';
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $Orders = $statement->fetchAll(PDO::FETCH_OBJ);
                    ?>
        <?php foreach($Orders as $Order): ?>
        <div class="row mt-3">
            <div class="col-md-9 col-md-9 col-sm-9 col-xs-12">
                <div class="hpanel email-compose mailbox-view">
                    <div class="panel-heading hbuilt">

                        <div class="p-xs h4">
                            <small class="pull-right view-hd-ml">
                               <?=  $Order->date; ?>
                            </small>  <?=  $Order->names; ?>

                        </div>
                    </div>

                    <div class="panel-body panel-csm">
                        <div>
                            <p><?= $Order->message; ?></p>
                        </div>
                       <strong>Mobile Number</strong> <?= $Order->phone; ?>
                    </div>


                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require_once 'bottom-layout.php'; ?>