<?php
session_start();
include 'db.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $sql->prepare("select a.*, b.name as state from posts as a left join states as b on a.state=b.id where a.id=?");
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
}else{
    header("location:index.php");
}


function get_starred($str) {
    $len = strlen($str);
    return str_repeat('*', 6).substr($str, 6);
}


?>
<!DOCTYPE html>
<html class="js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Request #<?php echo $id; ?> - Carentine</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.css">
    <?php include 'includes/head.php'; ?>
    <style>
        
        @media only screen and (max-width : 768px) { 
            header .logo a.logo-text {
                margin-top: -15px !important;
            }
            .hamburger {
               margin: 0;
            }
            
            .modal{
                top: 30%;
            }
        }
        
        .modal {
          text-align: center;
        }

        @media screen and (min-width: 768px) { 
          .modal:before {
            display: inline-block;
            vertical-align: middle;
            content: " ";
            height: 100%;
          }
        }

        .modal-dialog {
          display: inline-block;
          text-align: left;
          vertical-align: middle;
        }
        
        textarea {
            margin-bottom: 15px;
        }

        input[type="number"] {
            background: #fff;
            height: 50px;
            padding: 10px 20px;
            -webkit-transition: background .25s ease;
            -moz-transition: background .25s ease;
            -o-transition: background .25s ease;
            -ms-transition: background .25s ease;
            transition: background .25s ease;
            float: left;
            width: 100%;
            outline: 0;
            border: 1px solid #ccc;
            color: #000;
            font-size: 20px;
            font-family: PSFournierWebRegular;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, .08);
        }
        
        .row{
            margin-bottom: 30px;
        }
        
        body { padding-right: 0 !important }
        
        
    </style>
</head>

