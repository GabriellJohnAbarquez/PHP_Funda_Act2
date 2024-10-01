<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order System</title>
</head>
<body>

    <div class="menu">
        <h2>Welcome to Fistac's Snack Stop!</h2>
        <h3>Menu</h3>
        <table border="1">
            <tr>
                <th>Snack</th>
                <th>Price</th>
            </tr>
            <tr>
                <td>French Fries</td>
                <td>&#8369;25</td>
            </tr>
            <tr>
                <td>Cheese Sticks</td>
                <td>&#8369;15</td>
            </tr>
            <tr>
                <td>Potato Wedges</td>
                <td>&#8369;30</td>
            </tr>
        </table>

        <form method="post" action="">
            <label for="snack">Select Snack:</label>
            <select id="snack" name="snack" required>
                <option value="fries">French Fries</option>
                <option value="cheese_sticks">Cheese Sticks</option>
                <option value="potato_wedges">Potato Wedges</option>
            </select><br><br>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" value="1" required><br><br>

            <label for="cash">Amount of Cash:</label>
            <input type="number" id="cash" name="cash" required><br><br>

            <input type="submit" name="submit" value="Submit Order">
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        // Get the selected snack and quantity
        $snack = $_POST['snack'];
        $quantity = $_POST['quantity'];
        $cash = $_POST['cash'];

        // Prices
        $prices = [
            'fries' => 25,
            'cheese_sticks' => 15,
            'potato_wedges' => 30
        ];

        // Calculate total cost
        $total_cost = $prices[$snack] * $quantity;

        if ($cash < $total_cost) {
            // Display insufficient funds message
            echo "<h3>Sorry, Balance is not enough.</h3>";
            echo "<form method='post' action=''>";
            echo "<input type='submit' name='new_order' value='Re-order'>";
            echo "</form>";
            // Hide menu
            echo "<script>document.querySelector('.menu').style.display = 'none';</script>";
        } else {
            // Calculate change
            $change = $cash - $total_cost;

            // Get current date and time in UTC
            $date_time = new DateTime("now", new DateTimeZone('UTC'));
            $formatted_date = $date_time->format('m/d/Y h:i:s A');

            // Hide menu and show receipt
            echo "<h3>RECEIPT</h3>";
            echo "<p>Total Price: &#8369;" . $total_cost . "</p>";
            echo "<p>You Paid: &#8369;" . $cash . "</p>";
            echo "<p>CHANGE: &#8369;" . $change . "</p>";
            echo "<p>" . $formatted_date . "</p>";
            echo "<form method='post' action=''>";
            echo "<input type='submit' name='new_order' value='Order Again'>";
            echo "</form>";
            // Hide menu
            echo "<script>document.querySelector('.menu').style.display = 'none';</script>";
        }
    }

    if (isset($_POST['new_order'])) {
        // Refresh the page to start a new order
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    ?>
</body>
</html>