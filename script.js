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
    '/pictures/budget.jpg',
    '/pictures/budget2.jpg',
    '/pictures/budget3.jpg',
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
    '/pictures/standard.jpg',
    '/pictures/standard2.jpg',
    '/pictures/standard.jpg',
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
window.onpageshow = function () {
  startBudget();
  startStandard();
};
