<?php
session_start();
// if(empty($_SESSION['clientId']) || $_SESSION['clientId'] == ''){
//     header("Location:index.php");
//     die();
// }
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'include/head.php' ?>
</head>

<body>
    <?php include 'include/nav.php' ?>

    <!-- Header carousel Start-->
    <div id="header-carousel">
        <div class="header-carousel-container">
            <div id="headerCarousel" class="carousel  slide carousel-fade" data-ride="carousel">
                <ul class="carousel-indicators">
                    <li data-target="#headerCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#headerCarousel" data-slide-to="1"></li>
                    <!-- <li data-target="#headerCarousel" data-slide-to="2"></li> -->
                </ul>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="carousel-background"><img src="img/weignt-hero.jpg" alt=""></div>
                        <div class="carousel-container">
                            <div class="carousel-content">
                                <h2>AX Fitness</h2>
                                <p>
                                    Your Weight Loss Expert
                                </p>
                                <a href="appointment.php" class="btn-get-started scrollto">Book Now</a>

                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="carousel-background"><img src="img/boxing-hero.jpg" alt=""></div>
                        <div class="carousel-container">
                            <div class="carousel-content">
                            <h2>AX Fitness</h2>
                                <p>
                                    Your Weight Loss Expert
                                </p>
                                <a href="appointment.php" class="btn-get-started scrollto">Book Now</a>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="carousel-item">
                        <div class="carousel-background"><img src="img/lift-hero.jpg" alt=""></div>
                        <div class="carousel-container">
                            <div class="carousel-content">
                                <h2>AX Fitness</h2>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry
                                </p>
                                <a href="appointment.php" class="btn-get-started scrollto">Book Now</a>
                            </div>
                        </div>
                    </div> -->
                </div>

                <a class="carousel-control-prev" href="#headerCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon fa fa-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#headerCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon fa fa-chevron-right" aria-hidden="true"></span>
                </a>

            </div>
        </div>
    </div>
    <!-- Header carousel End-->

    <!-- About Us Start-->
    <div id="about">



        <div class="container-fluid">
            <div class="section-header">
                <h2>Welcome to AX Fitness</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="welcome m-auto">
                        <p>
                            AX fitness aims to help you with any of your fitness goals whether it be weight loss and strength conditioning
                            or boxing training, they have it. They also have a bunch of branches so if you’re a beginner searching for
                            the perfect location, AX could be your go-to gym.
                        </p>
                        
                        <!-- <a class="btn" href="#">Read More</a> -->
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    <!-- About Us End-->

    <!-- Services Start -->
    <div id="services">
        <div class="container">
            <div class="section-header">
                <h2>Our Services</h2>
                <p>
                    AX Fitness may offer a variety of additional programs and services, such as
                    boxing, weight loss management, weightlifting and the assistance of coach and trainer
                    in the member.
                </p>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="service-col">
                        <div class="service-icon"><i class="fa fa-television"></i></div>
                        <h3>Boxing</h3>
                        <div class="service-detail">
                            the sport or practice of fighting with the fists, especially with
                            padded gloves in a roped square ring according to prescribed rules.
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-col">
                        <div class="service-icon"><i class="fa fa-laptop"></i> </div>
                        <h3>Weight Lifting</h3>
                        <div class="service-detail">
                            the activity of lifting heavy bars to strengthen the muscles, either for exercise or
                            in a competition.
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-col">
                        <div class="service-icon"><i class="fa fa-cog"></i> </div>
                        <h3>Weight Loss Management</h3>
                        <div class="service-detail">
                            process of adopting long-term lifestyle modification to maintain a
                            healthy body weight on the basis of a person's age, sex and height.
                        </div>
                    </div>
                </div>
                <!--            <div class="col-md-6 col-lg-4">
                        <div class="service-col">
                            <div class="service-icon"><i class="fa fa-cogs"></i> </div>
                            <h3>Game Development</h3>
                            <div class="service-detail">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat mauris non
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="service-col">
                            <div class="service-icon"><i class="fa fa-android"></i> </div>
                            <h3>Apps Development</h3>
                            <div class="service-detail">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat mauris non
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="service-col">
                            <div class="service-icon"><i class="fa fa-television"></i> </div>
                            <h3>Desktop Application</h3>
                            <div class="service-detail">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat mauris non
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="service-col">
                            <div class="service-icon"><i class="fa fa-wordpress"></i> </div>
                            <h3>WordPress Themes</h3>
                            <div class="service-detail">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat mauris non
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="service-col">
                            <div class="service-icon"><i class="fa fa-cog"></i> </div>
                            <h3>WordPress Plugins</h3>
                            <div class="service-detail">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat mauris non
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="service-col">
                            <div class="service-icon"><i class="fa fa-phone"></i> </div>
                            <h3>Support & IT</h3>
                            <div class="service-detail">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat mauris non
                            </div>
                        </div>
                    </div> -->
            </div>
        </div>
    </div>
    <!-- Services End -->


    <!-- Portfolio Start -->
    <!--  <div id="portfolio">
            <div class="container">
                <header class="section-header">
                    <h3 class="section-title">Our Portfolio</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat, mauris non interdum cursus
                    </p>
                </header>

                <div class="row">
                    <div class="col-lg-12">
                        <ul class="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".web-dev">Web Development</li>
                            <li data-filter=".game-dev">Game Development</li>
                            <li data-filter=".app-dev">App Development</li>
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container">
                    <div class="col-lg-4 col-md-6 portfolio-item web-dev">
                        <div class="portfolio-wrap">
                            <figure>
                                <img src="img/portfolio-1.jpg" class="img-fluid" alt="">
                                <a href="img/portfolio-1.jpg" data-lightbox="portfolio" data-title="Lorem ipsum dolor sit" class="link-preview" title="Preview"><i class="fa fa-eye"></i></a>
                                <a href="#" class="link-details" title="More Details"><i class="fa fa-link"></i></a>
                                <h4 class="portfolio-title">Lorem ipsum dolor sit <span>Web Development</span></h4>
                            </figure>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item web-dev">
                        <div class="portfolio-wrap">
                            <figure>
                                <img src="img/portfolio-2.jpg" class="img-fluid" alt="">
                                <a href="img/portfolio-2.jpg" class="link-preview" data-lightbox="portfolio" data-title="Lorem ipsum dolor sit" title="Preview"><i class="fa fa-eye"></i></a>
                                <a href="#" class="link-details" title="More Details"><i class="fa fa-link"></i></a>
                                <h4 class="portfolio-title">Lorem ipsum dolor sit <span>Web Development</span></h4>
                            </figure>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item game-dev">
                        <div class="portfolio-wrap">
                            <figure>
                                <img src="img/portfolio-3.jpg" class="img-fluid" alt="">
                                <a href="img/portfolio-3.jpg" class="link-preview" data-lightbox="portfolio" data-title="Lorem ipsum dolor sit" title="Preview"><i class="fa fa-eye"></i></a>
                                <a href="#" class="link-details" title="More Details"><i class="fa fa-link"></i></a>
                                <h4 class="portfolio-title">Lorem ipsum dolor sit <span>Game Development</span></h4>
                            </figure>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item game-dev">
                        <div class="portfolio-wrap">
                            <figure>
                                <img src="img/portfolio-4.jpg" class="img-fluid" alt="">
                                <a href="img/portfolio-4.jpg" class="link-preview" data-lightbox="portfolio" data-title="Lorem ipsum dolor sit" title="Preview"><i class="fa fa-eye"></i></a>
                                <a href="#" class="link-details" title="More Details"><i class="fa fa-link"></i></a>
                                <h4 class="portfolio-title">Lorem ipsum dolor sit <span>Game Development</span></h4>
                            </figure>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item app-dev">
                        <div class="portfolio-wrap">
                            <figure>
                                <img src="img/portfolio-5.jpg" class="img-fluid" alt="">
                                <a href="img/portfolio-5.jpg" class="link-preview" data-lightbox="portfolio" data-title="Lorem ipsum dolor sit" title="Preview"><i class="fa fa-eye"></i></a>
                                <a href="#" class="link-details" title="More Details"><i class="fa fa-link"></i></a>
                                <h4 class="portfolio-title">Lorem ipsum dolor sit <span>App Development</span></h4>
                            </figure>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item app-dev">
                        <div class="portfolio-wrap">
                            <figure>
                                <img src="img/portfolio-6.jpg" class="img-fluid" alt="">
                                <a href="img/portfolio-6.jpg" class="link-preview" data-lightbox="portfolio" data-title="Lorem ipsum dolor sit" title="Preview"><i class="fa fa-eye"></i></a>
                                <a href="#" class="link-details" title="More Details"><i class="fa fa-link"></i></a>
                                <h4 class="portfolio-title">Lorem ipsum dolor sit <span>App Development</span></h4>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    <!-- Portfolio End -->


    <!-- Contact Start -->
    <div class="contact" id="contact">
        <div class="container">
            <div class="section-header">
                <h3>Contact Us</h3>
                <!-- <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat, mauris non interdum cursus
                </p> -->
            </div>

            <div>


                <div class="col-md">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2734.3411095313336!2d121.39510427649847!3d14.256588493971716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397e255b446ce4d%3A0x7a542d3161be136e!2sAX%20Fitness!5e0!3m2!1sen!2sph!4v1639018885764!5m2!1sen!2sph" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

                </div>

                <?php

          
$query = "SELECT * FROM webDetail where id='1'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
while ($row = mysqli_fetch_array($result)) {
  $name = $row['name'];
  $email = $row['email'];
  $contact = $row['contact'];
}
?>

                <div class="row">
                    <div class="col-10 pt-3">
                        <div class="contact-info">

                            <p><i class="fa fa-map-marker"></i>AX Fitness Bldg, National Hwy, Santa Cruz, 4009 Laguna</p>
                            <p><i class="fa fa-envelope"></i><?php echo $email ?></p>
                            <p><i class="fa fa-phone"></i><?php echo $contact ?></p>


                        </div>
                    </div>
                    <div class="col pt-2">
                        <div class="social">
                            <a href="https://www.facebook.com/AXgym"><i class="fa fa-facebook"></i></a>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <!-- Contact End -->

    <?php include 'include/footer.php'; ?>
</body>

</html>