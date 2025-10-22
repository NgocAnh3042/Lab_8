<form action="mail.php" enctype="multipart/form-data" method="POST"> 
    <label for="">Không nhập email là gửi cho nhiều người</label>
    <br>
<input type="text" class="form-control" name="email" placeholder="Email người nhận"> 
<input type="text" class="form-control" name="tieude" placeholder="Tiêu đề"> 
<textarea name="content" id="editor" class="form-control"></textarea> 
<input type="file" class="form-control" name="file"  > 
<button type="submit" name='send_one' class="btn btn-primary">Gửi</button>
