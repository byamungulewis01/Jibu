<?php 
require_once 'top-layout.php';
 ?>
<?php require_once 'header.php'; ?>
 <?php
 if (isset($_GET['delete'])) {
    $admin_id = $_GET['delete'];
  
    try {
      $sql = 'DELETE FROM `admin` WHERE id =:adminId';
      $stmt = $connection->prepare($sql);
      if($stmt->execute([':adminId' => $admin_id]))
      {      
          header("Location: Administration.php?Deleted");
    } 
  }
  catch (PDOException $e) {
       echo $e->getMessage();
      header("Location: Administration.php?error");
    }
     
   }
 ?>
<div class="button-edu-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <?php
            if (isset($_GET['edit'])) {
                $Admin_id = $_GET['edit'];
                $sql = 'SELECT * FROM `admin` WHERE id =:Admin_id';
                $statement = $connection->prepare($sql);
                $statement->execute([':Admin_id' => $Admin_id]);
                $Civil = $statement->fetchAll(PDO::FETCH_OBJ);
            ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="button-ad-wrap res-mg-b-30">
                    <div class="alert-title">
                        <h2>Edit Admin</h2>

                    </div>
                    <?php foreach($Civil as $Person): ?>
                    <form action="config/EditAdmin.php" method="post"
                        class="dropzone dropzone-custom needsclick add-professors">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="hidden" name="admin_id" value="<?= $Person->id; ?>">
                                    <input name="fname" type="text" class="form-control" id="fname"
                                        value="<?= $Person->fname; ?>">
                                </div>
                                <div class="form-group">
                                    <input name="lname" type="text" class="form-control" id="lname"
                                    value="<?= $Person->lname; ?>">
                                </div>
                                <div class="form-group">
                                    <input name="username" type="text" maxlength="20" class="form-control"
                                    value="<?= $Person->username; ?>">
                                </div>
                                <div class="form-group">
                                    <input name="password" type="password" maxlength="20" class="form-control"
                                    value="<?= $Person->password; ?>">
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
            else {
            ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="button-ad-wrap res-mg-b-30">
                    <div class="alert-title">
                        <h2>Add New Admin User</h2>

                    </div>
                    <form action="config/Add_Admin.php" method="post"
                        class="dropzone dropzone-custom needsclick add-professors">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input name="fname" type="text" class="form-control" id="fname"
                                        placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <input name="lname" type="text" class="form-control" id="lname"
                                        placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                    <input name="username" type="text" maxlength="60" class="form-control"
                                        placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input name="password" type="password" maxlength="10" class="form-control"
                                        placeholder="************">
                                </div>


                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="payment-adress">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light"
                                        name="submit">Add</button>
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
                <div class="button-ad-wrap">
                    <div class="alert-title">
                        <h2>All Admin User</h2>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N<sup>0</sup></th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                               
                                $sql = 'SELECT * FROM `admin`';
                                $statement = $connection->prepare($sql);
                                $statement->execute();
                                $Civil = $statement->fetchAll(PDO::FETCH_OBJ);
                                $count = 1;
                                ?>
                                <?php foreach($Civil as $Person): ?>
                                <tr>
                                    <td><?= $count; ?></td>
                                    <td><?= $Person->fname; ?></td>
                                    <td><?= $Person->lname; ?></td>
                                    <td><?= $Person->username; ?></td>

                                    <td style="width: 10px;">
                                        <form action="" method="get">
                                            <input type="hidden" name="edit" value="<?= $Person->id; ?>">
                                            <button title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o"
                                                    aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                    <td style="width: 10px;">
                                    <form action="" method="get">
                                            <input type="hidden" name="delete" value="<?= $Person->id; ?>">
                                            <button title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o"
                                                    aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                   
                                </tr>
                                <?php $count+=1; endforeach; ?>
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php require_once 'bottom-layout.php'; ?>