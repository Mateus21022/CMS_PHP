<?php
  class BancodeDados{
    private static $instance = null;
    private $connection;
    
    protected function connect(){
        $host = 'localhost';
        $port = 5432;
        $dbname = 'cms_lite';
        $user = 'postgres';
        $password = 'mateus12';


        try {
            $this->connection = new PDO ("pgsql:host=$host;port=$port;dbname=$dbname",$user,$password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        }catch(PDOException $e){
            die ("Erro na conexão".$e->getMessage());
        }
    }

    public static function getInstance(){
        if (self::$instance === null){
            self::$instance = new BancodeDados();
        }
    }
  }


  
  //Bloco de código para testar a conexão com o banco de dados 
  //Se quiser testar é só apagar esse bloco de código acima e substituir por esse debaixo, lembre-se de manter as informações! Apague somente os blocos de código.


  /*try {
      $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Conexão bem-sucedida!";
  } catch (PDOException $e) {

      echo "Erro na conexão: " . $e->getMessage();
  }*/
  
  