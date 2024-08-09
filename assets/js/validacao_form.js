function validarFormulario() {
  var nome = document.getElementById("nome").value;
  var cpf = document.getElementById("cpf").value;
  var data_nasc = document.getElementById("data_nasc").value;
  var peso = document.getElementById("peso").value;
  var altura = document.getElementById("altura").value;
  var horas_sono_dia = document.getElementById("horas_sono_dia").value;
  var email = document.getElementById("email").value;

  if (
    nome === "" ||
    cpf === "" ||
    email === "" ||
    data_nasc === "" ||
    peso === "" ||
    altura === "" ||
    horas_sono_dia === ""
  ) {
    alert("Todos os campos devem ser preenchidos.");
    return false;
  }

  // Validação do CPF
  var cpfRegex = /^[0-9]{11}$/;
  if (!cpfRegex.test(cpf)) {
    alert("CPF inválido.");
    return false;
  }

  // Validação do email
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    alert("E-mail inválido.");
    return false;
  }

  // Validação da data de nascimento (exemplo simples, não verifica se a data é válida)
  if (new Date(data_nasc) >= new Date()) {
    alert("Data de nascimento inválida.");
    return false;
  }

  // Validação do peso e altura (exemplo simples, apenas números positivos)
  if (peso <= 0 || altura <= 0) {
    alert("Peso e altura devem ser valores positivos.");
    return false;
  }

  // Validação das horas de sono por dia (exemplo simples, apenas números inteiros positivos)
  if (horas_sono_dia <= 0 || !Number.isInteger(Number(horas_sono_dia))) {
    alert("Horas de sono por dia devem ser um número inteiro positivo.");
    return false;
  }

  return true;
}
