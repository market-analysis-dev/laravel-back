<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use League\Csv\Reader;

class ExcelController
{
    protected $dropboxApiUrl = 'https://content.dropboxapi.com/2/files/download';
    protected $dropboxTokenUrl = 'https://api.dropboxapi.com/oauth2/token';

    public function getData()
    {
        $client = new Client();
        $filePath = env('DROPBOX_FILE_PATH');
        $accessToken = env('DROPBOX_ACCESS_TOKEN');

        try {
            if (empty($accessToken) || empty($filePath)) {
                throw new \Exception('Access token or file path is not set.');
            }

            $response = $this->downloadFile($client, $filePath, $accessToken);

            if ($response->getStatusCode() !== 200) {
                throw new \Exception('Failed to download file');
            }

            $body = $response->getBody()->getContents();

            // * Guardar el archivo temporalmente para poder leerlo con PhpSpreadsheet
            $tempFilePath =  tempnam(sys_get_temp_dir(), 'xlsx');
            file_put_contents($tempFilePath, $body);

            // * Leer el archivo Excel
            $spreadsheet = IOFactory::load($tempFilePath);
            $worksheet = $spreadsheet->getActiveSheet();
            $records = $worksheet->toArray();

            // * Eliminar el archivo temporal
            unlink($tempFilePath);

            // * Verificar que $records es un array
            if (!is_array($records)) {
                throw new \Exception('Failed to parse XLSX records into an array');
            }

            // * Obtener los encabezados
            $headers = array_shift($records);

            $cleanRecords = array_map(function($records) use ($headers){
                return array_combine($headers, $records);
            }, $records);

            // * Devolver los registros en formato JSON
            return response()->json($cleanRecords);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to download file',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function downloadFile(Client $client, $filePath, $accessToken)
    {
        try {
            return $client->post($this->dropboxApiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Dropbox-API-Arg' => json_encode(['path' => $filePath])
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if ($e->getResponse()->getStatusCode() === 401) {
                // * El token ha expirado, renovar
                $accessToken = $this->renewAccessToken($client);
                // * Intentar descargar el archivo nuevamente
                return $client->post($this->dropboxApiUrl, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $accessToken,
                        'Dropbox-API-Arg' => json_encode(['path' => $filePath])
                    ]
                ]);
            }

            throw $e;
        }
    }

    private function renewAccessToken(Client $client)
    {
        $response = $client->post($this->dropboxTokenUrl, [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => env('DROPBOX_REFRESH_TOKEN'),
                'client_id' => env('DROPBOX_CLIENT_ID'),
                'client_secret' => env('DROPBOX_CLIENT_SECRET'),
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        if (!isset($data['access_token'])) {
            throw new \Exception('Failed to refresh access token');
        }

        // * Guardar el nuevo token de acceso en el archivo .env o en la caché
        $newAccessToken = $data['access_token'];
        $this->updateEnvFile('DROPBOX_ACCESS_TOKEN', $newAccessToken);

        return $newAccessToken;
    }

    private function updateEnvFile($key, $value)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $key . '=' . env($key),
                $key . '=' . $value,
                file_get_contents($path)
            ));
        }
    }
}