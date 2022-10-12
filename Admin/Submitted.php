<?php require '../Config/Connection.php'; ?>
<?php require 'header.php'; ?>


<!-- Section-->
<section class="py-1">
    <div class="container px-4 px-lg-7 mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th>N<sup>0</sup></th>
                    <th>Names</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>List Of Customer Order</th>
                    <th>Amount Payed</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
                    $sql = 'SELECT * FROM `order` WHERE status=1';
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $Orders = $statement->fetchAll(PDO::FETCH_OBJ);
                    $count = 1;
                    ?>
                <?php foreach($Orders as $Order): ?>
            <tbody>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?=  $Order->names; ?></td>
                    <td><?=  $Order->phone; ?></td>
                    <td><?=  $Order->Address; ?></td>
                    <td><?=  $Order->ListOfOrder; ?></td>
                    <td><?=  $Order->Total_Amount; ?></td>
                    <td><?=  $Order->Date; ?></td>
                    <td><a href="">submited</a></td>
                </tr>
              <?php $count++; ?>
            </tbody>
            <?php endforeach; ?>
        </table>
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