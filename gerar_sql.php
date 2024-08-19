<?php
// Número de registros a serem gerados
$num_records = 1000;

// Nome do arquivo SQL
$file_name = "insert_emprestimo.sql";

// Abre o arquivo para escrita
$file = fopen($file_name, 'w');

// Escreve o início da instrução INSERT
fwrite($file, "INSERT INTO emprestimo (data_inicio, data_prazo, id_livro, id_aluno, id_usuario) VALUES\n");

// Gera os registros
for ($i = 1; $i <= $num_records; $i++) {
    $data_inicio = date('Y-m-d', strtotime('-' . ($i % 30) . ' days')); // Data de início fictícia
    $data_prazo = rand(7, 30); // Prazo em dias, entre 7 e 30 dias
    $id_livro = ($i % 1000) + 1; // ID do livro variando entre 1 e 1000
    $id_aluno = ($i % 1000) + 1; // ID do aluno variando entre 1 e 1000
    $id_usuario = 1; // ID do usuário fixo
    
    // Adiciona os valores no arquivo
    $line = "('$data_inicio', $data_prazo, $id_livro, $id_aluno, $id_usuario)";
    
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
