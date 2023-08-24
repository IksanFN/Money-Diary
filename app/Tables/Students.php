<?php

namespace App\Tables;

use App\Models\Kelas;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\AbstractTable;
use Spatie\QueryBuilder\AllowedFilter;

class Students extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Student::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('student_nisn', 'LIKE', "%{$value}%")
                        ->orWhere('student_name', 'LIKE', "%{$value}%")
                        ->orWhere('stduent_kelas', 'LIKE', "%{$value}%");
                });
            });
        });

        $students = QueryBuilder::for(Student::class)
                ->defaultSort('student_nisn')
                ->allowedSorts(['student_nisn', 'student_name', 'student_kelas'])
                ->allowedFilters(['student_nisn', 'student_name', 'kelas_id', $globalSearch]);

        $kelases = Kelas::pluck('name', 'id')->toArray();

        $table
            ->withGlobalSearch(columns: ['student_nisn', 'student_name', 'student_kelas'])
            ->column('student_nisn', sortable: true, canBeHidden:false)
            ->column('student_name', canBeHidden:false)
            ->column('student_kelas')
            ->column('student_major')
            ->column('actions')
            ->selectFilter('kelas_id', $kelases)
            ->simplePaginate(10);
    }
}
