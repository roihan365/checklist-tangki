<?php

namespace App\Repositories;

use app\Models\Histories;

class HistoriesRepository
{
    public function getAll(array $fields)
    {
        return Histories::select($fields)->latest()->paginate(10);
        //  name,tagline,blabla, ada 100 column
        //  1 jt data, 100 column
    }


    public function getById(int $id, array $fields)
    {
        return Histories::select($fields)->findOrFail($id);
    }

    public function create(array $data)
    {
       return Histories::create($data);
    }

     public function update(int $id, array $data)
    {
        $histories = Histories::findOrFail($id);

        $histories->update($data);

        return $histories;
    }

     public function delete(int $id)
    {
        $histories = Histories::findOrFail($id);

        $histories->delete();
    }

}
