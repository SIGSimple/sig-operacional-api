<?php

set_time_limit(0);

require_once('config/loader.php');

Flight::route('GET /', function() {
	Flight::halt(200, "<h1 style='margin-top: 30px; text-align: center;'>SIG Operacional API Services</h1>");
});

Flight::route('POST /configuracao/chave', 								array('ConfiguracaoController', 'saveConfiguracao'));
Flight::route('GET /configuracoes(.json)', 								array('ConfiguracaoController', 'getConfiguracoes'));

Flight::route('POST /alerta/email', 									array('AlertaEmailController', 'saveAlertaEmail'));
Flight::route('GET /alertas/email(.json)', 								array('AlertaEmailController', 'getAlertasEmail'));
Flight::route('GET /alertas/processar', 								array('AlertaEmailController', 'processarAlertas'));

Flight::route('POST /usuario/desbloquear/senha', 						array('UsuarioController', 'desbloquearSenhaUsuario'));
Flight::route('GET /usuarios(.json)', 									array('UsuarioController', 'getUsuarios'));
Flight::route('GET /modulos(.json)', 									array('ModuloController', 'getModulos'));
Flight::route('GET /tipos/recurso(.json)', 								array('TipoRecursoController', 'get'));
Flight::route('GET /tipos/empreendimento(.json)', 						array('TipoEmpreendimentoController', 'get'));
Flight::route('GET /tipos/ete(.json)',			 						array('TipoETEController', 'get'));
Flight::route('GET /tipos/pendencia(.json)',			 				array('TipoPendenciaController', 'get'));
Flight::route('GET /tipos/contratacao(.json)',			 				array('TipoContratacaoController', 'get'));
Flight::route('GET /cidades(.json)', 									array('CidadeController', 'get'));
Flight::route('GET /partidos(.json)', 									array('PartidoController', 'get'));
Flight::route('GET /concessoes(.json)', 								array('ConcessaoController', 'get'));
Flight::route('GET /parceiros(.json)', 									array('ParceiroController', 'get'));

Flight::route('POST /perfil',		 									array('PerfilController', 'save'));
Flight::route('GET /perfis(.json)',		 								array('PerfilController', 'getPerfis'));
Flight::route('GET /perfil/@cod_perfil/modulos(.json)',		 			array('ModuloPerfilController', 'getModulosPerfis'));

Flight::route('GET /situacoes/clima(.json)', 							array('SituacaoClimaController', 'get'));
Flight::route('GET /situacoes/obra(.json)', 							array('SituacaoObraController', 'get'));
Flight::route('GET /situacoes/sso(.json)', 								array('SituacaoSSOController', 'get'));

Flight::route('POST /agencia-cetesb', 									array('AgenciaCetesbController', 'save'));
Flight::route('DELETE /agencia-cetesb', 								array('AgenciaCetesbController', 'delete'));
Flight::route('GET /agencia-cetesb/@id/municipios-atendidos(.json)', 	array('AgenciaCetesbMunicipioController', 'getMunicipiosByIdAgenciaCetesb'));
Flight::route('GET /agencia-cetesb/@id(.json)', 						array('AgenciaCetesbController', 'getById'));
Flight::route('GET /agencias-cetesb(.json)', 							array('AgenciaCetesbController', 'get'));

Flight::route('POST /divisao-bacia', 									array('DivisaoBaciaController', 'save'));
Flight::route('DELETE /divisao-bacia', 									array('DivisaoBaciaController', 'delete'));
Flight::route('GET /divisao-bacia/@id(.json)', 							array('DivisaoBaciaController', 'getById'));
Flight::route('GET /divisoes-bacia(.json)', 							array('DivisaoBaciaController', 'get'));

Flight::route('POST /bacia-hidrografica', 								array('BaciaHidrograficaController', 'save'));
Flight::route('DELETE /bacia-hidrografica', 							array('BaciaHidrograficaController', 'delete'));
Flight::route('GET /bacia-hidrografica/@id(.json)', 					array('BaciaHidrograficaController', 'getById'));
Flight::route('GET /bacias-hidrograficas(.json)', 						array('BaciaHidrograficaController', 'get'));

Flight::route('POST /empresa', 											array('EmpresaController', 'save'));
Flight::route('DELETE /empresa', 										array('EmpresaController', 'delete'));
Flight::route('GET /empresa/@id(.json)', 								array('EmpresaController', 'getById'));
Flight::route('GET /empresas(.json)', 									array('EmpresaController', 'get'));

Flight::route('POST /interessado', 										array('InteressadoController', 'save'));
Flight::route('DELETE /interessado', 									array('InteressadoController', 'delete'));
Flight::route('GET /interessado/@id(.json)', 							array('InteressadoController', 'getById'));
Flight::route('GET /interessados(.json)', 								array('InteressadoController', 'get'));
Flight::route('GET /responsaveis(.json)', 								array('InteressadoController', 'get'));
Flight::route('GET /destinatarios(.json)', 								array('InteressadoController', 'get'));

Flight::route('POST /manancial-lancamento', 							array('ManancialLancamentoController', 'save'));
Flight::route('DELETE /manancial-lancamento', 							array('ManancialLancamentoController', 'delete'));
Flight::route('GET /manancial-lancamento/@id(.json)', 					array('ManancialLancamentoController', 'getById'));
Flight::route('GET /mananciais-lancamento(.json)', 						array('ManancialLancamentoController', 'get'));

