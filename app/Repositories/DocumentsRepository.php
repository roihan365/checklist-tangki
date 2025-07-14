<?php

namespace App\Repositories;

use app\Models\Documents;

class DocumentsRepository
{
    public function getAll(array $fields)
    {
        return Documents::select($fields)->latest()->paginate(10);
        //  name,tagline,blabla, ada 100 column
        //  1 jt data, 100 column
    }


    public function getById(int $id, array $fields)
    {
        return Documents::select($fields)->findOrFail($id);
    }

    public function create(array $data)
    {
       return Documents::create($data);
    }

     public function update(int $id, array $data)
    {
        $documents = Documents::findOrFail($id);

        $documents->update($data);

        return $documents;
    }

     public function delete(int $id)
    {
        $documents = Documents::findOrFail($id);

        $documents->delete();
    }

}
