<?php
  //-------------Conexao-----------
  try{
    $pdo = new PDO("mysql:dbname=CRUDPDO;host=localhost","root", ""); 
    //dbname
    //host
    //user & pass
  }
  catch(PDOException $e){
    echo "Erro com banco de dados: ".$e->getMessage();
  }
  catch(Exception $e){
    echo "Erro: ".$e->getMessage();
  }

  //---------------- INSERT ----------
  //1ª Forma:
  //$res = $pdo->prepare("INSERT INTO pessoa VALUES (NULL, :n, :t, :e)");
  
  //$res->bindValue(":n", "Perigo"); //aceita qualquer coisa
  //$res->bindValue(":t", "11969045887");
  //$res->bindValue(":e", "teste@gmail.com");
  //$res->execute();

  //$nome = "Perigo";
  //$res->bindParam(":n", $nome); //precisa de variaveis
  
  // 2ª Forma:
  //$pdo ->query("INSERT INTO pessoa VALUES (NULL, 'Jackson', '11969045887', 'teste@gmail.com')");

  //-------------------- DELETE e UPDATE--------
  //1ª Forma DELETE:
  //$res = $pdo ->prepare("DELETE FROM pessoa WHERE id = :id");
  //$id = 2;
  //$res->bindValue(":id", $id);
  ///$res->execute();

  //2ª Forma DELETE:
  //$res = $pdo->query("DELETE FROM pessoa WHERE id = '3'");

  //1ª Forma UPDATE
  //$res = $pdo->prepare("UPDATE pessoa SET email = :e WHERE id = :id");
  //$res->bindValue(":e", "jackson@gmail.com");
  //$res->bindValue(":id", 4);
  //$res->execute();

  // 2ª Forma UPDATE:
  //$res = $pdo->query("UPDATE pessoa SET email = 'perigo@gmail.com' WHERE id = '1'");

  // ---------------------- SELECT ----------
  $res = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
  $res->bindValue(":id", 4);
  $res->execute();
  $cmd = $res->fetch(PDO::FETCH_ASSOC); //-> quando temos apenas um registro no select
  //ou
  //$res->fetchAll(); -> quando temos mais de uma linha no select
  //echo "<pre>";
  //print_r($cmd);
  //echo "</pre>";

  foreach ($cmd as $key => $value){
    echo $key.": ".$value."<br>";
  }
?>