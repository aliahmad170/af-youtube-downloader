<?php require './function.php'; $error = "";?>
<html lang="en" class="h-100">
<head>
   

    
    
    
    
   
   
    <link href="img/favicon.ico" rel="icon">

   

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href=" {{ asset('C:\Users\ali-fhas\Desktop\laravel course\Youtube-Downloader\public\assets\lib\owlcarousel\assets\owl.carousel.min.css') }}"rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('C:\Users\ali-fhas\Desktop\laravel course\Youtube-Downloader\public\assets\css\style.css')}}" rel="stylesheet">

    <link rel="shortcut icon" href="{{asset('assets\img\images.jpeg')}}">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4645016582538623"
     crossorigin="anonymous"></script>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
<!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.css" rel="stylesheet">
<style>
    body {
        font-family: 'Montserrat', sans-serif;
    }
    .formSmall {
        width: 700px;
        margin: 20px auto 20px auto;
    }
</style>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>

<div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="index.html" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-uppercase text-primary">AF Youtube Downloader</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    
                     <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">language</a>
                        
                            
                        
                    </div> 
                  
                </div>
                
            </div>
        </nav>
    </div>
    
   
            <h6 class="text-white display-6 mb-5">download any video from Youtube for free</h6>
           
<body>
    <div class="container">
        <form method="post" action="" class="formSmall">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-align"> Download YouTube Video</h2>
                </div>
                <div class="col-lg-12">
                    <div class="input-group">
                        <input type="text" class="form-control" name="video_link" placeholder="Please Paste link.. " <?php if(isset($_POST['video_link'])) echo "value='".$_POST['video_link']."'"; ?>>
                        <span class="input-group-btn">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Go!</button>
                      </span>
                    </div>
                </div>
            </div>
        </form>

        <?php if(isset($_POST['submit'])): ?>


<?php 
$video_link = $_POST['video_link'];
preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_link, $match);
$video_id =  $match[1];
$video = json_decode(getVideoInfo($video_id));
$formats = $video->streamingData->formats;
$adaptiveFormats = $video->streamingData->adaptiveFormats;
$thumbnails = $video->videoDetails->thumbnail->thumbnails;
$title = $video->videoDetails->title;
$short_description = $video->videoDetails->shortDescription;
$thumbnail = end($thumbnails)->url;
?>


<div class="row formSmall">
    <div class="col-lg-3">
        <img src="<?php echo $thumbnail; ?>" style="max-width:100%">
    </div>
    <div class="col-lg-9">
        <h2><?php echo $title; ?> </h2>
        <p><?php echo str_split($short_description, 100)[0]; ?></p>
    </div>
</div>

<?php if(!empty($formats)): ?>


    <?php if(@$formats[0]->url == ""): ?>
    <div class="card formSmall">
        <div class="card-header">
            <strong>This video is currently not supported by our downloader!</strong>
            <small><?php 
            $signature = "https://example.com?".$formats[0]->signatureCipher;
                        parse_str( parse_url( $signature, PHP_URL_QUERY ), $parse_signature );
                        $url = $parse_signature['url']."&sig=".$parse_signature['s'];
                   ?>
            </small>
        </div>
    </div>
    <?php 
    die();
    endif;
    ?>
    
    <div class="card formSmall">
        <div class="card-header">
            <strong>With Video & Sound</strong>
        </div>
        
        <div class="card-body">
            <table class="table ">
                <tr>
                    <td>URL</td>
                    <td>Type</td>
                    <td>Quality</td>
                    <td>Download</td>
                </tr>
                <?php foreach($formats as $format): ?>
                    <?php
                    
                    if(@$format->url == ""){
                        $signature = "https://example.com?".$format->signatureCipher;
                        parse_str( parse_url( $signature, PHP_URL_QUERY ), $parse_signature );
                        $url = $parse_signature['url']."&sig=".$parse_signature['s'];
                    }else{
                        $url = $format->url;
                    }
                    
                        
                    
                    
                    ?>
                    <tr>
                        <td><a href="<?php echo $url; ?>">Test</a></td>
                        <td>
                            <?php if($format->mimeType) echo explode(";",explode("/",$format->mimeType)[1])[0]; else echo "Unknown";?>
                        </td>
                        <td>
                            <?php if($format->qualityLabel) echo $format->qualityLabel; else echo "Unknown"; ?>
                        </td>
                        <td>
                            <a 
                                href="downloader.php?link=<?php echo urlencode($url)?>&title=<?php echo urlencode($title)?>&type=<?php if($format->mimeType) echo explode(";",explode("/",$format->mimeType)[1])[0]; else echo "mp4";?>"
                            >
                                Download
                            </a> 
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <h5>scroll down for more format </h5>
        </div>
        
    </div>
    
    <!-- Your code here for additional formats -->
    <div class="card formSmall">
    <div class="card-header">
        <strong>Videos video only/ Audios audio only</strong>
    </div>
    <div class="card-body">
        <table class="table ">
            <tr>
                <td>Type</td>
                <td>Quality</td>
                <td>Download</td>
            </tr>
            <?php foreach ($adaptiveFormats as $video) :?>
                <?php
                try{
                    $url = $video->url;
                }catch(Exception $e){
                    $signature = $video->signatureCipher;
                    parse_str( parse_url( $signature, PHP_URL_QUERY ), $parse_signature );
                    $url = $parse_signature['url'];
                }
                
                ?>
                <tr>
                    <td><?php if(@$video->mimeType) echo explode(";",explode("/",$video->mimeType)[1])[0]; else echo "Unknown";?></td>
                    <td><?php if(@$video->qualityLabel) echo $video->qualityLabel; else echo "Unknown"; ?></td>
                    <td><a href="downloader.php?link=<?php print urlencode($url)?>&title=<?php print urlencode($title)?>&type=<?php if($video->mimeType) echo explode(";",explode("/",$video->mimeType)[1])[0]; else echo "mp4";?>">Download</a> </td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>

   
    
<?php endif; ?>


<?php endif; ?>
    </div>
    
    </div>
    </div>
    


   
    



    
   


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>


   


<div class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-3 item">
                        <h3>AF</h3>
                        <ul>
                        <li>   <p><i class="fa fa-phone-alt mr-2"></i>+961 81 528 892</p></li>
                            <li>      <p><i class="fa fa-envelope mr-2"></i>aliahmadfahs17@gmail.com</p></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-3 item">
                        <h3>About</h3>
                        <ul>
                            
                            <li> <a class="text-white-50 mb-2" href="{{route('privacy')}}"><i class="fa fa-angle-right mr-2"></i>Privacy Policy</a></li>
                           <li> <a class="text-white-50" href="{{route('contact')}}"><i class="fa fa-angle-right mr-2"></i>Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 item text">
                        <h3>AF</h3>
                        <p>downlad all youtube video free....</p>
                    </div>
                    <div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div>
                </div>
                <p class="m-7">Copyright &copy; <a class="text-black" href="#">AF Youtube Downloader </a>. All Rights Reserved.
            </div>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
</html>