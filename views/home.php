<?php

include "controllers/home.php";


?>
<section class="home-section" id="home-section">
    <div class="home-section-content">
        <div id="home-section-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#home-section-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#home-section-carousel" data-slide-to="1"></li>
                <li data-target="#home-section-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <img class="d-block w-100" src="design/images/barbershop_image_1.jpg" alt="First slide">
                    <div class="carousel-caption d-md-block">
                        <h3>More then a barber</h3>
                        <p>
                            Na nossa barbearia encontrará todo o tipo de serviços
                            <br>
                            com qualidade premium.
                        </p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img class="d-block w-100" src="design/images/barbershop_image_2.jpg" alt="Second slide">
                    <div class="carousel-caption d-md-block">
                        <h3>More then a barber</h3>
                        <p>
                            Na nossa barbearia encontrará todo o tipo de serviços
                            <br>
                            com qualidade premium.
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="design/images/barbershop_image_3.jpg" alt="Third slide">
                    <div class="carousel-caption d-md-block">
                        <<h3>More then a barber</h3>
                            <p>
                                Na nossa barbearia encontrará todo o tipo de serviços
                                <br>
                                com qualidade premium.
                            </p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#home-section-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#home-section-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Seguinte</span>
            </a>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>
</body>

</html>