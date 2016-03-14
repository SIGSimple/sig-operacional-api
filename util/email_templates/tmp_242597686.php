<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Programa Água Limpa | Contratos Vencidos e a Vencer</title>
</head>
<body style="font: 100% sans-serif;">
	<div style="max-width: 700px; margin: 0 auto;">
		<div style="max-height: 70px !important; border-bottom: 1px solid #00B3E6; padding-bottom: 10px;">
			<img src="http://programaagualimpa.net/logo_daee.jpg" style="max-height: 70px !important;">
			<h4 style="color: #00B3E7; float: right; padding-right: 10px !important; padding-top: 7px;">Contratos Vencidos e a Vencer</h4>
		</div>
		
		<div>
			<p>
				Caro(a) <strong><?=($nme_destinatario)?></strong>,
			</p>

			<p>Abaixo segue uma listagem das Contratos que vencem nos próximos 3 meses, e/ou que já venceram:</p>

			<table border="1" style="width: 100%">
				<thead>
					<th>Município</th>
					<th>Empreendimento</th>
					<th>No. Autos</th>
					<th>No. Contrato</th>
					<th>Dta. Conclusão Obra</th>
					<th width="100">Situação</th>
				</thead>
				<tbody>
					<?php
						foreach ($dataset as $key => $item) {
					?>
					<tr>
						<td><?=($item['municipio'])?></td>
						<td><?=($item['nome_empreendimento'])?></td>
						<td style="text-align: center;"><?=($item['num_autos'])?></td>
						<td style="text-align: center;"><?=($item['num_contrato'])?></td>
						<td style="text-align: center;"><?=($item['dta_conclusao_obra'])?></td>
						<td style="text-align: center;">
							<?php
								if((boolean)$item['flg_vencido'] == true) {
							?>
							<span style="background-color: red; color: white; padding: 2px;">Vencido</span>
							<?php
								} else {
							?>
							<span style="background-color: orange; color: white; padding: 2px;">A Vencer</span>
							<?php
								}
							?>
						</td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		<div>

		<div style="background-color: #CCCCCC; min-height: 30px !important;">
			<p style="color: #696969; text-align: center; font-size: 12px; min-height: 30px; line-height: 30px;">Programa Água Limpa &copy; 2015.</p>
		</div>
	</div>
</body>
</html>