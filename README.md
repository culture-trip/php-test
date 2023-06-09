# Culture Trip PHP Developer Technical Test

## Context
A big part of working as a Back-End Engineer on Culture Trip is managing the data and communication channels between systems. That means working with (RESTful) APIs, collaborating with other members to define contracts, parsing and transforming content, and making sure the data returned by the APIs is well-structured, valid and consistent.

## Exercise
The point of this exercise is to read article data from the provided JSON file (`assets/articles.json`), process it, and expose it via an API.  
The article data contains ID, title, slug and content fields for each article. Content can be either plain text, or HTML with paragraphs and images.  
The API should expose:
- an index endpoint that will return all available articles;
- an endpoint that takes the ID of a desired article and returns a single resource.

Each article resource should contain the ID, title, slug, content and publish_date fields.  
For the content field, the raw text or HTML should be parsed and transformed into blocks, for example a paragraph might turn into the following object:
```
{
    type: 'paragraph',
    content: 'Lorem ipsum dolor sit amet',
}
```
The inner paragraph formatting and tags should be preserved.

You may use any third party libraries at your discretion.

## Getting started
Install dependencies with `composer install`.  
Start the server with `composer start` or `php -S localhost:<port> -t public`.
