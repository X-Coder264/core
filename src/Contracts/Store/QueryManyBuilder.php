<?php
/*
 * Copyright 2021 Cloud Creativity Limited
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types=1);

namespace LaravelJsonApi\Contracts\Store;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;
use LaravelJsonApi\Contracts\Pagination\Page;
use LaravelJsonApi\Contracts\Query\QueryParameters;
use LaravelJsonApi\Core\Query\IncludePaths;
use LaravelJsonApi\Core\Query\RelationshipPath;
use LaravelJsonApi\Core\Query\SortField;
use LaravelJsonApi\Core\Query\SortFields;

interface QueryManyBuilder
{

    /**
     * Apply the provided query parameters.
     *
     * @param QueryParameters $query
     * @return $this
     */
    public function using(QueryParameters $query): self;

    /**
     * Filter models using JSON:API filter parameters.
     *
     * @param array|null $filters
     * @return $this
     */
    public function filter(?array $filters): self;

    /**
     * Sort models using JSON:API sort fields.
     *
     * @param SortFields|SortField|array|string|null $fields
     * @return $this
     */
    public function sort($fields): self;

    /**
     * Eager load resources using the provided JSON:API include paths.
     *
     * @param IncludePaths|RelationshipPath|array|string|null $includePaths
     * @return $this
     */
    public function with($includePaths): self;

    /**
     * Get the results of the query.
     *
     * @return Collection|EloquentCollection
     */
    public function get(): Collection;

    /**
     * Get a lazy collection for the query.
     *
     * @return LazyCollection
     */
    public function cursor(): LazyCollection;

    /**
     * Return a page of models using JSON:API page parameters.
     *
     * @param array $page
     * @return Page
     */
    public function paginate(array $page): Page;

    /**
     * Execute the query, paginating results only if page parameters are provided.
     *
     * @param array|null $page
     * @return Page|Collection|EloquentCollection|iterable
     */
    public function getOrPaginate(?array $page): iterable;

}
