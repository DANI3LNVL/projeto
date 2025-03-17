const cnpj = document.getElementById('cnpj');
const cpf = document.getElementById('cpf');
const tel = document.getElementById('tel');
var number = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
var boolean = false;

function Cnpj() {
    if (cnpj.value.length == 2) {
        cnpj.value += ".";
    } else if (cnpj.value.length == 6) {
        cnpj.value += ".";
    } else if (cnpj.value.length == 10) {
        cnpj.value += "/";
    } else if (cnpj.value.length == 15) {
        cnpj.value += "-";
    };
    if (cnpj.value.length > 1 && cnpj.value[2] != ".") {
        cnpj.value = "";
    };
    if (cnpj.value.length > 5 && cnpj.value[6] != ".") {
        cnpj.value = "";
    };
    if (cnpj.value.length > 9 && cnpj.value[10] != "/") {
        cnpj.value = "";
    };
    if (cnpj.value.length > 14 && cnpj.value[15] != "-") {
        cnpj.value = "";
    };
    for (var n = 0; n < cnpj.value.length; n++) {
        if (n == 2 || n == 6 || n == 10 || n == 15) {} else if (!number.includes(cnpj.value[n])) {
            cnpj.value = "";
        };
    };
};

function Cpf() {
    if (cpf.value.length == 3) {
        cpf.value += ".";
    } else if (cpf.value.length == 7) {
        cpf.value += ".";
    } else if (cpf.value.length == 11) {
        cpf.value += "-";
    };
    if (cpf.value.length > 2 && cpf.value[3] != ".") {
        cpf.value = "";
    };
    if (cpf.value.length > 6 && cpf.value[7] != ".") {
        cpf.value = "";
    };
    if (cpf.value.length > 10 && cpf.value[11] != "-") {
        cpf.value = "";
    };
    for (var n = 0; n < cpf.value.length; n++) {
        if (n == 3 || n == 7 || n == 11) {} else if (!number.includes(cpf.value[n])) {
            cpf.value = "";
        };
    };
};

function Tel() {
    if (tel.value.length < 2) {
        tel.value = "+";
        boolean = false;
    } else if (tel.value.length == 3) {
        tel.value += " (";
    } else if (tel.value.length == 4) {
        tel.value += "(";
    } else if (tel.value.length == 7) {
        tel.value += ") ";
    } else if (tel.value.length == 8) {
        tel.value += " ";
    } else if (tel.value.length == 13) {
        tel.value += "-";
    } else if (tel.value.length == 19) {
        var v1 = tel.value.substring(0, 13) + tel.value.substring(14);
        tel.value = v1;
        var v2 = tel.value.substring(0, 14) + "-" + tel.value.substring(14);
        tel.value = v2;
        boolean = true;
    } else if (tel.value.length == 18 && boolean == true) {
        var v1 = tel.value.substring(0, 14) + tel.value.substring(15);
        tel.value = v1;
        var v2 = tel.value.substring(0, 13) + "-" + tel.value.substring(13);
        tel.value = v2;
        boolean = false;
    };
    if (tel.value.length > 2 && tel.value[3] != " ") {
        tel.value = "+";
    };
    if (tel.value.length > 2 && tel.value[4] != "(") {
        tel.value = "+";
    };
    if (tel.value.length > 6 && tel.value[7] != ")") {
        tel.value = "+";
    };
    if (tel.value.length > 6 && tel.value[8] != " ") {
        tel.value = "+";
    };
    if (tel.value.length == 19) {
        if (tel.value[14] != "-") {
            tel.value = "+";
        };
    } else {
        if (tel.value.length > 12 && tel.value[13] != "-") {
            tel.value = "+";
        };
    };
    if (tel.value.length == 19) {
        for (var n = 1; n < tel.value.length; n++) {
            if (n == 3 || n == 4 || n == 7 || n == 8 || n == 14) {} else if (!number.includes(tel.value[n])) {
                tel.value = "+";
            };
        };
    } else {
        for (var n = 1; n < tel.value.length; n++) {
            if (n == 3 || n == 4 || n == 7 || n == 8 || n == 13) {} else if (!number.includes(tel.value[n])) {
                tel.value = "+";
            };
        };
    };
};