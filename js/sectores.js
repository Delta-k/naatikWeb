/*const card = document.getElementsByClassName("flip-card-block")

card.addEventListener("click",flipCard);*/
// function flipCard(id) {
    /*alert("bunas")
    var card = event.currentTarget;*/
    // const card = document.getElementById(id);
    // card.rotateY(180)
    // alert(id);
    /*card.rotateY(180);*/
/*    card.classList.toggle("flip-card-block");*/
// }

var cards = document.querySelectorAll('.card');

[...cards].forEach((card)=>{
  card.addEventListener( 'click', function() {
    card.classList.toggle('is-flipped');
  });
});