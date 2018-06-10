<?php
namespace Likha\Controllers
{
  use \Likha\Engine\View;
  use \Likha\Models\Article;
  use \Mni\FrontYAML\Parser;

  class ArticleController
  {
    public function show(string $slug)
    {
      $parser = new Parser();
      $article_path = __DIR__ . "/../articles/{$slug}.md";
      if(file_exists($article_path))
      {
        $markdown = file_get_contents($article_path);
        $document = $parser->parse($markdown);
        $article = new Article($document->getYAML(), $document->getContent());
        return new View('article.twig', ['article' => $article]);
      }
      else
      {
        return new View('404.twig');
      }
    }
  }
}