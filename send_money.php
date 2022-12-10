<?php
include 'connection.php';
$sender_id = $_GET['id'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SEND MONEY</title>
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

    <?php
    // echo $id;
    ?>

    <div class="row addmoney mt-5" style="width: 100%;margin:0 auto">
        <div class="col-md-4" style="margin: 0 auto;">
            <form action="" method="POST">
                <center>
                    <h5>MONEY TRANSFER</h5>
                </center>
                <label for="" class="form-label">Enter amount</label>
                <input type="text" name="money" id="money" class="form-control" required>
                <br>
                <select class="form-select mb-3" name="people" id="people" required>
                    <option selected disabled>Transfer to</option>
                    <?php
                    $selectQuery = 'select * from customers';
                    $query = mysqli_query($con, $selectQuery);
                    // $rows = mysqli_num_rows($query);
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                    <?php
                    }
                    ?>
                </select>
                <center>
                    <button class="btn btn-lg" name="add">Transfer</button>
                </center>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php
    if (isset($_POST['add'])) {
        $amount = $_POST['money'];
        $receiver = $_POST['people'];
        $selectQ = "select * from customers where id='$sender_id'";
        $que = mysqli_query($con, $selectQ);
        while ($row = mysqli_fetch_array($que)) {
            $current = $row['current_balance'];
            $sender = $row['name'];
        }
        if (($current - $amount) >= 0) {
            $new_balance = $current - $amount;
            $updateQuery = "update customers set current_balance='$new_balance' where id='$sender_id'";
            $q = mysqli_query($con, $updateQuery);
            $selectpeople = "select * from customers where name='$receiver'";
            $quer = mysqli_query($con, $selectpeople);
            while ($rows = mysqli_fetch_array($quer)) {
                $current_bal = $rows['current_balance'];
            }
            $final_balance = $current_bal + $amount;
            $updateQ = "update customers set current_balance='$final_balance' where name='$receiver'";
            $Query = mysqli_query($con, $updateQ);
            if ($Query && $q) {
                $insertQuery = "INSERT INTO `transaction`(`sender`, `receiver`, `amount`, `status`) VALUES ('$sender','$receiver','$amount','success')";
                $Que = mysqli_query($con, $insertQuery);
                header("Location: transactions.php");
            }
        } else {
    ?>
            <script>
                alert("Not enough balance");
            </script>
    <?php
            $insertQuery = "INSERT INTO `transaction`(`sender`, `receiver`, `amount`, `status`) VALUES ('$sender','$receiver','$amount','fail')";
            $Que = mysqli_query($con, $insertQuery);
            header("Location: transactions.php");
        }
    }
    ?>
</body>

</html>