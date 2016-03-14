<table style="border: 1px solid #ccc; width:100%;">
	<thead>
		<th style="border: 1px solid #ccc; text-align: left;">Campo</th>
		<th style="border: 1px solid #ccc;">Valor Atual</th>
		<th style="border: 1px solid #ccc;">Novo Valor</th>
	</thead>
	<tbody>
		<tr>
			<td style="border: 1px solid #ccc;">Matricula</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['num_matricula']) ? $cooperator['num_matricula'] : ''))?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['num_matricula']) ? $novosDados['num_matricula'] : ''))?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Nome</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['nme_colaborador']) ? $cooperator['nme_colaborador'] : ''))?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['nme_colaborador']) ? $novosDados['nme_colaborador'] : ''))?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Função</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['funcao']['nme_funcao']) ? $cooperator['funcao']['nme_funcao'] : ''))?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['funcao']['nme_funcao']) ? $novosDados['nme_funcao'] : ''))?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Departamento</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['nme_departamento']) ? $cooperator['nme_departamento'] : ''))?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['nme_departamento']) ? $novosDados['nme_departamento'] : ''))?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Local</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['nme_local_trabalho']) ? $cooperator['nme_local_trabalho'] : ''))?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['nme_local_trabalho']) ? $novosDados['nme_local_trabalho'] : ''))?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Horário</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['nme_grade_horario']) ? $cooperator['nme_grade_horario'] : ''))?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['nme_grade_horario']) ? $novosDados['nme_grade_horario'] : ''))?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Data de Admissão</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['dta_admissao']) ? $cooperator['dta_admissao'] : ''))?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['dta_admissao']) ? $novosDados['dta_admissao'] : ''))?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">No. CTPS</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['num_ctps']) ? $cooperator['num_ctps'] : ''))?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['num_ctps']) ? $novosDados['num_ctps'] : ''))?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">No. Serie CTPS</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['num_serie_ctps']) ? $cooperator['num_serie_ctps'] : ''))?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['num_serie_ctps']) ? $novosDados['num_serie_ctps'] : ''))?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Estado Emissão CTPS</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['nme_estado_ctps']) ? $cooperator['nme_estado_ctps'] : ''))?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['nme_estado_ctps']) ? $novosDados['nme_estado_ctps'] : ''))?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Data Emissão CTPS</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['dta_emissao_ctps']) ? $cooperator['dta_emissao_ctps'] : ''))?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['dta_emissao_ctps']) ? $novosDados['dta_emissao_ctps'] : ''))?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">No. RG</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['num_rg'])) ? $cooperator['num_rg'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['num_rg'])) ? $novosDados['num_rg'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">No. CPF</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['num_cpf'])) ? $cooperator['num_cpf'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['num_cpf'])) ? $novosDados['num_cpf'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">No. PIS</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['num_pis'])) ? $cooperator['num_pis'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['num_pis'])) ? $novosDados['num_pis'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">No. Título Eleitor</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['num_titulo_eleitor'])) ? $cooperator['num_titulo_eleitor'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['num_titulo_eleitor'])) ? $novosDados['num_titulo_eleitor'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Zona Eleitoral</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['num_zona_eleitoral'])) ? $cooperator['num_zona_eleitoral'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['num_zona_eleitoral'])) ? $novosDados['num_zona_eleitoral'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Seção Eleitoral</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['num_secao_eleitoral'])) ? $cooperator['num_secao_eleitoral'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['num_secao_eleitoral'])) ? $novosDados['num_secao_eleitoral'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Reservista</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['num_reservista'])) ? $cooperator['num_reservista'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['num_reservista'])) ? $novosDados['num_reservista'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Endereço</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['dsc_endereco'])) ? $cooperator['dsc_endereco'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['dsc_endereco'])) ? $novosDados['dsc_endereco'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Número</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['num_endereco'])) ? $cooperator['num_endereco'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['num_endereco'])) ? $novosDados['num_endereco'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Bairro</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['nme_bairro'])) ? $cooperator['nme_bairro'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['nme_bairro'])) ? $novosDados['nme_bairro'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Complemento</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['dsc_complemento'])) ? $cooperator['dsc_complemento'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['dsc_complemento'])) ? $novosDados['dsc_complemento'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Cidade</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['nme_cidade_moradia'])) ? $cooperator['nme_cidade_moradia'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['nme_cidade_moradia'])) ? $novosDados['nme_cidade_moradia'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">CEP</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['num_cep'])) ? $cooperator['num_cep'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['num_cep'])) ? $novosDados['num_cep'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Nascimento</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['nme_cidade_naturalidade'])) ? $cooperator['nme_cidade_naturalidade'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['nme_cidade_naturalidade'])) ? $novosDados['nme_cidade_naturalidade'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Cidade</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['nme_cidade_naturalidade'])) ? $cooperator['nme_cidade_naturalidade'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['nme_cidade_naturalidade'])) ? $novosDados['nme_cidade_naturalidade'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Estado</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['nme_estado_naturalidade'])) ? $cooperator['nme_estado_naturalidade'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['nme_estado_naturalidade'])) ? $novosDados['nme_estado_naturalidade'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">CNH</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['num_cnh'])) ? $cooperator['num_cnh'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['num_cnh'])) ? $novosDados['num_cnh'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Categoria</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['nme_categoria_cnh'])) ? $cooperator['nme_categoria_cnh'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['nme_categoria_cnh'])) ? $novosDados['nme_categoria_cnh'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Validade</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['dta_validade_cnh'])) ? $cooperator['dta_validade_cnh'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['dta_validade_cnh'])) ? $novosDados['dta_validade_cnh'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Sexo</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['flg_sexo'])) ? $cooperator['flg_sexo'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['flg_sexo'])) ? $novosDados['flg_sexo'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Banco</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['nme_banco'])) ? $cooperator['nme_banco'] : '')?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['nme_banco'])) ? $novosDados['nme_banco'] : '')?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Agência</td>
			<td style="border: 1px solid #ccc;">
				<?php
					$agencia_digito = "";
					if(isset($cooperator['num_agencia']))
						$agencia_digito .= $cooperator['num_agencia'];
					if(isset($cooperator['num_digito_agencia']))
						$agencia_digito .= '-'.$cooperator['num_digito_agencia'];
				?>
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=($agencia_digito)?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<?php
					$agencia_digito = "";
					if(isset($novosDados['num_agencia']))
						$agencia_digito .= $novosDados['num_agencia'];
					if(isset($novosDados['num_digito_agencia']))
						$agencia_digito .= '-'.$novosDados['num_digito_agencia'];
				?>
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=($agencia_digito)?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Conta</td>
			<td style="border: 1px solid #ccc;">
				<?php
					$conta_digito = "";
					if(isset($cooperator['num_conta_corrente']))
						$conta_digito .= $cooperator['num_conta_corrente'];
					if(isset($cooperator['num_digito_conta_corrente']))
						$conta_digito .= '-'.$cooperator['num_digito_conta_corrente'];
				?>
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=($conta_digito)?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<?php
					$conta_digito = "";
					if(isset($novosDados['num_conta_corrente']))
						$conta_digito .= $novosDados['num_conta_corrente'];
					if(isset($novosDados['num_digito_conta_corrente']))
						$conta_digito .= '-'.$novosDados['num_digito_conta_corrente'];
				?>
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=($conta_digito)?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Sindicato</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['nme_sindicato']) ? $cooperator['nme_sindicato'] : ''))?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['nme_sindicato']) ? $novosDados['nme_sindicato'] : ''))?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Entidade</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['nme_entidade']) ? $cooperator['nme_entidade'] : ''))?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['nme_entidade']) ? $novosDados['nme_entidade'] : ''))?>">
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #ccc;">Número</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($cooperator['num_entidade']) ? $cooperator['num_entidade'] : ''))?>">
			</td>
			<td style="border: 1px solid #ccc;">
				<input class="form-control" style="background-color: #eee; border: 1px solid #ccc; width: 100%;" disabled="disabled" value="<?=((isset($novosDados['num_entidade']) ? $novosDados['num_entidade'] : ''))?>">
			</td>
		</tr>
	</tbody>
