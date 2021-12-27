<?php
    namespace modele\admin;

    use models\BaseModel;
    use models\IModel;
    use models\File;

    class Book extends BaseModel implements IModel
    {
        public $error
        private $count_page;


        public function create($data)
    {
        $this->setId();
        $this->title = $data['title'];
        $this->author = $data['author'];
        $this->date_added = $data['date_added'];
        $this->description = $data['description'];
        if (empty($this->error)) {
            $this->file->new_data = $this;
            return $this->file->save(); 
        }
        return $this->error;
    }

    public function update($id, $data)
    {
        
        $model = new self();
        $model->id = $id;
        $model->title = $data['title'];
        $model->author = $data['author'];
        $model->author = $data['count_page'];
        $model->date_added = $data['date_added'];
        $model->description = $data['description'];

        $key = $this->getOneById($id);

        self::getList();
        $this->file->data_list[$key] =  $model;

        if (empty($this->error)) {
            return $this->file->save(); 
        }
        return $this->error;
    }

    }
?>