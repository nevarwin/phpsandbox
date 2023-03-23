<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Public Health Dashboard</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="container">
    <div class="navigation">
      <ul>
        <li>
          <!-- title -->
          <a href="#">
            <span class="icon"><ion-icon name="medkit-outline"></ion-icon>
            </span>
            <span class="title">Brand Name</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon">
              <ion-icon name="home-outline"></ion-icon></span>
            <span class="title">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon"><ion-icon name="people-outline"></ion-icon>
            </span>
            <span class="title">Admins</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon"><ion-icon name="cube-outline"></ion-icon>
            </span>
            <span class="title">Tables</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon"><ion-icon name="settings-outline"> </ion-icon>
            </span>
            <span class="title">Settings</span>
          </a>
        </li>

        <li>
          <a href="#">
            <span class="icon"><ion-icon name="map-outline"></ion-icon>
            </span>
            <span class="title">Map</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon"><ion-icon name="log-in-outline"></ion-icon>
            </span>
            <span class="title">Sign out</span>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <!-- hamber menu -->
  <div class="main">
    <div class="topbar">
      <div class="toggle">
        <ion-icon name="menu-outline"></ion-icon>
      </div>
      <div class="search">
        <label for="">
          <input type="text" placeholder="Search here" />
          <ion-icon name="search-outline"></ion-icon>
        </label>
      </div>
      <div class="user">
        <img src="user.jpg" alt="" />
      </div>
    </div>
    <!-- cards -->
    <div class="cardBox">
      <div class="card">
        <div>
          <div class="numbers">106</div>
          <div class="cardName">Admins</div>
        </div>
        <div class="iconBx"><ion-icon name="person-outline"></ion-icon></div>
      </div>
      <div class="card">
        <div>
          <div class="numbers">5</div>
          <div class="cardName">Dengue</div>
        </div>
        <div class="iconBx"><ion-icon name="medical-outline"></ion-icon></div>
      </div>
      <div class="card">
        <div>
          <div class="numbers">19</div>
          <div class="cardName">Malaria</div>
        </div>
        <div class="iconBx"><ion-icon name="medical-outline"></ion-icon></div>
      </div>
      <div class="card">
        <div>
          <div class="numbers">58</div>
          <div class="cardName">TB</div>
        </div>
        <div class="iconBx"><ion-icon name="medical-outline"></ion-icon></div>
      </div>
    </div>
  </div>

  <!-- ionicons installation -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <script>
    // menu toggle
    let toggle = document.querySelector(".toggle");
    let navigation = document.querySelector(".navigation");
    let main = document.querySelector(".main");

    toggle.onclick = function() {
      navigation.classList.toggle("active");
      main.classList.toggle("active");
    };

    // add hovered class in selected list item
    let list = document.querySelectorAll(".navigation li");

    function activeLink() {
      list.forEach((item) => item.classList.remove("hovered"));
      this.classList.add("hovered");
    }
    list.forEach((item) => item.addEventListener("mouseover", activeLink));
  </script>
</body>

</html>