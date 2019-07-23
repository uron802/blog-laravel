<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Faker\Generator as Faker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStart()
    {
        // $this->assertTrue(true);

        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();

        $this->index();
        $this->nonAuth($article);
        $this->list($user);
        $this->show($article);
        $this->create($user);
        $this->edit($user, $article);
        $this->store($user);
        $this->update($user, $article);
        $this->backDraft($user, $article);
        $this->deleteTest($user, $article);
    }

    private function nonAuth($article)
    {
        // 未認証チェック
        $response = $this->get('/article/list');
        $response->assertStatus(302);
        $response = $this->get('/article/create');
        $response->assertStatus(302);
        $response = $this->get('/article/edit/' . $article->id);
        $response->assertStatus(302);
    }

    private function index()
    {
        $response = $this->get('/');
        $response->assertStatus(200)->assertViewIs("article.index");
    }

    private function list($user)
    {
        $response = $this->actingAs($user)->get('/article/list');
        $response->assertStatus(200)->assertViewIs("article.list");
    }

    private function show($article)
    {
        $response = $this->get('/article/show/' . $article->id);
        $response->assertStatus(200)->assertViewIs("article.show");
    }

    private function create($user)
    {
        $response = $this->actingAs($user)->get('/article/create');
        $response->assertStatus(200)->assertViewIs("article.create");
    }

    private function edit($user, $article)
    {
        $response = $this->actingAs($user)->get('/article/edit/' . $article->id);
        $response->assertStatus(200)->assertViewIs("article.edit");
    }

    private function store($user)
    {
        $response = $this->actingAs($user)->json('POST', '/article/store',
            [
                'title' => 'testTitle1',
                'text' => 'テスト1',
                'publish' => 1,
            ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('articles', [
            'title' => 'testTitle1',
            'text' => 'テスト1',
            'publish' => 1,
            'author' => $user->id
        ]);

        $response = $this->actingAs($user)->json('POST', '/article/store',
            [
                'title' => 'testTitle2',
                'text' => 'テスト2',
                'publish' => 0,
            ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('articles', [
            'title' => 'testTitle2',
            'text' => 'テスト2',
            'publish' => 0,
            'author' => $user->id
        ]);
    }

    private function update($user, $article)
    {
        $response = $this->actingAs($user)->json('POST', '/article/update/' . $article->id,
            [
                'title' => 'testTitle3',
                'text' => 'テスト3',
                'publish' => 1,
            ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => 'testTitle3',
            'text' => 'テスト3',
            'publish' => 1
        ]);

        $response = $this->actingAs($user)->json('POST', '/article/update/' . $article->id,
            [
                'title' => 'testTitle4',
                'text' => 'テスト4',
                'publish' => 0,
            ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => 'testTitle4',
            'text' => 'テスト4',
            'publish' => 0
        ]);
    }

    private function deleteTest($user, $article)
    {
        // メソッド名にdeleteは使用できない？
        $response = $this->actingAs($user)->get('/article/delete/' . $article->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('articles', [
            'id' => $article->id
        ]);
    }

    private function backDraft($user, $article)
    {
        $response = $this->actingAs($user)->json('POST', '/article/back/draft/' . $article->id);
        $response->assertStatus(302);
        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'publish' => 0
        ]);
    }
}
