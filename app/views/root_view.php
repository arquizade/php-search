<!DOCTYPE html>
<html>
<head>
    <title>Sykes Cottages</title>
</head>
<body>

  <h2>Sykes Cottages</h2>

  <form action="check-location" method="post">
    <label for="location">Enter your desired location:</label><br>
    <input type="text" id="location" name="location" value="<?php echo isset($search_location) ? $search_location : '';?>" required><br>

    <label for="checkin">Check In:</label><br>
    <input type="date" id="checkin" name="checkin" min="<?php //echo date('Y-m-d');?>" value="<?php echo isset($checkin_date) ? $checkin_date : '';?>" required><br>

    <label for="checkout">Check In:</label><br>
    <input type="date" id="checkout" name="checkout" min="<?php //echo date('Y-m-d');?>" value="<?php echo isset($checkout_date) ? $checkout_date : '';?>" required><br>
  <!-- 
    <input type="checkbox" name="beachside">
    <label for="beachside">Near the beach</label><br>

    <input type="checkbox" name="allowpets">
    <label for="allowpets">Pet friendly</label><br>

    <label for="numguest">Number of guest:</label>
    <select name="numguest" id="numguest">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
    <br>

    <label for="numbeds">Number of beds:</label>
    <select name="numbeds" id="numbeds">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select> -->
    
    <br>
    <?php if(isset($error_message)):?>
      <span style="color:red;"><?php echo $error_message?></span><br>
    <?php endif;?>
    <input type="submit" value="Submit">
  </form>

</body>
</html>