<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bookingtable</title>
  <link rel="stylesheet" href="./login.css">
</head>
<style>
</style>
<body>
  <div class="main-wrapper">
    <div class="monkey-thought">
      <div class="buble-1"></div>
      <div class="monkey-comment">
        <p>es un email?</p>
      </div>
    </div>
    <div class="img-wrapper">
      <div class="monkey-face">
        <img src="./Images/cat.png" alt="face">
        <div class="eyes-wrapper">
          <div class="eyes">
            <div class="eye-brow"></div>
            <div class="eye-ball"></div>
          </div>
          <div class="eyes">
            <div class="eye-brow"></div>
            <div class="eye-ball"></div>
          </div>
        </div>
      </div>
      <img class="monkey-hand" src="./Images/hand.png" alt="hand">
    </div>
    <form action="">
      <input type="email" id="email" placeholder="john@gmail.com" autocomplete="off" required>
      <input type="password" placeholder="password" id="password"  onfocus="showMonkeyHand()" required>
      <button id="submit-btn" type="submit">submit</button>
    </form>
  </div>
</body>
  <script src="./login.js"></script>
</html>