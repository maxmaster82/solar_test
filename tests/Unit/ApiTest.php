<?php

namespace Tests\Unit;

use App\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function testing_comment_index()
	{
		$response = $this->get('/api/comments');

		$response->assertStatus(200);
	}

	/**
	 *
	 */
	public function testing_comment_store()
	{
		$response = $this->post('/api/comments', [
			'text' => 'Post text',
			'parent' => 0,
		]);
		$response->assertStatus(201)
			->assertExactJson([
				'created' => true,
			]);

	}

	/**
	 *
	 */
	public function testing_comment_put()
	{
		$comment = new Comment;
		$comment->text = 'Comment Text';
		$comment->save();
		$response = $this->put('/api/comments/' . $comment->id, [
			'text' => 'New Comment Text',
		]);

		$response->assertStatus(200);
	}

	/**
	 *
	 */
	public function testing_comment_destroy()
	{
		$comment = new Comment;
		$comment->text = 'Comment Text';
		$comment->save();
		$response = $this->delete('/api/comments/' . $comment->id);

		$response->assertStatus(204);
	}
}
