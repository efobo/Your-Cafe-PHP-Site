<?php include('partials-front/menu.php'); ?>

<?php

    if (isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];

        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    }
    else
    {
        header('location:'.SITEURL);
    }
?>


    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <div class="food-search-box text-center">
            
                <h2>Foods on <a href="#">"<?php echo $category_title; ?>"</a></h2>
            </div>
        </div>
    </section>
    <!-- Food Search Section Ends Here -->


    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
            
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);

                if ($count2 > 0)
                {
                    while ($row2 = mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if ($image_name == "")
                                    {
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL;?>img/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                
                            </div>
                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price;?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order now</a>
                            </div>

                            <div class="clearfix"></div>

                        </div>

                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Food not Available</div>";
                }
            ?>
            
            

            

            <div class="clearfix"></div>
            
        </div>

        <p class="text-center">
            <a href="#">See All Menu</a>
        </p>
    </section>
    <!-- Food Menu Section Ends Here -->

    
    <?php include('partials-front/footer.php'); ?>