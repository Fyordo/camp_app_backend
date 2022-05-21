<?php

namespace App\Models\Traits;

use App\Models\ChildModel;

trait WithChildren
{
    public function children()
    {
        return ChildModel::where('parent_id', $this->id);
    }
}
