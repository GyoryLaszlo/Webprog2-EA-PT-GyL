<?php
namespace Database\Seeders\Traits;

trait ReadsTsv {
    protected function readTsv(string $relativePath): array {
        $path = database_path('seeders/'.$relativePath);
        $rows = array_map('rtrim', file($path));
        $data = [];
        $headers = null;
        foreach ($rows as $i => $line) {
            $cols = preg_split("/\t/", $line);
            if ($i === 0) { $headers = $cols; continue; }
            $data[] = array_combine($headers, $cols);
        }
        return $data;
    }
}
