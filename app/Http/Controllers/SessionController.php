<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{


    public function RestoreDeletedItemWithId(int $id): mixed
    {
        if (Session::withTrashed()->find($id)->restore()) {
            return back();
        }

        return 'No Data To Restore';
    }

    public function RestoreAll(): mixed
    {

        if (Session::onlyTrashed()->restore()) {
            return back();
        }
        return 'No Data To Restore';
    }
}
