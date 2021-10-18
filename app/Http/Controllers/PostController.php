<?php

namespace App\Http\Controllers;

use App\DataTables\PostDataTable;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Category;
use Auth;
use Illuminate\Http\Request;
use Response;

class PostController extends AppBaseController
{
    /**
     * Display a listing of the Post.
     *
     * @param PostDataTable $postDataTable
     * @return Response
     */
    public function index(PostDataTable $postDataTable)
    {
        return $postDataTable->render('posts.index');
    }

    /**
     * Display a listing of the Post on the blog.
     *
     * @param Request $request
     * 
     * @return Response
     */
    public function blog_index(Request $request)
    {
        $posts = Post::all();

        /** @var Category $post */
        $categories = Category::all();

        $latest_posts = Post::orderBy('id', 'desc')->take(5)->get();
        return view('blog.posts.index', compact('posts', 'latest_posts', 'categories'));
    }

    public function show_by_category($id)
    {
        /** @var Category $post */
        $posts = Category::find($id)->posts()->get();

        /** @var Category $post */
        $categories = Category::all();

        $latest_posts = Post::orderBy('id', 'desc')->take(5)->get();

        return view('blog.posts.index', compact('posts', 'latest_posts', 'categories'));
    }

    /**
     * Show the form for creating a new Post.
     *
     * @return Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created Post in storage.
     *
     * @param CreatePostRequest $request
     *
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        }
        $image->move($destinationPath, $profileImage);
        $input['image'] = "$profileImage";

        /** @var Post $post */
        $post = Post::create($input);

        Flash::success('Post saved successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified Post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Post $post */
        $post = Post::find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('posts.show')->with('post', $post);
    }


    /**
     * Display the specified Post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function blog_show($id)
    {
        /** @var Post $post */
        $post = Post::find($id);

        /** @var Category $post */
        $categories = Category::all();

        $latest_posts = Post::orderBy('id', 'desc')->take(5)->get();

        // get previous post
        $previous = Post::where('id', '<', $id)->max('id');

        // get next post
        $next = Post::where('id', '>', $id)->min('id');

        if ($previous == '') {
            $previous = $post;
        } else {
            $previous = Post::find($previous);
        }
        if ($next == '') {
            $next = $post;
        } else {
            $next = Post::find($next);
        }

        if (empty($post)) {
            Flash::error('Post not found');
            return redirect(route('blog.posts.index'));
        }

        return view('blog.posts.post', compact('post', 'previous', 'next', 'latest_posts', 'categories'));
    }

    /**
     * Show the form for editing the specified Post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Post $post */
        $post = Post::find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified Post in storage.
     *
     * @param  int              $id
     * @param UpdatePostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostRequest $request)
    {
        /** @var Post $post */
        $post = Post::find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $post->fill($input);
        $post->save();

        Flash::success('Post updated successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified Post from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Post $post */
        $post = Post::find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        $post->delete();

        Flash::success('Post deleted successfully.');

        return redirect(route('posts.index'));
    }
}
