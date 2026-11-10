# Script para detener el servidor local de LAPRIEST (Puerto 3000)

Write-Host "====================================================================" -ForegroundColor DarkGray
Write-Host "  LAPRIEST HAUTE BRUTALISME // APAGAR SERVIDOR LOCAL" -ForegroundColor White
Write-Host "====================================================================" -ForegroundColor DarkGray

$found = $false

# 1. Buscar procesos escuchando en el puerto 3000
try {
    $connections = Get-NetTCPConnection -LocalPort 3000 -ErrorAction SilentlyContinue
    if ($connections) {
        $pids = $connections | Select-Object -ExpandProperty OwningProcess -Unique
        foreach ($procId in $pids) {
            if ($procId -gt 0) {
                try {
                    $p = Get-Process -Id $procId -ErrorAction SilentlyContinue
                    if ($p) {
                        Write-Host "  -> Deteniendo proceso en puerto 3000 (PID: $procId - $($p.ProcessName))..." -ForegroundColor Yellow
                        Stop-Process -Id $procId -Force -ErrorAction SilentlyContinue
                        $found = $true
                    }
                } catch {}
            }
        }
    }
} catch {}

# 2. Buscar procesos de PowerShell ejecutando start-server.ps1
try {
    $processes = Get-CimInstance Win32_Process -Filter "CommandLine LIKE '%start-server.ps1%'" -ErrorAction SilentlyContinue
    foreach ($proc in $processes) {
        if ($proc.ProcessId -ne $PID) {
            Write-Host "  -> Deteniendo proceso de servidor (PID: $($proc.ProcessId))..." -ForegroundColor Yellow
            Stop-Process -Id $proc.ProcessId -Force -ErrorAction SilentlyContinue
            $found = $true
        }
    }
} catch {}

# Breve pausa para asegurar liberación de socket
Start-Sleep -Milliseconds 800

# 3. Verificación final de estado
$stillListening = $null
try {
    $stillListening = Get-NetTCPConnection -LocalPort 3000 -ErrorAction SilentlyContinue
} catch {}

Write-Host "--------------------------------------------------------------------" -ForegroundColor DarkGray
if (-not $stillListening) {
    Write-Host "  [OK] SERVIDOR APAGADO CON EXITO." -ForegroundColor Green
    Write-Host "  El puerto 3000 ha sido liberado correctamente." -ForegroundColor Gray
} else {
    Write-Host "  [AVISO] El puerto 3000 todavia muestra conexiones activas." -ForegroundColor Red
}
Write-Host "====================================================================" -ForegroundColor DarkGray

