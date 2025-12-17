<?php
namespace App\Interface;

use Illuminate\Http\Request;

interface CRUD {

    public function create(Request $request);
    public function read(Request $request);
    public function update(int $id, Request $request);
    public function delete(int $id, Request $request);
}
