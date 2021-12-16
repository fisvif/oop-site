<?php

    namespace models\admin;

    use models\BaseModel;
    use models\IModel;
    use models\File;

    class Article extends BaseModel implements IModel
    {
        public $file;

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

        public function setId()
        {
            $articles = $this->getList();//список елеиентів 
            $count = count($articles) - 1;// порядковий номер

            if (isset($articles[$count])) {// отримали id останього елемента
                return $articles[$count]['id'] + 1;
            }
            return 1;
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
        
        public function getList()
        {
            $list = new self();
            return $list->file->read();
        }

    }
?>