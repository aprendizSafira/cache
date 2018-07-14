<?php
class Cache {
	private $cache;

	//Setando o valor
	public function setVar($nome, $valor) {
		//1ºRecuperar o cache que já esta salvo no servidor
		//2ºCriar o cache se for a primeira vez acessado
		//3ºAdicionar alguma coisa ao cache
		$this->readCache();//Lê o cache.
		$this->cache->$nome = $valor;//Adiciona ou Substitui o $nome pelo $valor que o user passou.
		$this->saveCache();//Salvar o cache.
	}

	//Pegando o valor
	public function getVar($nome) {
		$this->readCache();//Lê o cache;
		return $this->cache->$nome;//retorna o cache;
	}

	//Lê o cache do arquivo
	private function readCache() {
		//Limpando o cache que possa estar salvo nesse obejeto
		$this->cache = new stdClass();//new stdClass =  objeto vazio
		//Saber se o arquivo de cache existe
		if(file_exists("cache.cache")) {
			//Se ele existir armazena dentro da variavel cache
			$this->cache = json_decode(file_get_contents('cache.cache'));//retorna string e transforma em objeto
		}
	}

	//Salva o cache 
	private function saveCache() {
		file_put_contents("cache.cache", json_encode($this->cache));//Salva informações em um arquivo
	}

}
$cache = new Cache();

echo "Meu nome é: ".$cache->getVar("nome")." e minha idade é: ".$cache->getVar("idade")." anos.";