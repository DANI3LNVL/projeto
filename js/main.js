let list = document.querySelectorAll(".navegacao li");

function activeLink() {
    list.forEach((item) => {
        item.classList.remove("hovered");
    });
    this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

let toggle = document.querySelector(".alternar");
let navegacao = document.querySelector(".navegacao");
let principal = document.querySelector(".principal");

toggle.onclick = function () {
    navegacao.classList.toggle("ativa");
    principal.classList.toggle("ativa");
};
