const inputs = document.querySelectorAll(".input");


function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});

function submit() {
	var username = document.getElementById('username').value.toString().trim();

	newFunction();

	function newFunction() {
		if (username == "") {
			alert("กรอกชื่อของท่าน!!!");
		}
	}
}

