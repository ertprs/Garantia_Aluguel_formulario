<?php
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");
 header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once("php7_mysql_shim.php");

require '../../vendor/autoload.php';
$app = new \Slim\App;
$app->get('/hello', function(){
	return 'Hello World!';
});

$app->post('/salvarFormulario', 'salvar');

function salvar($request, $response){
	$cadastro = json_decode($request->getBody());
    //echo json_encode($cadastro->pretendente->cpf);

	$codigoCadastro = utf8_decode(trim(json_encode($cadastro->codigo, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));

	//DADOS DO PRETENDENTE
	$inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->nome, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$CPF_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->cpf, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$data_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->dataNascimento, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$tipo_DOC_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->tipoDoc, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$DOC_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->numDoc, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$orgao_exp_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->orgaoExpedidor, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$data_exp_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->dataEmissao, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$data_validade_doc_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->dataValidade, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$sexo_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->sexo, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$est_civil_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->estadoCivil, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$cpf_conjuge_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->cpfConjuge, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$nome_conjuge_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->nomeConjuge, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$data_conjuge_inquilno = utf8_decode(trim(json_encode($cadastro->pretendente->dataNascimentoConjuge, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$vai_residir_conjuge_inquilno = utf8_decode(trim(json_encode($cadastro->pretendente->iraResidirImovelConjuge, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$vai_compor_renda_conjuge_inquilno = utf8_decode(trim(json_encode($cadastro->pretendente->iraComporRendaConjuge, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$renda_conjuge_inquilno = utf8_decode(trim(json_encode($cadastro->pretendente->rendaConjuge, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$num_dependente_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->numeroDependente, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$nome_mae_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->nomeMae, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$nome_pai_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->nomePai, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$nacionalidade_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->nacionalidade, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	//$pais_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->paisOrigem, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$tempo_pais_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->tempoPais, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	//$resp_locacao_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->responsavelLocacao, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$vai_residir_imov_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->iraResidirImovel, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$fone_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->telefone, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$cel_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->celular, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$fone_com_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->telefoneComercial, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$email_inquilino = utf8_decode(trim(json_encode($cadastro->pretendente->email, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));

	//DADOS DA IMOBILIARIA
	$fantasia_corretor = utf8_decode(trim(json_encode($cadastro->imobiliaria->corretor, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$CGC_imob = utf8_decode(trim(json_encode($cadastro->imobiliaria->cnpj, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));

	//DADOS RESIDENCIAIS ATUAIS//
	$tempo_resid_inquilino = utf8_decode(trim(json_encode($cadastro->residencia->tempoResidencia, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$tipo_resid_inquilino = utf8_decode(trim(json_encode($cadastro->residencia->tipo, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$nome_imobiliaria = utf8_decode(trim(json_encode($cadastro->residencia->nomeImobiliaria, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$telefone_imobiliaria = utf8_decode(trim(json_encode($cadastro->residencia->telefoneImobiliaria, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$resid_emnomede_inquilino = utf8_decode(trim(json_encode($cadastro->residencia->emNome, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$arca_com_aluguel_inquilino = utf8_decode(trim(json_encode($cadastro->residencia->arcaAluguel, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$cep_anterior_inquilino = utf8_decode(trim(json_encode($cadastro->residencia->anterior->cep, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$uf_anterior_inquilino = utf8_decode(trim(json_encode($cadastro->residencia->anterior->estado, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$cidade_anterior_inquilino = utf8_decode(trim(json_encode($cadastro->residencia->anterior->cidade, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$endereco_anterior_inquilino = utf8_decode(trim(json_encode($cadastro->residencia->anterior->endereco, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$bairro_anterior_inquilino = utf8_decode(trim(json_encode($cadastro->residencia->anterior->bairro, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	if(json_encode($cadastro->residencia->anterior->complemento) <> "null"){$complemento_anterior_inquilino = utf8_decode(trim(json_encode($cadastro->residencia->anterior->complemento, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));}else{$complemento_anterior_inquilino="";}
	$num_anterior_inquilino = utf8_decode(trim(json_encode($cadastro->residencia->anterior->numero, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));

	//DADOS PROFISSIONAIS//
	$empresa_trab_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->empresa, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$fone_com_2_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->telefone, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$ramal_com_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->ramal, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$profissao_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->profissao, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$natureza_renda_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->naturezaRenda, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$data_admissao_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->dataAdmissao, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$salario_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->salario, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$outros_rendim_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->outrosRendimentos, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$total_rendim_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->totalRendimentos, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$empresa_anterior_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->empresaAnterior, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$endereco_com_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->enderecoComercial, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$ref_bancaria_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->possuiRefBancaria, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$banco_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->banco, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$agencia_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->agencia, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$ccorrente_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->contaCorrente, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$gerente_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->gerente, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$fone_gerente_inquilino = utf8_decode(trim(json_encode($cadastro->profissional->telefoneGerente, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));

	//DADOS IM�VEL PRETENDIDO//
	$ocupacao = utf8_decode(trim(json_encode($cadastro->imovel->finalidade, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$imovel_tipo = utf8_decode(trim(json_encode($cadastro->imovel->tipo, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$motivo_locacao = utf8_decode(trim(json_encode($cadastro->imovel->motivoLocacao, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$cep = utf8_decode(trim(json_encode($cadastro->imovel->cep, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$uf = utf8_decode(trim(json_encode($cadastro->imovel->estado, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$cidade = utf8_decode(trim(json_encode($cadastro->imovel->cidade, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$endereco = utf8_decode(trim(json_encode($cadastro->imovel->endereco, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$bairro = utf8_decode(trim(json_encode($cadastro->imovel->bairro, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$numero = utf8_decode(trim(json_encode($cadastro->imovel->numero, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$complemento = utf8_decode(trim(json_encode($cadastro->imovel->complemento, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$aluguel = utf8_decode(trim(json_encode($cadastro->imovel->aluguel, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$iptu = utf8_decode(trim(json_encode($cadastro->imovel->iptu, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$condominio = utf8_decode(trim(json_encode($cadastro->imovel->condominio, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$agua = utf8_decode(trim(json_encode($cadastro->imovel->agua, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$energia = utf8_decode(trim(json_encode($cadastro->imovel->luz, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$gas = utf8_decode(trim(json_encode($cadastro->imovel->gas, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	
	//DADOS IM�VEL PARA CADASTRO N�O RESIDENCIAL//
	$empresa_constituida = utf8_decode(trim(json_encode($cadastro->imovel->locacaoEmpresaConstituida, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$cnpj_empresa_constituida = utf8_decode(trim(json_encode($cadastro->imovel->cnpjEmpresaConstituida, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$ramo_atividade_empresa = utf8_decode(trim(json_encode($cadastro->imovel->ramoAtividadeEmpresa, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$franquia_empresa = utf8_decode(trim(json_encode($cadastro->imovel->trataDeFranquia, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$franqueadora_empresa = utf8_decode(trim(json_encode($cadastro->imovel->nomeFranqueadora, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$produtos_servicos_empresa = utf8_decode(trim(json_encode($cadastro->imovel->produtosFabRevPrest, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$experiencia_ramo_empresa = utf8_decode(trim(json_encode($cadastro->imovel->experienciaNoRamo, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$faturam_estim_empresa = utf8_decode(trim(json_encode($cadastro->imovel->faturamentoMensalEstimado, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$ret_cap_invest_empresa = utf8_decode(trim(json_encode($cadastro->imovel->prazoRetCapitalInvest, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));

	//DADOS PESSOAIS//
	$ref_pessoal_nome = utf8_decode(trim(json_encode($cadastro->pessoal->nome, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$ref_pessoal_fone = utf8_decode(trim(json_encode($cadastro->pessoal->telefone, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$ref_pessoal_cel = utf8_decode(trim(json_encode($cadastro->pessoal->celular, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$ref_pessoal_grau_parent = utf8_decode(trim(json_encode($cadastro->pessoal->grauParentesco, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$tem_renda_arcar_loc_inquilino = utf8_decode(trim(json_encode($cadastro->pessoal->possuiRendaArcarLocacao, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$num_solidarios = utf8_decode(trim(json_encode($cadastro->pessoal->numSolidarios, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario1 = utf8_decode(trim(json_encode($cadastro->pessoal->solidario1->nome, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario1_cpf = utf8_decode(trim(json_encode($cadastro->pessoal->solidario1->cpf, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario1_fone = utf8_decode(trim(json_encode($cadastro->pessoal->solidario1->telefone, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario1_sexo = utf8_decode(trim(json_encode($cadastro->pessoal->solidario1->sexo, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario1_rg = utf8_decode(trim(json_encode($cadastro->pessoal->solidario1->numDoc, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario1_renda = utf8_decode(trim(json_encode($cadastro->pessoal->solidario1->rendaMensalBruta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario1_orgao_exp_rg = utf8_decode(trim(json_encode($cadastro->pessoal->solidario1->orgaoExpedidor, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario1_data_exp_rg = utf8_decode(trim(json_encode($cadastro->pessoal->solidario1->dataEmissao, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));

	$solidario2 = utf8_decode(trim(json_encode($cadastro->pessoal->solidario2->nome, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario2_cpf = utf8_decode(trim(json_encode($cadastro->pessoal->solidario2->cpf, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario2_fone = utf8_decode(trim(json_encode($cadastro->pessoal->solidario2->telefone, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario2_sexo = utf8_decode(trim(json_encode($cadastro->pessoal->solidario2->sexo, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario2_rg = utf8_decode(trim(json_encode($cadastro->pessoal->solidario2->numDoc, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario2_renda = utf8_decode(trim(json_encode($cadastro->pessoal->solidario2->rendaMensalBruta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario2_orgao_exp_rg = utf8_decode(trim(json_encode($cadastro->pessoal->solidario2->orgaoExpedidor, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario2_data_exp_rg = utf8_decode(trim(json_encode($cadastro->pessoal->solidario2->dataEmissao, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));

	$solidario3 = utf8_decode(trim(json_encode($cadastro->pessoal->solidario3->nome, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario3_cpf = utf8_decode(trim(json_encode($cadastro->pessoal->solidario3->cpf, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario3_fone = utf8_decode(trim(json_encode($cadastro->pessoal->solidario3->telefone, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario3_sexo = utf8_decode(trim(json_encode($cadastro->pessoal->solidario3->sexo, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario3_rg = utf8_decode(trim(json_encode($cadastro->pessoal->solidario3->numDoc, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario3_renda = utf8_decode(trim(json_encode($cadastro->pessoal->solidario3->rendaMensalBruta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario3_orgao_exp_rg = utf8_decode(trim(json_encode($cadastro->pessoal->solidario3->orgaoExpedidor, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));
	$solidario3_data_exp_rg = utf8_decode(trim(json_encode($cadastro->pessoal->solidario3->dataEmissao, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"'));

    $data_cob = date("Y-m-d");
    $hora_cob = date("H:i:s");
    $seguradora = "ALL";
    $usuario_upload = "HOTSITE";
    $tipo_inquilino = "F";
    $resp_inquilino = "";
    $CPF_resp_inquilino = "";
   	$cep_anterior_inquilino = str_replace(".","", $cep_anterior_inquilino);
   	$cep = str_replace(".","", $cep);

    $conexao = mysql_connect("mysql.segurosja.com.br", "segurosja", "m1181s2081_") or die ("problema na conex�o");

    $sql_imob = "select fantasia, razao, corretor, email, (select razao from corretores where corretores.codigo=imobs.corretor) AS NOME_COR, (select email from corretores where corretores.codigo=imobs.corretor) AS EMAIL_COR from imobs where cpf='$CGC_imob'";
    $consulta_imob = mysql_db_query("segurosja", $sql_imob) or die ("problema no SQL imob");
    while($campo_imob = mysql_fetch_assoc($consulta_imob)){
            $razao_imob = $campo_imob['razao'];
            $fantasia_imob = $campo_imob['fantasia'];
            $email_imob = $campo_imob['email'];
            $cod_cor = $campo_imob['corretor'];
            $corretor = $campo_imob['NOME_COR'];
            $email_cor = $campo_imob['EMAIL_COR'];
    }
    if($fantasia_imob <> ""){$IMOB = $fantasia_imob;}
    else{$IMOB = $razao_imob;}

    //se n�o veio codigo cadastro � inclus�o sen�o � altera��o
    if($codigoCadastro == "" || $codigoCadastro == null || $codigoCadastro == "null"){

        $sql = "insert into fianca (data_transm, hora_transm, seguradora, solicitante, CGC_imob,
                                    inquilino, tipo_inquilino, CPF_inquilino, data_inquilino, sexo_inquilino, est_civil_inquilino, tipo_doc_inquilino, rg_inquilino, orgao_exp_inquilino, data_exp_inquilino, data_validade_doc_inquilino, resp_inquilino, CPF_resp_inquilino,
                                    nome_conjuge_inquilino, cpf_conjuge_inquilino, data_conjuge_inquilno, vai_residir_conjuge_inquilno, vai_compor_renda_conjuge_inquilno, renda_conjuge_inquilno,
                                    num_dependente_inquilino, nome_mae_inquilino, nome_pai_inquilino, nacionalidade_inquilino, pais_inquilino, tempo_pais_inquilino, resp_locacao_inquilino, vai_residir_imov_inquilino, tem_renda_arcar_loc_inquilino, fone_inquilino, cel_inquilino, email_inquilino,
                                    tempo_resid_inquilino, tipo_resid_inquilino, imob_prop_atual, fone_imob_prop_atual, resid_emnomede_inquilino, arca_com_aluguel_inquilino, cep_anterior_inquilino, uf_anterior_inquilino, cidade_anterior_inquilino, endereco_anterior_inquilino, bairro_anterior_inquilino, complemento_anterior_inquilino, num_anterior_inquilino,
                                    empresa_trab_inquilino, fone_com_inquilino, ramal_com_inquilino, profissao_inquilino, natureza_renda_inquilino, data_admissao_inquilino, salario_inquilino, outros_rendim_inquilino, total_rendim_inquilino, empresa_anterior_inquilino, endereco_com_inquilino,
                                    ref_bancaria_inquilino, banco_inquilino, agencia_inquilino, ccorrente_inquilino, gerente_inquilino, fone_gerente_inquilino, ref_pessoal_nome, ref_pessoal_fone, ref_pessoal_cel, ref_pessoal_grau_parent,
                                    empresa_constituida, cnpj_empresa_constituida, ramo_atividade_empresa, franquia_empresa, franqueadora_empresa, produtos_servicos_empresa, experiencia_ramo_empresa, faturam_estim_empresa, ret_cap_invest_empresa,
                                    num_solidarios, solidario1, solidario1_cpf, solidario1_fone, solidario1_sexo, solidario1_rg, solidario2, solidario2_cpf, solidario2_fone, solidario2_sexo, solidario2_rg, solidario3, solidario3_cpf, solidario3_fone, solidario3_sexo, solidario3_rg,
                                    cep, endereco, numero, complemento, bairro, cidade, uf, aluguel,
                                    ocupacao, imovel_tipo, motivo_locacao, inicio,
                                    condominio, gas, iptu, energia, agua, pintura_int, pintura_ext, danos, multa,
                                    corretor)

                            values ('$data_cob', '$hora_cob', '$seguradora', '$usuario_upload', '$CGC_imob',
								   '$inquilino', '$tipo_inquilino', '$CPF_inquilino', '$data_inquilino', '$sexo_inquilino', '$est_civil_inquilino', '$tipo_DOC_inquilino', '$DOC_inquilino', '$orgao_exp_inquilino', '$data_exp_inquilino', '$data_validade_doc_inquilino', '$resp_inquilino', '$CPF_resp_inquilino',
                                   '$nome_conjuge_inquilino', '$cpf_conjuge_inquilino', '$data_conjuge_inquilno', '$vai_residir_conjuge_inquilno', '$vai_compor_renda_conjuge_inquilno', '$renda_conjuge_inquilno',
                                   '$num_dependente_inquilino', '$nome_mae_inquilino', '$nome_pai_inquilino', '$nacionalidade_inquilino', '$pais_inquilino', '$tempo_pais_inquilino', '$resp_locacao_inquilino', '$vai_residir_imov_inquilino', '$tem_renda_arcar_loc_inquilino', '$fone_inquilino', '$cel_inquilino', '$email_inquilino',
								   '$tempo_resid_inquilino', '$tipo_resid_inquilino', '$nome_imobiliaria', '$telefone_imobiliaria', '$resid_emnomede_inquilino', '$arca_com_aluguel_inquilino', '$cep_anterior_inquilino', '$uf_anterior_inquilino', '$cidade_anterior_inquilino', '$endereco_anterior_inquilino', '$bairro_anterior_inquilino', '$complemento_anterior_inquilino', '$num_anterior_inquilino',
                                   '$empresa_trab_inquilino', '$fone_com_inquilino', '$ramal_com_inquilino', '$profissao_inquilino', '$natureza_renda_inquilino', '$data_admissao_inquilino', '$salario_inquilino', '$outros_rendim_inquilino', '$total_rendim_inquilino', '$empresa_anterior_inquilino', '$endereco_com_inquilino',
                                   '$ref_bancaria_inquilino', '$banco_inquilino', '$agencia_inquilino', '$ccorrente_inquilino', '$gerente_inquilino', '$fone_gerente_inquilino', '$ref_pessoal_nome', '$ref_pessoal_fone', '$ref_pessoal_cel', '$ref_pessoal_grau_parent',
                                   '$empresa_constituida', '$cnpj_empresa_constituida', '$ramo_atividade_empresa',	'$franquia_empresa', '$franqueadora_empresa', '$produtos_servicos_empresa', '$experiencia_ramo_empresa', '$faturam_estim_empresa', '$ret_cap_invest_empresa',
                                   '$num_solidarios', '$solidario1', '$solidario1_cpf', '$solidario1_fone', '$solidario1_sexo', '$solidario1_rg', '$solidario2', '$solidario2_cpf', '$solidario2_fone', '$solidario2_sexo', '$solidario2_rg', '$solidario3', '$solidario3_cpf', '$solidario3_fone', '$solidario3_sexo', '$solidario3_rg',
								   '$cep', '$endereco', '$numero', '$complemento', '$bairro', '$cidade', '$uf', '$aluguel',
								   '$ocupacao', '$imovel_tipo', '$motivo_locacao', '$inicio', '$condominio', '$gas', '$iptu', '$energia', '$agua', '$pintura_int', '$pintura_ext', '$danos', '$multa',
							       '$cod_cor')";
							       
        $sql = str_replace("null", "", $sql);

    }else{
    	$sql = "UPDATE fianca set 
		inquilino='$inquilino',
		tipo_inquilino='$tipo_inquilino',
		CPF_inquilino='$CPF_inquilino',
		data_inquilino='$data_inquilino',
		tipo_doc_inquilino = '$tipo_DOC_inquilino',
		sexo_inquilino='$sexo_inquilino',
		est_civil_inquilino='$est_civil_inquilino',
		rg_inquilino='$DOC_inquilino',
		orgao_exp_inquilino='$orgao_exp_inquilino',
		data_exp_inquilino='$data_exp_inquilino',
		data_validade_doc_inquilino='$data_validade_doc_inquilino',
		resp_inquilino='$resp_inquilino',
		CPF_resp_inquilino='$CPF_resp_inquilino',
		nome_conjuge_inquilino='$nome_conjuge_inquilino',
		cpf_conjuge_inquilino='$cpf_conjuge_inquilino',
		nome_conjuge_inquilino='$nome_conjuge_inquilino',
        cpf_conjuge_inquilino='$cpf_conjuge_inquilino',
        data_conjuge_inquilno='$data_conjuge_inquilno',
        vai_residir_conjuge_inquilno='$vai_residir_conjuge_inquilno',
        vai_compor_renda_conjuge_inquilno='$vai_compor_renda_conjuge_inquilno',
        renda_conjuge_inquilno='$renda_conjuge_inquilno',
		num_dependente_inquilino='$num_dependente_inquilino',
		nome_mae_inquilino='$nome_mae_inquilino',
		nome_pai_inquilino='$nome_pai_inquilino',
		nacionalidade_inquilino='$nacionalidade_inquilino',
		pais_inquilino='$pais_inquilino',
		tempo_pais_inquilino='$tempo_pais_inquilino',
		resp_locacao_inquilino='$resp_locacao_inquilino',
		vai_residir_imov_inquilino='$vai_residir_imov_inquilino',
		tem_renda_arcar_loc_inquilino='$tem_renda_arcar_loc_inquilino',
		fone_inquilino='$fone_inquilino',
		cel_inquilino='$cel_inquilino',
		email_inquilino='$email_inquilino',
		tempo_resid_inquilino='$tempo_resid_inquilino',
		tipo_resid_inquilino='$tipo_resid_inquilino',
		imob_prop_atual='$nome_imobiliaria',
		fone_imob_prop_atual='$telefone_imobiliaria',
		resid_emnomede_inquilino='$resid_emnomede_inquilino',
		arca_com_aluguel_inquilino='$arca_com_aluguel_inquilino',
		cep_anterior_inquilino='$cep_anterior_inquilino',
		uf_anterior_inquilino='$uf_anterior_inquilino',
		cidade_anterior_inquilino='$cidade_anterior_inquilino',
		endereco_anterior_inquilino='$endereco_anterior_inquilino',
		bairro_anterior_inquilino='$bairro_anterior_inquilino',
		complemento_anterior_inquilino='$complemento_anterior_inquilino',
		num_anterior_inquilino='$num_anterior_inquilino',
		empresa_trab_inquilino='$empresa_trab_inquilino',
		fone_com_inquilino='$fone_com_inquilino',
		ramal_com_inquilino='$ramal_com_inquilino',
		profissao_inquilino='$profissao_inquilino',
		natureza_renda_inquilino='$natureza_renda_inquilino',
		data_admissao_inquilino='$data_admissao_inquilino',
		salario_inquilino='$salario_inquilino',
		outros_rendim_inquilino='$outros_rendim_inquilino',
		total_rendim_inquilino='$total_rendim_inquilino',
		empresa_anterior_inquilino='$empresa_anterior_inquilino',
		endereco_com_inquilino='$endereco_com_inquilino',
		ref_bancaria_inquilino='$ref_bancaria_inquilino',
		banco_inquilino='$banco_inquilino',
		agencia_inquilino='$agencia_inquilino',
		ccorrente_inquilino='$ccorrente_inquilino',
		gerente_inquilino='$gerente_inquilino',
		fone_gerente_inquilino='$fone_gerente_inquilino',
		ref_pessoal_nome='$ref_pessoal_nome',
		ref_pessoal_fone='$ref_pessoal_fone',
		ref_pessoal_cel='$ref_pessoal_cel',
		ref_pessoal_grau_parent='$ref_pessoal_grau_parent',
		empresa_constituida='$empresa_constituida',
		cnpj_empresa_constituida='$cnpj_empresa_constituida',
		ramo_atividade_empresa='$ramo_atividade_empresa',
		franquia_empresa='$franquia_empresa',
		franqueadora_empresa='$franqueadora_empresa',
		produtos_servicos_empresa='$produtos_servicos_empresa',
		experiencia_ramo_empresa='$experiencia_ramo_empresa',
		faturam_estim_empresa='$faturam_estim_empresa',
		ret_cap_invest_empresa='$ret_cap_invest_empresa',
		num_solidarios='$num_solidarios',
		solidario1='$solidario1',
		solidario1_cpf='$solidario1_cpf',
		solidario1_fone='$solidario1_fone',
		solidario1_sexo='$solidario1_sexo',
		solidario1_rg='$solidario1_rg',
		solidario2='$solidario2',
		solidario2_cpf='$solidario2_cpf',
		solidario2_fone='$solidario2_fone',
		solidario2_sexo='$solidario2_sexo',
		solidario2_rg='$solidario2_rg',
		solidario3='$solidario3',
		solidario3_cpf='$solidario3_cpf', 
		solidario3_fone='$solidario3_fone',
		solidario3_sexo='$solidario3_sexo',
		solidario3_rg='$solidario3_rg',
		cep='$cep',
		endereco='$endereco',
		numero='$numero',
		quadra='$quadra',
		lote='$lote',
		complemento='$complemento',
		bairro='$bairro',
		cidade='$cidade',
		uf='$uf',
		aluguel='$aluguel',
		ocupacao='$ocupacao',
		imovel_tipo='$imovel_tipo',
		motivo_locacao='$motivo_locacao',
		condominio='$condominio',
		gas='$gas',
		iptu='$iptu',
		energia='$energia',
		agua='$agua'
		WHERE codigo=$codigoCadastro";
    }

   
    mysql_db_query("segurosja", $sql) or die (mysql_error());
    $sql_last_insert = "SELECT LAST_INSERT_ID()";
    $consulta_last_insert = mysql_db_query("segurosja", $sql_last_insert) or die (mysql_error());
    $aux=0;
    while($aux < mysql_num_rows($consulta_last_insert)){
          $campo_last_insert = mysql_fetch_array($consulta_last_insert);
          $registro = $campo_last_insert[0];
          $aux++;
    }
    
    /*
    //return requisicaoSucesso('dados salvo com sucesso'); ex: retorno sucesso
    //return erroInternoServidor('erro ao salvar dados'); ex: retorno erro servidor
    //return erroNegocio('cpf invalido'); ex: retorno erro de negocio

    //retorna status 500-> erro interno do servidor
    function erroInternoServidor($response, $erro){
    return $response->withStatus(500)->withHeader('HTTP/1.1 500 Error', $erro);
    }
    //retorna status 400-> erro de validacao
    function erroNegocio($response, $erro){
    return $response->withStatus(400)->withHeader('HTTP/1.1 400 Error', $erro);
    }
    //retorna status 200-> Ok
    function requisicaoSucesso($response, $msg){
    return $response->withStatus(200)->withHeader('HTTP/1.1 200 Success', $msg);
    }      */

    $mensagem = "<html><body><div align='center'><b>** An�lise de Cadastro para Fian�a Locat�cia n�: ". $registro . " **</b><BR>" . $inquilino . "<BR><BR>";
    $mensagem .= "
        <HR></div><div align='left'>
        <b>Imobili�ria:</b> ".$IMOB." - <b>Corretor:</b> ".$corretor."<BR>
        </div><div align='center'><HR></div><div align='left'>
        <b>Pretendente:</b> ".$inquilino." - <b>Tipo Pessoa:</b> ".$tipo_inquilino." - <b>CPF/CNPJ:</b> ".$CPF_inquilino."<BR>
        <b>Data de Nascimento:</b> ".$data_inquilino." - <b>Sexo:</b> ".$sexo_inquilino." - <b>Estado Civil:</b> ".$est_civil_inquilino."<BR>
        <b>RG/Documento:</b> ".$tipo_DOC_inquilino." - <b>�rg�o Expedidor:</b> ".$orgao_exp_inquilino." - <b>Data de Expedi��o do Documento:</b> ".$data_exp_inquilino." - <b>Validade:</b> ".$data_validade_doc_inquilino."<BR>
        <b>Respons�vel pela PJ:</b> ".$resp_inquilino." - <b>CPF:</b> ".$CPF_resp_inquilino."<BR>
        <b>Telefone:</b> ".$fone_inquilino." - <b>Celular:</b> ".$cel_inquilino." - <b>E-mail:</b> ".$email_inquilino."<BR>
        </div><div align='center'><HR></div><div align='left'>
        <b>CPF C�njuge:</b> ".$cpf_conjuge_inquilino." - <b>N�mero de Dependentes:</b> ".$num_dependente_inquilino."<BR>
        <b>Nome da M�e:</b> ".$nome_mae_inquilino." - <b>Nome do Pai:</b> ".$nome_pai_inquilino."<BR>
        <b>Nacionalidade Pretendente:</b> ".$nacionalidade_inquilino." - <b>Pa�s:</b> ".$pais_inquilino." - <b>Tempo no Pa�s:</b> ".$tempo_pais_inquilino."<BR>
        </div><div align='center'><HR></div><div align='left'>
        <b>Respons�vel pela Loca��o:</b> ".$resp_locacao_inquilino." - <b>Inquilino vai residir no im�vel?</b> ".$vai_residir_imov_inquilino." - <b>Tem renda para arcar com a loca��o?</b> ".$tem_renda_arcar_loc_inquilino."<BR>
        <b>Tempo de resid�ncia atual:</b> ".$tempo_resid_inquilino." - <b>Tipo de Resid�ncia:</b> ".$tipo_resid_inquilino." -
        <b>Imobili�ria/Propriet�rio Atual:</b> ".$imob_prop_atual." - <b>Telefone:</b> ".$fone_imob_prop_atual." - <b>Resid�ncia em Nome de quem?</b> ".$resid_emnomede_inquilino."<BR>
        <b>Arca com aluguel?</b> ".$arca_com_aluguel_inquilino."<b>CEP Atual:</b> ".$cep_anterior_inquilino." - <b>UF:</b> ".$uf_anterior_inquilino." - <b>Cidade:</b> ".$cidade_anterior_inquilino."<BR>
        <b>Endere�o Atual:</b> ".$endereco_anterior_inquilino." - <b>N�mero:</b> ".$num_anterior_inquilino." - <b>Complemento:</b> ".$complemento_anterior_inquilino." - <b>Bairro:</b> ".$bairro_anterior_inquilino."<BR>
        </div><div align='center'><HR></div><div align='left'>
        <b>Empresa que Trabalha:</b> ".$empresa_trab_inquilino." - <b>Telefone:</b> ".$fone_com_inquilino." - <b>Ramal:</b> ".$ramal_com_inquilino." - <b>Data de Admiss�o:</b> ".$data_admissao_inquilino." - <b>Endere�o Comercial:</b> ".$endereco_com_inquilino."<BR>
        <b>Profiss�o:</b> ".$profissao_inquilino." - <b>Natureza da Renda:</b> ".$natureza_renda_inquilino." - <b>Sal�rio:</b> ".$salario_inquilino."<BR>
        <b>Ourtos Rendimentos:</b> ".$outros_rendim_inquilino." - <b>Total de Outros Rendimentos:</b> ".$total_rendim_inquilino."<BR>
        <b>Empresa que trabalhou Anteriormente:</b> ".$empresa_anterior_inquilino."<BR>
        </div><div align='center'><HR></div><div align='left'>
        <b>Refer�ncia Banc�ria:</b> ".$ref_bancaria_inquilino." - <b>Banco:</b> ".$banco_inquilino." - <b>Ag�ncia:</b> ".$agencia_inquilino." - <b>Conta Corrente:</b> ".$ccorrente_inquilino."<BR>
        <b>Gerente da Conta:</b> ".$gerente_inquilino." - <b>Telefone:</b> ".$fone_gerente_inquilino."<BR>
        <b>Refer�ncia Pessoal:</b> ".$ref_pessoal_nome." - <b>Telefone:</b> ".$ref_pessoal_fone." - <b>Celular:</b> ".$ref_pessoal_cel." - <b>Grau de Parentesco/Relacionamento:</b> ".$ref_pessoal_grau_parent."<BR>
        </div><div align='center'><HR></div><div align='left'>
        <b>N�mero de Locat�rios Solid�rios:</b> ".$num_solidarios."<BR>
        <b>Nome do Solid�rio 1:</b> ".$solidario1." - <b>CPF/CNPJ:</b> ".$solidario1_cpf." - <b>Sexo:</b> ".$solidario1_sexo." - <b>RG:</b> ".$solidario1_rg." - <b>�rg�o Expedidor:</b> ".$solidario1_orgao_exp_rg." - <b>Data de Expedi��o:</b> ".$solidario1_data_exp_rg." - <b>Telefone:</b> ".$solidario1_fone."<BR>
        <b>Nome do Solid�rio 2:</b> ".$solidario2." - <b>CPF/CNPJ:</b> ".$solidario2_cpf." - <b>Sexo:</b> ".$solidario2_sexo." - <b>RG:</b> ".$solidario2_rg." - <b>�rg�o Expedidor:</b> ".$solidario2_orgao_exp_rg." - <b>Data de Expedi��o:</b> ".$solidario2_data_exp_rg." - <b>Telefone:</b> ".$solidario2_fone."<BR>
        <b>Nome do Solid�rio 3:</b> ".$solidario3." - <b>CPF/CNPJ:</b> ".$solidario3_cpf." - <b>Sexo:</b> ".$solidario3_sexo." - <b>RG:</b> ".$solidario3_rg." - <b>�rg�o Expedidor:</b> ".$solidario3_orgao_exp_rg." - <b>Data de Expedi��o:</b> ".$solidario3_data_exp_rg." - <b>Telefone:</b> ".$solidario3_fone."<BR>
        </div><div align='center'><HR></div><div align='left'>
        <b>CEP do Im�vel Pretendido:</b> ".$cep." - <b>Endere�o:</b> ".$endereco." - <b>N�mero:</b> ".$numero." - <b>Quadra:</b> ".$quadra." - <b>Lote:</b> ".$lote." - <b>Complemento:</b> ".$complemento."<BR>
        <b>Bairro:</b> ".$bairro." - <b>Cidade:</b> ".$cidade." - <b>UF:</b> ".$uf."<BR>
        <b>Finalidade da Loca��o:</b> ".$ocupacao." - <b>Tipo do Im�vel:</b> ".$imovel_tipo." - <b>Motivo da Loca��o:</b> ".$motivo_locacao."<BR>
        </div><div align='center'><HR></div><div align='left'>
        <b>Aluguel:</b> ".$aluguel." - <b>Condom�nio:</b> ".$condominio." - <b>G�s:</b> ".$gas." - <b>IPTU:</b> ".$iptu." - <b>Energia:</b> ".$energia." - <b>�gua:</b> ".$agua."
        </div><div align='center'><HR></div>";
    $mensagem .= "<div align='center'><font size='2'>Data e hora de envio: ".$data_cob." - ".$hora_cob." - Seg: ".$seguradora." - Usu�rio: ".$usuario_upload."</font></div></body></html>";

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
    $mail->AddReplyTo("$email_cor"); // Email para receber as respostas
    // Define os dados t�cnicos da Mensagem
    $mail->IsHTML(true); // Define que o e-mail ser� enviado como HTML
    $mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)

    if($cod_cor == "0"){$mail->AddAddress('cadastro@maximizaseguros.com.br');$mail->AddCC('aluguel@mx10.com.br');$mail->AddCC('aluguel2@maximizaseguros.com.br');$mail->AddCC('cadastro@mx10.com.br');}
    else if($cod_cor == "10"){$mail->AddAddress("cadastro.df@maximizaseguros.com.br");$mail->AddCC("aluguel.df@maximizaseguros.com.br");}
    else if($cod_cor == "8"){$mail->AddAddress("mt@maximizaseguros.com.br");$mail->AddCC("mt@mx10.com.br");}
    else if($cod_cor == "6"){$mail->AddAddress('cadastro@maximizaseguros.com.br');$mail->AddCC('aluguel@mx10.com.br');$mail->AddCC('aluguel2@maximizaseguros.com.br');$mail->AddCC('cadastro@mx10.com.br');}
    else if($cod_cor == "5"){$mail->AddAddress('ccavalcante@riolupo.com.br');$mail->AddBCC('clemente@mx10.com.br');$mail->AddBCC('leandro@maximizaseguros.com.br');}
    else if($cod_cor == "11"){$mail->AddAddress('ba@maximizaseguros.com.br');$mail->AddBCC('eduardo@maximizaseguros.com.br');$mail->AddBCC('silmara@maximizaseguros.com.br');}
    else{$mail->AddBCC("clemente@maximizaseguros.com.br");}
    $mail->AddCC("$email_imob");
    $mail->AddBCC("leandro@mx10.com.br");

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

    //echo $retorno_mail;
    return $registro;
}

$app->run();

?>
