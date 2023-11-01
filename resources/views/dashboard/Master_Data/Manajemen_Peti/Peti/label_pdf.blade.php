<!DOCTYPE html>
<html>

<head>
    <title>Data PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Data Peti</h1>
    <table style="width:100%" class="table table-bordered">
        <tr>
            <td rowspan="2">
                <img src="data:image/jpeg;base64,<?= base64_encode(file_get_contents('assets/img/Picture ISTW.jpg')) ?>"
                    alt="Logo ISTW" width="100" height="100">
            </td>
            <td>PETI NUMBER</td>
            <td>BARCODE</td>
        </tr>
        <tr>
            <td>
                {{ $peti->fix_lot }}
            </td>
            <td rowspan="4">
                <img src="data:image/svg+xml;base64,{{ $qrcode }}" alt="QR Code" />
            </td>
        </tr>
        <tr>
            <td>PT. {{ $peti->created_by }}</td>
            <td>CUSTOMER</td>
        </tr>
        <tr>
            <td>QTY PETI</td>
            <td rowspan="2">PT. {{ $peti->customer->name }}</td>
        </tr>
        <tr>
            <td>1</td>
        </tr>
    </table>

</body>

</html>
