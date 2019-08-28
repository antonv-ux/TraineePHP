<?php
/**
 * Класс для выполнения различных операций с БД
 */
class DataBaseOperation {
    private $_connection;
    /**
     * Конструктор класса устанавливает соединение с БД
     */

    public function __construct(){
        $this->_connection = new PDO('mysql:host=localhost;dbname=transport;charset=utf8', 'root', '');
    }
    
    /**Метод получения соединения с БД
     * 
     * @return object
     */

    public function getConnection(){
        
        return $this->_connection;
    }
   
    /**Метод для подготовленого запроса
     * 
     * @param string $queryStr - SQL запрос
     * @param integer $parent_id - Идентификатор родительского узла
     * @param string $name - Наименование узла
     * @return type
     */
    public function BaseQuery ($queryStr, $parent_id, $name){
        $db = $this->getConnection();
        $query = $db->prepare($queryStr);
        $query->bindParam(':parent_id', $parent_id);
        $query->bindParam(':name', $name);
        
        return $query;
    }
    /**Вспомогательный метод для генерации исключений,
     * предотвращает добаление строк с одинаковым родительським идентификатором
     * и наименованием узла.
     * 
     * @param integer $parent - родительский идентификатор узла
     * @param string $name - наименование узла
     * @return type
     */
    public function checkExistRecord ($parent, $name){
        $query = $this->getConnection()->prepare("SELECT `id` FROM `tbl_tree` WHERE `name`=:name AND `parent_id`=:parent");
        $query->bindParam(':parent', $parent);
        $query->bindParam(':name', $name);
        $query->execute();
        
        return $query->fetchColumn();
    }
    /**Метод для добавления узла
     * 
     * @param type $parent_id - Родительский идентификатор добавляемого узла
     * @param type $name - Наименование добавляемого узла
     * @return boolean
     */
    public function AddNode ($parent_id, $name){
        if($this->checkExistRecord($parent_id, $name ) !== false){
            throw new Exception('Дублирующая строка');
        }
        $Str = "INSERT INTO `tbl_tree` (`parent_id`, `name`) VALUES (:parent_id, :name)";
        
        return $this->BaseQuery($Str,$parent_id, $name)->execute();
    }
    
    /**Метод для удаления узла
     * 
     * @param integer $parent_id - Родительский идентификатор удаляемого узла
     * @param string $name - Наименование удаляемого узла
     * @return boolean
     */
    public function DeleteNode ($parent_id, $name){
        $Str = "DELETE FROM `tbl_tree` WHERE `parent_id`=:parent_id AND `name`=:name";
        
        return $this->BaseQuery($Str, $parent_id, $name)->execute();
        
    }
    
    /**Метод для обновления узла
     * 
     * @param integer $parent_id_from - Родительский идентификатор изменяемого узла
     * @param string $name_from - Наименование изменяемого узла
     * @param integer $parent_id - Родительский идентификатор узла который нужно установить
     * @param string $name - Наименование узла которое нужно установить
     * @return boolean
     */
    public function UpdateNode ($parent_id_from, $name_from, $parent_id, $name){
        if($this->checkExistRecord($parent_id, $name ) !== false){
           throw new Exception('Дублирующая строка');
        }
        $Str = "UPDATE `tbl_tree` SET `parent_id`=:parent_id, `name`=:name WHERE `parent_id`=:parent_id_from AND `name`=:name_from" ;
        $result = $this->BaseQuery($Str, $parent_id, $name);
        $result->bindParam(':parent_id_from', $parent_id_from);
        $result->bindParam(':name_from', $name_from);
     
        return $result->execute();
    }
}


