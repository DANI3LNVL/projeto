const cep = document.getElementById('cep');

function Cep() {
    if (cep.value.length == 5) {
        cep.value += "-";
    }
    if (cep.value.length > 5 && cep.value[5] != "-") {
        cep.value = "";
    }
    for (var n = 0; n < cep.value.length; n++) {
        if (n == 5) {} else if (!number.includes(cep.value[n])) {
            cep.value = "";
        }
    }
};