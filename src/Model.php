<?php

namespace Ethereal;

use Closure;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Query\Grammars\Grammar;
use Illuminate\Database\Query\Processors\Processor;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

/**
 * @method static BaseModel make($attributes = [])
 * @method static \Illuminate\Database\Eloquent\Builder withGlobalScope($identifier, $scope)
 * @method static \Illuminate\Database\Eloquent\Builder withoutGlobalScope($scope)
 * @method static \Illuminate\Database\Eloquent\Builder withoutGlobalScopes($scopes = null)
 * @method static array removedScopes()
 * @method static \Illuminate\Database\Eloquent\Builder whereKey($id)
 * @method static \Illuminate\Database\Eloquent\Builder whereKeyNot($id)
 * @method static \Illuminate\Database\Eloquent\Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static BaseModel|null firstWhere($column, $operator = null, $value = null, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder orWhere($column, $operator = null, $value = null)
 * @method static \Illuminate\Database\Eloquent\Builder latest($column = null)
 * @method static \Illuminate\Database\Eloquent\Builder oldest($column = null)
 * @method static \Illuminate\Database\Eloquent\Collection hydrate($items)
 * @method static \Illuminate\Database\Eloquent\Collection fromQuery($query, $bindings = [])
 * @method static BaseModel|\Illuminate\Database\Eloquent\Collection|static[]|static|null find($id, $columns = [])
 * @method static \Illuminate\Database\Eloquent\Collection findMany($ids, $columns = [])
 * @method static BaseModel|\Illuminate\Database\Eloquent\Collection|static|static[] findOrFail($id, $columns = [])
 * @method static BaseModel|static findOrNew($id, $columns = [])
 * @method static BaseModel|static firstOrNew($attributes = [], $values = [])
 * @method static BaseModel|static firstOrCreate($attributes = [], $values = [])
 * @method static BaseModel|static updateOrCreate($attributes, $values = [])
 * @method static BaseModel|static firstOrFail($columns = [])
 * @method static BaseModel|static|mixed firstOr($columns = [], $callback = null)
 * @method static BaseModel sole($columns = [])
 * @method static mixed value($column)
 * @method static \Illuminate\Database\Eloquent\Collection[]|static[] get($columns = [])
 * @method static BaseModel[]|static[] getModels($columns = [])
 * @method static array eagerLoadRelations($models)
 * @method static LazyCollection cursor()
 * @method static Collection pluck($column, $key = null)
 * @method static LengthAwarePaginator paginate($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Paginator simplePaginate($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static CursorPaginator cursorPaginate($perPage = null, $columns = [], $cursorName = 'cursor', $cursor = null)
 * @method static BaseModel|$this create($attributes = [])
 * @method static BaseModel|$this forceCreate($attributes)
 * @method static int upsert($values, $uniqueBy, $update = null)
 * @method static void onDelete($callback)
 * @method static static|mixed scopes($scopes)
 * @method static static applyScopes()
 * @method static \Illuminate\Database\Eloquent\Builder without($relations)
 * @method static \Illuminate\Database\Eloquent\Builder withOnly($relations)
 * @method static BaseModel newModelInstance($attributes = [])
 * @method static \Illuminate\Database\Eloquent\Builder withCasts($casts)
 * @method static Builder getQuery()
 * @method static \Illuminate\Database\Eloquent\Builder setQuery($query)
 * @method static Builder toBase()
 * @method static array getEagerLoads()
 * @method static \Illuminate\Database\Eloquent\Builder setEagerLoads($eagerLoad)
 * @method static BaseModel getModel()
 * @method static \Illuminate\Database\Eloquent\Builder setModel($model)
 * @method static Closure getMacro($name)
 * @method static bool hasMacro($name)
 * @method static Closure getGlobalMacro($name)
 * @method static bool hasGlobalMacro($name)
 * @method static static clone ()
 * @method static \Illuminate\Database\Eloquent\Builder has($relation, $operator = '>=', $count = 1, $boolean = 'and', $callback = null)
 * @method static \Illuminate\Database\Eloquent\Builder orHas($relation, $operator = '>=', $count = 1)
 * @method static \Illuminate\Database\Eloquent\Builder doesntHave($relation, $boolean = 'and', $callback = null)
 * @method static \Illuminate\Database\Eloquent\Builder orDoesntHave($relation)
 * @method static \Illuminate\Database\Eloquent\Builder whereHas($relation, $callback = null, $operator = '>=', $count = 1)
 * @method static \Illuminate\Database\Eloquent\Builder orWhereHas($relation, $callback = null, $operator = '>=', $count = 1)
 * @method static \Illuminate\Database\Eloquent\Builder whereDoesntHave($relation, $callback = null)
 * @method static \Illuminate\Database\Eloquent\Builder orWhereDoesntHave($relation, $callback = null)
 * @method static \Illuminate\Database\Eloquent\Builder hasMorph($relation, $types, $operator = '>=', $count = 1, $boolean = 'and', $callback = null)
 * @method static \Illuminate\Database\Eloquent\Builder orHasMorph($relation, $types, $operator = '>=', $count = 1)
 * @method static \Illuminate\Database\Eloquent\Builder doesntHaveMorph($relation, $types, $boolean = 'and', $callback = null)
 * @method static \Illuminate\Database\Eloquent\Builder orDoesntHaveMorph($relation, $types)
 * @method static \Illuminate\Database\Eloquent\Builder whereHasMorph($relation, $types, $callback = null, $operator = '>=', $count = 1)
 * @method static \Illuminate\Database\Eloquent\Builder orWhereHasMorph($relation, $types, $callback = null, $operator = '>=', $count = 1)
 * @method static \Illuminate\Database\Eloquent\Builder whereDoesntHaveMorph($relation, $types, $callback = null)
 * @method static \Illuminate\Database\Eloquent\Builder orWhereDoesntHaveMorph($relation, $types, $callback = null)
 * @method static \Illuminate\Database\Eloquent\Builder withAggregate($relations, $column, $function = null)
 * @method static \Illuminate\Database\Eloquent\Builder withCount($relations)
 * @method static \Illuminate\Database\Eloquent\Builder withMax($relation, $column)
 * @method static \Illuminate\Database\Eloquent\Builder withMin($relation, $column)
 * @method static \Illuminate\Database\Eloquent\Builder withSum($relation, $column)
 * @method static \Illuminate\Database\Eloquent\Builder withAvg($relation, $column)
 * @method static \Illuminate\Database\Eloquent\Builder withExists($relation)
 * @method static \Illuminate\Database\Eloquent\Builder mergeConstraintsFrom($from)
 * @method static Collection explain()
 * @method static bool chunk($count, $callback)
 * @method static Collection chunkMap($callback, $count = 1000)
 * @method static bool each($callback, $count = 1000)
 * @method static bool chunkById($count, $callback, $column = null, $alias = null)
 * @method static bool eachById($callback, $count = 1000, $column = null, $alias = null)
 * @method static LazyCollection lazy($chunkSize = 1000)
 * @method static LazyCollection lazyById($chunkSize = 1000, $column = null, $alias = null)
 * @method static BaseModel|object|static|null first($columns = [])
 * @method static BaseModel|object|null baseSole($columns = [])
 * @method static \Illuminate\Database\Eloquent\Builder tap($callback)
 * @method static mixed when($value, $callback, $default = null)
 * @method static mixed unless($value, $callback, $default = null)
 * @method static Builder select($columns = [])
 * @method static Builder selectSub($query, $as)
 * @method static Builder selectRaw($expression, $bindings = [])
 * @method static Builder fromSub($query, $as)
 * @method static Builder fromRaw($expression, $bindings = [])
 * @method static Builder addSelect($column)
 * @method static Builder distinct()
 * @method static Builder from($table, $as = null)
 * @method static Builder join($table, $first, $operator = null, $second = null, $type = 'inner', $where = false)
 * @method static Builder joinWhere($table, $first, $operator, $second, $type = 'inner')
 * @method static Builder joinSub($query, $as, $first, $operator = null, $second = null, $type = 'inner', $where = false)
 * @method static Builder leftJoin($table, $first, $operator = null, $second = null)
 * @method static Builder leftJoinWhere($table, $first, $operator, $second)
 * @method static Builder leftJoinSub($query, $as, $first, $operator = null, $second = null)
 * @method static Builder rightJoin($table, $first, $operator = null, $second = null)
 * @method static Builder rightJoinWhere($table, $first, $operator, $second)
 * @method static Builder rightJoinSub($query, $as, $first, $operator = null, $second = null)
 * @method static Builder crossJoin($table, $first = null, $operator = null, $second = null)
 * @method static Builder crossJoinSub($query, $as)
 * @method static void mergeWheres($wheres, $bindings)
 * @method static array prepareValueAndOperator($value, $operator, $useDefault = false)
 * @method static Builder whereColumn($first, $operator = null, $second = null, $boolean = 'and')
 * @method static Builder orWhereColumn($first, $operator = null, $second = null)
 * @method static Builder whereRaw($sql, $bindings = [], $boolean = 'and')
 * @method static Builder orWhereRaw($sql, $bindings = [])
 * @method static Builder whereIn($column, $values, $boolean = 'and', $not = false)
 * @method static Builder orWhereIn($column, $values)
 * @method static Builder whereNotIn($column, $values, $boolean = 'and')
 * @method static Builder orWhereNotIn($column, $values)
 * @method static Builder whereIntegerInRaw($column, $values, $boolean = 'and', $not = false)
 * @method static Builder orWhereIntegerInRaw($column, $values)
 * @method static Builder whereIntegerNotInRaw($column, $values, $boolean = 'and')
 * @method static Builder orWhereIntegerNotInRaw($column, $values)
 * @method static Builder whereNull($columns, $boolean = 'and', $not = false)
 * @method static Builder orWhereNull($column)
 * @method static Builder whereNotNull($columns, $boolean = 'and')
 * @method static Builder whereBetween($column, $values, $boolean = 'and', $not = false)
 * @method static Builder whereBetweenColumns($column, $values, $boolean = 'and', $not = false)
 * @method static Builder orWhereBetween($column, $values)
 * @method static Builder orWhereBetweenColumns($column, $values)
 * @method static Builder whereNotBetween($column, $values, $boolean = 'and')
 * @method static Builder whereNotBetweenColumns($column, $values, $boolean = 'and')
 * @method static Builder orWhereNotBetween($column, $values)
 * @method static Builder orWhereNotBetweenColumns($column, $values)
 * @method static Builder orWhereNotNull($column)
 * @method static Builder whereDate($column, $operator, $value = null, $boolean = 'and')
 * @method static Builder orWhereDate($column, $operator, $value = null)
 * @method static Builder whereTime($column, $operator, $value = null, $boolean = 'and')
 * @method static Builder orWhereTime($column, $operator, $value = null)
 * @method static Builder whereDay($column, $operator, $value = null, $boolean = 'and')
 * @method static Builder orWhereDay($column, $operator, $value = null)
 * @method static Builder whereMonth($column, $operator, $value = null, $boolean = 'and')
 * @method static Builder orWhereMonth($column, $operator, $value = null)
 * @method static Builder whereYear($column, $operator, $value = null, $boolean = 'and')
 * @method static Builder orWhereYear($column, $operator, $value = null)
 * @method static Builder whereNested($callback, $boolean = 'and')
 * @method static Builder forNestedWhere()
 * @method static Builder addNestedWhereQuery($query, $boolean = 'and')
 * @method static Builder whereExists($callback, $boolean = 'and', $not = false)
 * @method static Builder orWhereExists($callback, $not = false)
 * @method static Builder whereNotExists($callback, $boolean = 'and')
 * @method static Builder orWhereNotExists($callback)
 * @method static Builder addWhereExistsQuery($query, $boolean = 'and', $not = false)
 * @method static Builder whereRowValues($columns, $operator, $values, $boolean = 'and')
 * @method static Builder orWhereRowValues($columns, $operator, $values)
 * @method static Builder whereJsonContains($column, $value, $boolean = 'and', $not = false)
 * @method static Builder orWhereJsonContains($column, $value)
 * @method static Builder whereJsonDoesntContain($column, $value, $boolean = 'and')
 * @method static Builder orWhereJsonDoesntContain($column, $value)
 * @method static Builder whereJsonLength($column, $operator, $value = null, $boolean = 'and')
 * @method static Builder orWhereJsonLength($column, $operator, $value = null)
 * @method static Builder dynamicWhere($method, $parameters)
 * @method static Builder groupBy(...$groups)
 * @method static Builder groupByRaw($sql, $bindings = [])
 * @method static Builder having($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder orHaving($column, $operator = null, $value = null)
 * @method static Builder havingBetween($column, $values, $boolean = 'and', $not = false)
 * @method static Builder havingRaw($sql, $bindings = [], $boolean = 'and')
 * @method static Builder orHavingRaw($sql, $bindings = [])
 * @method static Builder orderBy($column, $direction = 'asc')
 * @method static Builder orderByDesc($column)
 * @method static Builder inRandomOrder($seed = '')
 * @method static Builder orderByRaw($sql, $bindings = [])
 * @method static Builder skip($value)
 * @method static Builder offset($value)
 * @method static Builder take($value)
 * @method static Builder limit($value)
 * @method static Builder forPage($page, $perPage = 15)
 * @method static Builder forPageBeforeId($perPage = 15, $lastId = 0, $column = 'id')
 * @method static Builder forPageAfterId($perPage = 15, $lastId = 0, $column = 'id')
 * @method static Builder reorder($column = null, $direction = 'asc')
 * @method static Builder union($query, $all = false)
 * @method static Builder unionAll($query)
 * @method static Builder lock($value = true)
 * @method static Builder lockForUpdate()
 * @method static Builder sharedLock()
 * @method static Builder beforeQuery($callback)
 * @method static void applyBeforeQueryCallbacks()
 * @method static string toSql()
 * @method static int getCountForPagination($columns = [])
 * @method static string implode($column, $glue = '')
 * @method static bool exists()
 * @method static bool doesntExist()
 * @method static mixed existsOr($callback)
 * @method static mixed doesntExistOr($callback)
 * @method static int count($columns = '*')
 * @method static mixed min($column)
 * @method static mixed max($column)
 * @method static mixed sum($column)
 * @method static mixed avg($column)
 * @method static mixed average($column)
 * @method static mixed aggregate($function, $columns = [])
 * @method static float|int numericAggregate($function, $columns = [])
 * @method static bool insert($values)
 * @method static int insertOrIgnore($values)
 * @method static int insertGetId($values, $sequence = null)
 * @method static int insertUsing($columns, $query)
 * @method static bool updateOrInsert($attributes, $values = [])
 * @method static void truncate()
 * @method static Expression raw($value)
 * @method static array getBindings()
 * @method static array getRawBindings()
 * @method static Builder setBindings($bindings, $type = 'where')
 * @method static Builder addBinding($value, $type = 'where')
 * @method static Builder mergeBindings($query)
 * @method static array cleanBindings($bindings)
 * @method static Processor getProcessor()
 * @method static Grammar getGrammar()
 * @method static Builder useWritePdo()
 * @method static static cloneWithout($properties)
 * @method static static cloneWithoutBindings($except)
 * @method static Builder dump()
 * @method static void dd()
 * @method static void macro($name, $macro)
 * @method static void mixin($mixin, $replace = true)
 * @method static mixed macroCall($method, $parameters)
 */
class Model extends BaseModel
{

}