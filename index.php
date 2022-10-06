<?php
    include_once 'includes/dbh.php';
    $_SESSION['username'] = "Admin";
?>

<!doctype html>
<html lang="en-US">
	<head>
		<title>My Portfolio</title>
        <!-- <link rel='shortcut icon' type='image/x-icon' href='resources/img/favicon.png'>   -->
		<meta name="viewport" content="width = device-width, initial-scale=1.0">
        <meta name="description" content="Php Gallery(learning with mmtuts)">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--for ie & edge support -->
		<meta name="author" content="Sadia Afrin Tarin">
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
		
		<!--<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/> used for animation on scroll-->
		<!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">-->
		<!--<script src="../travelBD/js/all.min.js"></script>-->
		<!--<script src="Prefix_Free.js"></script>   if js not supported in browser-->
		<!--<link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,400,600,700" rel='stylesheet'>-->	
        <!-- Latest compiled and minified CSS -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">-->

        <!-- jQuery library -->
       <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->

        <!-- Popper JS -->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>-->

        <!-- Latest compiled JavaScript -->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>-->
        <link rel="stylesheet"  type="text/css" href= "style.css">
	</head>

	<body>
        <header>
            <a href="index.html" class="header-brand">MMTUTS</a>
            <nav>
                <ul>
                    <li><a href="portfolio.html">Portfolio</a></li>
                    <li><a href="about.html">About me</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </nav>
        </header>  
        
        <main>
            <section class="gallery-links">
                <div class="wrapper">
                    <h2>Gallery</h2>
                    <div class="gallery-container">
                        <?php
                            $sql = "SELECT * FROM gallery ORDER BY orderGallery DESC;";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                echo "SQL statement failed";
                            }else{
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                while($row = mysqli_fetch_assoc($result)){
                                    echo '<a href="#">
                                    <div style="background-image: url(img/gallery/'.$row["imgFullNameGallery"].');"></div>
                                    <h3>'.$row["titleGallery"].'</h3>
                                    <p>'.$row["descGallery"].'</p>
                                    </a>';
                                }
                            } 
                        ?>
                    </div>
                    
                    <?php
                         if(isset($_SESSION['username'])){
                           echo '<div class="gallery-upload">
                                <form action="includes/gallery-upload.php" method="post" enctype="multipart/form-data">
                                    <input type="text" name="filename" placeholder="Filename...">
                                    <input type="text" name="filetitle" placeholder="Image title...">
                                    <input type="text" name="filedesc" placeholder="Image description...">
                                    <input type="file" name="file" >
                                    <button type="submit" name="submit">Upload</button>
                                </form>
                            </div>';
                         }
                    ?>
                </div>
            </section>
        </main>
        
        <div class="wrapper">
            <footer>
                <ul class="footer-links-main">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Cases</a></li>
                    <li><a href="#">Portfolio</a></li>
                    <li><a href="#">About me</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <ul class="footer-links-cases">
                    <li><p>LATEST CASES</p></li>
                    <li><a href="#">MALING SHAOLIN - WEB DEVELOPMENT</a></li>
                    <li><a href="#">EXCELLENTO - WEB DEVELOPMENT.SEO</a></li>
                    <li><a href="#">MMTUTS YOUTUBE CHANNEL</a></li>
                    <li><a href="#">WELTEC - VIDEO PRODUCTION</a></li>
                </ul>
            </footer>
        </div>  
    </body>
</html>