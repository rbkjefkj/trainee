let err = document.getElementById('error');
let form = document.getElementById('form');
let price = document.getElementById('price');
let intRX = /^[0-9]+$/;
let priceRX = /^[0-9]+(\.?[0-9]+)?$/;
let intInputs = document.getElementsByClassName('int');


function getLastInput() {
	for (let intInput of intInputs) { intInput.classList.remove('visible'); }
	document.getElementById('DVD').classList.remove('visible');
	document.getElementById('Furniture').classList.remove('visible');
	document.getElementById('Book').classList.remove('visible');
	let selected = document.getElementById('productType');
	let chosen = document.getElementById(selected.value);
	chosen.classList.add('visible');
	for (let child of chosen.getElementsByTagName('input')) { child.classList.add('visible'); }
}


form.addEventListener('submit', (e) => {
	if (document.getElementById('productType').value === 'TS') {
		e.preventDefault();
		err.innerText = "Please, submit required data";
		return;
	}

	for (let el of form.elements) {
		if (window.getComputedStyle(el).display === "none") { console.log(el); continue; }
		if (el.value.length === 0) {
			e.preventDefault();
			err.innerText = "Please, submit required data";
			return;
		}

		if (el.classList.contains('int')) {
			if (!intRX.test(el.value)) {
				e.preventDefault();
				err.innerText = "Please, provide data of the indicated type";
				return;
			}
		}

		if (el === price) {
			if (!priceRX.test(price.value)) {
				e.preventDefault();
				err.innerText = "Please, provide data of the indicated type";
				return;
			}
		}
	}
});

//just some fun functions I found
//element.setCustomValidity();
//element.checkValidity();

/*document.addEventListener('invalid', (function(){
return function(e) {
  e.preventDefault();
  myValidation();
};
})(), true);
*/
