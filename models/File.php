<?php
    namespace models;

    class File
    {
        private const DIR_PATH =  './filelist/';
        public $name;
        public $new_data = NULL;
        public $data_list = [];

        public function __construct($name)
        {
            if($this->validate(self::DIR_PATH.$name.'.txt')){
                $this->name = $name;
            }
        }
        
        private function validate($name)
        {
            if (file_exists($name)) {
                return true;
            }
            return false;
        }
        
        public function read()
        {
            $list = file(self::DIR_PATH.$this->name.'.txt');

            foreach($list as $item){
                // if ($item != '') {
                    $this->data_list[] = unserialize($item);
                // }
            }
            return $this->date_list;
        }
        
        public function save()
        {
            if (!is_null($this->new_data)) {
                $handle = fopen(self::DIR_PATH.$this->name.'.txt', 'a+');
                fwrite($handle, serialize($this->new_data)."\n"); 
                fclose($handle);
            }
        }

        public function write(array $catalog_item)
        {
            // try {
            //     $handle = fopen(self::DIR_PATH.$this->name.'.txt', 'a+');
            //     // fputcsv($handle, $catalog_item, ';', '"'); 

            // } catch (Exeption $a) {

            // } finally {
            //     fclose($handle);
            // }
        }
    }
?>