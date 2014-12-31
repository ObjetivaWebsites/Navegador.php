<?

/*

VERSÃO:			1.1.1
AUTOR:			Moisés de Lima
ATUALIZAÇÃO:	31/12/2014
FUNÇÃO:			Detectar o navegador e sua versão e retornar se for solicitado.

*/

class Plugins_Navegador{

	public $UltimasVersoes	= array(
		'Firefox'				=> array('18', 'http://br.mozdev.org/firefox/download/'),
		'Chrome' 				=> array('30', 'https://www.google.com/intl/pt-BR/chrome/browser/?hl=pt-BR'),
		'Chromium'				=> array('30', 'https://www.google.com/intl/pt-BR/chrome/browser/?hl=pt-BR'),
		'Internet Explorer' 	=> array('10', 'http://windows.microsoft.com/pt-BR/internet-explorer/downloads/ie'),
		'Safari' 				=> array('4', 'http://appldnld.apple.com/Safari5/041-5487.20120509.INU8B/SafariSetup.exe'),
		'Opera' 				=> array('12', 'http://www.opera.com/download/')
	);

	public $user_agent;

	function processaNavegador($navegador){

		// PARA INTERNET EXPLORER
		if(preg_match("|MSIE|", $navegador) == true and preg_match("|Opera|", $navegador) != true){

			$retorna['navegador']	=	'Internet Explorer';

			preg_match_all("|MSIE ([0-9.]+)|", $navegador, $versao);

			if(!isset($versao[1][0])){

				$versao[1][0] = '0.1';

			}

			$retorna['versao']		=	@$versao[1][0];

			return $retorna;
		}

		// PARA FIREFOX
		if(preg_match("|Firefox|", $navegador) == true and preg_match("|Opera|", $navegador) != true){

			$retorna['navegador']	=	'Firefox';

			preg_match_all("|Firefox/([0-9.]+)|", $navegador, $versao);

			if(!isset($versao[1][0])){

				$versao[1][0] = '0.1';

			}

			$retorna['versao']		=	@$versao[1][0];

			return $retorna;
		}

		// PARA GOOGLE CHROME
		if(preg_match("|Chrome|", $navegador) == true and preg_match("|Chromium|", $navegador) != true){

			$retorna['navegador']	=	'Chrome';

			preg_match_all("|Chrome/([0-9.]+)|", $navegador, $versao);

			if(!isset($versao[1][0])){

				$versao[1][0] = '0.1';

			}

			$retorna['versao']		=	@$versao[1][0];

			return $retorna;

		}

		// PARA GOOGLE CHROMIUM
		if(preg_match("|Chromium|", $navegador) == true){

			$retorna['navegador']	=	'Chromium';

			preg_match_all("|Chrome/([0-9.]+)|", $navegador, $versao);

			if(!isset($versao[1][0])){

				$versao[1][0] = '0.1';

			}

			$retorna['versao']		=	@$versao[1][0];

			return $retorna;
		}

		// PARA OPERA
		if(preg_match("|Opera|", $navegador) == true){

			preg_match_all("|Version/([0-9.]+)|", $navegador, $versao);

			if(@$versao[1][0] < 10){

				preg_match_all("|Opera/([0-9.]+)|", $navegador, $versao);

			}

			if(!@$versao[1][0]){

				preg_match_all("|Opera ([0-9.]+)|", $navegador, $versao);

			}

			if(!@$versao[1][0]){

				$versao[1][0] = '0.1';

			}

			$retorna['navegador']	=	'Opera';

			$retorna['versao']		=	$versao[1][0];

			return $retorna;

		}

		// PARA APPLE SAFARI
		if(preg_match("|Safari|", $navegador) == true and preg_match("|Chrome|", $navegador) != true){

			preg_match_all("|Version/([0-9.]+)|", $navegador, $versao);

			if(!isset($versao[1][0])){

				$versao[1][0] = '0.1';

			}

			$retorna['navegador']	=	'Safari';

			$retorna['versao']		=	$versao[1][0];

			return $retorna;

		}

		$retorna['navegador']	=	'desconhecido';

		$retorna['versao']		=	1;

		return $retorna;

	}

	function browser(){

		$this->user_agent = $_SERVER['HTTP_USER_AGENT'];
	
		$navegador = $this->processaNavegador($this->user_agent);

		$versaoNavegador	= explode('.', $navegador['versao']);					//POR CAUSA DAS VERSÕES 10.0.2, POR NÃO SER NÚMERO VÁLIDO, ELE PEGA SOMENTE 10.0

		if(isset($versaoNavegador[0]) and isset($versaoNavegador[1])){				//VERIFICA SE O NÚMERO TEM PONTO

			$versaoNavegador	= $versaoNavegador[0].'.'.$versaoNavegador[1];

		}else{																		// SE NÃO TIVER PONTO

			$versaoNavegador	= $navegador['versao'];

		}
		
		if(!isset($this->UltimasVersoes[$navegador['navegador']][0])){
		
			return false;
		
		}

		if($versaoNavegador < $this->UltimasVersoes[$navegador['navegador']][0]){

			return false;

		}else{

			return true;

		}

	}

	function esteNavegador(){

		return $this->processaNavegador($_SERVER['HTTP_USER_AGENT']);

	}

	function versoesLinks(){

		return $this->UltimasVersoes;

	}

}
