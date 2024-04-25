<link rel="stylesheet" href="styles/teacher.css">
<div id="teacher">
  <div>
    <img src="images/no-picture.jpg" style="width:75px; margin-right:5px;">
  </div>
  <div>
    <?php echo $parent['username'];
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