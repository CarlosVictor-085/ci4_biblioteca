<?php
// Função para gerar um nome fictício
function gerarNome() {
    $nomes = ['Ana', 'Pedro', 'Maria', 'João', 'Carlos', 'Fernanda', 'Juliana', 'Ricardo', 'Roberta', 'Marcelo'];
    $sobrenomes = ['Silva', 'Souza', 'Oliveira', 'Pereira', 'Costa', 'Almeida', 'Barbosa', 'Gomes', 'Santos', 'Ferreira'];
    return $nomes[array_rand($nomes)] . ' ' . $sobrenomes[array_rand($sobrenomes)];
}

// Função para gerar um e-mail fictício
function gerarEmail($nome) {
    return strtolower(str_replace(' ', '.', $nome)) . '@example.com';
}

// Função para gerar um telefone fictício
function gerarTelefone() {
    return '(11) 9' . rand(10000000, 99999999);
}

// Gerar e imprimir instruções SQL para inserir dados
for ($i = 0; $i < 1000; $i++) { // Gera 1000 editoras
    $nome = gerarNome();
    $email = gerarEmail($nome);
    $telefone = gerarTelefone();

    $sql = sprintf(
        "INSERT INTO editora (nome, email, telefone) VALUES ('%s', '%s', '%s');",
        $nome,
        $email,
        $telefone
    );

    echo $sql . "\n";
}
?>
