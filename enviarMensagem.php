<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["emailAddress"]), FILTER_SANITIZE_EMAIL);
    $mensagem = trim($_POST["message"]);

    // Verificar se os campos não estão vazios
    if (empty($nome) || empty($mensagem) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Por favor, preencha todos os campos corretamente.";
        exit;
    }

    // Email para onde será enviado
    $para = "seu_email@example.com";  // Substitua pelo seu email
    $assunto = "Novo contato de $nome";

    // Conteúdo do email
    $conteudo = "Nome: $nome\n";
    $conteudo .= "Email: $email\n\n";
    $conteudo .= "Mensagem:\n$mensagem\n";

    // Cabeçalhos do email
    $headers = "De: $nome <$email>";

    // Enviar email
    if (mail($para, $assunto, $conteudo, $headers)) {
        http_response_code(200);
        echo "Mensagem enviada com sucesso!";
    } else {
        http_response_code(500);
        echo "Erro ao enviar a mensagem. Tente novamente mais tarde.";
    }
} else {
    http_response_code(403);
    echo "Este formulário só pode ser submetido via POST.";
}
?>