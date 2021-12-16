<?php
    namespace models;

    interface IModel
    {
        public function create(array $data);
        public function update();
        public function delete();
    }
?>