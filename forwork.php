<?php
    session_start();
    include('connect.php');

    error_reporting(0);
    if($_SESSION['accountID'] == ""){
        echo "<script>alert('Please Login!');</script>";
        echo "<script>window.location='login.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
    />
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/forwork.css?v=<?=time();?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
</head>
<body >
    <div class="main-container" >
        <div id="navbaron"></div>
        <div class="mainbody">
            <form action="checkwork.php" method="POST" id="checkwork1">
                <div class="photo1">
                    <div class="Box1"> 
                        <h1>แบบฟอร์มการจ้างงาน</h1>
                        <div class="Box1_1">
                            <label for="name" class="label2">Name</label><br>
                            <input type="text" id="name" name="name" placeholder="ชื่อ-นามสกุล"><br><br>
                            <label for="phone" class="label2">Phone (ใช้เบอร์จริงที่สามารถรับ SMS ได้)</label><br>
                            <input type="text" id="phone" name="phone" placeholder="Phone number"><br><br>
                            <label for="work">Choose a work</label><br>

                            <select name="work" id="work">
                            <option value="prewedding">Pre Wedding</option>
                            <option value="wedding">Wedding</option>
                            <option value="graduation">Graduation</option>
                            <option value="event">Event</option>
                            </select>
                            <br><br>
                            <label for="time">Choose a time</label><br>

                            <select name="time" id="time">
                            <option value="halfdaymo">ครึ่งวันเช้า</option>
                            <option value="halfdayaf">ครึ่งวันบ่าย</option>
                            <option value="allday">เต็มวัน</option>
                            </select><br><br>

                            <label for="date">Date</label><br>
                            
                            <input type="date" id="birthday" name="birthday" ><br><br>

                            <label for="photo">Photographer</label><br>

                            <select name="photo" id="photo">
                            <option value="a">a</option>
                            <option value="b">b</option>
                            <option value="c">c</option>
                            <option value="e">e</option>
                            </select>
                            <br><br>

                            <label for="w3review">รายละเอียดเพิ่มเติม</label><br>
                            <label for="w3review">(กรอกสถานที่ และอื่นๆที่ต้องการบอกช่างภาพ)</label><br>
                            <textarea name="story" id="" rows="4" cols="50" ></textarea>
                        </div>
                        <div class="submit">
                            <br><button id="checkwork2" type="submit">Submit</button>
                        </div>
                    </div>
                </div> 
            </form>
        </div>
    </div>
</div>
<footer>
    <div class="foot">
        <span>Copyright Website Photographer © 2021 Design by ท็อปโครตกีม</span>
    </div>
</footer>
</body>
<script type="text/javascript">

    $.get("navbar.php", function(data){
        $("#navbaron").replaceWith(data);
    });

$(document).ready(function()
{
    $("#checkwork2").click(function(e)
    {
        e.preventDefault();
        $.ajax(
        {
            type: "POST",
            url:  "checkwork.php",
            data: $("#checkwork1").serialize(),
            success:function(result)
            {
                if(result.status == 0)
                {
                    swal({
                        title: "ผิดพลาด!",
                        text: "คุณได้ทำการส่งแบบฟอร์มไปแล้วกรุณารอทางผู้ดูแลยืนยันและติดต่อกลับ!",
                        type: "error",
                        showButtonCancel: true,
                    }, function(isConfirm) {
                            if(isConfirm){
                                window.location = "index.php";
                            }
                            if(isCancel){
                                window.location = "index.php";
                            }
                    });
                }
                else if(result.status == 1)
                {
                    swal({
                        title: "สำเร็จ!",
                        text: "ระบบได้ทำการส่งแบบฟอร์มการจ้างงานไปยังผู้ดูแลแล้ว!",
                        type: "success",
                        showButtonCancel: true,
                    }, function(isConfirm) {
                            if(isConfirm){
                                window.location = "index.php";
                            }
                            if(isCancel){
                                window.location = "index.php";
                            }
                    });
                }
                else if(result.status == 2)
                {
                    swal({
                        title: "ผิดพลาด!",
                        text: "คุณจำเป็นต้องกรอกชื่อของคุณ!",
                        type: "error",
                        showButtonCancel: true,
                    }, function(isConfirm) {
                            if(isConfirm){
                                window.location = "forwork.php";
                            }
                            if(isCancel){
                                window.location = "forwork.php";
                            }
                    });
                }
                else if(result.status == 3)
                {
                    swal({
                        title: "ผิดพลาด!",
                        text: "คุณจำเป็นต้องกรอกเบอร์โทรศัพท์!",
                        type: "error",
                        showButtonCancel: true,
                    }, function(isConfirm) {
                            if(isConfirm){
                                window.location = "forwork.php";
                            }
                            if(isCancel){
                                window.location = "forwork.php";
                            }
                    });
                }
                else if(result.status == 4)
                {
                    swal({
                        title: "ผิดพลาด!",
                        text: "ช่วงเวลาที่คุณเลือกไม่ว่างกรุณาเลือกวันนัดใหม่!",
                        type: "error",
                        showButtonCancel: true,
                    }, function(isConfirm) {
                            if(isConfirm){
                                window.location = "forwork.php";
                            }
                            if(isCancel){
                                window.location = "forwork.php";
                            }
                    });
                }
                else if(result.status == 5)
                {
                    swal({
                        title: "ผิดพลาด!",
                        text: "คุณจำเป็นต้องเลือกวันที่จ้างงาน!",
                        type: "error",
                        showButtonCancel: true,
                    }, function(isConfirm) {
                            if(isConfirm){
                                window.location = "forwork.php";
                            }
                            if(isCancel){
                                window.location = "forwork.php";
                            }
                    });
                }
            }
        });

    });
});
</script>
<script>

    $.get("navbar.php", function(data){
        $("#navbaron").replaceWith(data);
    });

function myFunction() {

  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
function clickme(){
      swal({
          title: "ออกจากระบบ",
          text: "คุณออกจากระบบสำเร็จ!",
          type: "success",
          showButtonCancel: true,
      }, function(isConfirm) {
              if(isConfirm){
                  window.location = "logout.php";
              }
              if(isCancel){
                  window.location = "logout.php";
              }
      });
  }
</script>
</html>