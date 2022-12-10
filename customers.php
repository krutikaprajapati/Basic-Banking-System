<?php
include 'connection.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customers</title>
    <!-- css file  -->
    <link rel="stylesheet" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <!-- navigation bar  -->
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="color: white;font-size:2rem;">The Sparks Bank</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="home.php"><button class="btn btn-lg">Home</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customers.php"><button class="btn btn-lg">Customers</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transactions.php"><button class="btn btn-lg">Transactions</button></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <center>
        <div class="row" style="width: 100%;">
            <div id="table-wrapper">
                <div id="table-scroll">
                    <table class="mt-1">
                        <tr style="text-align: center;">
                            <th>Sr No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Account No</th>
                            <th>Current Balance</th>
                            <th>Send Money</th>
                            <!-- <th>Withdraw Money</th> -->
                        </tr>
                        <tr>
                            <?php
                            $selectQuery = 'select * from customers';
                            $query = mysqli_query($con, $selectQuery);
                            $rows = mysqli_num_rows($query);
                            while ($res = mysqli_fetch_assoc($query)) {
                            ?>
                                <td><?php echo "<br>" . $res['id']; ?></td>
                                <td><?php echo $res['name']; ?></td>
                                <td><?php echo $res['email']; ?></td>
                                <td><?php echo $res['account_num']; ?></td>
                                <td><?php echo $res['current_balance']; ?></td>
                                <td> <a href="send_money.php?id=<?php echo $res['id']; ?>" data-bs-toggle="tooltip" data-bs-title="update">
                                        <Button class="btn btn-lg">Send</Button></td>
                                <!-- <td> <a href="withdraw.php?id=<?php echo $res['id']; ?>" data-bs-toggle="tooltip" data-bs-title="update">
                                        <Button class="btn btn-lg">Withdraw</Button></td> -->
                        </tr>

                    <?php

                            }

                    ?>
                    </tr>
                    </table>
                </div>
            </div>
        </div>
    </center>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>