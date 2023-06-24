<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AcVis-Home</title>
    <link rel="stylesheet" href="../static/styles/style_home.css">
</head>
<body>

    <div class="header">
        <img src="../static/styles/resources/BG.png" alt="Imga" class="imga">
        <div class="search-container">
        <form method="POST" action="search.php">
          <input class="search-input" type="text" name="searchInput" placeholder="Search" />
          <button type="submit" class="search-button"><img src="../static/styles/resources/magnifying_glass.png" alt="Search"></button>
        </form>
      </div>
    </div>

    <div class="top">
        <ul class="menu">
          <li><a href="../views/HOME.html" class="home">HOME</a></li>
          <li><a href="news.php" class="news">NEWS</a></li>
          <li><a href="../views/HELP.html" class="help">HELP</a></li>
          <li><a href="account.php" class="account">MY ACCOUNT</a></li>
        </ul>
    </div>
    <div class="sign-up-button">
      <a href="../views/SIGN_UP.html" class="signup-link">Sign Up</a>
  </div>
    <div class="best-actors">
        <h1>BEST ACTORS</h1>
      </div>
      <div id="our-best-container" class="grid-wrapper">
      </div>
      <div class="sag-awards">
        <div class="sag-awards-container">
          <h2 class="sag-awards-title">SAG AWARDS</h2>
          <p class="sag-awards-text">Screen Actors Guild Awards (also known as SAG Awards) are accolades given by the Screen Actors Guild-American Federation of Television and Radio Artists (SAG-AFTRA). The award was founded in 1995 to recognize outstanding performances in movies and prime-time television. SAG Awards have been one of the major awards events in the Hollywood film industry since then, along with the Golden Globes and the Oscars. The SAG Awards focus on both individual performances and the work of the entire ensemble of drama series, comedy series, and motion pictures.</p>
        </div>
      </div>
      <div class="sag-awards">
        <div class="sag-awards-container">
          <h2 class="sag-awards-title">ABOUT THE SCREEN ACTORS GUILD AWARDS</h2>
          <p class="sag-awards-text">The only televised awards ceremony to exclusively honor actors, the SAG Awards® presents 13 awards in TV and film. Voted on by SAG-AFTRA’s robust and diverse membership of 130,000+ performers – the SAG Awards has the largest voting body on the awards circuit. Beloved for its style, simplicity, and genuine warmth, the show has become an industry favorite and one of awards season’s most prized honors since its debut in 1995.</p>
        </div>
      </div>
    <script>
   const ourBestContainer = document.getElementById('our-best-container');

    
    fetch('get_actors.php')
      .then(response => response.text())
      .then(data => {
        ourBestContainer.innerHTML = data;
      })
      .catch(error => console.error(error));

      const gridItems = document.querySelectorAll('.grid-item');

      gridItems.forEach((item) => {
        item.addEventListener('mouseover', () => {
          item.querySelector('img').style.transform = 'scale(1.1)';
        });
      
        item.addEventListener('mouseout', () => {
          item.querySelector('img').style.transform = 'scale(1)';
        });
      });
      const actorImages = document.querySelectorAll('.actor-image');

actorImages.forEach((image) => {
  image.addEventListener('mouseover', () => {
    image.querySelector('img').style.transform = 'scale(1.1)';
  });

  image.addEventListener('mouseout', () => {
    image.querySelector('img').style.transform = 'scale(1)';
  });
});

    </script>
      
      


</body>
</html>
</body>
</html>