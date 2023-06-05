<section id="team" class="team_section">
    <div class="container">
        <div class="section_heading ">
            <h3>Salão & Spa</h3>
            <h2>Nossos Barbeiros</h2>
            <div class="heading-line"></div>
        </div>
        <ul class="team_members row">
            <?php foreach ($barbers as $barber) { ?>
                <li class="col-lg-3 col-md-6 padd_col_res">
                    <div class="team_member">
                        <img src="/design/images/<?php echo $barber['photo']; ?>" alt="Team Member">
                        <span>
                            <?php echo $barber['first_name']; ?>
                        </span>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</section>