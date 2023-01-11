//arrays with pictures
const budget = [
  'pictures/budget1.png',
  'pictures/budget4.png',
  'pictures/budget5.png',
];

const standard = [
  'pictures/standard1.png',
  'pictures/standard2.png',
  'pictures/standard3.png',
];

const luxury = [
  'pictures/luxury1.png',
  'pictures/luxury2.png',
  'pictures/luxury3.png',
];

//function that adds pictures to the rooms
function imgChange(images, roomType) {
  const img = document.querySelector(`.${roomType}`);
  const imgRoom = document.querySelector(`.room-${roomType}`);

  let delayInSeconds = 1;
  let num = 0;
  let changeImage = function () {
    let len = images.length;
    img.src = images[num++];
    img.alt = 'Image of hotel room';
    imgRoom.append(img);
    if (num == len) {
      num = 0;
    }
  };
  setInterval(changeImage, delayInSeconds * 1500);
}
window.onpageshow = function () {
  imgChange(budget, 'budget');
  imgChange(standard, 'standard');
  imgChange(luxury, 'luxury');
};
