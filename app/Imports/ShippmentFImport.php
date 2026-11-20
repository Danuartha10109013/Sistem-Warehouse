<?php

namespace App\Imports;

use App\Models\ShipF;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;

class ShippmentFImport implements ToCollection
{
    public function collection(Collection $rows): void
    {
        $header = $rows->first();
        $expected = ['SO', 'UNICODE', 'POD', 'ATTRIBUTE'];
        $actual = $header ? $header->take(4)->map(fn ($value) => mb_strtoupper(trim((string) $value)))->all() : [];

        if ($actual !== $expected) {
            throw ValidationException::withMessages(['file' => 'Kolom Excel harus: SO, UNICODE, POD, ATTRIBUTE.']);
        }

        $records = [];
        foreach ($rows->skip(1) as $index => $row) {
            $values = [
                'no_so' => trim((string) ($row[0] ?? '')),
                'reference' => trim((string) ($row[1] ?? '')),
                'destination' => trim((string) ($row[2] ?? '')),
                'attribute' => trim((string) ($row[3] ?? '')),
            ];

            if (implode('', $values) === '') {
                continue;
            }

            $validator = Validator::make($values, [
                'no_so' => ['required', 'string', 'max:100'],
                'reference' => ['required', 'string', 'max:100'],
                'destination' => ['required', 'string', 'max:100'],
                'attribute' => ['required', 'string', 'max:100'],
            ]);

            if ($validator->fails()) {
                throw ValidationException::withMessages(['file' => 'Data tidak lengkap atau terlalu panjang pada baris ' . ($index + 1) . '.']);
            }

            $records[] = $values;
        }

        if (!$records) {
            throw ValidationException::withMessages(['file' => 'File tidak memiliki data Shipment F.']);
        }

        DB::transaction(function () use ($records) {
            foreach ($records as $record) {
                ShipF::create($record);
            }
        });
    }
}
