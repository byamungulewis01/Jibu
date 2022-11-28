<?php 
require_once 'top-layout.php';
 ?>
<?php require_once 'header.php'; ?>
<div class="button-edu-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12">
                <div class="button-ad-wrap res-mg-b-30">

                    <div class="product-status-wrap drp-lst">
                        <h4>Recent Activities</h4>

                        <div class="asset-inner">
                            <table>
                                <tr>
                                    <th>No</th>
                                    <th>Customer Names</th>
                                    <th>Mobile</th>
                                    <th>email</th>
                                    <th>Addrss</th>
                                </tr>
                                <?php
                    $sql = 'SELECT * FROM `order` WHERE status=0';
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $Orders = $statement->fetchAll(PDO::FETCH_OBJ);
                    $count = 1;
                    ?>
                                <?php foreach($Orders as $Order): ?>
                                <tr>
                                    <td><?= $count; ?></td>
                                    <td><?=  $Order->fname; ?> <?=  $Order->lname; ?></td>
                                    <td><?=  $Order->mobileno; ?></td>
                                    <td><?=  $Order->email; ?></td>
                                    <td><?=  $Order->Address; ?></td>
                                </tr>
                                <?php $count++; ?>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                <div class="button-ad-wrap res-mg-b-30">
                    <div class="alert-title">
                        <h2>Bottle in Store</h2>

                    </div>

                    <div class="row">
                        <?php
                    $sql = 'SELECT * FROM `water_bottle`';
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $Product = $statement->fetchAll(PDO::FETCH_OBJ);
                    ?>
                        <?php foreach($Product as $Item): ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-3">
                            <div class="courses-title">
                                <img src="../Images/<?= $Item->Image; ?>" style="width: 100px; height: 100px;">
                                <h2><?= $Item->Littles; ?> Littles</h2>
                            </div>
                            <div class="course-des">
                                <p><span><i class="fa fa-money"></i></span> <?= $Item->Amount; ?> Rwf</p>

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