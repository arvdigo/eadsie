<?php session_start("SELECAO"); ?>
<?php	
	//Trecho que automatiza o encerramento do Período de Isento
	$data_fim_isencao  	= $_SESSION["Gdataterminoisencao"];

	//Trecho que automatiza o encerramento do Processo seletivo em vigência
	$data_incio   	= $_SESSION["Gdatainicio"];
	$data_fim     	= $_SESSION["Gdatatermino"];
	$data_atual   	= strtotime("now");
        			
	if ($data_fim < $data_atual){
		header("Location: ../../index.php?sc=Inscricao");
	}       
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title> <?php echo ($_SESSION["Gnomeprocessoseletivo"]);?> </title>
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../../js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="../../js/jquery.alphanumeric.pack.js"></script>
	<script type="text/javascript" src="../../js/jquery.price_format.1.4.js"></script>        
	<script language="JavaScript" type="text/JavaScript">
	
        function Onlynumber(e){
		var tecla=new Number();

		if (window.event) {
			tecla = e.keyCode;
		} else if (e.which) {
			tecla = e.which;
		} else {
			return true;
		}
		if (((tecla < 48) || (tecla > 57)) && (tecla!=8)) {
			return false;
		}
	}

	function validar() {
		var nome                    = document.getElementById("nome");
		var endereco                = document.getElementById("endereco");
		var bairro                  = document.getElementById("bairro");
		var cep                     = document.getElementById("cep");
		var municipio               = document.getElementById("municipio");
		var estado                  = document.getElementById("estado");
		var rg                      = document.getElementById("rg");
		var cpf                     = document.getElementById("cpf");
		var senha                   = document.getElementById("senha");
		var senhaConfirm            = document.getElementById("senhaConfirm");
		var declaracao              = document.getElementById("declaracao");
		var nacionalidade           = document.getElementById("nacionalidade");
		var dataNascimento          = document.getElementById("datanascimento");
		var dataExpedicao           = document.getElementById("dataexpedicao");
		var sexo                    = document.getElementById("sexo");
		var email                   = document.getElementById("email");
		var campus                  = document.getElementById("campus");
		var curso                   = document.getElementById("curso");
		//Retirado - Processo Seletivo de EAD
		//var localprova      		= document.getElementById("localprova");
        var flag_especial_descricao = document.getElementById("flag_especial_descricao");
        var flag_especial_prova_descricao = document.getElementById("flag_especial_prova_descricao");
                
        //lançamento das notas de EAD
        var mediapor1			= document.getElementById("mediapor1");
		var mediapor2			= document.getElementById("mediapor2");
		var mediapor3			= document.getElementById("mediapor3");
		var mediamat1			= document.getElementById("mediamat1");
		var mediamat2			= document.getElementById("mediamat2");
		var mediamat3			= document.getElementById("mediamat3");          
                                
        resultado = true;
		
		if (declaracao.value == "NAO") {
			alert('Voce precisa aceitar a declaracao!');
			declaracao.focus();
			resultado = false;
		} else if (nome.value == "") {
			alert('Informe o nome!');
			nome.focus();
			resultado = false;
		} else if(cpf.value== "") {
			alert('Informe o CPF!');
			cpf.focus();
			resultado = false;
		} else if (!ValidaCPF(cpf)) {
			resultado = false;
		} else if(senha.value== "") {
			alert('Informe a senha!');
			senha.focus();
			resultado = false;
		} else if(senhaConfirm.value == "") {
			alert('Informe a confirmacao de senha!');
			senhaConfirm.focus();
			resultado = false;
		} else if(senhaConfirm.value != senha.value) {
			alert('Confirmacao de senha deve ser igual a senha!');
			senhaConfirm.focus();
			resultado = false;
		} else if (rg.value == "") {
			alert('Informe o RG!');
			rg.focus();
			resultado = false;
		} else if (email.value == "") {
			alert('Informe o email!');
			email.focus();
			resultado = false;
		} else if(nacionalidade.value == "") {
			alert('Informe a nacionalidade!');
			nacionalidade.focus();
			resultado = false;
		} else if (dataNascimento.value == "") {
			alert('Informe a data de nascimento!');
			dataNascimento.focus();
			resultado = false;
		} else if (!CheckDate(dataNascimento)) {
			alert('Informe corretamente a data de nascimento!');
			dataNascimento.focus();
			resultado = false;
		} else if (dataExpedicao.value == "") {
			alert('Informe a data de expedicao!');
			dataExpedicao.focus();
			resultado = false;
		} else if (!CheckDate(dataExpedicao)) {
			alert('Informe corretamente a data de expedicao!');
			dataExpedicao.focus();
			resultado = false;
		} else if(sexo.value == "") {
			alert('Informe sexo!');
			sexo.focus();
			resultado = false;
		} else if (endereco.value == "") {
			alert('Informe o endereco!');
			endereco.focus();
			resultado = false;
		} else if (bairro.value == "") {
			alert('Informe o bairro!');
			bairro.focus();
			resultado = false;
		} else if (cep.value == "") {
			alert('Informe o CEP!');
			cep.focus();
			resultado = false;
		} else if (municipio.value == "" || municipio.value == "0") {
			alert('Informe o Estado e Municipio!');
			municipio.focus();
			resultado = false;
		} else if (campus.value == "" || campus.value == "0") {
			alert('Informe o Polo e Area!');
			campus.focus();
			resultado = false;
		} else if (curso.value == "" || curso.value == "0") {
			alert('Informe o Polo e Area!');
			curso.focus();
			resultado = false;
		}else if (flag_especial_descricao.value == "1") {
			alert('Informe a necessidade especial!');
			resultado = false;		        
		} else if (mediapor1.value == "" || mediapor2.value == "" || mediapor3.value == "" || mediamat1.value == "" || mediamat2.value == "" || mediamat3.value == "") {
			alert('Informe suas notas!');
			mediapor1.focus();
			resultado = false;
		} else if (mediapor1.value <= 4.9 || mediapor2.value <= 4.9 || mediapor3.value <= 4.9 || mediamat1.value <= 4.9 || mediamat2.value <= 4.9 || mediamat3.value <= 4.9) {
                	alert('A nota deve ser maior ou igual a 5.0!');
			mediapor1.focus();
			resultado = false;
		} else if (mediapor1.value > 10.0 || mediapor2.value > 10.0 || mediapor3.value > 10.0 || mediamat1.value > 10.0 || mediamat2.value > 10.0 || mediamat3.value > 10.0) {
			alert('A nota deve ser menor ou igual a 10.0!');
			mediapor1.focus();
			resultado = false;
		}    

		//Retirado - Processo Seletivo de EAD
		//else if (localprova.value == "" || localprova.value == "0") {
		//	alert('Informe o Campus e Local de Prova!');
		//	localprova.focus();
		//	resultado = false;
		//}     
		
		return resultado;
	}

	function Mascara(tipo, campo, teclaPress) {
		if (window.event) {
			var tecla = teclaPress.keyCode;
		} else {
			tecla = teclaPress.which;
		}

		var s = new String(campo.value);

		// Remove todos os caracteres a seguir: ( ) / - . e espaço, para tratar a string denovo.
		s = s.replace(/(\.|\(|\)|\/|\-| )+/g,'');
		tam = s.length + 1;

		if ( tecla != 9 && tecla != 8 ) {
			switch (tipo) {
				case 'CPF' :
					if (tam > 3 && tam < 7)
						campo.value = s.substr(0,3) + '.' + s.substr(3, tam);
					if (tam >= 7 && tam < 10)
						campo.value = s.substr(0,3) + '.' + s.substr(3,3) + '.' + s.substr(6,tam-6);
					if (tam >= 10 && tam < 12)
						campo.value = s.substr(0,3) + '.' + s.substr(3,3) + '.' + s.substr(6,3) + '-' + s.substr(9,tam-9);
					break;
				case 'CNPJ' :
					if (tam > 2 && tam < 6)
						campo.value = s.substr(0,2) + '.' + s.substr(2, tam);
					if (tam >= 6 && tam < 9)
						campo.value = s.substr(0,2) + '.' + s.substr(2,3) + '.' + s.substr(5,tam-5);
					if (tam >= 9 && tam < 13)
						campo.value = s.substr(0,2) + '.' + s.substr(2,3) + '.' + s.substr(5,3) + '/' + s.substr(8,tam-8);
					if (tam >= 13 && tam < 15)
						campo.value = s.substr(0,2) + '.' + s.substr(2,3) + '.' + s.substr(5,3) + '/' + s.substr(8,4)+ '-' + s.substr(12,tam-12);
					break;
				case 'TEL' :
					if (tam > 2 && tam < 4)
						campo.value = '(' + s.substr(0,2) + ') ' + s.substr(2,tam);
					if (tam >= 7 && tam < 11)
						campo.value = '(' + s.substr(0,2) + ') ' + s.substr(2,4) + '-' + s.substr(6,tam-6);
					break;
				case 'DATA' :
					if (tam > 2 && tam < 4)
						campo.value = s.substr(0,2) + '/' + s.substr(2, tam);
					if (tam > 4 && tam < 11)
						campo.value = s.substr(0,2) + '/' + s.substr(2,2) + '/' + s.substr(4,tam-4);
					break;
				case 'CEP' :
					if (tam > 5 && tam < 7)
						campo.value = s.substr(0,5) + '-' + s.substr(5, tam);
					break;
			}
		}
	}

	function CheckDate(pObj) {
		var expReg = /^((0[1-9]|[12]\d)\/(0[1-9]|1[0-2])|30\/(0[13-9]|1[0-2])|31\/(0[13578]|1[02]))\/(19|20)?\d{2}$/;
		var aRet = true;
		if ((pObj) && (pObj.value.match(expReg)) && (pObj.value != '')) {
			var dia = pObj.value.substring(0,2);
			var mes = pObj.value.substring(3,5);
			var ano = pObj.value.substring(6,10);
			if ((mes == 4 || mes == 6 || mes == 9 || mes == 11) && dia > 30) {
				aRet = false;
			} else if ((ano % 4) != 0 && mes == 2 && dia > 28) {
				aRet = false;
			} else if ((ano%4) == 0 && mes == 2 && dia > 29) {
				aRet = false;
			}
		} else {
			aRet = false;
		}
		return aRet;
	}

	// funcao para formatar qualquer campo.Ex.:cep,cpf,telefone,cnpj.
	function formata(src, mask) {
		var i = src.value.length;
		var saida = '#';
		var texto = mask.substring(i)
		if (texto.substring(0,1) != saida) {
			src.value += texto.substring(0,1);
		}
	}

        function redireciona() {
		window.location="../../index.php"; //redereciona para a página inicial.
	}

	function ValidaCPF(campo) {
		var CPF = campo.value; // Recebe o valor digitado no campo
		// Aqui começa a checagem do CPF
		var POSICAO, I, SOMA, DV, DV_INFORMADO;
		var DIGITO = new Array(10);
		DV_INFORMADO = CPF.substr(9, 2); // Retira os dois últimos dígitos do número informado

		// Desemembra o número do CPF na array DIGITO
		for (I=0; I<=8; I++) {
			DIGITO[I] = CPF.substr( I, 1);
		}

		// Calcula o valor do 10 dígito da verificação
		POSICAO = 10;
		SOMA = 0;
		for (I=0; I<=8; I++) {
			SOMA = SOMA + DIGITO[I] * POSICAO;
			POSICAO = POSICAO - 1;
		}
		DIGITO[9] = SOMA % 11;
		if (DIGITO[9] < 2) {
			DIGITO[9] = 0;
		} else {
			DIGITO[9] = 11 - DIGITO[9];
		}

		// Calcula o valor do 11 dígito da verificação
		POSICAO = 11;
		SOMA = 0;
		for (I=0; I<=9; I++) {
			SOMA = SOMA + DIGITO[I] * POSICAO;
			POSICAO = POSICAO - 1;
		}
		DIGITO[10] = SOMA % 11;
		if (DIGITO[10] < 2) {
			DIGITO[10] = 0;
		} else {
			DIGITO[10] = 11 - DIGITO[10];
		}

		// Verifica se os valores dos dígitos verificadores conferem
		DV = DIGITO[9] * 10 + DIGITO[10];
		if (DV != DV_INFORMADO) {
			alert('CPF invalido');
			campo.value = '';
			campo.focus();
			return false;
		}
		return true;
	}

	function getCurso(pCampus) {
		if (pCampus.selectedIndex != '') {
			var campusCurso2 = pCampus.value;
			// document.location=('cadastro.php?campusCurso=' + campusCurso);
			// document.getElementById('campusCurso') = campusCurso2;
			return campusCurso2;
		}
	}

	$(document).ready(function() {
		
                $(".notas").priceFormat({
		   prefix: '',
		    limit: 3,
		    centsLimit: 1,
		    centsSeparator: '.',
		    thousandsSeparator: ''
		});
                
                $(".alpha").alpha();

		$("#nis").attr("disabled", true);
		$("#isencao").change(function() {
			$("#isencao option:selected").each(function() {
				if (this.value == "SIM") {
					$("#nis").removeAttr("disabled");
				} else if(this.value == "NAO") {
					$("#nis").val("");
					$("#nis").attr("disabled", true);
				}
			});
		});

		$("#vaga_especial").change(function() {
			if ($(this).val() == "SIM") {
				$("#vaga_rede_publica").val("NAO");
			}
		});

		$("#vaga_rede_publica").change(function() {
			if ($(this).val() == "SIM") {
				$("#vaga_especial").val("NAO");
			}
		});

                
                $("#especial_prova_descricao").attr("disabled", true);
                $("#especial_descricao").attr("disabled", true);

		               
                $("#especial").change(function() {
			$("#especial option:selected").each(function() {
				if (this.value == "OUTRA") {
					$("#especial_descricao").removeAttr("disabled");
                                        $("#especial_descricao").val("");
                                        $("#flag_especial_descricao").val("1");
				} else {
					$("#especial_descricao").val("");
					$("#especial_descricao").attr("disabled", true);
                                        $("#flag_especial_descricao").val("0");
                                }
			});
		});
                
                $("#especial_descricao").change(function() {
			if ($(this).val() != "") {
				$("#flag_especial_descricao").val("0");
			}
		});
                
                $("#especial_prova").change(function() {
			$("#especial_prova option:selected").each(function() {
				if (this.value == "SIM") {
					$("#especial_prova_descricao").removeAttr("disabled");
                                        $("#flag_especial_prova_descricao").val("1");
				} else {
					$("#especial_prova_descricao").val("");
					$("#especial_prova_descricao").attr("disabled", true);
                                        $("#flag_especial_prova_descricao").val("0");
				}
			});
		});
                
                $("#especial_prova_descricao").change(function() {
			if ($(this).val() != "") {
				$("#flag_especial_prova_descricao").val("0");
			}
		});

		$("select[name=campus]").change(function() {
			$("select[name=curso]").html('<option value="0">Carregando...</option>');
			$.post("cursos.php",
				{campus:$(this).val()},
				function(valor) {
					$("select[name=curso]").html(valor);
				}
			)
		})

		$("select[name=campus]").change(function() {
			$("select[name=localprova]").html('<option value="0">Carregando...</option>');
			$.post("locais.php",
				{campus:$(this).val()},
				function(valor) {
					$("select[name=localprova]").html(valor);
				}
			)
		})
                
                $("select[name=uf]").change(function() {
			$("select[name=municipio]").html('<option value="0">Carregando...</option>');
			$.post("municipios.php",
				{uf:$(this).val()},
				function(valor) {
					$("select[name=municipio]").html(valor);
				}
			)
		})                                
	})
	</script>
