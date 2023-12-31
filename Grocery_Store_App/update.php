<?php
    include("connect.php");
    if(isset($_POST['btn'])) 
    {
        $item_name = $_POST['iname'];
        $item_qty = $_POST['iqty'];
        $istatus = $_POST['istatus'];
        $date = $_POST['idate'];
        $id = $_GET['id'];
        $q = "update grocerytb set item_name='$item_name', item_quantity='$item_qty', item_status='$istatus', date='$date' where id=$id";
        $query = mysqli_query($con,$q);
        header('location:index.php');
    }
    else if(isset($_GET['id'])) 
    {
        $q = "SELECT * FROM grocerytb WHERE id='".$_GET['id']."'";
        $query = mysqli_query($con, $q);
        $res = mysqli_fetch_array($query);
    }
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Update List</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Update Grocery List</h1>
        <form method="post">
            <div class="form-group">
                <label>Item Name</label>
                <input type="text" class="form-control" name="iname" placeholder="Item name" value="<?php echo $res['item_name'];?>">
            </div>

            <div class="form-group">
                <label>Item Quantity</label>
                <input type="text" class="form-control" name="iqty" placeholder="Item quantity" value="<?php echo $res['item_quantity'];?>">
            </div>

            <div class="form-group">
                <label>Item Status</label>
                <select class="form-control" name="istatus">
                <?php
                    if($res['item_status'] == 0) {
                ?>
                <option value="0" selected>PENDING</option>
                <option value="1">BOUGHT</option>  
                <option value="2">NOT AVAILABLE</option> 
                <?php } else if($res['item_status'] == 1) { ?>
                <option value="0">PENDING</option>
                <option value="1" selected>BOUGHT</option>
                <option value="2">NOT AVAILABLE</option>    
                <?php } else if($res['item_status'] == 2) { ?>
                <option value="0">PENDING</option>
                <option value="1">BOUGHT</option>
                <option value="2" selected>NOT AVAILABLE</option>
                <?php         
                    }
                ?>    
                </select>
            </div>   
            
            <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" name="idate" placeholder="Date" value="<?php echo $res['date']?>">
            </div>

            <div class="form-group">
                <input type="submit" value="Update" name="btn" class="btn btn-danger">
            </div>
        </form>
    </div>
</body>

</html>