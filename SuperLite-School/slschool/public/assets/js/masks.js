// formatarTelefone.js

function formatarTelefone(input) {
    var value = input.value.replace(/\D/g, '');
    var formattedValue = '';

    if (value.length > 0) {
        formattedValue = '(' + value.substring(0, 2);
    }
    if (value.length > 2) {
        formattedValue += ') ' + value.substring(2, 6);
    }
    if (value.length > 6) {
        formattedValue += '-' + value.substring(6, 10);
    }

    input.value = formattedValue;
}

function formatarCelular(input) {
    var value = input.value.replace(/\D/g, '');
    var formattedValue = '';

    if (value.length > 0) {
        formattedValue = '(' + value.substring(0, 2);
    }
    if (value.length > 2) {
        formattedValue += ') ' + value.substring(2, 3);
    }
    if (value.length > 3) {
        formattedValue += ' ' + value.substring(3, 7);
    }
    if (value.length > 7) {
        formattedValue += '-' + value.substring(7, 11);
    }

    input.value = formattedValue;
}

function formatarCEP(input) {
    var value = input.value.replace(/\D/g, '');
    var formattedValue = '';

    if (value.length > 0) {
        formattedValue = value.substring(0, 5);
    }
    if (value.length > 5) {
        formattedValue += '-' + value.substring(5, 8);
    }

    input.value = formattedValue;
}

// mascaraCPF.js
function formatarCPF(input) {
    var value = input.value.replace(/\D/g, '');
    var formattedValue = '';

    if (value.length > 0) {
        formattedValue = value.substring(0, 3);
    }
    if (value.length > 3) {
        formattedValue += '.' + value.substring(3, 6); 
    }
    if (value.length > 6) {
        formattedValue += '.' + value.substring(6, 9); 
    }
    if (value.length > 9) {
        formattedValue += '-' + value.substring(9, 11); 
    }

    input.value = formattedValue;
}

// mascaraCNPJ.js
function formatarCNPJ(input) {
    var value = input.value.replace(/\D/g, ''); 
    var formattedValue = '';

    if (value.length > 0) {
        formattedValue = value.substring(0, 2); 
    }
    if (value.length > 2) {
        formattedValue += '.' + value.substring(2, 5);
    }
    if (value.length > 5) {
        formattedValue += '.' + value.substring(5, 8); 
    }
    if (value.length > 8) {
        formattedValue += '/' + value.substring(8, 12);
    }
    if (value.length > 12) {
        formattedValue += '-' + value.substring(12, 14);
    }

    input.value = formattedValue;
}


//VALIDAÇÃO
// validacoes.js

function formatarCPF(input) {
    var value = input.value.replace(/\D/g, '');
    var formattedValue = '';

    if (value.length > 0) {
        formattedValue = value.substring(0, 3);
    }
    if (value.length > 3) {
        formattedValue += '.' + value.substring(3, 6);
    }
    if (value.length > 6) {
        formattedValue += '.' + value.substring(6, 9);
    }
    if (value.length > 9) {
        formattedValue += '-' + value.substring(9, 11);
    }

    input.value = formattedValue;

    var validationMessage = document.getElementById('cpfValidationMessage');
    if (validarCPF(value)) {
        validationMessage.textContent = '';
    } else {
        validationMessage.textContent = 'Atenção! O CPF Informado é inválido!';
        input.focus(); 
    }
}

function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');

    if (cpf.length !== 11 || /^(.)\1+$/.test(cpf)) return false;

    var soma = 0;
    var resto;

    for (var i = 1; i <= 9; i++) soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);

    resto = (soma * 10) % 11;

    if ((resto === 10) || (resto === 11)) resto = 0;

    if (resto !== parseInt(cpf.substring(9, 10))) return false;

    soma = 0;

    for (var i = 1; i <= 10; i++) soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);

    resto = (soma * 10) % 11;

    if ((resto === 10) || (resto === 11)) resto = 0;

    if (resto !== parseInt(cpf.substring(10, 11))) return false; 

    return true;
}

function formatarCNPJ(input) {
    var value = input.value.replace(/\D/g, '');
    var formattedValue = '';

    if (value.length > 0) {
        formattedValue = value.substring(0, 2);
    }
    if (value.length > 2) {
        formattedValue += '.' + value.substring(2, 5);
    }
    if (value.length > 5) {
        formattedValue += '.' + value.substring(5, 8);
    }
    if (value.length > 8) {
        formattedValue += '/' + value.substring(8, 12);
    }
    if (value.length > 12) {
        formattedValue += '-' + value.substring(12, 14); 
    }

    input.value = formattedValue;

    var validationMessage = document.getElementById('cnpjValidationMessage');
    if (validarCNPJ(value)) {
        validationMessage.textContent = "";
    } else {
        validationMessage.textContent = 'Atenção! o CNPJ Informado é inválido!';
        input.focus(); 
    }
}

function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g, ''); 

    if (cnpj.length !== 14 || /^(.)\1+$/.test(cnpj)) return false; 

    var tamanho = cnpj.length - 2;
    var numeros = cnpj.substring(0, tamanho);
    var digitos = cnpj.substring(tamanho);
    var soma = 0;
    var pos = tamanho - 7;

    for (var i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
    }

    var resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;

    if (resultado != digitos.charAt(0)) return false; 

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;

    for (var i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
    }

    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;

    if (resultado != digitos.charAt(1)) return false; 

    return true;
}
