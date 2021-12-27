<?php

    namespace models\admin;

    use models\BaseModel;
    use models\IModel;
    use models\File;

    class Article extends BaseModel implements IModel
    {
        public function __construct()
        {
            $this->file = new File('article');
        }

        public function create(array $data)
        {
            $this->id = $this->setId();
            $this->title = $data['title'];
            $this->author = $data['author'];
            $this->date_added = $data['date_added'];

            if (empty($this->errors)) {
                $this->file->new_data = $this;
                $this->file->save();
            } 
            return $this->errors;
        }

        


        public function index()
        {
            return self::getList();
        }

        public function update()
        {

        }

        public function delete()
        {

        }

        public function view($id)
        {
            return self::getList();
        }
        
        public static function getList()
        {
            $list = new self();
            return $list->file->read();
        }

    }
?>