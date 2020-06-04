function number_format_js( number, decimals, thousands_sep ) {
    // http://kevin.vanzonneveld.net
    // + original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // + improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + bugfix by: Michael White (http://crestidg.com)
    // + bugfix by: Benjamin Lupton
    // + bugfix by: Allan Jensen (http://www.winternet.no)
    // + revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // + edited by: Ba Duy
    // * example 1: number_format(200000);
    // * returns 1: 200,000
    
    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var t = thousands_sep == undefined ? "," : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t);
}

function onOption1Change(list_option) {
    let option = document.getElementById("select-option-1").value;
    if (option === "") {
        document.getElementById("option-amount-1").innerHTML = '';
        document.getElementById("option-amount-1-hidden").innerHTML = 0;
        totalAmount();
    }

    let newOption;
    list_option.forEach((element) => {
        if (element.op_id == option) {
            newOption = element
        }
    })
    document.getElementById("option-amount-1").innerHTML = number_format_js(newOption.op_amount);
    document.getElementById("option-amount-1-hidden").innerHTML = newOption.op_amount;
    totalAmount();
}

function onOption2Change(list_option) {
    let option = document.getElementById("select-option-2").value;
    if (option === "") {
        document.getElementById("option-amount-2").innerHTML = '';
        document.getElementById("option-amount-2-hidden").innerHTML = 0;
        totalAmount();
    }

    let newOption;
    list_option.forEach((element) => {
        if (element.op_id == option) {
            newOption = element
        }
    })
    document.getElementById("option-amount-2").innerHTML = number_format_js(newOption.op_amount);
    document.getElementById("option-amount-2-hidden").innerHTML = newOption.op_amount;
    totalAmount();
}

function onOption3Change(list_option) {
    let option = document.getElementById("select-option-3").value;
    if (option === "") {
        document.getElementById("option-amount-3").innerHTML = '';
        document.getElementById("option-amount-3-hidden").innerHTML = 0;
        totalAmount();
    }

    let newOption;
    list_option.forEach((element) => {
        if (element.op_id == option) {
            newOption = element
        }
    })
    document.getElementById("option-amount-3").innerHTML = number_format_js(newOption.op_amount);
    document.getElementById("option-amount-3-hidden").innerHTML = newOption.op_amount;
    totalAmount();
}

function onOption4Change(list_option) {
    let option = document.getElementById("select-option-4").value;
    if (option === "") {
        document.getElementById("option-amount-4").innerHTML = '';
        document.getElementById("option-amount-4-hidden").innerHTML = 0;
        totalAmount();
    }

    let newOption;
    list_option.forEach((element) => {
        if (element.op_id == option) {
            newOption = element
        }
    })
    document.getElementById("option-amount-4").innerHTML = number_format_js(newOption.op_amount);
    document.getElementById("option-amount-4-hidden").innerHTML = newOption.op_amount;
    totalAmount();
}

function onOption5Change(list_option) {
    let option = document.getElementById("select-option-5").value;
    if (option === "") {
        document.getElementById("option-amount-5").innerHTML = '';
        document.getElementById("option-amount-5-hidden").innerHTML = 0;
        totalAmount();
    }

    let newOption;
    list_option.forEach((element) => {
        if (element.op_id == option) {
            newOption = element
        }
    })
    document.getElementById("option-amount-5").innerHTML = number_format_js(newOption.op_amount);
    document.getElementById("option-amount-5-hidden").innerHTML = newOption.op_amount;
    totalAmount();
}

function totalAmount() {
    let option1 = parseInt(document.getElementById("option-amount-1-hidden").innerHTML);
    let option2 = parseInt(document.getElementById("option-amount-2-hidden").innerHTML);
    let option3 = parseInt(document.getElementById("option-amount-3-hidden").innerHTML);
    let option4 = parseInt(document.getElementById("option-amount-4-hidden").innerHTML);
    let option5 = parseInt(document.getElementById("option-amount-5-hidden").innerHTML);
    let total = option1 + option2 + option3 + option4 + option5;
    document.getElementById("co_money").value = number_format_js(total);
}