<body class="home page-template-default page page-id-41">
<?php include 'includes/nav.php'; ?>
<div id="container-wrap">
<main>
<div class="topper-posts no-topper"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; unset($_SESSION['message']); } ?>
                <h1><small><a href="#!" onclick="window.history.go(-1); return false;"><i class='fa fa-chevron-left'></i></a></small> <?php if($row['post_type']=='wanthelp'){ echo 'Want help'; }else{ echo 'Want to help'; }  ?></h1>
                <div class="description" style="margin-bottom:50px">
                    <p>Requested on <?php echo date('d M, Y', strtotime($row['time'])); ?>
                       <?php if($row['emergency']==1){ ?><br> <span style="color:red"> This is an emergency.</span> <?php } ?>
                       <br> Status:
                        <?php 
                            if($row['status']=='open'){ echo '<span style="color:#1dbf73"><b>Open</b></span>'; } 
                            if($row['status']=='inprogress'){ echo '<span style="color:orange"><b>In Progress</b></span>'; } 
                            if($row['status']=='closed'){ echo '<span style="color:red"><b>Closed</b></span>'; } 
                        ?>
                        <br><span style="color:#1dbf73;cursor:pointer;font-size:15px"><a href="update-post.php?id=<?php echo $row['id']; ?>">Update this post or change status</a></span>
                        <br><span style="color:#1dbf73;cursor:pointer;font-size:15px"><a href="rate-post.php?post-id=<?php echo $row['id']; ?>">Rate this post</a></span>
                    </p>
                    
                    
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="" style="height:100%;width:100%">
                            <a href="#!"></a>
                            <div class="wrapper">
                               <?php if($row['status']!='closed'){ ?>
                                <h5>Phone</h5>
                                <p id="postphone"><?php echo get_starred($row['phone']); ?>
                                <br>
                                <span id='submitnumsmall' data-toggle="modal" data-target="#myModal" style="color:#1dbf73;cursor:pointer"><u>Submit your phone number to see the full number</u></span>
                                
                                </p>
                                <?php }else{ ?>
                                <h5>Phone</h5>
                                <p id="postphone"><?php echo get_starred($row['phone']); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-issue inner-issue" style="height:100%;width:100%">
                            <a href="#!"></a>
                            <div class="wrapper">
                                <h5>Suburb</h5>
                                <p><?php echo empty($row['suburb'])?'N/A' : $row['suburb']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="single-issue inner-issue" style="height:100%;width:100%">
                            <a href="#!"></a>
                            <div class="wrapper">
                                <h5>Post Code</h5>
                                <p><?php echo $row['postcode']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-issue inner-issue" style="height:100%;width:100%">
                            <a href="#!"></a>
                            <div class="wrapper">
                                <h5>State</h5>
                                <p><?php echo $row['state']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-issue inner-issue" style="height:100%;width:100%">
                            <a href="#!"></a>
                            <div class="wrapper">
                                <h5>Address</h5>
                                <p><?php echo $row['address']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-issue inner-issue" style="height:100%;width:100%">
                            <a href="#!"></a>
                            <div class="wrapper">
                                <h5>Description</h5>
                                <p><?php echo $row['description']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</div> <!-- #container-wrap -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:0">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Submit Phone Number</h4>
            </div>
            <div class="modal-body">
                <form action="" id="submitphone">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="msg"></div>
                            <div class="form-group">
                                <input id="" required name="phone" type="text" class="form-control numeric" placeholder="Example: 0430174622">
                                <input type="hidden" name="postid" value="<?php echo $id; ?>">
                            </div>
                            <button id="submitbtn" class="btn btn-sm" style="width:30%;background:#1dbf73;border-color:#1dbf73;height:50px">Submit</button>
                        </div>
                    </div>
                </form>
                <form action="" id="verifycode" style="display:none">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="alert alert-success">
                                    Please enter the verification PIN we have sent to your phone.
                                </div>
                                <input required name="code" type="text" class="form-control numeric" placeholder="Enter the verification PIN">
                                <input type="hidden" name="postid" value="<?php echo $id; ?>">
                            </div>
                            <button id="submitcodebtn" class="btn btn-sm" style="width:30%;background:#1dbf73;border-color:#1dbf73;height:50px">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.js"></script>
<script type='text/javascript' src='assets/js/TweenMax.min.js.download'></script>
<script type='text/javascript' src='assets/js/ScrollMagic.min.js.download'></script>
<script type='text/javascript' src='assets/js/animation.gsap.min.js.download'></script>
<script type='text/javascript' src='assets/js/debug.addIndicators.min.js.download'></script>
<script type='text/javascript' src='assets/js/scripts.min.js.download'></script>
<script>
jQuery(function($) {
    $("#submitphone").on('submit', function(e){
        e.preventDefault();
        $("#submitbtn").html('Please wait...');
        var data = $(this).serialize();
        setTimeout(function(){
            $.ajax({
                type:"POST",
                url:'submit-phone.php',
                data:data,
                success: function(response){
                    $("#submitbtn").html('Submit');
                    var data = JSON.parse(response);
                    console.log(data);
                    $('#submitphone')[0].reset();
                    $('#verifycode')[0].reset();
                    if(data.phone_exists==1){
                        $("#postphone").html(data.post_phone);
                        $("#submitnumsmall").hide();
                        $("#myModal").modal("hide");
                    }else if(data.error == 1){
                        $("#msg").html(data.message);
                    }else{
                        $("#submitphone").hide();
                        $("#verifycode").show();
                    }
                }
            });
        }, 1000);
    });
    
    $("#verifycode").on('submit', function(e){
        e.preventDefault();
        $("#submitcodebtn").html('Verifying...');
        var data = $(this).serialize();
        setTimeout(function(){
            $.ajax({
                type:"POST",
                url:'submit-phone.php',
                data:data,
                success: function(response){
                    $("#submitcodebtn").html('Submit');
                    var data = JSON.parse(response);
                    console.log(data);
                    $('#submitphone')[0].reset();
                    $('#verifycode')[0].reset();
                    if(data.error==0){
                        $("#postphone").html(data.post_phone);
                        $("#submitnumsmall").hide();
                        $("#myModal").modal("hide");
                    }else{
                        $("#submitphone").show();
                        $("#msg").html(data.message);
                        $("#verifycode").hide();
                    }
                }
            });
        }, 1000);
    });
});

jQuery(document).on("input", ".numeric", function() {
    this.value = this.value.replace(/\D/g,'');
});
</script>
</body>
</html>