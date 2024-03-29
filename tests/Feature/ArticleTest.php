<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $articles;
    private $fakerJaJp;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->articles = factory(Article::class, 100)->create();
        $this->fakerJaJp = \Faker\Factory::create('ja_JP');
    }

    /**
     * start test.
     *
     * @return void
     */
    public function testStart()
    {
        $this->index();
        $this->nonAuth($this->articles[0]);
        $this->list($this->user);
        $this->show($this->articles[0]);
        $this->create($this->user);
        $this->edit($this->user, $this->articles[0]);
        $this->store($this->user);
        $this->update($this->user, $this->articles[0]);
        $this->backDraft($this->user, $this->articles[0]);
        $this->deleteTest($this->user, $this->articles[0]);
    }

    private function nonAuth($article)
    {
        // 未認証チェック
        $response = $this->get('/article/list');
        $response->assertStatus(302);
        $response = $this->get('/article/create');
        $response->assertStatus(302);
        $response = $this->get('/article/edit/'.$article->id);
        $response->assertStatus(302);
    }

    private function index()
    {
        $response = $this->get('/');
        $response->assertStatus(200)->assertViewIs('article.index');
    }

    private function list($user)
    {
        $response = $this->actingAs($user)->get('/article/list');
        $response->assertStatus(200)->assertViewIs('article.list');
    }

    private function show($article)
    {
        $response = $this->get('/article/show/'.$article->id);
        $response->assertStatus(200)->assertViewIs('article.show');
    }

    private function create($user)
    {
        $response = $this->actingAs($user)->get('/article/create');
        $response->assertStatus(200)->assertViewIs('article.create');
    }

    private function edit($user, $article)
    {
        $response = $this->actingAs($user)->get('/article/edit/'.$article->id);
        $response->assertStatus(200)->assertViewIs('article.edit');
    }

    private function store($user)
    {
        // バリデーションチェック
        $okLengthTitle = $this->fakerJaJp->realText(191);
        $ngLengthTitle = $this->fakerJaJp->realText(192);
        $okLengthText = $this->fakerJaJp->realText(16383);
        $ngLengthText = $this->fakerJaJp->realText(16384);
        $okPublish = 1;
        $ngPublish = null;
        $this->storeValidateTest($user, '', $okLengthText, $okPublish);
        $this->storeValidateTest($user, $okLengthTitle, '', $okPublish);
        $this->storeValidateTest($user, $okLengthTitle, $okLengthText, '');
        $this->storeValidateTest($user, null, $okLengthText, $okPublish);
        $this->storeValidateTest($user, $okLengthTitle, null, $okPublish);
        $this->storeValidateTest($user, $okLengthTitle, $okLengthText, null);
        $this->storeValidateTest($user, $ngLengthTitle, $okLengthText, $okPublish);
        $this->storeValidateTest($user, $okLengthTitle, $ngLengthText, $okPublish);
        $this->storeValidateTest($user, $okLengthTitle, $okLengthText, $ngPublish);

        // 正常ケース
        $this->storeSuccessTest($user, $okLengthTitle, $okLengthText, 0);
        $this->storeSuccessTest($user, $okLengthTitle, $okLengthText, 1);
    }

    private function storeValidateTest($user, $title, $text, $publish)
    {
        $response = $this->actingAs($user)->post(
            '/article/store',
            [
                'title'   => $title,
                'text'    => $text,
                'publish' => $publish,
            ]
        );
        $response->assertStatus(302);
        $this->assertDatabaseMissing('articles', [
            'title'      => $title,
            'text'       => $text,
            'publish'    => $publish,
            'author_id'  => $user->id,
        ]);
    }

    private function storeSuccessTest($user, $title, $text, $publish)
    {
        $response = $this->actingAs($user)->post(
            '/article/store',
            [
                'title'   => $title,
                'text'    => $text,
                'publish' => $publish,
            ]
        );
        $response->assertStatus(302);
        $this->assertDatabaseHas('articles', [
            'title'      => $title,
            'text'       => $text,
            'publish'    => $publish,
            'author_id'  => $user->id,
        ]);
    }

    private function update($user, $article)
    {
        // バリデーションチェック
        $okLengthTitle = $this->fakerJaJp->realText(191);
        $ngLengthTitle = $this->fakerJaJp->realText(192);
        $okLengthText = $this->fakerJaJp->realText(16383);
        $ngLengthText = $this->fakerJaJp->realText(16384);
        $okPublish = 1;
        $ngPublish = null;
        $this->updateValidateTest($user, $article, '', $okLengthText, $okPublish);
        $this->updateValidateTest($user, $article, $okLengthTitle, '', $okPublish);
        $this->updateValidateTest($user, $article, $okLengthTitle, $okLengthText, '');
        $this->updateValidateTest($user, $article, null, $okLengthText, $okPublish);
        $this->updateValidateTest($user, $article, $okLengthTitle, null, $okPublish);
        $this->updateValidateTest($user, $article, $okLengthTitle, $okLengthText, null);
        $this->updateValidateTest($user, $article, $ngLengthTitle, $okLengthText, $okPublish);
        $this->updateValidateTest($user, $article, $okLengthTitle, $ngLengthText, $okPublish);
        $this->updateValidateTest($user, $article, $okLengthTitle, $okLengthText, $ngPublish);

        $this->updateNonExistTest($user, $okLengthTitle, $okLengthText, $okPublish);

        // 正常ケース
        $this->updateSuccessTest($user, $article, $okLengthTitle, $okLengthText, 0);
        $this->updateSuccessTest($user, $article, $okLengthTitle, $okLengthText, 1);
    }

    private function updateNonExistTest($user, $title, $text, $publish)
    {
        $response = $this->actingAs($user)->post(
            '/article/update/dummy',
            [
                'title'   => $title,
                'text'    => $text,
                'publish' => $publish,
            ]
        );
        $response->assertStatus(404);
    }

    private function updateValidateTest($user, $article, $title, $text, $publish)
    {
        $response = $this->actingAs($user)->post(
            '/article/update/'.$article->id,
            [
                'title'   => $title,
                'text'    => $text,
                'publish' => $publish,
            ]
        );
        $response->assertStatus(302);
        $this->assertDatabaseMissing('articles', [
            'id'      => $article->id,
            'title'   => $title,
            'text'    => $text,
            'publish' => $publish,
        ]);
    }

    private function updateSuccessTest($user, $article, $title, $text, $publish)
    {
        $response = $this->actingAs($user)->post(
            '/article/update/'.$article->id,
            [
                'title'   => $title,
                'text'    => $text,
                'publish' => $publish,
            ]
        );
        $response->assertStatus(302);
        $this->assertDatabaseHas('articles', [
            'id'      => $article->id,
            'title'   => $title,
            'text'    => $text,
            'publish' => $publish,
        ]);
    }

    private function deleteTest($user, $article)
    {
        // メソッド名にdeleteは使用できない？
        $response = $this->actingAs($user)->post('/article/delete/dummy');
        $response->assertStatus(404);
        $response = $this->actingAs($user)->post('/article/delete/'.$article->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
        ]);
    }

    private function backDraft($user, $article)
    {
        $response = $this->actingAs($user)->post('/article/back/draft/dummy');
        $response->assertStatus(404);
        $response = $this->actingAs($user)->post('/article/back/draft/'.$article->id);
        $response->assertStatus(302);
        $this->assertDatabaseHas('articles', [
            'id'      => $article->id,
            'publish' => 0,
        ]);
    }
}
