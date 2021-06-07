<!DOCTYPE html>
<html class="js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Carentine - A donation can spread joy</title>
    <meta http-equiv="content-language” content=”en-us”>

     <meta charset="UTF-8">
  <meta name="description" content="Give a toy to a kid. Give food to a poor man. Drive an ill woman to a hospital. Help a jobless man. Or just talk to a depressed person.">
  <meta name="keywords" content="help, carentine">
  <meta name="author" content="Carentine">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta property="og:title" content="Carentine">
<meta property="og:site_name" content="Carentine">
<meta property="og:url" content="http://www.carentine.com/">
<meta property="og:description" content="Give a toy to a kid. Give food to a poor man. Drive an ill woman to a hospital. Help a jobless man. Or just talk to a depressed person.">
<meta property="og:type" content="article">
<meta property="og:image" content="http://carentine.com/assets/images/logo.png">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.css">
    <script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-37672-2', 'auto');
ga('send', 'pageview');
</script>
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
            
            .statuscheck{
                display: flex;
                margin-left: 0 !important;
            }
        }
        
        a:hover{
            text-decoration: none;
        }

        footer{
            border-top: 0;
        }
    </style>
</head>

<body class="home page-template-default page page-id-41">
<script type='application/ld+json'> 
{
  "@context": "http://www.schema.org",
  "@type": "WebSite",
  "name": "Carentine",
  "alternateName": "Carentine",
  "url": "http://www.carentine.com/"
}
 </script>
<?php include 'includes/nav.php'; ?>
    <div id="container-wrap">
        <main>
        <div class="topper tall home" style="background: url(assets/images/mask-man-bg.jpg) no-repeat center center">
                <div class="overlay" style="opacity: 0.6;"></div>
                <div class="container" style="opacity: 1;">
                    <div class="row">
                        <div class="col-xs-12">
                            <h1 style="opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);">
                                 <p id="hometitle">Browse nearby people who want to help</p>
                                <form action="search.php" method="get">
                                    <input  style="opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);" type="text" class="form-control" placeholder="Enter Postcode" name="postcode">
                                    <input type="hidden" name="type" value="wanttohelp">
                                </form>
                            </h1>
                            
                        </div>
                    </div>
                </div>
            </div>


            <ul class="home-nav">
                <li>
                    <a href="want-help.php">
                        <div class="container">
                            Want help? </div>
                    </a>
                </li>
                <li>
                    <a href="want-to-help.php">
                        <div class="container">
                            Want to help? </div>
                    </a>
                </li>
                <li>
                    <a href="find-posts.php">
                        <div class="container">
                            Find your post and rate users </div>
                    </a>
                </li>
                <li>
                    <a href="companies.php">
                        <div class="container">
                            Are you an organization or business?  </div>
                    </a>
                </li>
                
            </ul>
        </main>
    <?php include 'includes/footer.php'; ?>
    </div> <!-- #container-wrap -->
    <script type='text/javascript' src='assets/js/TweenMax.min.js.download'></script>
    <script type='text/javascript' src='assets/js/ScrollMagic.min.js.download'></script>
    <script type='text/javascript' src='assets/js/animation.gsap.min.js.download'></script>
    <script type='text/javascript' src='assets/js/debug.addIndicators.min.js.download'></script>
    <script type='text/javascript' src='assets/js/scripts.min.js.download'></script>

    <script>
        function getURLParameter(name) {
            return decodeURI(
                (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search) || [, null])[1]
            );
        }

        function createCookie(name, value, days) {
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                var expires = "; expires=" + date.toGMTString();
            } else var expires = "";
            document.cookie = name + "=" + value + expires + "; path=/";
        }

        function readCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function eraseCookie(name) {
            createCookie(name, "", -1);
        }
        jQuery(function($) {
            $('header .contribute-link a').each(function(i, val) {
                var url = $(this).attr('href');
                var source = getURLParameter('source');
                if (source == 'null') {
                    source = 'website';
                }
                if (readCookie('source') !== null) {
                    source = readCookie('source');
                }
                url = url.replace('website', source);
                url = url.replace('=homepage', '=' + source);
                console.log(source);
                $(this).attr('href', url);
                if (source != 'website') {
                    history.replaceState(null, null, "?source=" + source);
                }
            });
        });
    </script>

</body>

</html>