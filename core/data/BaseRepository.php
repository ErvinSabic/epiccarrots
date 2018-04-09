<?php 

namespace Core\Data;

class BaseRepository {
    public $table; 

    public function __construct(string $table){
        $this->table = $table;
    }
}


?>