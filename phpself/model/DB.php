<?php
  require_once('config/config.php');
  
class DB {
  // フィールド
  private $host;
  private $dbname;
  private $user;
  private $password;
  protected $con;

  // コンストラクタ
       function __construct($host, $dbname, $user, $password) {
         $this->host = $host;
         $this->dbname = $dbname;
         $this->user = $user;
         $this->password = $password;
       }
  // メソッド
     public function connectDb() {
         $this->con = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->user, $this->password);
         if(!$this->con) {
           print '接続できませんでした。';
           die();
         }
     }
}
