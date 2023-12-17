<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Task extends Model
{
    use HasFactory;

    const MAX_PER_PAGE = 20;

    protected $fillable = [
        'title',
        'content'
    ];

    public static function searchByQuery(string|null $query = null, int|null $page = 1) : array {

        $q = Task::query();

        // 検索機能の実装
        if (isset($query)) {
            
            $searchs = [];

            $i = 0;
            foreach (explode('"', $query) as $words) {
                if ($i % 2) {
                    array_push($searchs, ($words));
                    
                } else {
                    foreach (explode(' ', $words) as $word) {
                        array_push($searchs, $word);
                    }
                }

                $i++;
            }

            foreach ($searchs as $search) {
                $temp = '%' . addcslashes($search, '%_\\') . '%';
                $q->where(function ($query) use ($temp) {
                    $query->where('title', 'LIKE', $temp)->orWhere('content', 'LIKE', $temp);
                });
            }
        }
        
        $count = $q->count();

        return [
            $q->offset(($page - 1) * self::MAX_PER_PAGE)->limit(self::MAX_PER_PAGE)->get(),
            $count,
            $page
        ];
    } 
}