Flight::route('POST /recurso', 											array('RecursoController', 'save'));
Flight::route('DELETE /recurso', 										array('RecursoController', 'delete'));
Flight::route('GET /recurso/@id(.json)', 								array('RecursoController', 'getById'));
Flight::route('GET /recursos(.json)', 									array('RecursoController', 'get'));

Flight::route('POST /programa', 										array('ProgramaController', 'save'));
Flight::route('DELETE /programa', 										array('ProgramaController', 'delete'));
Flight::route('GET /programa/@id(.json)', 								array('ProgramaController', 'getById'));
Flight::route('GET /programas(.json)', 									array('ProgramaController', 'get'));

Flight::route('POST /situacao/contrato',								array('SituacaoContratoController', 'save'));
Flight::route('DELETE /situacao/contrato',								array('SituacaoContratoController', 'delete'));
Flight::route('GET /situacao/contrato/@id(.json)', 						array('SituacaoContratoController', 'getById'));
Flight::route('GET /situacoes/contrato(.json)', 						array('SituacaoContratoController', 'get'));

Flight::route('POST /municipio',										array('MunicipioController', 'save'));
Flight::route('DELETE /municipio',										array('MunicipioController', 'delete'));
Flight::route('GET /municipio/@id(.json)', 								array('MunicipioController', 'getById'));
Flight::route('GET /municipios(.json)', 								array('MunicipioController', 'get'));

Flight::route('POST /empreendimento',									array('EmpreendimentoController', 'save'));
Flight::route('DELETE /empreendimento',									array('EmpreendimentoController', 'delete'));
Flight::route('GET /empreendimento/@id(.json)', 						array('EmpreendimentoController', 'getById'));
Flight::route('GET /empreendimentos(.json)', 							array('EmpreendimentoController', 'get'));

Flight::route('POST /contrato',											array('ContratoController', 'save'));
Flight::route('DELETE /contrato',										array('ContratoController', 'delete'));
Flight::route('GET /contrato/@idct/cronograma/@idcn/itens(.json)', 		array('ItemCronogramaContratoController', 'getByIdCronograma'));
Flight::route('GET /contrato/@idct(.json)', 							array('ContratoController', 'getById'));
Flight::route('GET /contrato/@idct/itens(.json)', 						array('ItemContratoController', 'getByIdContrato'));
Flight::route('GET /contratos(.json)', 									array('ContratoController', 'get'));

Flight::route('POST /convenio',											array('ConvenioController', 'save'));
Flight::route('DELETE /convenio',										array('ConvenioController', 'delete'));
Flight::route('GET /convenio/enquadramentos(.json)', 					array('EnquadramentoConvenioController', 'get'));
Flight::route('GET /convenio/@id(.json)', 								array('ConvenioController', 'getById'));
Flight::route('GET /convenios(.json)', 									array('ConvenioController', 'get'));

Flight::route('POST /diario-de-obra',									array('DiarioObraController', 'save'));
Flight::route('DELETE /diario-de-obra',									array('DiarioObraController', 'delete'));
Flight::route('GET /diario-de-obra/@id(.json)', 						array('DiarioObraController', 'getById'));
Flight::route('GET /diario-de-obra/@id/anexos(.json)', 					array('AnexoDiarioObraController', 'getByIdDiarioObra'));
Flight::route('GET /diario-de-obra/@id/histogramas(.json)', 			array('HistogramaDiarioObraController', 'getByIdDiarioObra'));
Flight::route('POST /diario-de-obra/@id/histograma', 					array('HistogramaDiarioObraController', 'save'));
Flight::route('POST /diario-de-obra/@id/anexo', 						array('AnexoDiarioObraController', 'save'));
Flight::route('DELETE /diario-de-obra/histograma',						array('HistogramaDiarioObraController', 'delete'));
Flight::route('DELETE /diario-de-obra/anexo',							array('AnexoDiarioObraController', 'delete'));
Flight::route('GET /diarios-de-obra(.json)', 							array('DiarioObraController', 'get'));

Flight::route('POST /licitacao',										array('LicitacaoController', 'save'));
Flight::route('DELETE /licitacao',										array('LicitacaoController', 'delete'));
Flight::route('GET /licitacao/financiadores(.json)', 					array('FinanciadorLicitacaoController', 'get'));
Flight::route('GET /licitacao/modalidades(.json)', 						array('ModalidadeLicitacaoController', 'get'));
Flight::route('GET /licitacao/situacoes(.json)', 						array('SituacaoLicitacaoController', 'get'));
Flight::route('GET /licitacao/@id(.json)', 								array('LicitacaoController', 'getById'));
Flight::route('GET /licitacoes(.json)', 								array('LicitacaoController', 'get'));

Flight::route('POST /convenio/licitacao/contrato',						array('ConvenioLicitacaoContratoController', 'save'));
Flight::route('DELETE /convenio/licitacao/contrato',					array('ConvenioLicitacaoContratoController', 'delete'));
Flight::route('GET /convenio/licitacao/contrato/@id(.json)', 			array('ConvenioLicitacaoContratoController', 'getById'));
Flight::route('GET /convenios/licitacoes/contratos(.json)', 			array('ConvenioLicitacaoContratoController', 'get'));

Flight::start();

?>