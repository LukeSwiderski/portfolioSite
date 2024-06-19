(function loadApp () {
  let App = {
    init: function() {
      this.populateTechCards();
    },

    techMap: {
      "JavaScript": [
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg",
        "JavaScript is my first language.  I have extensive experience using it to build apps, websites, solve leetcode problems and more!  I think in javaScript!"
      ],
      "PHP": [
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg",
        "I use php to build back-ends for my projects.  Why php?  Because it's supported by every host on the internet!  I originally gravitated towards node.js because it's javaScript after all, but my web host didn't support it.  So I learned php, and I ended up liking it!  With node, it's sometimes hard to differentiate what is node, what is express, what is mongoose, etc.  I like that I can read a php file and quickly parse it without confusion."
      ],
      "MySQL": [
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original.svg",
        "I use MySQL to store data.  Its widely supported, it's tried and true. It goes with php like peanut butter and jelly.  Whether you need to build a login system from scratch or store a few items in a todo list, MySQL is the Toyota Camry of databases."
      ],
      "React":  [
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/react/react-original.svg",
        "I worked with React during my time as an Open Source developer.  The Firefox debugger is built with React.  I solved numerous bugs in the debugger, all of which can be viewed in the projects area of this site."
      ],
      "Redux":  [
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/redux/redux-original.svg",
        "The Firefox devtools debugger uses Redux to organize the flow of information through the app.  I had to understand how it works to fix bugs when I was working as an Open Source developer.  That project was a great learning experience in the Redux framework."
      ], 
      "HTML": [
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/html5/html5-original.svg",
        "HTML, the building blocks of the internet.  I have used html extensively to build websites and web-apps.  I feel quite at home marking up those tags!"
      ],
      "CSS": [
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/css3/css3-original.svg",
        "CSS doesnt get enough respect.  It seems simple, yet can be mystifying at times.  For most of my career, I eschewed any frameworks and did all of my styling in CSS. The first open source bug I solved was a CSS bug on Google Chrome.  I like to think I know my way around a style sheet!"
      ],
      "Bootstrap": [
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/bootstrap/bootstrap-original.svg",
        "I use to avoid frameworks like bootstrap, I think out of some sense of purism, or that it was better for me to stick with the fundementals. After all, CSS Grid had arrived, right? About a thousand media-queries later I thought, you know, they might be on to something with this bootstrap thing.  I have now been using bootstrap 5 whenever I need something responsive or just want to have a much smaller style sheet."
      ],
      "Node.js": [
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nodejs/nodejs-original.svg",
        "I first started looking at node because it's a back-end framework that uses javaScript, the language I already knew.  Seems like a no brainer, right? After watching a bunch of tutorials and reading docs I was able to cobble together a few projects, some which can be seen in the projects area of this site.  Unfortunately my web-host doesn't support node, so the projects I did had to be deployed via third party."
      ],
      "Express": [
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/express/express-original.svg",
        "Express is an interesting framework.  I used it in most of the projects that I created with node.js.  In fact, at first I couldn't differentiate between node and express, so I specifically sought out node courses that didn't use other frameworks, so I could better understand what makes Express important."
      ],
      "Postman": [
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/postman/postman-original.svg",
        "Postman is a great tool for testing end-points, APIs and more.  I used it a lot when I was working on node projects."
      ],
      "Git": [
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/git/git-original.svg",
        "I have been using git since I began programming.  I have also used other version control systems like Mercurial.  Git is a part of my regular routine."
      ],
      "Photoshop": [
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/photoshop/photoshop-original.svg",
        "I began using photoshop years ago, mostly to make memes, lol.  Now days I sometimes need graphics or original content for a website.  I have a lot of experience manipulating images and creating composites.  I also use GIMP, which is a free, open source, similar software."
      ],
    },

    populateTechCards: function() {
      let cardRow = document.getElementById("cardRow");
    
      for (var key in this.techMap) {
        var value = this.techMap[key][0];
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
        cardBody.setAttribute('data-id', key);
        columns.appendChild(cardBody);
        cardRow.appendChild(columns);
        cardBody.addEventListener('click', this.onCardClick.bind(this));
      }
    },

    onCardClick(e) {
      let textArea = document.getElementById('tech-paragraph');
      dataId = e.target.closest('.card-body').getAttribute('data-id');
      textArea.innerHTML = this.techMap[dataId][1];
    }
  };

  App.init();
})();