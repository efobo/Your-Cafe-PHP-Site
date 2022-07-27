<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>

        <?php 
        
            if (isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        
        ?>

        <br><br>

        <!-- Button to Add Category -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

        <br><br><br>
        
        <table class="tbl-full">
            <tr>
                <th>S. N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Fearured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            
                $sql = "SELECT * FROM tbl_category";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                $sn = 1;

                if ($count > 0)
                {
                    while ($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>

                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $title; ?></td>

                            <td>
                                <?php
                                
                                    if ($image_name != "")
                                    {
                                        ?>

                                        <img src="<?php echo SITEURL; ?>img/category/<?php echo $image_name; ?>" width="100px">

                                        <?php
                                    }
                                    else
                                    {
                                        echo "<div class='error'>Image Not Added</div>";
                                    }

                                ?>
                            </td>

                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="#" class="btn-secondary">Update Category</a>
                                <a href="#" class="btn-danger">Delete Category</a>
                    
                            </td>
                        </tr>

                        <?php
                    }
                }
                else
                {
                    ?>

                    <tr>
                        <td>
                            <div class="error" colspan="6">No Category Added</div>
                        </td>
                    </tr>

                    <?php
                }
            
            ?>
            <!-- <tr>
                <td>1.</td>
                <td>Anna</td>
                <td>anna</td>
                <td></td>
                <td></td>
                <td>
                    <a href="#" class="btn-secondary">Update Category</a>
                    <a href="#" class="btn-danger">Delete Category</a>
                    
                </td>
            </tr> -->

            
        </table>
            
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>