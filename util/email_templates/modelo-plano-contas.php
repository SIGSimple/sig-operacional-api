<?php

ini_set('default_charset','UTF-8');
date_default_timezone_set('America/Sao_Paulo');

$itens = array
(
	'3 Receitas',
	'3.1 Receitas Operacionais',
	'3.1.1 Receita Bruta de Vendas',
	'3.1.1.01 Mercado Interno',
	'3.1.1.01.001 Vendas de Produtos de Fabricação Própria',
	'3.1.1.01.002 Revenda de Mercadorias',
	'3.1.1.02 Exterior',
	'3.1.1.02.001 Venda de Produtos de Fabricação Própria',
	'3.1.1.02.002 Revenda de Mercadorias',
	'3.1.2 Deduções da Receita Bruta de Vendas',
	'3.1.2.01 Devoluções',
	'3.1.2.01.001 Devoluções de Vendas',
	'3.1.2.02 Tributos sobre Vendas',
	'3.1.2.02.001 IPI',
	'3.1.2.02.002 ICMS',
	'3.1.2.02.003 PIS',
	'3.1.2.02.004 Cofins',
	'3.1.3 Receitas Financeiras',
	'3.1.3.01 Variações Monetárias',
	'3.1.3.01.001 Variação Monetária Ativa',
	'3.1.3.02 Rendimentos de Aplicação Financeira',
	'3.1.3.02.001 Renda Fixa',
	'3.1.3.02.002 Renda Variável',
	'3.1.3.02.003 Outras Aplicações',
	'3.1.3.03 Juros Ativos e Descontos Obtidos',
	'3.1.3.03.001 Juros Ativos',
	'3.1.3.03.002 Descontos Obtidos',
	'3.1.4 Receitas com Participações Societárias',
	'3.1.4.01 Lucros e Dividendos Auferidos',
	'3.1.4.01.001 Lucros',
	'3.1.4.01.002 Dividendos',
	'3.1.4.02 Equivalência Patrimonial',
	'3.1.4.02.001 Equivalência Patrimonial Positiva',
	'3.1.5 Outras Receitas Operacionais',
	'3.1.5.01 Receitas Diversas',
	'3.1.5.01.001 Receitas Eventuais',
	'3.1.5.01.002 Reversão de Provisões',
	'3.1.5.01.003 Recuperação de Despesas',
	'4 Custos e Despesas',
	'4.1 Custos',
	'4.1.1 Custos de Revenda e de Produção',
	'4.1.1.01 Custo de Revenda',
	'4.1.1.01.001 Custo das Mercadorias Vendidas',
	'4.1.1.02 Custos de Produção',
	'4.1.1.02.001 Custo dos Produtos Vendidos',
	'4.2 Despesas',
	'4.2.1 Despesas Operacionais – Comerciais',
	'4.2.1.01 Despesas com Pessoal',
	'4.2.1.01.001 Salários e Ordenados',
	'4.2.1.01.002 Pró-Labore',
	'4.2.1.01.003 Comissões sobre Vendas',
	'4.2.1.01.004 Férias',
	'4.2.1.01.005 Décimo Terceiro Salário',
	'4.2.1.01.006 Horas Extras',
	'4.2.1.01.007 Aviso Prévio',
	'4.2.1.01.008 Indenizações Trabalhistas',
	'4.2.1.01.009 Gratificações',
	'4.2.1.01.010 INSS',
	'4.2.1.01.011 FGTS',
	'4.2.1.02 Despesas Gerais',
	'4.2.1.02.001 Aluguel',
	'4.2.1.02.002 Energia Elétrica',
	'4.2.1.02.003 Telefone',
	'4.2.1.02.004 Água e Esgoto',
	'4.2.1.02.005 Material de Escritório',
	'4.2.1.02.006 Material de Limpeza',
	'4.2.1.02.007 Vale-Transporte',
	'4.2.1.02.008 Serviços Postais',
	'4.2.1.02.009 Seguros',
	'4.2.1.02.010 Viagens',
	'4.2.1.02.011 Propaganda e Publicidade',
	'4.2.1.02.012 Manutenção e Conservação',
	'4.2.1.02.013 Combustíveis e Lubrificantes',
	'4.2.1.02.014 Fretes',
	'4.2.1.02.015 Depreciação e Amortização',
	'4.2.1.02.016 Assistência Médica',
	'4.2.1.02.017 Contratação de Serviços de Terceiros – PJ',
	'4.2.1.02.018 Contratação de Serviços de Terceiros – PF',
	'4.2.1.02.019 Lanches e Refeições',
	'4.2.1.02.020 Programa de Alimentação do Trabalhador',
	'4.2.1.02.021 Brindes',
	'4.2.1.02.022 Pedágios',
	'4.2.1.02.023 Condução',
	'4.2.1.02.024 Arrendamento Mercantil',
	'4.2.1.02.025 Formação Profissional',
	'4.2.1.02.026 Periódicos',
	'4.2.1.02.027 Confraternizações',
	'4.2.2 Despesas Operacionais – Administrativas',
	'4.2.2.01 Despesas com Pessoal',
	'4.2.2.01.001 Salários e Ordenados',
	'4.2.2.01.002 Pró-Labore',
	'4.2.2.01.003 Comissões sobre Vendas',
	'4.2.2.01.004 Férias',
	'4.2.2.01.005 Décimo Terceiro Salário',
	'4.2.2.01.006 Horas Extras',
	'4.2.2.01.007 Aviso Prévio',
	'4.2.2.01.008 Indenizações Trabalhistas',
	'4.2.2.01.009 Gratificações',
	'4.2.2.01.010 INSS',
	'4.2.2.01.011 FGTS',
	'4.2.2.02 Despesas Gerais',
	'4.2.2.02.001 Aluguel',
	'4.2.2.02.002 Energia Elétrica',
	'4.2.2.02.003 Telefone',
	'4.2.2.02.004 Água e Esgoto',
	'4.2.2.02.005 Material de Escritório',
	'4.2.2.02.006 Material de Limpeza',
	'4.2.2.02.007 Vale-Transporte',
	'4.2.2.02.008 Serviços Postais',
	'4.2.2.02.009 Seguros',
	'4.2.2.02.010 Viagens',
	'4.2.2.02.011 Propaganda e Publicidade',
	'4.2.2.02.012 Manutenção e Conservação',
	'4.2.2.02.013 Combustíveis e Lubrificantes',
	'4.2.2.02.014 Depreciação',
	'4.2.2.02.015 Amortização',
	'4.2.2.02.016 Exaustão',
	'4.2.2.02.017 Contratação de Serviços de Terceiros – PJ',
	'4.2.2.02.018 Contratação de Serviços de Terceiros – PF',
	'4.2.2.02.019 Lanches e Refeições',
	'4.2.2.02.020 Programa de Alimentação do Trabalhador',
	'4.2.2.02.021 Brindes',
	'4.2.2.02.022 Assistência Médica',
	'4.2.2.02.023 Condução',
	'4.2.2.02.024 Arrendamento Mercantil',
	'4.2.2.02.025 Formação Profissional',
	'4.2.2.02.026 Periódicos',
	'4.2.2.02.027 Multas Contratuais',
	'4.2.2.02.028 Confraternizações',
	'4.2.2.02.029 Despesas Bancárias',
	'4.2.2.02.030 Perdas com Créditos Incobráveis',
	'4.2.3 Despesas Operacionais – Financeiras',
	'4.2.3.01 Variações Monetárias',
	'4.2.3.01.001 Variação Monetária Passiva',
	'4.2.3.01.002 Juros Pagos',
	'4.2.3.01.003 Descontos Concedidos',
	'4.2.4 Despesas Operacionais – Tributárias',
	'4.2.4.01 Impostos, Taxas e Contribuições',
	'4.2.4.01.001 IPTU',
	'4.2.4.01.002 IPVA',
	'4.2.4.01.003 PIS – Demais Receitas',
	'4.2.4.01.004 Cofins – Demais Receitas',
	'4.2.4.01.005 Multas Fiscais Compensatórias',
	'4.2.4.01.006 Multas Fiscais Punitivas',
	'4.2.4.01.007 Multas Não-Fiscais',
	'4.2.4.01.008 IOF',
	'4.2.5 Outras Despesas Operacionais',
	'4.2.5.01 Outras Despesas Operacionais',
	'4.2.5.01.001 Equivalência Patrimonial Negativa',
	'4.2.5.01.002 Provisões',
	'4.2.6 Outras Receitas e Despesas',
	'4.2.6.01 Receita',
	'4.2.6.01.001 Receita com Alienação de Ativo Não-Circulante',
	'4.2.6.02 Custo',
	'4.2.6.02.001 Custo de Alienação de Ativo Não-Circulante',
	'4.2.6.03 Perdas com Sinistros',
	'4.2.6.03.001 Perdas com Sinistros'
);

