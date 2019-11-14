<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    private $fakerJaJp;

    /**
     * start test.
     *
     * @return void
     */
    public function testStart()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();
        $comments = factory(Comment::class, 100)->create();
        $this->fakerJaJp = \Faker\Factory::create('ja_JP');

        $this->nonAuth();
        $this->store($article);
        $this->list($user);
        $this->approve($user, $comments[0]);
        $this->backApprovalPending($user, $comments[0]);
        $this->deleteTest($user, $comments[0]);
    }

    private function nonAuth()
    {
        // 未認証チェック
        $response = $this->get('/comment/list');
        $response->assertStatus(302);
    }

    public function store($article)
    {
        // バリデーションチェック
        $okLengthContributor = $this->fakerJaJp->realText(191);
        $ngLengthContributor = $this->fakerJaJp->realText(192);
        $okLengthText = $this->fakerJaJp->realText(16383);
        $ngLengthText = $this->fakerJaJp->realText(16384);

        $this->storeValidateTest($article, '', $okLengthText);
        $this->storeValidateTest($article, $okLengthContributor, '');
        $this->storeValidateTest($article, null, $okLengthText);
        $this->storeValidateTest($article, $okLengthContributor, null);
        $this->storeValidateTest($article, $ngLengthContributor, $okLengthText);
        $this->storeValidateTest($article, $okLengthContributor, $ngLengthText);

        // 正常ケース
        $this->storeSuccessTest($article, $okLengthContributor, $okLengthText);
    }

    private function storeValidateTest($article, $contributor, $text)
    {
        $response = $this->post('/article/'.$article->id.'/comment/store',
            [
                'contributor' => $contributor,
                'text'        => $text,
            ]);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('comments', [
            'contributor'       => $contributor,
            'text'              => $text,
            'parent_article_id' => $article->id,
            'approval_flg'      => false,
        ]);
    }

    private function storeSuccessTest($article, $contributor, $text)
    {
        $response = $this->post('/article/'.$article->id.'/comment/store',
            [
                'contributor' => $contributor,
                'text'        => $text,
            ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('comments', [
            'contributor'       => $contributor,
            'text'              => $text,
            'parent_article_id' => $article->id,
            'approval_flg'      => false,
        ]);
    }

    private function list($user)
    {
        $response = $this->actingAs($user)->get('/comment/list');
        $response->assertStatus(200)->assertViewIs('comment.list');
    }

    private function approve($user, $comment)
    {
        $response = $this->actingAs($user)->post('/comment/approve/dummy');
        $response->assertStatus(404);

        $response = $this->actingAs($user)->post('/comment/approve/'.$comment->id);
        $response->assertStatus(302);
        $this->assertDatabaseHas('comments', [
            'id'               => $comment->id,
            'approval_flg'     => true,
            'approval_user_id' => $user->id,
        ]);
    }

    private function backApprovalPending($user, $comment)
    {
        $response = $this->actingAs($user)->post('/comment/back_approval_pending/dummy');
        $response->assertStatus(404);

        $response = $this->actingAs($user)->post('/comment/back_approval_pending/'.$comment->id);
        $response->assertStatus(302);
        $this->assertDatabaseHas('comments', [
            'id'               => $comment->id,
            'approval_flg'     => false,
            'approval_user_id' => null,
        ]);
    }

    private function deleteTest($user, $comment)
    {
        $response = $this->actingAs($user)->post('/comment/delete/dummy');
        $response->assertStatus(404);

        $response = $this->actingAs($user)->post('/comment/delete/'.$comment->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);
    }
}
