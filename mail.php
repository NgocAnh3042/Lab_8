<?php 
require "./PHPMailer-master/PHPMailer-master/src/PHPMailer.php";
require "./PHPMailer-master/PHPMailer-master/src/SMTP.php";
require './PHPMailer-master/PHPMailer-master/src/Exception.php';

if (isset($_POST)) { 
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try { 
        $mail->isSMTP(); 
        $mail->CharSet  = "utf-8"; 
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $nguoigui = 'anh3042k6@gmail.com'; 
        $matkhau = 'mkvs pswa pnwf wpjv'; 
        $tennguoigui = 'Ngọc Anh'; 
        $mail->Username = $nguoigui;
        $mail->Password = $matkhau;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom($nguoigui, $tennguoigui); 
        
        // PHẦN THÊM MỚI: Kiểm tra gửi 1 hay nhiều
        $to = $_POST['email']; 
        
        if (!empty($to)) {
            // GỬI CHO 1 NGƯỜI
            $to_name = "bạn"; 
            $mail->addAddress($to, $to_name);
        } else {
            // GỬI CHO NHIỀU NGƯỜI TỪ SQL
            $conn = new mysqli("localhost", "root", "", "list_mail");
            $sql = "SELECT email, name FROM mail";
            $result = $conn->query($sql);
            
            while($row = $result->fetch_assoc()) {
                $mail->addAddress($row['email'], $row['name']);
            }
            $to_name = "bạn";
            $conn->close();
        }
        
        $tieude = $_POST['tieude']; 
        $mail->isHTML(true);
        $mail->Subject = $tieude; 
        $noidungthu = ' <div class="card" style="width: 18rem;"> 
                <div class="card-body"> 
                    <h5 class="card-title"><b>Xin chào ' . $to_name . '</b></h5> 
                    <h6 class="card-subtitle mb-2 text-muted"></h6> 
                    <p class="card-text">' . $_POST['content'] . '</p> 
                </div> 
                </div> '; 
        $mail->Body =  $noidungthu;  
        
        if(isset($_FILES['file']['name'])) { 
            $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['file']['name'])); 
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) 
                $mail->addAttachment($uploadfile, $_FILES['file']['name']); 
        }  
        
        $mail->smtpConnect(array( 
            "ssl" => array( 
                "verify_peer" => false, 
                "verify_peer_name" => false, 
                "allow_self_signed" => true 
            ) 
        )); 
        
        if($mail->send()) { 
            header("Location:index.php"); 
        } 
    } catch (Exception $e) { 
        echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo; 
    }  
} 
?>