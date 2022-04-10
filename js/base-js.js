// Képmegjelenítő
var modal = document.getElementById("modalWindow");
var modalImg = document.getElementById("placeHolderImage");
var captionText = document.getElementById("caption");

function reply_click(clicked_object) {
    modal.style.display = "block";
    modalImg.src = clicked_object.src;
    captionText.innerHTML = clicked_object.alt;
}

//Bezárás definiálása
var span = document.getElementsByClassName("close")[0];

//Bezárásra kattintásra bezárja a megjelenítőt
span.onclick = function () {
    modal.style.display = "none";
}
