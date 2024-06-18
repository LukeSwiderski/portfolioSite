function populateTechCards() {
  techMap = {
    "JavaScript": "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg",
    "PHP": "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg",
    "MySQL": "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original.svg",
    "React":  "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/react/react-original.svg",
    "Redux":  "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/redux/redux-original.svg", 
    "HTML": "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/html5/html5-original.svg",
    "CSS": "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/css3/css3-original.svg",
    "Bootstrap": "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/bootstrap/bootstrap-original.svg",
    "Node.js": "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nodejs/nodejs-original.svg",
    "Express": "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/express/express-original.svg",
    "Postman": "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/postman/postman-original.svg",
    "Git": "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/git/git-original.svg",
    "Photoshop": "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/photoshop/photoshop-original.svg",
  }

  let cardRow = document.getElementById("cardRow");

  for (var key in techMap) {
    var value = techMap[key];
    let columns = document.createElement('div');
    columns.className = "card col-4 col-sm-3 col-md-2 px-2";
    let cardBody = document.createElement('div');
    cardBody.className = "card-body";
    let headline = document.createElement('h5');
    headline.innerHTML = key;
    headline.className = "text-center";
    let image = document.createElement('img');
    image.src = value;
    image.className = "card-img-top";
    cardBody.appendChild(image);
    cardBody.appendChild(headline);
    columns.appendChild(cardBody);
    cardRow.appendChild(columns);

  }

      // <div class="card col-4 col-sm-3 col-md-2 px-2" style="width: 18rem;">
      //   <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
      //   <div class="card-body">
      //     <h5 class="card-title">Card 1</h5>
      //     <p class="card-text">Lorem ipsum dolor sit amet,</p>
      // </div>

}

populateTechCards();

