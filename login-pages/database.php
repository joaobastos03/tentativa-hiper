<?php
// Configurações seguras para conexão MySQL no Railway
$dbHost = 'mysql.railway.internal';
$dbPort = '21857'; // Porta fornecida pelo Railway
$dbUsername = 'root';
$dbPassword = 'mUQyCplkYOrCpJOqfMZrJttPKFKrOygY';
$dbName = 'railway'; // Note que o nome do banco é 'railway' e não 'teste_railway'

try {
    // Conexão com especificação de porta
    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName, $dbPort);
    
    // Verificação adicional da conexão
    if (!$conn) {
        throw new mysqli_sql_exception(mysqli_connect_error());
    }
    
    // Configurações importantes para o MySQL
    mysqli_set_charset($conn, 'utf8mb4');
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    // Opcional: definir timezone
    $conn->query("SET time_zone = '-03:00'");
    
} catch(mysqli_sql_exception $e) {
    // Log do erro (útil para debug)
    error_log("Database connection failed: " . $e->getMessage());
    
    // Mensagem amigável para o usuário
    die("Desculpe, estamos com problemas técnicos. Por favor, tente novamente mais tarde.");
}
?>