</table>

<br/>
<label style="font-weight: bold;">Telefones</label>
<br/>
<table style="border: 1px solid #ccc;">
	<thead>
		<th style="border: 1px solid #ccc;" class="text-center text-middle">DDD</th>
		<th style="border: 1px solid #ccc;" class="text-center text-middle">Número</th>
		<th style="border: 1px solid #ccc;" class="text-center text-middle">Tipo</th>
	</thead>
	<tbody>
		<?php
			if(isset($cooperator['telefones'])) {
				foreach ($cooperator['telefones'] as $key => $value) {
		?>
		<tr>
			<td style="border: 1px solid #ccc;" class="text-center text-middle"><?=($value['num_ddd'])?></td>
			<td style="border: 1px solid #ccc;" class="text-center text-middle"><?=($value['num_telefone'])?></td>
			<td style="border: 1px solid #ccc;" class="text-center text-middle"><?=(isset($value['tipoTelefone']) ? $value['tipoTelefone']['nme_tipo_telefone'] : $value['nme_tipo_telefone'])?></td>
		</tr>
		<?php
				}
			}
		?>
	</tbody>
</table>

<br/>
<label style="font-weight: bold;">E-mails</label>
<br/>
<table style="border: 1px solid #ccc;">
	<thead>
		<th style="border: 1px solid #ccc;">Endereço de E-mail</th>
	</thead>
	<tbody>
		<?php
			if(isset($cooperator['emails'])) {
				foreach ($cooperator['emails'] as $key => $value) {
		?>
		<tr>
			<td style="border: 1px solid #ccc;"><?=($value['end_email'])?></td>
		</tr>
		<?php
				}
			}
		?>
	</tbody>
