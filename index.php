<?php include_once("inc_header.php")?>
        <!-- home -->
        <section id="home">
            <img src="<?php echo get_picture('8')?>" alt="main_img">
            <div class="column">
                <p class="desc"><?php echo get_quote('8') ?></p>
                <h2><?php echo get_title('8')?></h2>
                <?php echo maximum_word(get_content('8'),10)?>
                <p><a href="<?php echo create_page_link('8') ?>" class="tbl-pink">Learn more</a></p>
            </div>
        </section>

        <!-- courses -->
        <section id="courses">
            <div class="column">
            <p class="desc"><?php echo get_quote('9') ?></p>
                <h2><?php echo get_title('9') ?></h2>
                <?php echo maximum_word(get_content('9'),20)?>
                <p><a href="<?php echo create_page_link('9') ?>" class="tbl-blue">Learn more</a></p>
            </div>
            <img src="<?php echo get_picture('9')?>"/>
        </section>

        <!-- tutors -->
        <section id="tutors">
            <div class="mid">
                <div class="column">
                    <p class="desc">Our Top Tutors</p>
                    <h2>Tutors</h2>
                    <p>See all top Academia expert tutors that can assist your studies more further! Choose the best with us.</p>
                </div>

                <div class="tutor-list">
                    <?php
                    $sql1   = " select * from tutors order by id desc";
                    $q1     = mysqli_query($conn,$sql1);
                    while($r1 = mysqli_fetch_array($q1)){
                        ?>
                    <div class="card-tutor">
                        <a href="<?php echo create_page_tutors($r1['id'])?>">
                        <img src="<?php echo url_first()."/images/".tutors_photo($r1['id']) ?>"/>
                        <p><?php echo $r1['name']?></p>
                        </a>
                    </div>
                        <?php
                    }


                    ?>

                </div>
            </div>
        </section>

        <!-- partners -->
        <section id="partners">
            <div class="mid">
                <div class="column">
                    <p class="desc">Our Top Partners</p>
                    <h2>Partners</h2>
                    <p>See our partners.</p>
                </div>

                <div class="partner-list">
                    <?php
                    $sql1   = " select * from partners order by id asc ";
                    $q1     = mysqli_query($conn,$sql1);
                    while($r1 = mysqli_fetch_assoc($q1)){
                        ?>
                    <div class="card-partner">
                    <a href="<?php echo create_page_partners($r1['id'])?>">
                    <img src="<?php echo url_first()."/images/".partners_photo($r1['id'])?>"/>
                    </a>
                    </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>
<?php include_once("inc_footer.php")?>