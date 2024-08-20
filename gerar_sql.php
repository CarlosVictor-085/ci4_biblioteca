<?php
// Número de registros a serem gerados
$num_records = 1000;

// Nome do arquivo SQL
$file_name = "insert_usuario.sql";

// Funções para gerar dados aleatórios
function randomName() {
    $first_names = ['Ana', 'João', 'Maria', 'Pedro', 'Lucas', 'Laura', 'Carlos', 'Sofia', 'Gabriel', 'Julia'];
    $last_names = ['Silva', 'Santos', 'Oliveira', 'Pereira', 'Costa', 'Almeida', 'Ferreira', 'Rodrigues', 'Lima', 'Gomes'];
    
    return $first_names[array_rand($first_names)] . ' ' . $last_names[array_rand($last_names)];
}

function randomEmail($name) {
    $domains = ['example.com', 'test.com', 'demo.com'];
    $namePart = strtolower(str_replace(' ', '.', $name));
    return $namePart . '@' . $domains[array_rand($domains)];
}

function randomPassword() {
    return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()'), 0, 12);
}

function randomPhoneNumber() {
    return '+55 ' . rand(11, 99) . ' 9' . rand(1000, 9999) . '-' . rand(1000, 9999);
}

// Abre o arquivo para escrita
$file = fopen($file_name, 'w');

// Escreve o início da instrução INSERT
fwrite($file, "INSERT INTO usuario (nome, email, senha, telefone) VALUES\n");

// Gera os registros
for ($i = 1; $i <= $num_records; $i++) {
    $nome = randomName();
    $email = randomEmail($nome);
    $senha = randomPassword();
    $telefone = randomPhoneNumber();
    
    // Adiciona os valores no arquivo
    $line = "('$nome', '$email', '$senha', '$telefone')";
    
    // Se não for o último registro, adicione uma vírgula
    if ($i < $num_records) {
        $line .= ",\n";
    } else {
        $line .= ";\n"; // Finaliza a instrução INSERT
    }
    
    fwrite($file, $line);
}

// Fecha o arquivo
fclose($file);

echo "$file_name gerado com sucesso!";
?>
