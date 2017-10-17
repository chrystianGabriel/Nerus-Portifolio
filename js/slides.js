function mudarSlide(input){
	let slides = document.getElementsByClassName('slide');
	let labels = document.getElementsByClassName('indice-slide');
	let i = Number(input.id.match('[0-9]+')[0]);
	let j = slides.length-1;

	while(j > -1){

		slides[j].style.display= "none";
		labels[j].style.color = "white";	
		j--;
	}
	slides[i-1].style.display  = "block";
	labels[i-1].style.color = "#fd6703";
}	