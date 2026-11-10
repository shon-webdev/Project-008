# Servidor Web Local para Prototipos LAPRIEST (Puerto 3000)
param(
    [switch]$NoBrowser = $false
)

$port = 3000
$rootPath = $PSScriptRoot

# 1. Comprobar si el puerto ya está en uso
$occupied = $null
try {
    $occupied = Get-NetTCPConnection -LocalPort $port -ErrorAction SilentlyContinue
} catch {}

if ($occupied) {
    Write-Host "====================================================================" -ForegroundColor DarkGray
    Write-Host "  LAPRIEST HAUTE BRUTALISME // SERVIDOR LOCAL" -ForegroundColor White
    Write-Host "====================================================================" -ForegroundColor DarkGray
    Write-Host "  [AVISO] El puerto $port ya está en uso por otro proceso." -ForegroundColor Yellow
    Write-Host "  La dirección activa es: http://localhost:$port/" -ForegroundColor Cyan
    Write-Host ""
    Write-Host "  Si deseas reiniciar el servidor, ejecuta primero DETENER-SITIO.bat" -ForegroundColor Gray
    Write-Host "====================================================================" -ForegroundColor DarkGray
    if (-not $NoBrowser) {
        Start-Process "http://localhost:$port/"
    }
    exit 0
}

$listener = New-Object System.Net.HttpListener
$listener.Prefixes.Add("http://localhost:$port/")
$listener.Prefixes.Add("http://127.0.0.1:$port/")

try {
    $listener.Start()

    Clear-Host
    Write-Host "====================================================================" -ForegroundColor DarkGray
    Write-Host "  LAPRIEST HAUTE BRUTALISME // SERVIDOR LOCAL ACTIVO" -ForegroundColor White
    Write-Host "====================================================================" -ForegroundColor DarkGray
    Write-Host "  ESTADO:      EN LÍNEA Y ESCUCHANDO" -ForegroundColor Green
    Write-Host "  DIRECCIÓN:   http://localhost:$port/" -ForegroundColor Cyan
    Write-Host "--------------------------------------------------------------------" -ForegroundColor DarkGray
    Write-Host "  RUTAS DIRECTAS DISPONIBLES:" -ForegroundColor White
    Write-Host "  * Portada Cliente (V1):     http://localhost:$port/" -ForegroundColor Cyan
    Write-Host "  * Catálogo de Piezas:       http://localhost:$port/catalog.html" -ForegroundColor Gray
    Write-Host "  * Quién Soy (Manifiesto):   http://localhost:$port/quien-soy.html" -ForegroundColor Gray
    Write-Host "  * Versión 2 (Alternativa):  http://localhost:$port/v2/index.html" -ForegroundColor Gray
    Write-Host "  * Versión 3 (Alternativa):  http://localhost:$port/v3/index.html" -ForegroundColor Gray
    Write-Host "  * Hub Interno Curaduría:    http://localhost:$port/curaduria-interna.html" -ForegroundColor DarkGray
    Write-Host "  * Test 5 Tipografías:       http://localhost:$port/prueba-tipografias.html" -ForegroundColor DarkGray
    Write-Host "--------------------------------------------------------------------" -ForegroundColor DarkGray
    Write-Host "  * Para APAGAR el servidor, ejecuta DETENER-SITIO.bat o presiona Ctrl+C" -ForegroundColor DarkYellow
    Write-Host "====================================================================" -ForegroundColor DarkGray
    Write-Host ""

    # Abrir navegador automáticamente
    if (-not $NoBrowser) {
        Start-Process "http://localhost:$port/"
    }

    while ($listener.IsListening) {
        $context = $listener.GetContext()
        $request = $context.Request
        $response = $context.Response

        $rawUrl = $request.Url.LocalPath
        if ($rawUrl -eq "/" -or $rawUrl -eq "") {
            $rawUrl = "/index.html"
        }

        # Normalizar ruta relativa
        $relPath = $rawUrl.TrimStart("/").Replace("/", "\")
        $filePath = Join-Path $rootPath $relPath

        # Si es un directorio, servir index.html
        if (Test-Path $filePath -PathType Container) {
            $filePath = Join-Path $filePath "index.html"
        }

        if (Test-Path $filePath -PathType Leaf) {
            $bytes = [System.IO.File]::ReadAllBytes($filePath)
            
            $ext = [System.IO.Path]::GetExtension($filePath).ToLower()
            $mime = "text/plain"
            switch ($ext) {
                ".html"  { $mime = "text/html; charset=utf-8" }
                ".css"   { $mime = "text/css; charset=utf-8" }
                ".js"    { $mime = "application/javascript; charset=utf-8" }
                ".json"  { $mime = "application/json; charset=utf-8" }
                ".png"   { $mime = "image/png" }
                ".jpg"   { $mime = "image/jpeg" }
                ".jpeg"  { $mime = "image/jpeg" }
                ".svg"   { $mime = "image/svg+xml" }
                ".ico"   { $mime = "image/x-icon" }
                ".woff2" { $mime = "font/woff2" }
                ".woff"  { $mime = "font/woff" }
                ".ttf"   { $mime = "font/ttf" }
            }

            $response.ContentType = $mime
            $response.ContentLength64 = $bytes.Length
            $response.AddHeader("Cache-Control", "no-cache, no-store, must-revalidate")
            $response.OutputStream.Write($bytes, 0, $bytes.Length)
            
            $time = Get-Date -Format "HH:mm:ss"
            Write-Host "[$time] 200 OK  $rawUrl" -ForegroundColor DarkGray
        } else {
            $response.StatusCode = 404
            $errBytes = [System.Text.Encoding]::UTF8.GetBytes("404 Not Found: $rawUrl")
            $response.ContentLength64 = $errBytes.Length
            $response.OutputStream.Write($errBytes, 0, $errBytes.Length)
            
            $time = Get-Date -Format "HH:mm:ss"
            Write-Host "[$time] 404 NOT FOUND $rawUrl" -ForegroundColor Red
        }

        $response.OutputStream.Close()
    }
} catch {
    Write-Host "Error en el servidor: $_" -ForegroundColor Red
} finally {
    $listener.Stop()
    $listener.Close()
}
