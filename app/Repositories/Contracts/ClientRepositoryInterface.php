<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface ClientRepositoryInterface
{
    public function getAll(Request $request);
    public function getById($id);
    public function create(Request $request);
    public function update(Request $request, $id);
    public function delete($id);
    public function departments();
}