</table>

<br/>
<label style="font-weight: bold;">Dependentes</label>
<br/>
<table style="border: 1px solid #ccc;">
	<thead>
		<th style="border: 1px solid #ccc;" class="text-middle" width="265">Nome</th>
		<th style="border: 1px solid #ccc;" class="text-center text-middle" width="127">Parentesco</th>
		<th style="border: 1px solid #ccc;" class="text-center text-middle" width="85">Dt. Nasc.</th>
		<th style="border: 1px solid #ccc;" class="text-center text-middle" width="160">Plano de Saúde</th>
		<th style="border: 1px solid #ccc;" class="text-center text-middle" width="160">Cursa Faculdade?</th>
	</thead>
	<tbody>
		<?php
			if(isset($cooperator['dependentes'])) {
				foreach ($cooperator['dependentes'] as $key => $value) {
					$nmeTipoDependencia = "";

					if(isset($value['tipoDependencia']))
						$nmeTipoDependencia = $value['tipoDependencia']['nme_tipo_dependencia'];
					else if(isset($value['nme_tipo_dependencia']))
						$nmeTipoDependencia = $value['nme_tipo_dependencia'];

					$nmePlanoSaude = "";

					if(isset($value['planoSaude']))
						$nmePlanoSaude = $value['planoSaude']['nme_plano_saude'];
					else if(isset($value['nme_plano_saude']))
						$nmePlanoSaude = $value['nme_plano_saude'];
					else
						$nmePlanoSaude = 'Não optante';

					$flgCursoSuperior = "Não";

					if(isset($value['flg_curso_superior']))
						$flgCursoSuperior = "Sim";
		?>
		<tr>
			<td style="border: 1px solid #ccc;" class="text-middle"><?=($value['nme_dependente'])?></td>
			<td style="border: 1px solid #ccc;" class="text-center text-middle"><?=($nmeTipoDependencia)?></td>
			<td style="border: 1px solid #ccc;" class="text-center text-middle"><?=($value['dta_nascimento'])?></td>
			<td style="border: 1px solid #ccc;" class="text-center text-middle"><?=($nmePlanoSaude)?></td>
			<td style="border: 1px solid #ccc;" class="text-center text-middle"><?=($flgCursoSuperior)?></td>
		</tr>
		<?php
				}
			}
		?>
	</tbody>
</table>