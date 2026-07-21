<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class WarehouseExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected Collection $items;
    protected array $headings;

    public function __construct(Collection $items, array $headings)
    {
        $this->items = $items;
        $this->headings = $headings;
    }

    public function collection()
    {
        return $this->items;
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function map($row): array
    {
        // If row is an array already, return values in same order as headings
        if (is_array($row)) {
            return array_values($row);
        }

        // If row is an object, try to convert to array preserving keys order
        if (is_object($row)) {
            $arr = [];
            foreach ($this->headings as $key) {
                // try to use snake_case or camelCase properties
                $prop = lcfirst(str_replace(' ', '_', $key));
                if (isset($row->{$prop})) {
                    $arr[] = $row->{$prop};
                    continue;
                }

                // fallback: try to find property by case-insensitive match
                $found = null;
                foreach ((array) $row as $k => $v) {
                    if (strcasecmp($k, $prop) === 0 || strcasecmp($k, str_replace(' ', '_', $key)) === 0) {
                        $found = $v;
                        break;
                    }
                }

                $arr[] = $found;
            }

            return $arr;
        }

        // Otherwise return as single string
        return [$row];
    }
}
