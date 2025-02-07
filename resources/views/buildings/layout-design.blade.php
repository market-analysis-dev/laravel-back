<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Building Layout Design</title>
    <style>
        .tables-container {
            display: flex;
            justify-content: space-between; /* Distribuye el espacio entre ambas tablas */
            gap: 20px; /* Espaciado entre tablas */
        }
        .table {
            width: 48%; /* Ajusta el ancho de cada tabla para que ocupen la misma fila */
            border-collapse: collapse;
        }
        .table, .table th, .table td {
            border: 1px solid black;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="header">
        {{ $building->building_name }}
    </div>

    <div class="image-container">
        <img src="{{ asset('buildings-flyer/detalle-header-flyer.png') }}" alt="Building Image" style="max-width: 100%; height: auto; margin-bottom: 20px;">
    </div>

    <div class="section">
        <div class="tables-container">
            <table class="table">
                <tr>
                    <th>Total Land</th>
                    <td>{{ $building->total_land_sf }} SF</td>
                </tr>
                <tr>
                    <th>Total Building Size</th>
                    <td>{{ number_format($building->building_size_sf, 0) }} SF</td>
                </tr>
                <tr>
                    <th>Available Building</th>
                    <td>169,432 SF</td>
                </tr>
                <tr>
                    <th>Expansion Up To</th>
                    <td>{{ $building->expansion_up_to_sf }} SF</td>
                </tr>
                <tr>
                    <th>Construction Type</th>
                    <td>{{ $building->construction_type }}</td>
                </tr>
                <tr>
                    <th>Floor Slab Thickness</th>
                    <td>{{ $building->floor_thickness_in }}</td>
                </tr>
                <tr>
                    <th>Floor Resistance</th>
                    <td>{{ $building->floor_resistance }}</td>
                </tr>
                <tr>
                    <th>Roofing</th>
                    <td>{{ $building->roof_system }}</td>
                </tr>
                <tr>
                    <th>Min. Clear Height</th>
                    <td>{{ $building->clear_height_ft }}</td>
                </tr>
                <tr>
                    <th>Building Dimensions</th>
                    <td>{{ $building->avl_building_dimensions }}</td>
                </tr>
                <tr>
                    <th>Columns Spacing</th>
                    <td>{{ $building->columns_spacing }}</td>
                </tr>
                <tr>
                    <th>Bay's Size</th>
                    <td>{{ $building->bay_size }}</td>
                </tr>
                <tr>
                    <th>Dock Doors</th>
                    <td>{{ $building->dock_doors }}</td>
                </tr>
                <tr>
                    <th>Knockouts Docks</th>
                    <td>{{ $building->knockouts_docks }}</td>
                </tr>
                <tr>
                    <th>Drive In Door</th>
                    <td>2</td>
                </tr>
                <tr>
                    <th>Truck Court</th>
                    <td>{{ $building->truck_court_ft }}</td>
                </tr>
                <tr>
                    <th>Trailer Parking Spaces</th>
                    <td>{{ $building->trailer_parking_space }}</td>
                </tr>
                <tr>
                    <th>Shared Truck Court Area</th>
                    <td>{{ $building->shared_truck }}</td>
                </tr>
            </table>
        
            <table class="table">
                <tr>
                    <th>Office Space</th>
                    <td>{{ $building->offices_space_sf }}</td>
                </tr>
                <tr>
                    <th>Market</th>
                    <td>{{ $building->market_name }}</td>
                </tr>
                <tr>
                    <th>Submarket</th>
                    <td>{{ $building->submarket_name }}</td>
                </tr>
                <tr>
                    <th>Industrial Park</th>
                    <td>{{ $building->industrial_park_name }}</td>
                </tr>
                <tr>
                    <th>Year Built</th>
                    <td>{{ $building->year_built }}</td>
                </tr>
                <tr>
                    <th>Owner</th>
                    <td>{{ $building->owner_id }}</td>
                </tr>
                <tr>
                    <th>Builder</th>
                    <td>{{ $building->builder_id }}</td>
                </tr>
                <tr>
                    <th>Currency</th>
                    <td>{{ $building->currency }}</td>
                </tr>
                <tr>
                    <th>Min. Asking Rate (SF/MO)</th>
                    <td>$0.4</td>
                </tr>
                <tr>
                    <th>Max. Asking Rate (SF/MO)</th>
                    <td>$0</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="footer">
        <p>LUIS SEGOVIA - luis.segovia@sitiusnet.com</p>
        <p>2025 SITIUS. La información ha sido obtenida de fuentes confiables, pero no garantizamos su exactitud.</p>
    </div>

</body>
</html>
