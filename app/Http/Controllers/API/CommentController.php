<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{

	/**
	 * @return CommentCollection
	 */
	public function index()
    {
		return new CommentCollection(Comment::all());
    }

	/**
	 * @param Request $request
	 */
	public function store(Request $request)
    {
		$comment = new Comment();
		$comment->text = $request->text;
		$comment->parent = $request->parent;
		$comment->save();

		return response()->json(['created' => true], 201);
    }

	/**
	 * @param Comment $comment
	 * @return CommentResource
	 */
	public function show(Comment $comment)
    {
		return new CommentResource($comment);
    }

	/**
	 * @param Request $request
	 * @param Comment $comment
	 * @return CommentResource
	 */
	public function update(Request $request, Comment $comment)
    {
		$comment->text = $request->text;
		$comment->save();

		return new CommentResource($comment);
    }

	/**
	 * @param Comment $comment
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function destroy(Comment $comment)
    {
		$comment->delete();

		return response()->json(null, 204);
    }
}
