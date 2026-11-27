<?php

namespace App\Http\Controllers;

use App\Models\ShipA;
use App\Models\ShipB;
use App\Models\ShipC;
use App\Models\ShipD;
use App\Models\ShipE;
use App\Models\ShipF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipmarkSearchController extends Controller
{
    // [TAG: HALAMAN UTAMA] Pencarian global atribute across Shipment A-F
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search', ''));
        $results = collect();
        $summary = [];

        if ($search !== '') {
            $rolePrefix = Auth::user()->role == 0 ? 'Ship-Mark.admin.' : 'Ship-Mark.pegawai.';

            // [TAG: QUERY SHIPMENT A]
            $shipA = ShipA::where('atribute', 'LIKE', "%{$search}%")->get();
            foreach ($shipA as $item) {
                $results->push([
                    'shipment'    => 'Shipment A',
                    'badge_class' => 'bg-primary',
                    'atribute'    => $item->atribute,
                    'no_so'       => $item->type,
                    'detail'      => collect([$item->unicode, $item->size, $item->destination])->filter()->implode(' | '),
                    'show_url'    => route($rolePrefix . 'shipment-a-show', $item->type),
                    'print_url'   => route($rolePrefix . 'shipment-a-printone', $item->atribute),
                    'edit_url'    => route($rolePrefix . 'shipment-a-edit', $item->id),
                    'delete_url'  => route($rolePrefix . 'shipment-a-delete', $item->id),
                    'delete_method' => 'GET',
                ]);
            }
            if ($shipA->isNotEmpty()) $summary['Shipment A'] = $shipA->count();

            // [TAG: QUERY SHIPMENT B]
            $shipB = ShipB::where('atribute', 'LIKE', "%{$search}%")->get();
            foreach ($shipB as $item) {
                $results->push([
                    'shipment'    => 'Shipment B',
                    'badge_class' => 'bg-danger',
                    'atribute'    => $item->atribute,
                    'no_so'       => $item->type,
                    'detail'      => collect([$item->product, $item->size, $item->destination])->filter()->implode(' | '),
                    'show_url'    => route($rolePrefix . 'shipment-b-show', $item->type),
                    'print_url'   => route($rolePrefix . 'shipment-b-printone', $item->atribute),
                    'edit_url'    => route($rolePrefix . 'shipment-b-edit', $item->id),
                    'delete_url'  => route($rolePrefix . 'shipment-b-delete', $item->id),
                    'delete_method' => 'GET',
                ]);
            }
            if ($shipB->isNotEmpty()) $summary['Shipment B'] = $shipB->count();

            // [TAG: QUERY SHIPMENT C]
            $shipC = ShipC::where('atribute', 'LIKE', "%{$search}%")->get();
            foreach ($shipC as $item) {
                $results->push([
                    'shipment'    => 'Shipment C',
                    'badge_class' => 'bg-warning text-dark',
                    'atribute'    => $item->atribute,
                    'no_so'       => $item->type,
                    'detail'      => collect([$item->unicode, $item->product, $item->pod])->filter()->implode(' | '),
                    'show_url'    => route($rolePrefix . 'shipment-c-show', $item->type),
                    'print_url'   => route($rolePrefix . 'shipment-c-printone', $item->atribute),
                    'edit_url'    => route($rolePrefix . 'shipment-c-edit', $item->id),
                    'delete_url'  => route($rolePrefix . 'shipment-c-delete', $item->id),
                    'delete_method' => 'GET',
                ]);
            }
            if ($shipC->isNotEmpty()) $summary['Shipment C'] = $shipC->count();

            // [TAG: QUERY SHIPMENT D]
            $shipD = ShipD::where('atribute', 'LIKE', "%{$search}%")->get();
            foreach ($shipD as $item) {
                $results->push([
                    'shipment'    => 'Shipment D',
                    'badge_class' => 'bg-info text-dark',
                    'atribute'    => $item->atribute,
                    'no_so'       => $item->type,
                    'detail'      => collect([$item->unicode, $item->size, $item->destination])->filter()->implode(' | '),
                    'show_url'    => route($rolePrefix . 'shipment-d-show', $item->type),
                    'print_url'   => route($rolePrefix . 'shipment-d-printone', $item->atribute),
                    'edit_url'    => route($rolePrefix . 'shipment-d-edit', $item->id),
                    'delete_url'  => route($rolePrefix . 'shipment-d-delete', $item->id),
                    'delete_method' => 'GET',
                ]);
            }
            if ($shipD->isNotEmpty()) $summary['Shipment D'] = $shipD->count();

            // [TAG: QUERY SHIPMENT E]
            $shipE = ShipE::where('attribute', 'LIKE', "%{$search}%")->get();
            foreach ($shipE as $item) {
                $results->push([
                    'shipment'    => 'Shipment E',
                    'badge_class' => 'bg-secondary',
                    'atribute'    => $item->attribute,
                    'no_so'       => $item->no_so,
                    'detail'      => collect([$item->name, $item->product, $item->pod])->filter()->implode(' | '),
                    'show_url'    => route($rolePrefix . 'shipment-e-show', $item->no_so),
                    'print_url'   => route($rolePrefix . 'shipment-e-printone', $item->id),
                    'edit_url'    => route($rolePrefix . 'shipment-e-edit', $item->id),
                    'delete_url'  => route($rolePrefix . 'shipment-e-delete', $item->id),
                    'delete_method' => 'GET',
                ]);
            }
            if ($shipE->isNotEmpty()) $summary['Shipment E'] = $shipE->count();

            // [TAG: QUERY SHIPMENT F]
            $shipF = ShipF::where('attribute', 'LIKE', "%{$search}%")->get();
            foreach ($shipF as $item) {
                $results->push([
                    'shipment'    => 'Shipment F',
                    'badge_class' => 'bg-dark',
                    'atribute'    => $item->attribute,
                    'no_so'       => $item->no_so,
                    'detail'      => collect([$item->reference, $item->destination])->filter()->implode(' | '),
                    'show_url'    => route($rolePrefix . 'shipment-f-show', $item->id),
                    'print_url'   => route($rolePrefix . 'shipment-f-printone', $item->id),
                    'edit_url'    => route($rolePrefix . 'shipment-f-edit', $item->id),
                    'delete_url'  => route($rolePrefix . 'shipment-f-delete', $item->id),
                    'delete_method' => 'DELETE',
                ]);
            }
            if ($shipF->isNotEmpty()) $summary['Shipment F'] = $shipF->count();
        }

        return view('pegawai.shippment.search_atribute', compact('search', 'results', 'summary'));
    }
}