$saida = array();
$rel = array ();

/*****************************
 * NÃO ESQUECER DE ATUALIZAR *
 *****************************/

$id_bd = 826;
$id_empreendimento = 20;

/*****************************/

foreach ($itens as $key => $value) {
	$cod = substr($value, 0, strpos($value, ' '));
	$dsc = strstr($value, ' ');

	$codigos = explode('.', $cod);
	$cod_atual = is_array($codigos) ? $codigos[count($codigos)-1] : $cod ;

	$rel[$cod] = $id_bd+$key;
}

foreach ($itens as $key => $value) {
	$cod = substr($value, 0, strpos($value, ' '));
	$dsc = strstr($value, ' ');
	$cod_ant = substr($cod,0, strrpos($cod, '.'));
	if($cod_ant == "")
		echo "INSERT INTO tbl_plano_conta (id, cod_plano, dsc_plano, id_empreendimento) VALUES (". ($id_bd+$key) .", '". $cod ."', '". $dsc ."', ". $id_empreendimento .");<br>";
	else
		echo "INSERT INTO tbl_plano_conta (id, cod_plano, dsc_plano, id_plano_pai, id_empreendimento) VALUES (". ($id_bd+$key) .", '". $cod ."', '". $dsc ."', ". $rel[$cod_ant] .", ". $id_empreendimento .");<br>";

}

?>
