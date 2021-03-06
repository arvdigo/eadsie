<?php
//ini_set('display_errors', 1);

include_once '../classes/DB.php';
include_once '../classes/PHPExcel/PHPExcel.php';
include_once '../classes/PHPExcel/PHPExcel/Writer/Excel5.php';


	$banco    = DB::getInstance();
	$conexao  = $banco->ConectarDB();

	$sql = <<<SQL
SELECT
	campus.id AS campus_id,
	campus.nome AS campus_nome,
	curso.nome AS curso_nome,
	inscrito.nome AS inscrito_nome,
	inscrito.numinscricao AS inscrito_numinscricao,
	inscrito.cpf AS inscrito_cpf,
	inscrito.rg AS inscrito_rg,
	inscrito.orgaoexpedidor AS inscrito_orgaoexpedidor,
	inscrito.uf AS inscrito_uf,
	inscrito.dataexpedicao AS inscrito_dataexpedicao,
	inscrito.nacionalidade AS inscrito_nacionalidade,
	inscrito.datanascimento AS inscrito_datanascimento,
	inscrito.sexo AS inscrito_sexo,
	inscrito.endereco AS inscrito_endereco,
	inscrito.cep AS inscrito_cep,
	inscrito.cidade AS inscrito_cidade,
	inscrito.estado AS inscrito_estado,
	inscrito.telefone AS inscrito_telefone,
	inscrito.celular AS inscrito_celular,
	inscrito.email AS inscrito_email,
	inscrito.estadocivil AS inscrito_estadocivil,
	inscrito.especial AS inscrito_especial,
	inscrito.especial_descricao AS inscrito_descricao_especial,
	inscrito.isencao AS inscrito_isencao,
	inscrito.cadastro_unico AS inscrito_nis,
	inscrito.especial_prova AS inscrito_especial_prova,
	inscrito.especial_prova_descricao AS inscrito_especial_prova_descricao,
	inscrito.vaga_especial AS inscrito_vaga_especial
FROM
	inscrito
		INNER JOIN pagamentos ON pagamentos.id_inscrito = inscrito.numinscricao
		INNER JOIN campus ON campus.id = inscrito.campus
		INNER JOIN curso ON curso.cod_curso = inscrito.curso
ORDER BY campus.id, inscrito.id
SQL;
$objPHPExcel = new PHPExcel();
//$objPHPExcel->createSheet();
//$objPHPExcel->setActiveSheetIndex(1);

function setCabecalho($objPHPExcel, $colunas) {
	foreach ($colunas as $coluna => $valor) {
		$objPHPExcel->getActiveSheet()->SetCellValue($coluna.'1', $valor);
		$objPHPExcel->getActiveSheet()->getColumnDimension($coluna)->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getStyle($coluna.'1')->getFont()->setBold(true);
	}
}

$colunas = array(
	'A' => 'CAMPUS',
	'B' => 'CURSO',
	'C' => 'INSCRITO',
	'D' => utf8_encode('N� INSCRI��O'),
	'E' => 'CPF',
	'F' => 'RG',
	'G' => utf8_encode('ORG�O EXPEDIDOR'),
	'H' => 'UF',
	'I' => utf8_encode('DATA DE EXPEDI��O'),
	'J' => 'NACIONALIDADE',
	'K' => 'DATA DE NASCIMENTO',
	'L' => 'SEXO',
	'M' => utf8_encode('ENDERE�O'),
	'N' => 'CEP',
	'O' => 'CIDADE',
	'P' => 'ESTADO',
	'Q' => 'TELEFONE',
	'R' => 'CELULAR',
	'S' => 'EMAIL',
	'T' => 'ESTADO CIVIL',
	'U' => utf8_encode('NECESSIDADE ESPECIAL?'),
	'V' => utf8_encode('DESCRI��O NECESSIDADE ESPECIAL'),
	'W' => utf8_encode('ISEN��O DE TAXA'),
	'X' => utf8_encode('CADASTRO �NICO (NIS)'),
	'Y' => utf8_encode('CONDI��ES ESPECIAIS PARA REALIZA��O DA PROVA'),
	'Z' => utf8_encode('DESCRI��O CONDI��ES ESPECIAIS PARA REALIZA��O DA PROVA'),
	'AA' => utf8_encode('CONCORRE AS VAGAS DESTINADAS A CANDIDATOS COM NECESSIDADES ESPECIAIS'),
);


$query = $banco->ExecutaQueryGenerica($sql);
$linha = 2;
$campus_id = null;
while ($row = mysql_fetch_assoc($query)) {
	$val = array_values($row);
	if ($campus_id != $val[0]) {
		$campus_id = $val[0];
			if ($campus_id > 1) {
				$objPHPExcel->createSheet();
				$objPHPExcel->setActiveSheetIndex($objPHPExcel->getActiveSheetIndex() + 1);
			}
			$objPHPExcel->getActiveSheet()->setTitle($val[1]);
			setCabecalho($objPHPExcel, $colunas);
			$linha = 2;
	}
	$col = 1;
	foreach ($colunas as $coluna => $valor) {
		if ($val[$col] == null) {
			$objPHPExcel->getActiveSheet()->SetCellValue($coluna.$linha, '---');
		} else {
			$objPHPExcel->getActiveSheet()->SetCellValue($coluna.$linha, utf8_encode($val[$col]));
		}
		$col++;
	}
	$linha++;
}

//$objPHPExcel->setActiveSheetIndex(0);
//$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', __FILE__));

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="relatorio_completo.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
