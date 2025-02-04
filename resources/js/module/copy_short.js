export function copy_short(id) {
	console.log(document.URL+id);
	alert("コピーしました");
}

let buttons = document.getElementsByClassName('copy_button');
for (let i = 0; i < buttons.length; i++) {
	buttons[i].addEventListener('click', (e) => {
		copy_short(e.target.value);
	})
}
// addEventListener("click", function () {})
// console.log("読み込まれました")