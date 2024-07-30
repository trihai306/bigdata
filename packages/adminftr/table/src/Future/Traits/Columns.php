<?php

namespace Adminftr\Table\Future\Traits;

trait Columns
{
    protected function getNameColumns()
    {
        $columns = $this->defineColumns();
        $columns = array_map(function ($column) {
            return $column->name;
        }, $columns);

        return array_filter($columns, function ($column) {
            return ! str_contains($column, '.');
        });
    }

    protected function defineColumns(): array
    {
        $columns = $this->columns();

        foreach ($columns as $column) {
            $column->visible = $this->columnVisibility[$column->name] ?? $column->visible;
        }

        return $columns;
    }

    abstract protected function columns(): array;

    protected function getRelationColumns()
    {
        $columns = $this->defineColumns();
        $columns = array_map(function ($column) {
            return $column->name;
        }, $columns);
        $columns = array_filter($columns, function ($column) {
            return str_contains($column, '.');
        });

        return array_map(function ($column) {
            return [
                'relation' => explode('.', $column)[0],
                'column' => explode('.', $column)[1],
            ];
        }, $columns);
    }

    protected function getSearchableRelationColumns()
    {
        $columns = $this->defineColumns();
        $columns = array_filter($columns, function ($column) {
            return str_contains($column->name, '.') && $column->searchable;
        });

        return array_map(function ($column) {
            return [
                'relation' => explode('.', $column->name)[0],
                'column' => explode('.', $column->name)[1],
            ];
        }, $columns);
    }

    protected function getSearchableNonRelationColumns()
    {
        $columns = $this->defineColumns();
        $columns = array_filter($columns, function ($column) {
            return ! str_contains($column->name, '.') && $column->searchable;
        });

        return array_map(function ($column) {
            return $column->name;
        }, $columns);
    }
}
