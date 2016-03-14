Error Date : <strong><?php echo date('d/m/Y H:m:i')?></strong>
<br/>
<br/>
<table>
	<thead bgcolor='#c8c8c8'>
		<tr>
			<th>Item</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
		<tr valign='top'>
			<td>
				<b>Error</b>
			</td>
			<td>
				<pre><?php echo $message ?></pre>
			</td>
		</tr>
		<tr valign='top'>
			<td>
				<b>Error Level:</b>
			</td>
			<td>
				<pre><?php echo $level ?></pre>
			</td>
		</tr>
		<tr valign='top'>
			<td>
				<b>Error Number:</b>
			</td>
			<td>
				<pre><?php echo $type ?></pre>
			</td>
		</tr>
		<tr valign='top'>
			<td>
				<b>Error File:</b>
			</td>
			<td>
				<pre><?php echo $file ?></pre>
			</td>
		</tr>
		<tr valign='top'>
			<td>
				<b>Error Line:</b>
			</td>
			<td>
				<pre><?php echo $line ?></pre>
			</td>
		</tr>
		<tr valign='top'>
			<td>
				<b>Error Trace:</b>
			</td>
			<td>
				<pre><?php echo $trace ?></pre>
			</td>
		</tr>
		<tr>
			<td>
				<b>REQUEST URI:</b>
			</td>
			<td>
				<pre><?php echo $request_uri ?></pre>
			</td>
		</tr>
		<tr>
			<td>
				<b>Data GET:</b>
			</td>
			<td>
				<pre><?php echo $data_get ?></pre>
			</td>
		</tr>
		<tr>
			<td>
				<b>Data POST:</b>
			</td>
			<td>
				<pre><?php echo $data_post ?></pre>
			</td>
		</tr>


	</tbody>
</table>
