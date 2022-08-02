<?php include('partials-front/menu.php'); ?>


     <!-- Food Search Section Starts Here -->
     <section class="order-area text-center">
        <div class="container">

            <h2 class="text-center">Fill this form to confirm your order</h2>
            <br><br>
            <form action="#" class="order">
                <fieldset>
                    <legend>Selected Food</legend>
                    
                    <br>

                    <div class="food-menu-img">
                        <img src="img/menu-honey-cake.jpg" alt="Honey cake" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h3>Honey cake</h3>
                        <p class="food-price">$2.3</p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>
                </fieldset>
                <br>
                <fieldset>
                    <legend>Delivery Details</legend>

                    <br>

                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Mary Johnson" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="89000000000" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="email@mail.ru" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
            </form>
        </div>
    </section>
    <!-- Food Search Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>