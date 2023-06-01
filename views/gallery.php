<section class="gallery-section" id="gallery">
    <div class="section_heading">
        <h3>Salão & Spa</h3>
        <h2>Galeria de Cortes</h2>
        <div class="heading-line"></div>
    </div>
    <div class="container">
        <div class="row">
            <?php foreach ($images as $image) { ?>
                <div class="col-lg-3 col-md-6 gallery-column">
                    <div style="height: 230px;">
                        <div class="gallery-img">
                            <img src="/design/images/<?php echo $image['photo']; ?>" alt="Gallery Image">
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>