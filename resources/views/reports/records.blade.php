<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $title }}</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url({{ storage_path('fonts/DejaVuSans.ttf') }}) format('truetype');
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .date {
            font-size: 14px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="title">{{ $title }}</div>
        <div class="date">Дата формирования: {{ $date }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>№</th>
                <th>Дата и время</th>
                <th>Клиент</th>
                <th>Услуга</th>
                <th>Мастер</th>
                <th>Цена</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $index => $record)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->datetime)->format('d.m.Y H:i') }}</td>
                    <td>{{ $record->client->name }}</td>
                    <td>{{ $record->masterService->service->name }}</td>
                    <td>{{ $record->masterService->master->surname }} {{ $record->masterService->master->name }}</td>
                    <td>{{ number_format($record->masterService->service->price, 2) }} ₽</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Всего записей: {{ count($records) }}
    </div>
</body>

</html>
