<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once('_meta.php') ;?>
  
  <title><?php echo $title ?></title>

  <!-- CSS Files -->

  <?php require_once('_css.php') ;?>

  
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>

      <nav class="navbar navbar-expand-lg main-navbar">
        <?php require_once('_navbar.php') ;?>
      </nav>

      <div class="main-sidebar">
        <?php require_once('_sidebar.php') ;?>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <?php echo $contents ;?>
      </div>


      <footer class="main-footer">
        <?php require_once('_footer.php') ;?>
      </footer>

    </div>
  </div>

   <?php require_once('_js.php') ;?>
</body>
</html>
