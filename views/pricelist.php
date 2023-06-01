<section class="pricing_section" id="pricing">
    <div class="container">
        <div class="section_heading">
            <h3>20% em tratamento SPA</h3>
            <h2>Preçário da nossa barbearia</h2>
            <div class="heading-line"></div>
        </div>
        <div class="row">
            <?php
            $prevCategory = null;
            foreach ($categories as $category):
                $currentCategory = $category['category_name'];
                if ($currentCategory !== $prevCategory):
                    ?>
                    <div class="col-lg-4 col-md-6 sm-padding">
                        <div class="price_wrap">
                            <h3>
                                <?php echo $currentCategory; ?>
                            </h3>
                            <ul class="price_list">
                                <?php foreach ($categories as $service): ?>
                                    <?php if ($service['category_name'] === $currentCategory): ?>
                                        <li>
                                            <h4>
                                                <?php echo $service['name']; ?>
                                            </h4>
                                            <p>
                                                <?php echo $service['description']; ?>
                                            </p>
                                            <span class="price">€
                                                <?php echo $service['price']; ?>
                                            </span>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                    $prevCategory = $currentCategory;
                endif;
            endforeach;
            ?>
        </div>
    </div>
</section>