const budgetPics = ['/pictures/pexels-andrew-neel-budget.jpg'];

const standardPics = [(src = '/pictures/pexels-andrew-neel-standard.jpg')];

const luxuryPics = [(src = '/pictures/pexels-mikhail-nilov-luxury.jpg')];

//////////////////

const imgBudget = document.querySelector('.budget');
imgBudget.src = '/pictures/pexels-andrew-neel-budget.jpg';
const imgRoomBudget = document.querySelector('.room-budget');
imgRoomBudget.append(imgBudget);

const imgStandard = document.querySelector('.standard');
imgStandard.src = '/pictures/pexels-andrew-neel-standard.jpg';
const imgRoomStandard = document.querySelector('.room-standard');
imgRoomStandard.append(imgStandard);

const imgLuxury = document.querySelector('.luxury');
imgLuxury.src = '/pictures/pexels-mikhail-nilov-luxury.jpg';
const imgRoomLuxury = document.querySelector('.room-standard');
imgRoomLuxury.append(imgStandard);
