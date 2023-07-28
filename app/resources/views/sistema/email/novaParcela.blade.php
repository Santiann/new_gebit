<html>
<head>
	<meta content="text/html; charset=UTF-8" />
</head>
<body style="background: #f1f4f5">
	<table border="0" cellpadding="0" cellspacing="0" height="90%" width="90%" id="bodyTable">
		<tr>
			<td align="center" valign="top">
				<table border="0" cellpadding="20" cellspacing="0" width="600" style="background: #fff;">
					<tr>
						<td align="center" valign="top">
						<img style="display: block;width: 164px;height: 120px;" src="{{asset('/img/logo-login.png')}}">
						<img style="display: none;" src="{{ route('email.visualizar', [
							'a997_id_email' => $a997_id_email, 
							'a028_id_contrato_financeiro' => $a028_id_contrato_financeiro,
							'a997_email_visualizado' => $a997_email_visualizado
							]) }}" />
						</td>
					</tr>
					<tr>
						<td align="center" valign="top">
						{!!  $mensagem !!}
						</td>
					</tr>
					<tr>
						<td align="center" valign="top">
						Valor: {{ $data['a028_valor_fracao'] }}
						</td>
					</tr>
					<tr>
						<td align="center" valign="top">
						Valor comissão: {{ $data['a028_valor_comissao'] }}
						</td>
					</tr>
					<tr>
						<td align="center" valign="top">
						Valor extra: {{ $data['a028_valor_extra'] }}
						</td>
					</tr>
					<tr>
						<td align="center" valign="top">
						Justificativa: {{ $data['a028_justificativa'] }}
						</td>
					</tr>
				</table>
				<br>
				{{--<strong>Copyright © 2020 <a href="#"> Dealix</a></strong>--}}
			</td>
		</tr>
	</table>
</body>
</html>
