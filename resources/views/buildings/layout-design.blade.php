<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Building Layout Design</title>

        <!-- Agregar Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>

            /* Definir márgenes de la página */
            @page {
                margin: 100px 25px;
            }

            /* Header */
            header {
                position: fixed;
                top: -80px;
                left: 0;
                right: 0;
                height: 80px;
                text-align: center;
            }

            /* Footer */
            .footer {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                height: 80px;
                font-size: 10px;
                color: #555;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0 20px; /* Espaciado en los extremos */
            }

            .footer hr {
                position: absolute;
                top: 0;
                width: 100%;
                border: none;
                border-top: 1px solid #ccc;
            }

            .footer p {
                margin: 5px 0;
            }

            /* Contenido principal */
            body {
                font-family: Arial, sans-serif;
            }

            .content {
                margin-top: 50px;
            }

            .first-img img {
                width: 100%;
                height: auto;
            }

            /* Estilos tabla principal */
            .main-table table {
                border-collapse:collapse;
                margin-left:5.35pt;
            }

            .primary-row {
                background-color: #F1F1F1;
            }

            tr {
                height:15pt;
            }

            th {
                text-align: left;
            }

            .s2 {
                color: #1F4E78;
                font-family: Arial, sans-serif;
                font-style: normal;
                font-weight: bold;
                text-decoration: none;
                font-size: 9pt;
                padding-left: 12pt;
            }

            .s3 {
                color: #1F4E78;
                font-family: Arial, sans-serif;
                font-style: normal;
                font-weight: normal;
                text-decoration: none;
                font-size: 9pt;
                width:156pt;
                text-align: right;
            }

        </style>
    </head>
    <body>
        <header>
            <!-- Título centrado con fondo -->
            <table style="width: 100%;">
                <tr>
                    <!-- Imagen izquierda -->
                    <td style="text-align: left;">
                        <img src="{{ public_path('buildings-flyer/detalle-header-flyer.png') }}" style="height: 50px; width:auto;">
                    </td>
                    <td style="text-align: left; background-color: {{ $user->primary_color }}; color: white; font-size: 1.5rem; font-weight: bold; padding: 10px; width:100%; font-family:Arial, sans-serif;">
                        {{ $building->building_name }}
                    </td>
                    <!-- Imagen derecha -->
                    <td style="text-align: right;">
                    @if($logoPath)
                        <img src="{{ $logoPath }}" style="width: 150px; height: auto;">
                    @else
                        <img src="{{ public_path('buildings-flyer/detalle-header-flyer.png') }}" style="width: 150px; height: auto;">
                    @endif
                    </td>
                </tr>

            </table>
        </header>
        
        <br>
        {{-- Contenido principal --}}
        <div class="first-img">
        @php $frontPage = collect($images)->firstWhere('type', 'Front Page'); @endphp
        @if($frontPage)
            <img src="{{ $frontPage['url'] }}" style="height: 400px; width:100%;">
        @else
            <img src="{{ public_path('buildings-flyer\detalle-header-flyer.png') }}" style="height: 400px; width:100%;">
        @endif
        </div>

        <br>
        
        <div class="content">
            <table class="main-table" cellspacing="0">
                <tbody>
                    <tr class="primary-row">
                        <th class="s2">Total Land:</th>
                        <td class="s3">{{ $building->total_land_sf }} SF</td>
                    
                        <th class="s2">Electric Substations:</th>
                        <td class="s3"> KVAS</td>
                    </tr>
                    <tr>
                        <th class="s2">Total Building Size:</th>
                        <td class="s3">{{ number_format($building->building_size_sf, 0) }} SF</td>
                    
                        <th class="s2">Skylight:</th>
                        <td class="s3">%</td>
                    </tr>
                    <tr class="primary-row">
                        <th class="s2">Available Building:</th>
                        <td class="s3">169,432 SF</td>
                    
                        <th class="s2">Lighting:</th>
                        <td class="s3">169,432 SF</td>    
                    </tr>
                    <tr>
                        <th class="s2">Expansion Up To:</th>
                        <td class="s3">{{ $building->expansion_up_to_sf }} SF</td>
                        
                        <th class="s2">Ventilation System:</th>
                        <td class="s3"></td>
                    </tr>
                    <tr class="primary-row">
                        <th class="s2">Construction Type:</th>
                        <td class="s3">{{ $building->construction_type }}</td>
                        
                        <th class="s2">HVAC for Production Area:</th>
                        <td class="s3"></td>
                    </tr>
                    <tr>
                        <th class="s2">Floor Slab Thickness:</th>
                        <td class="s3">{{ $building->floor_thickness_in }}</td>
                        
                        <th class="s2">Fire Protection System:</th>
                        <td class="s3">{{ $building->floor_thickness_in }}</td>
                    </tr>
                    <tr class="primary-row">
                        <th class="s2">Floor Resistance:</th>
                        <td class="s3">{{ $building->floor_resistance }}</td>
                    
                        <th class="s2">Parking Space:</th>
                        <td class="s3"></td>
                    </tr>
                    <tr>
                        <th class="s2">Roofing</th>
                        <td class="s3">{{ $building->roof_system }}</td>
                    
                        <th class="s2">Office Space</th>
                        <td class="s3">{{ $building->offices_space_sf }}</td>
                    </tr>
                    <tr class="primary-row">
                        <th class="s2">Min. Clear Height</th>
                        <td class="s3">{{ $building->clear_height_ft }}</td>
                    
                        <th class="s2">Market</th>
                        <td class="s3">{{ $building->market_name }}</td>
                    </tr>
                    {{-- Segunda columna --}}
                    <tr>
                        <th class="s2">Building Dimensions</th>
                        <td class="s3">{{ $building->avl_building_dimensions }}</td>
                        
                        <th class="s2">Submarket</th>
                        <td class="s3">{{ $building->submarket_name }}</td>
                    </tr>
                    <tr class="primary-row">
                        <th class="s2">Columns Spacing</th>
                        <td class="s3">{{ $building->columns_spacing }}</td>
                        
                        <th class="s2">Industrial Park</th>
                        <td class="s3">{{ $building->industrial_park_name }}</td>
                    </tr>
                    <tr>
                        <th class="s2">Bay's Size</th>
                        <td class="s3">{{ $building->bay_size }}</td>
                    
                        <th class="s2">Year Built</th>
                        <td class="s3">{{ $building->year_built }}</td>
                    </tr>
                    <tr class="primary-row">
                        <th class="s2">Dock Doors</th>
                        <td class="s3">{{ $building->dock_doors }}</td>
                    
                        <th class="s2">Available From</th>
                        <td class="s3">{{ $building->dock_doors }}</td>
                    </tr>
                    <tr>
                        <th class="s2">Knockouts Docks</th>
                        <td class="s3">{{ $building->knockouts_docks }}</td>
                    
                        <th class="s2">Owner</th>
                        <td class="s3">{{ $building->owner_id }}</td>
                    </tr>
                    <tr class="primary-row">
                        <th class="s2">Drive In Door</th>
                        <td class="s3">2</td>
                    
                        <th class="s2">Builder</th>
                        <td class="s3">{{ $building->builder_id }}</td>
                    </tr>
                    <tr>    
                        <th class="s2">Truck Court</th>
                        <td class="s3">{{ $building->truck_court_ft }}</td>
                    
                        <th class="s2">Currency</th>
                        <td class="s3">{{ $building->currency }}</td>
                    </tr>
                    <tr class="primary-row">    
                        <th class="s2">Trailer Parking Spaces</th>
                        <td class="s3">{{ $building->trailer_parking_space }}</td>
                    
                        <th class="s2">Min. Asking Rate (SF/MO)</th>
                        <td class="s3">$0.4</td>
                    </tr>
                    <tr>    
                        <th class="s2">Shared Truck Court Area</th>
                        <td class="s3">{{ $building->shared_truck }}</td>
                    
                        <th class="s2">Max. Asking Rate (SF/MO)</th>
                        <td class="s3">$0</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="footer">
            <hr><br>
            <table style="width: 100%;">
                <tr>
                    <td style="text-align:left;">{{ $user->name . ' ' . $user->middle_name . ' ' . $user->last_name }}</td>
                    <td style="text-align:right;">{{ $user->email }}</td>
                </tr>
            </table>
            <p>{{ date('Y') }} MARKET ANALYSIS. The information above has been obtained from sources believed reliable. While we do not doubt its accuracy, we have not verified it and make no guarantee, warranty or representation about it. It is your responsibility to independently confirm its accuracy and completeness.
                Any projection, options, assumptions or estimates used are for example only and do not represent the current or future performance of the property. The value of this transaction to you depends on tax and other factors which should be evaluated by your tax, financial and legal advisor.
                You and your advisors should conduct a careful, independent investigation of the property to determinate to your satisfaction the suitability of the property for your needs.</p>
        </div>

        {{-- Mostrar todas las imágenes de tipo "Gallery" --}}
        @php $galleryImages = collect($images)->where('type', 'Gallery'); @endphp
        @if($galleryImages->isNotEmpty())
            <div style="page-break-after: always;"></div>
            @foreach($galleryImages as $image)
                <img src="{{ $image['url'] }}" style="width: 300px; height: auto; margin-bottom: 10px;">
            @endforeach
        @endif

        {{-- Mostrar la imagen de tipo "Aerial" --}}
        @php $aerial = collect($images)->firstWhere('type', 'Aerial'); @endphp
        @if($aerial)
            <div style="page-break-after: always;"></div>
            <img src="{{ $aerial['url'] }}" style="width: 300px; height: auto; margin-bottom: 10px;">
        @endif
    </body>
</html>
