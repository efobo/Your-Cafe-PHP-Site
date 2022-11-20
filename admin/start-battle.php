<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Start th Battle</h1>

        <br><br>

        <?php 
  
            if ($_SESSION['status'] != "ruler")
            {
                echo "<div>Sorry, you don't have access to change this data. Ask one of the ruler for this</div>";
            }
            else
            {
                $id_my_universe = $_SESSION['id_universe'];
                $sql3 = "SELECT * FROM army WHERE id_universe=$id_my_universe";
                $res3 = mysqli_query($conn, $sql3);

                $count3 = mysqli_num_rows($res3);

                if ($count3 == 0) 
                {
                    echo "<div>You don't have any soldiers at all! Ask the advisors to recruit an army!</div>";
                } else {
        
                    if (isset($_SESSION['msg']))
                    {
                        echo $_SESSION['msg'];
                        echo '<br><br>';
                        unset($_SESSION['msg']);
                    }

                    if (isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        echo '<br><br>';
                        unset($_SESSION['add']);
                    }

                    if (isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        echo '<br><br>';
                        unset($_SESSION['upload']);
                    }
        ?>


        <!-- Start Battle Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Choose the ruler you want to attack</td>
                    <td>
                        <select name="id_ruler_victim">
                        <?php
                            $id_ruler_started = $_SESSION['id'];
                            $sql5 = "SELECT * FROM ruler WHERE id<>$id_ruler_started";
                            $res5 = mysqli_query($conn, $sql5);
                            $count5 = mysqli_num_rows($res5);
                            if ($count5 > 0)
                            {
                                while ($row5 = mysqli_fetch_assoc($res5))
                                {
                                    $id_ruler_victim = $row5['id'];
                                    $title = $row5['name'];
                                    $id_universe = $row5['id_universe'];
                                    
                                    $sql6 = "SELECT * FROM universe WHERE id=$id_universe";

                                    $res6 = mysqli_query($conn, $sql6);

                                    $count6 = mysqli_num_rows($res6);

                                    if ($count6 == 1)
                                    {
                                        $row6 = mysqli_fetch_assoc($res6);
                                        $universe = $row6['name'];
                                    }
                                    else
                                    {
                                        $universe = "unknown";
                                    }
                                    
                                    ?>

                                    <option value="<?php echo $id; ?>">
                                        <?php echo $title.'('.$universe.')'; ?>
                                    </option>

                                    <?php
                                }
                            }
                            else {
                                ?>

                                <option value="0">No else Rulers Found</option>
                                
                                <?php
                            }
                        ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Select an available location:</td>
                    <td>
                        <select name="id_location">
                        <?php
                            
                            $sql = "SELECT * FROM location";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            if ($count > 0)
                            {
                                while ($row = mysqli_fetch_assoc($res))
                                {
                                    $id = $row['id'];
                                    $title = $row['name'];
                                    $id_universe = $row['id_universe'];

                                    $sql2 = "SELECT * FROM universe WHERE id=$id_universe";

                                    $res2 = mysqli_query($conn, $sql2);

                                    $count2 = mysqli_num_rows($res2);

                                    if ($count2 == 1)
                                    {
                                        $row2 = mysqli_fetch_assoc($res2);
                                        $universe = $row2['name'];
                                    }
                                    else
                                    {
                                        $universe = "unknown";
                                    }

                                    ?>

                                    <option value="<?php echo $id; ?>">
                                        <?php echo $title.'('.$universe.')'; ?>
                                    </option>

                                    <?php
                                }
                            }
                            else 
                            {
                                ?>

                                <option value="0">No Location Found</option>
                                
                                <?php
                                
                            }
                        ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>How many soldiers will you send to battle?</td>
                    <td>
                        
                        <input type="number" name="qty_soldiers" min="0" max="<?php echo $count3; ?>">
                    </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Start the Battle" class="btn-danger">
                    </td>
                </tr>
            </table>

        </form>
        <!-- Add People Form Ends -->


        <?php
        
            if (isset($_POST['submit']))
            {
                $qty_soldiers = $_POST['qty_soldiers'];
                if ($qty_soldiers <= 0) 
                {
                    $_SESSION['msg'] = "<div class='error'>You can't send 0 soldiers into battle</div>";
                        header('location:'.SITEURL.'admin/start-battle.php');
                }
                $battle_id_location = $_POST['id_location'];
                $sql4 = "SELECT * FROM location WHERE id=$battle_id_location";
                $res4 = mysqli_query($conn, $sql4);
                $count4 = mysqli_num_rows($res4);
                if ($count4 == 1)
                {
                    $row4 = mysqli_fetch_assoc($res4);
                    $battle_id_universe = $row4['id_universe'];
                }
                else
                {
                    $_SESSION['msg'] = "<div class='error'>Some error with battle id universe</div>";
                    header('location:'.SITEURL.'admin/start-battle.php');
                }

                $id_ruler_started = $_SESSION['id'];
                $id_universe_started = $_SESSION['id_universe'];
                $id_ruler_victim = $_POST['id_ruler_victim'];
                
                $sql7 = "SELECT * FROM ruler WHERE id=$id_ruler_victim";
                $res7 = mysqli_query($conn, $sql7);
                $count7 = mysqli_num_rows($res7);
                if ($count7 == 1)
                {
                    $row7 = mysqli_fetch_assoc($res7);
                    $id_universe_victim = $row7['id_universe'];
                }
                else
                {
                    $_SESSION['msg'] = "<div class='error'>Some error with id ruler victim</div>";
                    header('location:'.SITEURL.'admin/start-battle.php');
                }
                
                echo $qty_soldiers;
                echo '<br>';
                echo $battle_id_location;
                echo '<br>';
                echo $battle_id_universe;
               /* for ($i = 0; $i < $qty; $i++) {

                    $sql2 = "INSERT INTO people SET
                    name='$name',
                    id_universe='$id_universe',
                    status='$status'
                    ";


                    $res2 = mysqli_query($conn, $sql2);

                    if ($res2)
                    {
                        $_SESSION['add'] = "<div class='success'>People Added Successfully</div>";
                        header('location:'.SITEURL.'admin/manage-people.php');
                    }
                    else 
                    {
                        $_SESSION['add'] = "<div class='error'>Failed to add People</div>";
                        header('location:'.SITEURL.'admin/add-people.php');
                    }
                }*/
            }
        }}
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>