<?php

namespace App\Repositories;

use App\Models\Documents;

class RejectedRepository
{
    public function getAll(array $fields)
    {
        return Rejected::select($fields)->with(['id', 'dokumen'])->latest()->paginate(10);
    }


    public function getById(int $id, array $fields)
    {
        return Rejected::select($fields)->with(['id', 'dokumen'])->findOrFail($id);
    }

    public function create(array $data)
    {
       return Rejected::create($data);
    }

     public function update(int $id, array $data)
    {
        $rejected = Rejected::findOrFail($id);

        $rejected->update($data);

        return $rejected;
    }

     public function delete(int $id)
    {
        $rejected = Rejected::findOrFail($id);

        $rejected->delete();
    }

    public function getBykeeperId(int $keeperId, array $fields = ['*'])
    {
        return Rejected::select($fields)
            ->where('keeper_id', $keeperId)
            ->with(['documents.controller'])
            ->firstOrFail();
    }


}
