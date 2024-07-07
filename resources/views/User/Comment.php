<?php
include "../../connectionUser/Connection.php";
include "../../connection/Controller.php";
session_start();
$id_danhmuc = isset($_GET['idDM']) && is_numeric($_GET['idDM']) ? $_GET['idDM'] : 0;
$conn = Connection::getInstance();
$email_user = $_SESSION['customer_email'];
$query = $conn->prepare("select id,name from customers where email=:email");
$query->execute([":email" => $email_user]);
foreach ($query->fetchAll() as $result) {
    $idCus = $result->id;
}
$idPro = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Care</title>
    <link rel="shortcut icon" type="image/png" href="../Project-petcare-php/images/logo/PetCARE.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="../Project-petcare-php/css/user-responsive.css">
    <link rel="stylesheet" href="../Project-petcare-php/css/user1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body style="width:100%;overflow-y:hidden">
    <form method="post" action="index.php?controller=product&action=addComment&idPro=<?php echo $idPro ?>&idUs=<?php echo $idCus ?>">
        <input placeholder="Nhập bình luận của bạn" style="width:100%;border-radius:10px;height:50px" name="comment" required>
        <button class="btn btn-primary mt-3 float-end">Bình luận</button>
    </form>

    <!-- Danh sách các bình luận -->
    <div class="container" style="width:70%;height:300px;margin-top:20px;overflow-y:auto;overflow-x:hidden">
        <div class="list-comment mt-5" style="background-color:#EEEEEE;border-radius:6px" width="80%">

            <?php
            /*
              $id=$_GET['id'];
              $conn=Connection::getInstance();
              $query=$conn->prepare("select * from comment where id_comment=:id");
              $query->execute([':id'=>$id]);
              foreach($query->fetchAll() as $result){}
              */

            ?>
            <div class="d-flex flex-column mt-3 ms-5">
                <?php foreach ($comment as $result)   ?>
                <div>
                    <div class="me-4">
                        <img style="width:50px;height:50px;margin-left:40px;margin-top:10px;border-radius:20px" class="img-fluid rounded text-center" src="images/logo/PetCARE (2).png">
                    </div>

                    <div class="" style="margin-bottom:20px;box-shadow: 2px 2px 2px gray;margin-top:10px;background-color:#FFFFFF;border-radius:10px;width:60%">
                        <span style="font-weight:bold;font-size:15px;color:blue" class="user-name"> sss</span>
                        <span style="font-weight:lighter" class="comment-time">dđ</span>
                        <div style="margin-left:40px" class="noidung"></div>
                        <br>
                    </div>
                </div>

            </div>

        </div>

        <!-- end danh sách bình luận -->

    </div>
</body>
<script href="../js/script.js"></script>

</html>