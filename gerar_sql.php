<?php
// Número de registros a serem gerados
$num_records = 1000;

// Nome do arquivo SQL
$file_name = "insert_usuarios.sql";

// Abre o arquivo para escrita
$file = fopen($file_name, 'w');

// Escreve o início da instrução INSERT
fwrite($file, "INSERT INTO usuarios (nome, email, senha, telefone) VALUES\n");

// Gera os registros
for ($i = 1; $i <= $num_records; $i++) {
    $nome = "Tom Cruise $i";
    $email = "tomcruise$i@gmail.com";
    $senha = "123$i";
    $telefone = "12345678" . ($i % 10);
    
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