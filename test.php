 ->with(array('comments'=>function($query){
                $query->orderBy('created_at', 'desc');
                $query->take(3);
            }))
