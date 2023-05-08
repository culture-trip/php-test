<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ArticleController extends Controller
{
    public function index()
    {
        $articles = json_decode(File::get(public_path('articles.json')), true);

        $parsedArticles = array_map(function ($article) {
            return $this->parseArticle($article);
        }, $articles);

        return response()->json($parsedArticles);
    }

    public function show($id)
    {
        $articles = json_decode(File::get(public_path('articles.json')), true);

        $article = collect($articles)->firstWhere('id', $id);

        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        $parsedArticle = $this->parseArticle($article);

        return response()->json($parsedArticle);
    }

    private function parseArticle($article)
    {
        $blocks = [];

        $content = $article['content'];
        $dom = new \DOMDocument();
        $dom->loadHTML($content);

        foreach ($dom->childNodes as $node) {
            $block = [];

            if ($node->nodeName === '#text') {
                $block['type'] = 'text';
                $block['content'] = $node->nodeValue;
            } else if ($node->nodeName === 'p') {
                $block['type'] = 'paragraph';
                $block['content'] = $node->textContent;
            } else if ($node->nodeName === 'img') {
                $block['type'] = 'image';
                $block['src'] = $node->getAttribute('src');
                $block['alt'] = $node->getAttribute('alt');
            }

            if ($block) {
                $blocks[] = $block;
            }
        }

        $parsedArticle = [
            'id' => $article['id'],
            'title' => $article['title'],
            'slug' => $article['slug'],
            'publish_date' => $article['publish_date'],
            'content' => $blocks,
        ];

        return $parsedArticle;
    }
}
