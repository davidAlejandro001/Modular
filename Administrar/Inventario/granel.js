const box = document.getElementById('box');

function handleRadioClick() {
  if (document.getElementById('show').checked) {
    box.style.display = 'block';
  } else {
    box.style.display = 'none';
  }
}

const radioButtons = document.querySelectorAll('input[name="granel"]');
radioButtons.forEach(radio => {
  radio.addEventListener('click', handleRadioClick);
});
