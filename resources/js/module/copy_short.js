export function copy_short(id) {
	navigator.clipboard.writeText(id);
	alert("コピーしました:"+id);
}

let buttons = document.getElementsByClassName('copy_button');
for (let i = 0; i < buttons.length; i++) {
	buttons[i].addEventListener('click', (e) => {
		copy_short(e.target.value);
	})
}