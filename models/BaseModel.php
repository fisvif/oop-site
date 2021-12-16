<?php
    namespace models;

    abstract class BaseModel
    {
        private $id;
        private $date_added;
        private $title;
        private $description;
        private $image;
        private $author;
        private $errors = [];
        
        public function __set($property, $value)
        {
            $a = array_map("ucfirst", explode( "_", $property));
            $validateMethod = "validate".implode($a);
            
            if (method_exists($this, $validateMethod)) {
                if ($this->$validateMethod($value)) {
                    $this->$property = $value;
                }
            }else{
                $this->$property = $value;
            }
        }

        public function __get($property)
        {
            return $this->$property;
        }

        public function __sleep()
        {
            return array('id', 'title', 'date_added', 'author');
        }

        abstract public function view($id);
        abstract public function getList();
        
        public function validateTitle($title)
        {
            if (isset($title) && !empty($title)) {
                //10-70 cumvoliv perevirka
                if (strlen($title) >= 5 && strlen($title) <= 70) {
                    return true;
                } else {
                    $this->errors['title'] = 'Повино бути більше 5 та менше 70 символів';
                }
            } else {
                $this->errors['title'] = 'Не коректно введено заголоваок';
            }
            return false;
        }
        
        public function validateDateAdded($date_added)
        {
            if (isset($date_added) && !empty($date_added)) {
                $this->date_added = $date_added;
            } else {
                $this->date_added = date('Y-m-', time());
            }
        }

        public function validateDescription($description)
        {
            if (isset($description) && !empty($description)) {
                if (strlen($description) > 10 && strlen($description) < 1000) {
                    $this->description = htmlspecialchars($description);
                } else {
                    $this->errors['description'] = 'Описание слишком короткое';
                }
            } else {
                $this->errors['description'] = 'Опис не може бути пустим';
            }
        }

    //     public function validateImage($image)
    //     {
    //         if (empty($error)){    
    //             if (isset($image) && $image['error'] == 0) {
    //                 if (preg_match('#image/((png)|(jpg)|(jpeg))#', $image['type'])) {
    //                     if ($image['size'] < 10000000) {
    //                         $image = 'uploads/'.$image['name'];
    //                         if (move_uploaded_file($image['tmp_name'], "../".$image)) {
    //                            $this->image = $image;
    //                         } else {
    //                             $this->errors['image'] = 'Щось пішло не так попробуйте знову';
    //                         }
    //                     } else {
    //                         $this->errors['image'] = 'Размер изображения слишком большой';
    //                     }
    //                 } else {
    //                     $this->errors['image'] = 'Тип изображения не поддерживается. Поддерживаемые типы изображений: PNG, JPG, JPEG';
    //                 }
    //             } 
    //     }
    }
?>