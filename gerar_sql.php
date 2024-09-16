<?php
// Funções para gerar dados aleatórios
function gerarIdEditora() {
    return rand(1, 1000);
}

function gerarPrefixo() {
    $prefixos = [
        'O Grande', 'A Jornada de', 'Mistérios de', 'Segredos do', 'A Vida em', 
        'O Enigma de', 'O Último', 'A Herança de', 'O Retorno de', 'No Mundo de',
        'O Despertar de', 'As Aventuras de', 'O Legado de', 'O Coração de', 'Em Busca de'
    ];
    return $prefixos[array_rand($prefixos)];
}

function gerarTema() {
    $temas = [
        'Fogo', 'Água', 'Gelo', 'Aventura', 'Amor', 'Mistério', 
        'Segredos', 'Esperança', 'Desafios', 'Perda', 'Redenção',
        'Destino', 'Sorte', 'Coragem', 'Medo', 'Lenda'
    ];
    return $temas[array_rand($temas)];
}

function gerarSubtitulo() {
    $subtitulos = [
        'No Crepúsculo', 'No Limite do Tempo', 'Entre Mundos', 'Nas Sombras', 
        'A Última Esperança', 'O Desafio Supremo', 'No Vale das Sombras', 
        'Em Terras Distantes', 'A Jornada do Destino', 'Na Fronteira da Aventura'
    ];
    return $subtitulos[array_rand($subtitulos)];
}

function gerarIsbn() {
    return '978-' . rand(0, 9) . rand(0, 9) . rand(0, 9) . '-' . rand(0, 9) . rand(0, 9) . rand(0, 9) . '-' . rand(0, 9) . rand(0, 9) . rand(0, 9) . '-' . rand(0, 9) . rand(0, 9) . '-' . rand(0, 9);
}

function gerarAnoPublicacao() {
    return rand(1900, 2024);
}

// Gerar 1000 títulos únicos
$titulos = [];
while (count($titulos) < 1000) {
    $titulo = gerarPrefixo() . ' ' . gerarTema() . ' ' . gerarSubtitulo();
    
    // Garantir que o título seja único
    if (!in_array($titulo, $titulos)) {
        $titulos[] = $titulo;
    }
}

// Gerar comandos SQL de inserção
foreach ($titulos as $titulo) {
    $isbn = gerarIsbn();
    $categoria = gerarTema(); // Usando gerarTema() para categoria também
    $ano_publicacao = gerarAnoPublicacao();
    $id_editora = gerarIdEditora();

    $sql = "INSERT INTO obra (titulo, isbn, categoria, ano_publicacao, id_editora) 
            VALUES ('$titulo', '$isbn', '$categoria', $ano_publicacao, $id_editora);";

    // Exibir o comando SQL gerado
    echo $sql . "\n";
}
?>
