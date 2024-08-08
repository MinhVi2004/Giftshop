<?php
// require (__DIR__ . "/../../Lib/Database.php");
class ThanhToanMomoModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAll() {
            $getAllQuery = "SELECT * from `thanhtoanmomo`";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getLastId() {
            return $this->db->getLastInsertId();
      }
      
      public function insertThanhToanMomo($partnerCode, $partnerName, $storeId, $requestId, $amount, $orderId, $orderInfo, $redirectUrl, $ipnUrl, $lang, $extraData, $requestType, $signature, $currentDateTime) {
            $insertQuery = "INSERT INTO thanhtoanmomo (orderId, partnerCode, partnerName, storeId, requestId, amount, orderInfo, redirectUrl, ipnUrl, lang, extraData, requestType, signature, currentDateTime) 
                            VALUES ('$orderId', '$partnerCode', '$partnerName', '$storeId', '$requestId', '$amount', '$orderInfo', '$redirectUrl', '$ipnUrl', '$lang', '$extraData', '$requestType', '$signature', '$currentDateTime')";
            $result = $this->db->execute($insertQuery);
            if($result) {
                  return true;
            }
            return false;
      }
}