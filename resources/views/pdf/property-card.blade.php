<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>{{ $property->title }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            padding: 30px;
        }

        .header {
            background-color: #1e3a8a;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .img-wrapper {
            text-align: center;
            margin-bottom: 20px;
        }

        img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 8px;
        }

        .section {
            margin-bottom: 20px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #f9f9f9;
        }

        .section h2 {
            font-size: 14px;
            color: #1e3a8a;
            margin-bottom: 8px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 4px;
        }

        .row {
            margin-bottom: 4px;
        }

        .row strong {
            width: 100px;
            display: inline-block;
        }

        .footer {
            text-align: right;
            font-size: 10px;
            color: #999;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>{{ $property->title }}</h1>
    </div>

    @if ($base64Image)
        <div class="img-wrapper">
            <div style="width:100%; height:200px; overflow:hidden; border-radius:8px; margin-bottom:20px;">
                <img src="{{ $base64Image }}" alt="Foto principal" style="width:100%; margin-top:-30px;">
            </div>
        </div>
    @endif


    <div class="section">
        <h2>Ubicación y Estado</h2>
        <div class="row"><strong>Ubicación:</strong> {{ $property->neighborhood->name ?? '' }},
            {{ $property->city->name ?? '' }}</div>
        <div class="row"><strong>Precio:</strong> ${{ number_format($property->price, 0, ',', '.') }}
            {{ $property->currency }}</div>
        <div class="row"><strong>Estado:</strong> {{ $property->propertyStatus->name ?? 'Sin estado' }}</div>
    </div>

    <div class="section">
        <h2>Características</h2>
        <div class="row"><strong>Ambientes:</strong> {{ $property->rooms }}</div>
        <div class="row"><strong>Baños:</strong> {{ $property->bathrooms }}</div>
        <div class="row"><strong>Superficie:</strong> {{ $property->surface }} m²</div>
        <div class="row"><strong>Cochera:</strong>
            {{ $property->features->contains('code', 'GARAGE') ? 'Sí' : 'No' }}</div>
    </div>

    @if ($property->description)
        <div class="section">
            <h2>Descripción</h2>
            <p>{{ $property->description }}</p>
        </div>
    @endif

    <div class="footer">
        Generado por PropFlex – {{ now()->format('d/m/Y') }}
    </div>

</body>

</html>
