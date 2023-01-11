<?php
include(__DIR__ . '/header.php');
$prices = prices();

?>

<main>

    <!-- hero with hotel pictures -->
    <div class="hero">
        <img src="pictures/hotel1.jpg" alt="Hero Image of hotel">
        <img src="pictures/computer.jpg" alt="Hero Image of computer">
        <img src="pictures/hotel2.jpg" alt="Hero Image of hotel">
    </div>

    <!-- section with rooms and calendar -->
    <section class="room-type" id="rooms_section">
        <div class="room-type-item ">
            <h2>ROOMS</h2>
            <h3 class="room-heading">BUDGET</h3>
            <div class="room-budget">
                <div class="price">
                    <?php
                    echo "$" . $prices[0]['cost'];
                    ?>
                </div>
                <div class="cal">
                    <?php echo $calendar1->draw(date('Y-m-d')); ?>
                </div>
                <img src="pictures/budget1.png" class="budget" alt="Image of hotel room">
            </div>
        </div>

        <div class="room-type-item ">
            <h3 class="room-heading">STANDARD</h3>
            <div class="room-standard">
                <div class="price">
                    <?php
                    echo "$" . $prices[1]['cost'];
                    ?>
                </div>
                <img src="pictures/standard1.png" class="standard" alt="Image of hotel room">
                <div class="cal">
                    <?php echo $calendar2->draw(date('Y-m-d')); ?>
                </div>
            </div>
        </div>

        <div class="room-type-item">
            <h3 class=" room-heading">LUXURY</h3>
            <div class="room-luxury">
                <div class="price">
                    <?php
                    echo "$" . $prices[2]['cost'];
                    ?>
                </div>
                <div class="cal">
                    <?php echo $calendar3->draw(date('Y-m-d')); ?>
                </div>
                <img src="pictures/luxury1.png" class="luxury" alt="Image of hotel room">
            </div>
        </div>

        <!-- section with form -->
        <section class="form-section" id="form_section">
            <div class="form">
                <h3 class="form-heading">Book your room here</h3>
                <form action="index.php" method="POST">
                    <label for="name"> Name</label><br>
                    <input type="text" id="name" name="name" required><br>
                    <label for="transferCode"> Transfer Code</label><br>
                    <input type="text" id="transferCode" name="transferCode" required><br>
                    <label for="arrivalDate">Arrival Date</label><br>
                    <input type="date" min="2023-01-01" max="2023-01-31" id="arrivalDate" name="arrivalDate"><br>
                    <label for="departureDate">Departure Date</label><br>
                    <input type="date" min="2023-01-01" max="2023-01-31" id="departureDate" name="departureDate"><br>
                    <label for="rooms">Rooms</label> <br>

                    <select name="rooms" id="rooms" class="form-input">
                        <option value="1">Budget</option>
                        <option value="2">Standard</option>
                        <option value="3">Luxury</option>
                    </select> <br>
                    <button type="submit"> Make a reservation </button>
                </form>
                <div class="receipt">
                    <?php
                    validationForm();
                    ?>
                </div>
            </div>
        </section>

        <section class="about" id="about_section">
            <div class="about-text">
                <h3 class="about-heading">ABOUT</h3>
                <p> We are a web hotel that exits not only on the web. Have a get away weekend with your computer, just
                    the
                    two of you. Internet is of course free end coding possibilities are endless! </p>
                <div>

        </section>

</main>
<script src="script.js"></script>

<?php
include(__DIR__ . '/footer.php');








?>
