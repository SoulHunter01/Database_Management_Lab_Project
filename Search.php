<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title></title>
      <link rel="stylesheet" href="style.css">
    </head>

    <body>
      <div class="wrapper">
        <div class="title">
          SEARCH IN DATABASE
        </div>

          <form class="form" method="post"action="results.php">
            <div>
              <label>Recieve Report</label><br><br>
              <input type="radio" name="driver">Driver Report</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="radio" name="officer">Officer Report</input>
              <br>
            </div>
            <div class="inputfield">
              <button type="submit" class="btn" name="sub">Search</button>
            </div>
          </form>
        </div>

</body>
</html>
