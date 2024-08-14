<?php
// Número de registros a serem gerados
$num_records = 1000;

// Nome do arquivo SQL
$file_name = "insert_alunos.sql";

// Abre o arquivo para escrita
$file = fopen($file_name, 'w');

// Escreve o início da instrução INSERT
fwrite($file, "INSERT INTO aluno (cpf, nome, email, telefone, turma) VALUES\n");

// Gera os registros
for ($i = 1; $i <= $num_records; $i++) {
    $cpf = str_pad($i, 11, '0', STR_PAD_LEFT); // CPF fictício, formato 00000000000
    $nome = "Aluno $i";
    $email = "aluno$i@gmail.com";
    $telefone = "12345678" . ($i % 10);
    $turma = "3D"; // Turmas de A a Z
    
    // Adiciona os valores no arquivo
    $line = "('$cpf', '$nome', '$email', '$telefone', '$turma')";
    
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
