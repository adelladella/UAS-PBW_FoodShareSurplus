<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleCrudTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test getting all articles.
     */
    public function test_can_retrieve_articles_list(): void
    {
        $response = $this->getJson('/api/articles');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'id',
                         'title',
                         'category',
                         'author',
                         'emoji',
                         'content',
                         'snippet',
                         'views'
                     ]
                 ]);
    }

    /**
     * Test full article CRUD cycle.
     */
    public function test_article_crud_cycle(): void
    {
        // 1. Create Article
        $createResponse = $this->postJson('/api/articles', [
            'title' => 'Judul Artikel Pengujian Baru',
            'category' => 'edukasi',
            'content' => 'Ini adalah konten utama artikel pengujian yang digunakan untuk memverifikasi fungsionalitas CRUD di database.',
            'author' => 'Test Author'
        ]);

        $createResponse->assertStatus(200)
                       ->assertJson([
                           'status' => 'success',
                           'data' => [
                               'title' => 'Judul Artikel Pengujian Baru',
                               'category' => 'edukasi',
                               'author' => 'Test Author'
                           ]
                       ]);
        
        $articleId = $createResponse->json('data.id');

        // 2. Read Single Article
        $readResponse = $this->getJson("/api/articles/{$articleId}");
        $readResponse->assertStatus(200)
                     ->assertJson([
                         'title' => 'Judul Artikel Pengujian Baru',
                         'views' => 1 // Increment view checked
                     ]);

        // 3. Update Article
        $updateResponse = $this->putJson("/api/articles/{$articleId}", [
            'title' => 'Judul Artikel Pengujian Diubah',
            'category' => 'tips',
            'content' => 'Konten artikel ini telah diubah untuk tujuan verifikasi.'
        ]);

        $updateResponse->assertStatus(200)
                       ->assertJson([
                           'status' => 'success',
                           'data' => [
                               'title' => 'Judul Artikel Pengujian Diubah',
                               'category' => 'tips'
                           ]
                       ]);

        // 4. Delete Article
        $deleteResponse = $this->deleteJson("/api/articles/{$articleId}");
        $deleteResponse->assertStatus(200)
                       ->assertJson([
                           'status' => 'success',
                           'message' => 'Artikel berhasil dihapus.'
                       ]);

        // 5. Read Deleted Article (Should fail with 404)
        $readDeletedResponse = $this->getJson("/api/articles/{$articleId}");
        $readDeletedResponse->assertStatus(404);
    }
}
