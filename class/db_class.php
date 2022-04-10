<?php
class DatabasePDO{

   private $connection = null;

   public function __construct($dsn, $username, $password, $options)
   {
      try{
         $this->connection = new PDO($dsn, $username, $password, $options);
      }catch(Exception $e){
         throw new Exception($e->getMessage());
      }
   }

   public function __destruct() {
      if($this->connection) {
         $this->connection = null;
      }
   }

   public function getRowCount() {
      return $this->connection->rowCount();
   }

   public function Insert($statement = "" , $parameters = []){
      try{
         $this->executeStatement( $statement , $parameters );
         return $this->connection->lastInsertId();

      }catch(Exception $e){
         throw new Exception($e->getMessage());
      }
   }

   public function Select($statement = "" , $parameters = []){
      try{
         $stmt = $this->executeStatement( $statement , $parameters );
         return $stmt->fetchAll();

      }catch(Exception $e){
         throw new Exception($e->getMessage());
      }
   }

   public function Update($statement = "" , $parameters = []){
      try{
         $this->executeStatement( $statement , $parameters );

      }catch(Exception $e){
         throw new Exception($e->getMessage());
      }
   }

   public function Remove($statement = "" , $parameters = [] ){
      try{

         $this->executeStatement( $statement , $parameters );

      }catch(Exception $e){
         throw new Exception($e->getMessage());
      }
   }

   private function executeStatement($statement = "" , $parameters = []){
      try{
         $stmt = $this->connection->prepare($statement);
         $stmt->execute($parameters);
         return $stmt;
      }catch(Exception $e){
         throw new Exception($e->getMessage());
      }
   }
}
?>
