<?php
require_once("php7_mysql_shim.php");

$registro = $_REQUEST['codigo'];
$conexao = mysql_connect("mysql.segurosja.com.br", "segurosja", "m1181s2081_") or die ("problema na conex�o");
$sql = "select * from fianca where codigo='$registro'";
$consulta = mysql_db_query("segurosja", $sql);
while($campo = mysql_fetch_assoc($consulta)){
    $inquilino=$campo['inquilino'];
}

$inquilino = str_replace(' ', '_', $inquilino);

if ( !empty( $_FILES ) ) {
    $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
    $path = "./uploads/" . "$registro" . '_' . "$inquilino";
    if(!file_exists ( $path )){
        mkdir($path, 0777);
    }
    $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . "$registro" . '_' . "$inquilino" . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
    move_uploaded_file( $tempPath, $uploadPath );
    copy('./uploads/index.php', './uploads/index.php');
    copy('./uploads/.user.ini', './uploads/.user.ini');
    $answer = array( 'answer' => 'Transfer�ncia Conclu�da' );
    $json = json_encode( $answer );
    echo $json;
} else {
    echo 'Sem arquivo.';
}

$mensagem = "<html><body><div align='center'><b>** An�lise de Cadastro para Fian�a Locat�cia n�: ". $registro . " **</b><BR>" . $inquilino . "<BR><BR><a href='http://www.segurosja.com.br/gerenciador/fianca/app/php/uploads/" . $registro . '_' . $inquilino . "'>Arquivo(s) anexado(s)</a></body></html>";

// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
require("../../../../adm/phpmailer/class.phpmailer.php");
// Inicia a classe PHPMailer
$mail = new PHPMailer();
// Define os dados do servidor e tipo de conex�o
$mail->IsSMTP(); // Define que a mensagem ser� SMTP
$mail->Host = "smtp.segurosja.com.br"; // Endere�o do servidor SMTP (caso queira utilizar a autentica��o, utilize o host smtp.seudom�nio.com.br)
$mail->SMTPAuth = true; // Usar autentica��o SMTP (obrigat�rio para smtp.seudom�nio.com.br)
$mail->Username = 'cobertura=segurosja.com.br'; // Usu�rio do servidor SMTP (endere�o de email)
$mail->Password = 'm1181s2081_'; // Senha do servidor SMTP (senha do email usado)
// Define o remetente
$mail->From = "cobertura@segurosja.com.br"; // Seu e-mail
$mail->Sender = "cobertura@segurosja.com.br"; // Seu e-mail
$mail->FromName = "Seguros J�! Cadastro"; // Seu nome
$mail->AddReplyTo("cobertura@segurosja.com.br"); // Email para receber as respostas
// Define os dados t�cnicos da Mensagem
$mail->IsHTML(true); // Define que o e-mail ser� enviado como HTML
$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
$mail->AddAddress("leandro@maximizaseguros.com.br");//apagar
$mail->Body = $mensagem;//apagar
$mail->Subject = "An�lise de Fian�a " . $registro . " - " . $inquilino; //apagar
$enviado = $mail->Send();//apagar

// Limpa os destinat�rios e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();
// Exibe uma mensagem de resultado
if($enviado){$retorno_mail = "E-mail(s) enviado(s) com sucesso!";}
else{
    $retorno_mail = "N�o foi poss�vel enviar o(s) e-mail(s).";
    $retorno_mail .= " Informa��es do erro: " . $mail->ErrorInfo;
}

mysql_close($conexao);

echo $retorno_mail;

?>
