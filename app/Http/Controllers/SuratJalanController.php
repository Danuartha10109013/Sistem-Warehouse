<?php

namespace App\Http\Controllers;

use App\Models\SuratJalan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SuratJalanController extends Controller
{
    public function index()
    {
        return view('suratjalan.index');
    }

    public function dashboardData(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:191',
            'page' => 'nullable|integer|min:1',
        ]);

        $query = SuratJalan::query();

        if (!empty($validated['search'])) {
            $search = trim($validated['search']);
            $query->where(function ($builder) use ($search) {
                $builder->where('no_surat_jalan', 'like', '%' . $search . '%')
                    ->orWhere('business_partner', 'like', '%' . $search . '%')
                    ->orWhere('foto_scan', 'like', '%' . $search . '%');
            });
        }

        $page = max(1, (int) ($validated['page'] ?? 1));
        $perPage = 10;

        $paginated = $query
            ->orderByDesc('receive_date')
            ->orderByDesc('id')
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'summary' => [
                'total_records' => $query->count(),
            ],
            'rows' => collect($paginated->items())
                ->map(fn (SuratJalan $row) => $this->formatRow($row))
                ->values(),
            'pagination' => [
                'current_page' => $paginated->currentPage(),
                'last_page' => $paginated->lastPage(),
                'per_page' => $paginated->perPage(),
                'total' => $paginated->total(),
                'from' => $paginated->firstItem(),
                'to' => $paginated->lastItem(),
            ],
        ]);
    }

    public function show(Request $request, $id)
    {
        $record = SuratJalan::findOrFail($id);

        return response()->json([
            'record' => $this->formatRow($record, true),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePayload($request);
        $scanPayload = $this->decodeScanPayload($validated['scan_payload']);
        $filename = $this->storeScanFile($scanPayload['bytes'], $scanPayload['extension'], $validated['no_surat_jalan']);

        $record = SuratJalan::create([
            'no_surat_jalan' => $validated['no_surat_jalan'],
            'business_partner' => $validated['business_partner'],
            'receive_date' => $validated['receive_date'],
            'foto_scan' => $filename,
        ]);

        return $this->responsePayload($request, 'Surat jalan berhasil disimpan.', $record);
    }

    public function update(Request $request, $id)
    {
        $record = SuratJalan::findOrFail($id);
        $validated = $this->validatePayload($request, $record->id);

        $record->no_surat_jalan = $validated['no_surat_jalan'];
        $record->business_partner = $validated['business_partner'];
        $record->receive_date = $validated['receive_date'];

        if (!empty($validated['scan_payload'])) {
            $this->deleteStoredFile($record->foto_scan);
            $scanPayload = $this->decodeScanPayload($validated['scan_payload']);
            $record->foto_scan = $this->storeScanFile($scanPayload['bytes'], $scanPayload['extension'], $validated['no_surat_jalan']);
        }

        $record->save();

        return $this->responsePayload($request, 'Surat jalan berhasil diperbarui.', $record->fresh());
    }

    public function destroy(Request $request, $id)
    {
        $record = SuratJalan::findOrFail($id);
        $this->deleteStoredFile($record->foto_scan);
        $record->delete();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Surat jalan berhasil dihapus.',
            ]);
        }

        return redirect()->route('suratjalan')->with('success', 'Surat jalan berhasil dihapus.');
    }

    private function validatePayload(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'no_surat_jalan' => [
                'required',
                'string',
                'max:191',
                Rule::unique('surat_jalan', 'no_surat_jalan')->ignore($ignoreId),
            ],
            'business_partner' => 'required|string|max:191',
            'receive_date' => 'required|date',
            'scan_payload' => $ignoreId ? 'nullable|string' : 'required|string',
        ]);
    }

    private function decodeScanPayload(string $payload): array
    {
        $payload = trim($payload);
        $mime = 'image/jpeg';
        $base64 = $payload;

        if (Str::startsWith($payload, 'data:')) {
            [$header, $data] = array_pad(explode(',', $payload, 2), 2, '');
            $base64 = $data;

            if (preg_match('/^data:([^;]+);base64$/', $header, $matches) || preg_match('/^data:([^;]+);/', $header, $matches)) {
                $mime = $matches[1];
            }
        }

        $bytes = base64_decode($base64, true);

        if ($bytes === false) {
            throw ValidationException::withMessages([
                'scan_payload' => 'Data scan tidak valid.',
            ]);
        }

        return [
            'mime' => $mime,
            'extension' => $this->mimeToExtension($mime),
            'bytes' => $bytes,
        ];
    }

    private function mimeToExtension(string $mime): string
    {
        return match ($mime) {
            'image/png' => 'png',
            'image/webp' => 'webp',
            'application/pdf' => 'pdf',
            default => 'jpg',
        };
    }

    private function storeScanFile(string $bytes, string $extension, string $reference): string
    {
        $directory = public_path('uploads/surat_jalan');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $filename = Str::slug($reference) . '_' . Carbon::now()->format('YmdHis') . '_' . Str::random(6) . '.' . $extension;
        File::put($directory . DIRECTORY_SEPARATOR . $filename, $bytes);

        return $filename;
    }

    private function deleteStoredFile(?string $filename): void
    {
        if (empty($filename)) {
            return;
        }

        $path = public_path('uploads/surat_jalan/' . $filename);

        if (File::exists($path)) {
            File::delete($path);
        }
    }

    private function formatRow(SuratJalan $record, bool $forForm = false): array
    {
        $fileUrl = $record->foto_scan ? asset('uploads/surat_jalan/' . $record->foto_scan) : null;
        $receiveDate = $record->receive_date instanceof Carbon
            ? $record->receive_date
            : ($record->receive_date ? Carbon::parse($record->receive_date) : null);

        return [
            'id' => $record->id,
            'no_surat_jalan' => $record->no_surat_jalan,
            'business_partner' => $record->business_partner,
            'receive_date' => $receiveDate ? $receiveDate->format('Y-m-d') : null,
            'receive_date_label' => $receiveDate ? $receiveDate->format('d-m-Y') : '-',
            'foto_scan' => $record->foto_scan,
            'foto_scan_url' => $fileUrl,
            'foto_scan_ext' => $record->foto_scan ? strtolower(pathinfo($record->foto_scan, PATHINFO_EXTENSION)) : null,
            'created_at' => $record->created_at ? $record->created_at->format('d-m-Y H:i') : '-',
            'updated_at' => $record->updated_at ? $record->updated_at->format('d-m-Y H:i') : '-',
            'for_form' => $forForm,
        ];
    }

    private function responsePayload(Request $request, string $message, SuratJalan $record)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'record' => $this->formatRow($record->fresh()),
            ]);
        }

        return redirect()->route('suratjalan')->with('success', $message);
    }
}
