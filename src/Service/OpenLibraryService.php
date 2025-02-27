<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenLibraryService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function searchBooks(string $query): array
    {
        $response = $this->client->request(
            'GET',
            'https://openlibrary.org/search.json',
            ['query' => ['q' => $query, 'limit' => 10]]
        );

        $data = $response->toArray();

        return $data['docs'] ?? [];
    }

    public function getBookDetails(string $olid): array
    {
        $response = $this->client->request('GET', 'https://openlibrary.org/api/books', [
            'query' => [
                'bibkeys' => 'OLID:' . $olid,
                'format' => 'json',
                'jscmd' => 'data',
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Failed to fetch data from Open Library');
        }

        return $response->toArray();
    }
}
