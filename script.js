const budgetPics = [
  '/pictures/budget.jpg',
  '/pictures/budget.jpg',
  '/pictures/budget.jpg',
  '/pictures/budget.jpg',
];

const standardPics = [
  '/pictures/standard.jpg',
  '/pictures/standard.jpg',
  '/pictures/standard.jpg',
  '/pictures/standard.jpg',
];

const luxuryPics = [
  '/pictures/luxury.jpg',
  '/pictures/luxury.jpg',
  '/pictures/luxury.jpg',
  '/pictures/luxury.jpg',
];

//////////////////

// const imgBudget = document.querySelector('.budget');
// imgBudget.src = '/pictures/budget.jpg';
// const imgRoomBudget = document.querySelector('.room-budget');
// imgRoomBudget.append(imgBudget);

const imgStandard = document.querySelector('.standard');
imgStandard.src = '/pictures/standard.jpg';
const imgRoomStandard = document.querySelector('.room-standard');
imgRoomStandard.append(imgStandard);

const imgLuxury = document.querySelector('.luxury');
imgLuxury.src = '/pictures/luxury.jpg';
const imgRoomLuxury = document.querySelector('.room-standard');
imgRoomLuxury.append(imgStandard);

function startBudget() {
  const imgBudget = document.querySelector('.budget');
  const imgRoomBudget = document.querySelector('.room-budget');

  let delayInSeconds = 1;

  const budget = [
    '/pictures/budget1.png',
    //'/pictures/budget2.png',
    //'/pictures/budget3.png',
    '/pictures/budget4.png',
    '/pictures/budget5.png',
  ];

  let num = 0;
  let changeImageBudget = function () {
    let len = budget.length;
    imgBudget.src = budget[num++];
    imgRoomBudget.append(imgBudget);
    if (num == len) {
      num = 0;
    }
  };

  setInterval(changeImageBudget, delayInSeconds * 1500);
}
// window.onpageshow = function () {
//   startBudget();
//};

function startStandard() {
  const imgStandard = document.querySelector('.standard');
  const imgRoomStandard = document.querySelector('.room-standard');

  let delayInSeconds = 1;
  const standard = [
    '/pictures/standard1.png',
    '/pictures/standard2.png',
    '/pictures/standard3.png',
  ];
  let num = 0;
  let changeImageStandard = function () {
    let len = standard.length;
    imgStandard.src = standard[num++];
    imgRoomStandard.append(imgStandard);
    if (num == len) {
      num = 0;
    }
  };
  setInterval(changeImageStandard, delayInSeconds * 1500);
}

function startLuxury() {
  const imgLuxury = document.querySelector('.luxury');
  const imgRoomLuxury = document.querySelector('.room-luxury');

  let delayInSeconds = 1;
  const luxury = [
    '/pictures/luxury1.png',
    '/pictures/luxury2.png',
    '/pictures/luxury3.png',
  ];
  let num = 0;
  let changeImageLuxury = function () {
    let len = luxury.length;
    imgLuxury.src = luxury[num++];
    imgRoomLuxury.append(imgLuxury);
    if (num == len) {
      num = 0;
    }
  };
  setInterval(changeImageLuxury, delayInSeconds * 1500);
}
window.onpageshow = function () {
  startBudget();
  startStandard();
  startLuxury();
};
