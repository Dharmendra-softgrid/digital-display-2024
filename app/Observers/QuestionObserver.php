<?php
namespace App\Observers;

use App\Question;
use Illuminate\Support\Facades\Auth;

class QuestionObserver {

    public function creating(Question $model) {
        $this->created_by = Auth::id();
        $this->updated_by = Auth::id();
    }
}

?>