</head>
<body>

	<div align='center'>
		<img src="../../imgs/topo2/topo_formulario.png" alt="Instituto Federal Baiano" />
		<div id="topoFormTexto">
			<?php 
                            echo ($_SESSION["Gnomeprocessoseletivo"]."<br />");
                            echo ("Edital N&#186; ".$_SESSION["Gedital"]."/".$_SESSION["Gano"]);
                        ?>
                        
		</div>
		<h2>Ficha de Inscri&ccedil;&atilde;o</h2>
		<p><span class="textoDestaque">OBSERVA&Ccedil;&Atilde;O: Os campos marcados com asterisco (*) s&atilde;o de preenchimento obrigat&oacute;rio.</span></p>
	</div>

	<div id="formularioInscricao">
		<form id='forminscricao' name='frmaincricao' action='cadastrar_inscrito.php' method='post' onsubmit='return validar()' >
			<table width="760" border="0" align='center'>
				<tr>
					<td align="right"><label for=nome>Nome:</label></td>
					<td colspan='2'>
						<input style="text-transform:uppercase" name="nome" id="nome" type="text" tabindex=1 size='65' maxlength="65" alt="Nome Completo" />
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>

				<tr>
					<td align='right'><label for=cpf >CPF:</label></td>
					<td>
						<input name="cpf" type="text" id="cpf" tabindex=2 onkeypress="javascript:return Onlynumber(event);" value="" size="15" maxlength="11" alt="CPF" />
						<span class="textoSobrescrito">* ATEN&Ccedil;&Atilde;O: N&atilde;o ser&aacute; poss&iacute;vel alterar o CPF posteriormente.</span>
					</td>
				</tr>

				<tr>
					<td height="27" align='right'><label for="senha">Senha:</label></td>
					<td>
						<input name="senha" id="senha" type="password" tabindex=4 size="15" maxlength="15" alt="Senha" />
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>

				<tr>
					<td height="27" align='right'><label for="senha">Confirmar Senha:</label></td>
					<td>
						<input name="senhaConfirm" id="senhaConfirm" type="password" tabindex=5 size="15" maxlength="15" alt="Confirmar Senha" />
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>

				<tr>
					<td height="27" align='right'><label for=rg>RG:</label></td>
					<td>
						<input name="rg" type="text" id="rg" tabindex=5 onkeypress="javascript:return Onlynumber(event);" value="" size="15" maxlength="11" alt="RG" />
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>

				<tr>
					<td align='right'><label for=orgaoexpedidor>&Oacute;rg&atilde;o Expedidor:</label></td>
					<td>
						<input class="alpha" style="text-transform:uppercase" name="orgaoexpedidor" id="orgaoexpedidor"  type="text" tabindex=6 size="8" maxlength="8" alt="Órgão Expedidor" />
						&nbsp;&nbsp;UF:&nbsp;&nbsp;
                                                
                                                <select id="uf_org_exp" name="uf_org_exp" tabindex="7" >
                                                <option value="0" selected="selected">Escolha um Estado</option>
                                                <?php
                                                    include_once ("../classes/DB.php");
                                                    include_once ("../classes/UnidadeFederativa.php");
                                                    $banco = DB::getInstance();
                                                    $conexao = $banco->ConectarDB();

                                                    $uforgexp = new UnidadeFederativa(null, null);
                                                    $vetoruforgexp = $uforgexp->SelectByAll($conexao);

                                                    /* Varaveis auxiliares */
                                                    $i = 0;
                                                    $sel = "selected";
                                                    $total = count($vetoruforgexp);

                                                    while ($total > $i) {
                                                            $nome = $vetoruforgexp[$i]->getNome();
                                                            $codigo = $vetoruforgexp[$i]->getIdUnidadeFederativa();
                                                            echo("<option value=".$codigo.">".strtoupper($nome)."</option>\n");
                                                            $i = $i + 1;
                                                    }
                                                    ?>
                                                </select>
					</td>
				</tr>

				<tr>
					<td align='right'><label for=dataexpedicao>Data de Expedi&ccedil;&atilde;o:</label></td>
					<td>
						<input name="dataexpedicao" id="dataexpedicao" type="text" tabindex=8 size="12" maxlength="10" alt="Data de Expedi&ccedil;&atilde;o (RG)" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" />
					</td>
				</tr>

				<tr>
					<td align='right'><label for=nacionalidade>Nacionalidade:</label></td>
					<td>
						<input class="alpha" style="text-transform:uppercase" name="nacionalidade" id="nacionalidade" type="text" tabindex=9 size="30" maxlength="30" alt="Nacionalidade" />
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>

				<tr>
					<td align='right'><label for=datanascimento>Data de Nascimento:</label></td>
					<td><input name="datanascimento" id="datanascimento" type="text" tabindex=10 size="12" maxlength="10" alt="Data de Nascimento" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" />
					<span class="textoSobrescrito">*</span></td>
				</tr>

				<tr>
					<td align='right'><label for=sexo>Sexo:</label></td>
					<td>
						<select name="sexo" id="sexo" tabindex=11>
							<option value="MASCULINO" selected="selected">MASCULINO</option>
							<option value="FEMININO">FEMININO</option>
						</select>
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>

				<tr>
					<td align='right'><label for=endereco>Endere&ccedil;o:</label></td>
					<td colspan='2'>
						<input style="text-transform:uppercase" name="endereco" id="endereco" type="text" tabindex=12 size='65' maxlength="65" alt="Endereço" />
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>

				<tr>
					<td align='right'><label for=bairro>Bairro:</label></td>
					<td>
						<input style="text-transform:uppercase" name="bairro" id="bairro" type="text" tabindex=13 size="30" maxlength="30" alt="Bairro" />
						<span class="textoSobrescrito">*</span>
						&nbsp;&nbsp;CEP:&nbsp;&nbsp;
						<input name="cep" type="text" id="cep" tabindex=14 onkeypress="Mascara('CEP',this,event); return Onlynumber(event);" size='12' maxlength="09" alt="CEP" />
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>

				<tr>
					<td align='right'><label for=uf>UF:</label></td>
					<td>
                                            <select id="uf" name="uf" tabindex="15" >
                                                <option value="0" selected="selected">Escolha um Estado</option>
                                                <?php
                                                    
                                                    $banco = DB::getInstance();
                                                    $conexao = $banco->ConectarDB();

                                                    $unidadefederativa = new UnidadeFederativa(null, null);
                                                    $vetorunidadefederativa = $unidadefederativa->SelectByAll($conexao);

                                                    /* Varaveis auxiliares */
                                                    $i = 0;
                                                    $sel = "selected";
                                                    $total = count($vetorunidadefederativa);

                                                    while ($total > $i) {
                                                            $nome = $vetorunidadefederativa[$i]->getNome();
                                                            $codigo = $vetorunidadefederativa[$i]->getIdUnidadeFederativa();
                                                            echo("<option value=".$codigo.">".strtoupper($nome)."</option>\n");
                                                            $i = $i + 1;
                                                    }
                                                    ?>
                                            </select>
                                            
                                            <span class="textoSobrescrito">*</span>
				
					</td>
				</tr>
                            
                                <tr>
					<td align='right' width="200px">
                                            <label for=municipio>Munic&iacute;pio:</label>
					</td>
					<td>
						<select id="municipio" name="municipio" tabindex="16">
							<option value="0" disabled="disabled">Escolha um Estado primeiro</option>
						</select>
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>

				<tr>
					<td align='right'><label for=telefone>Telefone:</label></td>
					<td>
						<input name="telefone" id="telefone" type="text" tabindex=17 size="17" maxlength="14" alt="Telefone"  onkeypress="Mascara('TEL',this,event); return Onlynumber(event);" />
					</td>
				</tr>

				<tr>
					<td align='right'><label for=celular >Celular:</label></td>
					<td>
						<input name="celular" id="celular" type="text" tabindex=19 size="17" maxlength="14" alt="Celular" onkeypress="Mascara('TEL',this,event); return Onlynumber(event);" />
					</td>
				</tr>

				<tr>
					<td align='right'><label for=email>E-mail:</label></td>
					<td>
						<input style="text-transform:uppercase" name="email" id="email" type="text" tabindex=20 size='40' maxlength="40" alt="E-mail" />
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>

				<tr>
					<td align='right'><label for=estadocivil>Estado Civil:</label></td>
					<td>
						<select name="estadocivil" id="estadocivil" tabindex=21>
							 <option value="SOLTEIRO(A)" selected="selected">SOLTEIRO(A)</option>
							 <option value="CASADO(A)">CASADO(A)</option>
							 <option value="VIUVO(A)">VI&Uacute;VO(A)</option>
							 <option value="SEPARADO(A)">SEPARADO(A)</option>
							 <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
						 </select>
					</td>
				</tr>

				<tr>
					<td width="139" align='right'><label for=responsavel>Respons&aacute;vel:</label></td>
					<td width="412" colspan='2'>
						<input style="text-transform:uppercase" name="responsavel" id="responsavel" type="text" tabindex=22 size='65' maxlength="65" alt="Nome do Responsável" />
					</td>
				</tr>

				<tr>
					<td height="28" align='right'><label for=especial>Necessidade Especial:</label></td>
					<td>
						<select name="especial" id="especial" tabindex=23 onchange="javascript:necessidadeEspecial()">
							<option value="NAO" selected="selected">NAO</option>
							<option value="VISUAL - CEGUEIRA">VISUAL - CEGUEIRA</option>
							<option value="VISUAL - BAIXA VISAO">VISUAL - BAIXA VISAO</option>
							<option value="MOTORA">MOTORA</option>
							<option value="AUDITIVA">AUDITIVA</option>
							<option value="MULTIPLAS">MULTIPLAS</option>
							<option value="OUTRA">OUTRA</option>
						</select>
						<span class="textoSobrescrito">*</span>
						&nbsp;&nbsp;Qual:&nbsp;&nbsp;
						<input style="text-transform:uppercase" name="especial_descricao" type="text" id="especial_descricao" tabindex=24 size='40' maxlength="40" alt="Descrição da Necessidade Especial" />
                                                <input type="hidden" name="flag_especial_descricao" id="flag_especial_descricao" />
					</td>
				</tr>

				<tr>
					<td align='right' width="200px">
						<label for=campus>Polo:</label>
					</td>
					<td colspan='2'>
						<select id="campus" name="campus" tabindex="25">
							<option value="0" selected="selected">Escolha um Polo</option>
							<?php
							include_once ("../classes/DB.php");
							include_once ("../classes/Campus.php");
							$banco = DB::getInstance();
							$conexao = $banco->ConectarDB();

							$campus = new Campus(null, null);
							$vetorcampus = $campus->SelectByAll($conexao);

							/* Varaveis auxiliares */
							$i = 0;
							$sel = "selected";
							$total = count($vetorcampus);

							while ($total > $i) {
								$nome = $vetorcampus[$i]->getNome();
								$codigo = $vetorcampus[$i]->getIdCampus();
								echo("<option value=".$codigo.">".strtoupper($nome)."</option>\n");
								$i = $i + 1;
							}
							?>
						</select>
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>

				<tr>
					<td align='right' width="200px">
						<label for=curso>Curso:</label>
					</td>
					<td>
						<select id="curso" name="curso" tabindex="26">
							<option value="0" disabled="disabled">Escolha um Campus Primeiro</option>
						</select>
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>
   				<tr style="display: none">
                    <td align='right' width="200px">
                        <label for=localprova>Local de realiza&ccedil;&atilde;o prova:</label>
                    </td>

                    <td>
                        <select id="localprova" name="localprova" tabindex="27">
                            <option value="0" disabled="disabled">Escolha um Campus Primeiro</option>
                        </select>
                        <span class="textoSobrescrito">*</span>
                    </td>
                </tr>

                <tr style="display: none">
                    <td height="28" align='right'><label for=isencao>Isen&ccedil;&atilde;o de Taxa:</label></td>
                    <td>
                        <select name="isencao" id="isencao" tabindex=28>
                             <option value="NAO" selected="selected">N&Atilde;O</option>
				 <?php	
					//Verifica o término do período de isenção
					if ($data_fim_isencao >= $data_atual){
 						echo("<option value='SIM'/>SIM</option>");
					}
				  ?>
                        </select>
                        <span class="textoSobrescrito">
                            * Caso positivo, veja as condi&ccedil;&otilde;es de atendimento no Edital
                        </span>
                    </td>
                </tr>

				<tr style="display: none">
							<td height="28" align='right'><label for=nis>Cadastro &Uacute;nico (NIS):</label></td>
							<td>
								<input name="nis" id="nis" tabindex="28" type="text" size="15" maxlength="11" OnKeyPress="javascript:return Onlynumber(event);" alt="Cadastro &Uacute;nico (NIS)" />
							</td>
						</tr>

				<tr style="display: none">
					<td height="28" align='right'><label for=especial_prova>Condi&ccedil;&otilde;es especiais para realiza&ccedil;&atilde;o da prova:</label></td>
					<td>
						<select name="especial_prova" id="especial_prova" tabindex=28 onchange="javascript:especialProva()">
							<option value="NAO" selected />N&Atilde;O
							<option value="SIM" /> SIM
						</select>
						<span class="textoSobrescrito">*</span>
						&nbsp;&nbsp;Qual:&nbsp;&nbsp;
						<input style="text-transform:uppercase" name="especial_prova_descricao" type="text" id="especial_prova_descricao" tabindex=29 size='40' maxlength="40" alt="Especial Prova" />
										<input type="hidden" name="flag_especial_prova_descricao" id="flag_especial_prova_descricao" />
								</td>
				</tr>

						<tr>
							<td height="28" align='right'><label for=vaga_especial>Concorre &agrave;s vagas destinadas a candidatos com Necessidades Especiais:</label></td>
							<td>
								<select name="vaga_especial" id="vaga_especial" tabindex=30>
									 <option value="NAO" selected="selected">N&Atilde;O</option>
									 <option value="SIM" >SIM</option>
								</select>
								<span class="textoSobrescrito">*</span>
							</td>
						</tr>
				
						<tr>
					<td height="28" align='right'><label for=vaga_rede_publica>Concorrer &agrave;s vagas reservadas para alunos oriundos da Rede P&uacute;blica:</label></td>
					<td>
						<select name="vaga_rede_publica" id="vaga_rede_publica" tabindex=31>
							<option value="NAO" selected="selected" >N&Atilde;O</option>
							<option value="SIM">SIM</option>
						</select>
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>

				<tr style="display: none">
					<td height="28" align='left'><label for=vaga_rural>Concorrer &agrave;s vagas reservadas para alunos filhos de Pequenos Produtores Rurais, Assentados, Lavradores e Trabalhadores Rurais:</label></td>
					<td>
						<select name="vaga_rural" id="vaga_rural" tabindex=33>
							<option value="NAO" selected="selected">N&Atilde;O</option>
							<option value="SIM">SIM</option>
						</select>
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>                
                                <tr>
                                        <td align="right" height="28"><label for="etnia">Informe sua Etnia:</label></td>
                                        <td>
                                            <select name="etnia" id="etnia" >
                                                <option value="" selected="selected"></option>
                                                <option value="PRETO">PRETO</option>
                                                <option value="PARDO">PARDO</option>
                                                <option value="INDIGENA">INDIGENA</option>
                                                <option value="OUTRA">OUTRA ETNIA</option>
                                            </select>
                                            <input name="flag_etnia" id="flag_vaga_etnia" type="hidden">
                                            <span class="textoSobrescrito">**</span>
                                        </td>
                                </tr>
                                <tr>
                                    <td align="right" height="28"><label for="renda">Qual a renda total de sua família (soma aproximada dos rendimentos de todos que residem na sua casa)?</label></td>
                                    <td>
                                        <select name="renda" id="renda" >
                                            <option value="" selected="selected"></option>
                                            <option value="1">Igual ou inferior a 1,5 salario-mínimo (R$ xxx)</option>
                                            <option value="2">Superior a 1,5 salario-mínimo (R$ xxx)</option>
                                        </select>
                                        <input name="flag_renda" id="flag_vaga_renda" type="hidden">
                                        <span class="textoSobrescrito">
                                            **<br>
                                            <b>1</b> - Renda familiar per capita igual ou inferior a 1,5 salário-mínimo (um salário-mínimo e meio) ou R$ 933,00.<br>
                                            <b>2</b> - Renda familiar per capita superior a 1,5 salário-mínimo (um salário-mínimo e meio).<br>

                                        </span>
                                    </td>
                                </tr>
				<tr>
							<td colspan="2" align="center"><h2> Registro de notas </h2> </td>
				</tr>                
									
						<tr>
								<td align='right' width="200px">Portugu&ecirc;s:</td>
								<td>
										&emsp;1&deg; Ano: <input class="notas" name="mediapor1" type="text" id="mediapor1" tabindex=32 onkeypress="javascript:return Onlynumber(event);" value="" size="5" maxlength="5" alt="Média de Portugu&ecirc;s 1&deg;" />
										<span class="textoSobrescrito">*</span>
										&emsp;2&deg; Ano: <input class="notas" name="mediapor2" type="text" id="mediapor2" tabindex=33 onkeypress="javascript:return Onlynumber(event);" value="" size="5" maxlength="5" alt="Média de Portugu&ecirc;s 2&deg;" />
										<span class="textoSobrescrito">*</span>
										&emsp;3&deg; Ano: <input class="notas" name="mediapor3" type="text" id="mediapor3" tabindex=34 onkeypress="javascript:return Onlynumber(event);" value="" size="5" maxlength="5" alt="Média de Portugu&ecirc;s 3&deg;" />
										<span class="textoSobrescrito">*</span>
								</td>
						</tr>

						<tr>
								<td align='right' width="200px">Matem&aacute;tica:</td>
								<td>
									&emsp;1&deg; Ano: <input class="notas" name="mediamat1" type="text" id="mediamat1" tabindex=35 onkeypress="javascript:return Onlynumber(event);" value="" size="5" maxlength="5" alt="Média de Matem&aacute;tica 1&deg;" />
									<span class="textoSobrescrito">*</span>
									&emsp;2&deg; Ano: <input class="notas" name="mediamat2" type="text" id="mediamat2" tabindex=36 onkeypress="javascript:return Onlynumber(event);" value="" size="5" maxlength="5" alt="Média de Matem&aacute;tica 2&deg;" />
									<span class="textoSobrescrito">*</span>
									&emsp;3&deg; Ano: <input class="notas" name="mediamat3" type="text" id="mediamat3" tabindex=37 onkeypress="javascript:return Onlynumber(event);" value="" size="5" maxlength="5" alt="Média de Matem&aacute;tica 3&deg;" />
									<span class="textoSobrescrito">*</span>
								</td>
						</tr>                            

				<tr>
					<td colspan="2" align="justify">
						<hr />
						<p>Declaro, que estou ciente e de acordo com todas as regras que norteiam a presente sele&ccedil;&atilde;o e que a
					declara&ccedil;&atilde;o de informa&ccedil;&otilde;es falsas sujeita-me &agrave;s san&ccedil;&otilde;es
					administrativa, c&iacute;vel e criminal.</p>
					</td>
				</tr>

				<tr>
					<td colspan="2" align="center">Confirma?
						<select name="declaracao" id="declaracao" tabindex=38>
							<option value="NAO" selected="selected">N&Atilde;O</option>
							<option value="SIM">SIM</option>
						</select>
						<br />
						<br />
					</td>
				</tr>

				<tr>
					<td>
						<!--<input type="text" name="localprova" id="localprova" style="display: none" value="null" />-->
						<input type="text" name="numinscricao" id="numinscricao" style="display: none" />
					</td>
				</tr>

				<tr>
					<td colspan='3' align='center'>
						<input name="Gravar" type="submit" id="Gravar" tabindex=39 value="Enviar" />
						<input type="button" value="Cancelar" onclick="javascript:redireciona();" />
					</td>
				</tr>
	</table>
	</form>
	</div>
</body>
</html>
