<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/Teacher.css">
    <title>Document</title>
  </head>
  <body>
    <section id="body">
      <h1>You can Update OR Delete this Parent : </h1>
      <div id="teacher">
        <div>
          <img src="images/no-picture.jpg">
        </div>
        <div>
          <?php echo "<h2>".$parent['username']."</h2>";
          ?>
        </div>
        <form method="POST" action="delete-change.php">
          <div>
            <button type="submit" name="change">change</button>
            <button type="submit" name="delete">delete</button>
            <?php $_SESSION['theparent'] = $parent['username']; ?>
          </div>
        </form>
      </div>
    </section>
  </body>
</html>
