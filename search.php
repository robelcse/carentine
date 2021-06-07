<?php
include 'db.php';
if(isset($_GET['postcode'])){
     $postcode = $_GET['postcode'];
}

if(isset($_GET['state'])){
     $state = $_GET['state'];
}

if(!isset($_GET['postcode']) && !isset($_GET['state'])){
     $none = "";
}

if(isset($_GET['type'])){
     $type = $_GET['type'];
}else{
    $type = 'wanttohelp';
}


?>
<!DOCTYPE html>
<html class="js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Search - Carentine</title>
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
        
        input[type='radio'] {
            height: 1px;
            width: 1px;
            opacity: 0;
        }

        input:checked+.outside .inside {
            -webkit-animation: radio-select 0.1s linear;
            animation: radio-select 0.1s linear;
            -webkit-transform: scale(1, 1);
            transform: scale(1, 1);
        }


        label {
            /*margin: 2em;*/
            font-size: 18px;
            position: relative;
            cursor: pointer;
        }

        .outside {
            display: inline-block;
            position: absolute;
            left: 0;
            top: 50%;
            margin-top: -10px;
            width: 20px;
            height: 20px;
            border: 2px solid grey;
            /*border-radius: 50%;*/
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            background: none;
        }

        .inside {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            display: inline-block;
            /*border-radius: 50%;*/
            width: 10px;
            height: 10px;
            background: #1dbf73;
            left: 3px;
            top: 3px;
            -webkit-transform: scale(0, 0);
            transform: scale(0, 0);
        }

        .no-transforms .inside {
            left: auto;
            top: auto;
            width: 0;
            height: 0;
        }
        
        select {
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
        
        .pagination .active a{
            background: #1dbf73;
            border-color: #1dbf73;
        }
        
        
    </style>
</head>
<body class="home page-template-default page page-id-41">
    <?php include 'includes/nav.php'; ?>
    <div id="container-wrap">
        <main style="min-height:90vh">

            <div class="topper-posts no-topper">
            </div>

            <div class="content">
               
                <div class="container">
                   
                   <div id="postcodeform" <?php if(isset($state)){ echo 'style="display:none"'; } ?>>
                       <h1>Browse by postcode</h1>
                    <form action="search.php" method="get" >
                        <div class="row">
                            <div class="col-lg-8">
                                <input required type="text" class="form-control" placeholder="Enter postcode to search" name="postcode" value="<?php if(isset($postcode)){ echo $postcode; } ?>">
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" style="width:100%;height:50px;background:#1dbf73;border-color:#1dbf73" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                        <br>
                        <label style="padding-left:25px">
                            <input <?php if($type=='wanttohelp'){ echo 'checked'; } ?> type="radio" class="radio-inline" name="type" value="wanttohelp">
                            
                            <span class="outside">
                                <span class="inside"></span>
                            </span>
                            People who want to help
                        </label>
                        <label style="padding-left:25px;margin-left:15px">
                            <input <?php if($type=='wanthelp'){ echo 'checked'; } ?> type="radio" class="radio-inline" name="type" value="wanthelp">
                            <span class="outside">
                                <span class="inside"></span>
                            </span>
                            People who want help
                        </label>
                    </form>
                   </div>
                    
                   <div id="stateform" <?php if(isset($postcode) || isset($none)){ echo 'style="display:none"'; } ?> >
                       <h1>Browse by State</h1>
                    <form action="search.php" method="get" >
                        <div class="row">
                            <div class="col-lg-8">
                                <select required name="state" class="" id="">
                                   <option value="">Select</option>
                                    <?php
                                    $stmt = $sql->prepare("select * from states order by name asc");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                    foreach($result as $row){
                                    ?>
                                    <option <?php if(isset($state)){ if($state==$row['id']){ echo 'selected'; } } ?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" style="width:100%;height:50px;background:#1dbf73;border-color:#1dbf73" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                        <br>
                        <label style="padding-left:25px">
                            <input <?php if($type=='wanttohelp'){ echo 'checked'; } ?> type="radio" class="radio-inline" name="type" value="wanttohelp">
                            
                            <span class="outside">
                                <span class="inside"></span>
                            </span>
                            People who want to help
                        </label>
                        <label style="padding-left:25px;margin-left:15px">
                            <input <?php if($type=='wanthelp'){ echo 'checked'; } ?> type="radio" class="radio-inline" name="type" value="wanthelp">
                            <span class="outside">
                                <span class="inside"></span>
                            </span>
                            People who want help
                        </label>
                    </form>
                   </div>
                   
                   <?php
                        $limit = 5;
                        if(isset($postcode)){
                            $query = "select a.*, b.name as state from posts as a left join states as b on a.state=b.id where postcode=? AND post_type=? order by emergency desc";
                            $stmt = $sql->prepare($query);
                            $stmt->bindParam(1, $postcode, PDO::PARAM_STR);
                        }else{
                            $query = "select a.*, b.name as state from posts as a left join states as b on a.state=b.id where state=? AND post_type=? order by emergency desc";
                            $stmt = $sql->prepare($query);
                            $stmt->bindParam(1, $state, PDO::PARAM_STR);
                        }

                        $stmt->bindParam(2, $type, PDO::PARAM_STR);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        $total = $stmt->rowCount();
                        $total_pages = ceil($total/$limit);

                        if (!isset($_GET['page'])) {
                            $page = 1;
                        } else{
                            $page = $_GET['page'];
                        }
                    
                        $starting_limit = ($page-1)*$limit;
                    ?>
                    
                    
                    <?php if(isset($postcode) || isset($state)){ ?>
                    <div class="latest-projects">
                        <?php
                            if(isset($postcode)){
                                $query = "select a.*, b.name as state from posts as a left join states as b on a.state=b.id where postcode=? AND post_type=? order by emergency desc LIMIT ?,?";
                                $stmt = $sql->prepare($query);
                                $stmt->bindParam(1, $postcode, PDO::PARAM_STR);
                            }else{
                                $query = "select a.*, b.name as state from posts as a left join states as b on a.state=b.id where state=? AND post_type=? order by emergency desc LIMIT ?,?";
                                $stmt = $sql->prepare($query);
                                $stmt->bindParam(1, $state, PDO::PARAM_STR);
                            }
                            
                            $stmt->bindParam(2, $type, PDO::PARAM_STR);
                            $stmt->bindParam(3, $starting_limit, PDO::PARAM_INT);
                            $stmt->bindParam(4, $limit, PDO::PARAM_INT);
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            //$total = $stmt->rowCount();
                        ?>
                        
                        
                        <h2><?php echo $total; ?> 
                        <?php if($type=='wanttohelp'){ echo 'people want to help'; }else{ echo 'people want help'; } ?>
                        <?php if($total==0){ ?>
                        
                        <?php if(isset($postcode)){ ?>
                        <br><a href="#!" id="browsebystate" style="font-size:15px">Browse by state</a>
                        <?php }else{ ?>
                        <br><a href="#!" id="browsebypostcode" style="font-size:15px">Browse by postcode</a>
                        <?php } ?>
                        
                        <?php } ?>
                        </h2>
                        <?php foreach($result as $row){ ?>
                        <div class="latest-project">
                            <div class="">
                                <div class="project-title"><?php if(!empty($row['suburb'])){ echo $row['suburb'].', '; } ?> <?php echo $row['state']; ?></div>
                                <p><?php echo substr($row['description'], 0, 250).'....'; ?></p>
                                <a href="view-request.php?id=<?php echo $row['id']; ?>">View this post</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <center>
                    <ul class="pagination">
                    <?php for($page=1; $page <= $total_pages ; $page++){ 
                        if(isset($_GET['page']) && $_GET['page']==$page){ $class='active'; }else{ $class=""; }    
                    ?>
                      <?php if(isset($postcode)){ ?>
                       <li class="<?php echo $class; ?>">
                           <a href='<?php echo "?postcode=$postcode&type=$type&page=$page"; ?>' class="links"><?php  echo $page; ?></a>
                       </li>
                      <?php }else{ ?>
                       <li class="<?php echo $class; ?>">
                           <a href='<?php echo "?state=$state&type=$type&page=$page"; ?>' class="links"><?php  echo $page; ?></a>
                       </li>
                      <?php } ?>
                    <?php } ?>
                    </ul>
                    </center>
                    
                <?php } ?>
                </div>
           
            </div>
        </main>
        <?php include 'includes/footer.php'; ?>
    
    </div> <!-- #container-wrap -->
    <script type='text/javascript' src='assets/js/TweenMax.min.js.download'></script>
    <script type='text/javascript' src='assets/js/ScrollMagic.min.js.download'></script>
    <script type='text/javascript' src='assets/js/animation.gsap.min.js.download'></script>
    <script type='text/javascript' src='assets/js/debug.addIndicators.min.js.download'></script>
    <script type='text/javascript' src='assets/js/scripts.min.js.download'></script>
    <script>
    jQuery('#browsebystate').click(function(){
        jQuery("#postcodeform").hide();
        jQuery(".latest-projects").hide();
        jQuery("#stateform").show();
    });
        
    jQuery('#browsebypostcode').click(function(){
        jQuery("#stateform").hide();
        jQuery(".latest-projects").hide();
        jQuery("#postcodeform").show();
    });
    
    
    </script>
</body>

</html>