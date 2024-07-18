<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1><a href="/"><?php echo STORE_NAME; ?></a></h1>
    <nav>
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/products">Products</a></li>
        <li><a href="/about">About Us</a></li>
        <li><a href="/cart">Cart</a></li>
        <li><a href="/account">Account</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <?php include('content.php'); ?>
  </main>
  <aside>
    <?php include('sidebar.php'); ?>
  </aside>
  <footer>
    <p>&copy; <?php echo date("Y") ." ". STORE_NAME; ?></p>
  </footer>
  <script src="script.js"></script>
</body>
</html>