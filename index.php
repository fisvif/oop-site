<?php 
    echo "<pre>";

    use models\admin\Article;
    
    spl_autoload_register();

    $article = new Article();

    echo $article->create(["title" => "title", "autor" => "autor", "date_added" => "01.01.1980"]);
    
    // var_dump($article);

    // var_dump($article->view(1));
?>