<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Library\Response;
use Illuminate\Support\Facades\Validator;


class CommentController extends Controller
{
    public function index($id)
    {
        $list = DB::select(
            'SELECT
                        *
                   FROM
                        comments
                   WHERE
                         post_id = ? AND parent_id = 0
                   ORDER BY id DESC'
            , [$id]);

        foreach ($list as $key => $item)
        {
            $subCommentsOne = DB::select('SELECT * FROM comments WHERE parent_id = ?', [$item->id]);
            foreach ($subCommentsOne as $k => $i)
            {
                $subCommentsTwo = DB::select('SELECT * FROM comments WHERE parent_id = ?', [$i->id]);
                $subCommentsOne[$k]->comments = $subCommentsTwo;
            }
            $list[$key]->comments = $subCommentsOne;

        }

        if (count($list) > 0)
            return Response::withData(true, 'Comments list succesfull', $list);
        else
            return Response::withoutData(false, 'Comments not found');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),
            [

                'name' => 'required',
                'comment' => 'required',
                'post_id' => 'required'

            ]);

        if ($validator->fails()) {
            $fails = array_values($validator->getMessageBag()->toArray())[0];
            $error = $fails[0];
            return Response::withoutData(false, "$error");
        }

        $create = DB::insert(
            'INSERT INTO comments (comments.name, comment, post_id, parent_id) VALUES (?,?,?,?)',
            [$request->name, $request->comment, $request->post_id, $request->parent_id ?? 0]
        );

        if ($create)
            return Response::withoutData(true, 'Comment add successfull');
        else
            return Response::withoutData(false, 'Sorry, There is a problem');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),
            [

                'id' => 'required',
                'name' => 'required',
                'comment' => 'required'

            ]);

        if ($validator->fails()) {
            $fails = array_values($validator->getMessageBag()->toArray())[0];
            $error = $fails[0];
            return Response::withoutData(false, "$error");
        }

        $update = DB::update(
            'UPDATE comments SET comments.name = ?, comment = ? WHERE id = ?',
            [$request->name, $request->comment, $request->id]
        );

        if ($update)
            return Response::withoutData(true, 'Comment edit successfull');
        else
            return Response::withoutData(false, 'Sorry, There is a problem');

    }

    public function delete($id)
    {
        $delete = DB::delete('DELETE FROM comments WHERE id = ? LIMIT 1', [$id]);

        if ($delete)
        {
            $count = DB::select('SELECT COUNT(id) AS sub_count FROM comments WHERE parent_id = ?', [$id]);
            if ($count['sub_count'] > 0)
            {
                $subDelete = DB::delete('DELETE FROM comments WHERE parent_id = ?', [$id]);
                if ($subDelete)
                    return Response::withoutData(true, 'Comment delete successfull, subcomments delete successfull');
                else
                    return Response::withoutData(true, 'Comment delete, subcomments delete unsuccessfull');
            }
            return Response::withoutData(true, 'Comment delete successfull');
        }
        else
            return Response::withoutData(false, 'Comment delete unsuccessfull');
    }
}
