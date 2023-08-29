<!DOCTYPE html>
<html>
<head>
  <title>Popup Form Example</title>
  <style>
    /* Styles for the popup container */
    #popup {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1;
    }
    /* Styles for the popup content */
    #popup-content {
      background-color: white;
      width: 300px;
      height: 200px;
      margin: 100px auto;
      padding: 20px;
      text-align: center;
    }
  </style>
  <script>
    function openPopup() {
      document.getElementById("popup").style.display = "block";
    }
    function closePopup() {
      document.getElementById("popup").style.display = "none";
    }
  </script>
</head>
<body>
  <h1>Popup Form Example</h1>
  <button onclick="openPopup()">Open Popup</button>
  <div id="popup">
    <div id="popup-content">
      <h2>Enter your details:</h2>
      <form action="submit.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <input type="submit" value="Submit">
        <button onclick="closePopup()">Close</button>
      </form>
    </div>
  </div>
</body>
</html>
