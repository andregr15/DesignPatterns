<?php
namespace AGR\Dao;

class SqliteDao extends \SQLite3{

    function __construct()
    {
        $this->open('categorias.db');
    }

    function getConnection(){
        $db = new SqliteDao();
        if(!$db){
            throw new \Exception("erro banco de dados");
        }
        return $db;
    }

    function fixture(){
        $db = $this->getConnection();

        $sql = "drop table if exists categoria; create table categoria (id integer, categoria text);";

        $ret = $db->exec($sql);
        if(!$ret){
            echo $db->lastErrorMsg();
        } 
        
        $sql = "insert into categoria (id, categoria) values (1, 'unitário');
                insert into categoria (id, categoria) values (2, 'fracionado');
                insert into categoria (id, categoria) values (3, 'pesado');";

        $ret = $db->exec($sql);
        if(!$ret){
            echo $db->lastErrorMsg();
        } 

        $db->close();
    }

    function getCategorias(){
        $categorias = array('class' => 'select', 'options' => array());
        
        $db = $this->getConnection();        
        $ret = $db->query("select id, categoria from categoria order by id;");
        while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $categorias['options'][] = array('id'=> $row['id'], 'value' => $row['categoria'], 'content' => ucfirst($row['categoria']));
        }

        return $categorias;
    }

}

?>