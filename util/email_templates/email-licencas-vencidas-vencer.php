<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Programa Água Limpa | Contratos com valor maior que do convênio</title>
</head>
<body style="font: 100% sans-serif;">
	<div style="max-width: 700px; margin: 0 auto;">
		<div style="max-height: 70px !important; border-bottom: 1px solid #00B3E6; padding-bottom: 10px;">
			<img src="http://programaagualimpa.net/logo_daee.jpg" style="max-height: 70px !important;">
			<h4 style="color: #00B3E7; float: right; padding-right: 10px !important; padding-top: 7px;">Contratos com valor maior que do convênio</h4>
		</div>
		
		<div>
			<p>
				Caro(a) <strong><?=($nme_destinatario)?></strong>,
			</p>

			<p>Abaixo segue uma listagem de Contratos com valor superior ao valor do convênio:</p>

			<table border="1" style="width: 100%; font-size: 90%;">
				<thead>
					<th>Município</th>
					<th>Empreendimento</th>
					<th>No. Contrato</th>
					<th>Vlr. Total Contrato</th>
					<th>No. Convênio</th>
					<th>Vlr. Total Convênio</th>
					<th>Vlr. Diferença</th>
				</thead>
				<tbody>
					<?php
						foreach ($dataset as $key => $item) {
					?>
					<tr>
						<td><?=($item['municipio'])?></td>
						<td><?=($item['nome_empreendimento'])?></td>
						<td style="text-align: center;"><?=($item['num_contrato'])?></td>
						<td style="text-align: center;"><?=('R$ ' . number_format($item['vlr_total_contrato'], 2, ',', '.'))?></td>
						<td style="text-align: center;"><?=($item['num_convenio'])?></td>
						<td style="text-align: center;"><?=('R$ ' . number_format($item['vlr_total_convenio'], 2, ',', '.'))?></td>
						<td style="text-align: center;"><?=('R$ ' . number_format($item['vlr_diferenca'], 2, ',', '.'))?></td>
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