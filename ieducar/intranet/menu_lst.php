<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	*																	     *
	*	@author Prefeitura Municipal de Itajaí								 *
	*	@updated 29/03/2007													 *
	*   Pacote: i-PLB Software Público Livre e Brasileiro					 *
	*																		 *
	*	Copyright (C) 2006	PMI - Prefeitura Municipal de Itajaí			 *
	*						ctima@itajai.sc.gov.br					    	 *
	*																		 *
	*	Este  programa  é  software livre, você pode redistribuí-lo e/ou	 *
	*	modificá-lo sob os termos da Licença Pública Geral GNU, conforme	 *
	*	publicada pela Free  Software  Foundation,  tanto  a versão 2 da	 *
	*	Licença   como  (a  seu  critério)  qualquer  versão  mais  nova.	 *
	*																		 *
	*	Este programa  é distribuído na expectativa de ser útil, mas SEM	 *
	*	QUALQUER GARANTIA. Sem mesmo a garantia implícita de COMERCIALI-	 *
	*	ZAÇÃO  ou  de ADEQUAÇÃO A QUALQUER PROPÓSITO EM PARTICULAR. Con-	 *
	*	sulte  a  Licença  Pública  Geral  GNU para obter mais detalhes.	 *
	*																		 *
	*	Você  deve  ter  recebido uma cópia da Licença Pública Geral GNU	 *
	*	junto  com  este  programa. Se não, escreva para a Free Software	 *
	*	Foundation,  Inc.,  59  Temple  Place,  Suite  330,  Boston,  MA	 *
	*	02111-1307, USA.													 *
	*																		 *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
$desvio_diretorio = "";
require_once ("include/clsBase.inc.php");
require_once ("include/clsListagem.inc.php");
require_once ("include/clsBanco.inc.php");

class clsIndex extends clsBase
{
	
	function Formular()
	{
		$this->SetTitulo( "{$this->_instituicao} Menu!" );
		$this->processoAp = "35";
	}
}

class indice2 extends clsListagem
{
	function Gerar()
	{
		$this->titulo = "Menu da Intranet";
		$this->addBanner( "", "", "", true );
		
		$this->addCabecalhos( array( "Nome", "Arquivo") );
		
		
		$db = new clsBanco();
		$db->Consulta( "SELECT cod_menu_submenu, nm_submenu, arquivo FROM menu_submenu WHERE cod_sistema=2 ORDER BY nm_submenu" );
		while ($db->ProximoRegistro())
		{
			list ($id_item, $nome, $arquivo) = $db->Tupla();

			$this->addLinhas( array("<a href='menu_det.php?id_item=$id_item'><img src='imagens/noticia.jpg' border=0>$nome</a>", $arquivo) );
		}

		$this->acao = "go(\"menu_cad.php\")";
		$this->nome_acao = "Novo";

		$this->largura = "100%";
	}
}


$pagina = new clsIndex();


$miolo2 = new indice2();
$pagina->addForm( $miolo2 );

$pagina->MakeAll();

?>