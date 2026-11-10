# Script generador de las 3 versiones tipográficas de LAPRIEST
# Todas las versiones aplican la Tipografía 3: SF PRO DISPLAY para todos los títulos

$googleFonts = @'
  <!-- Fuentes: SF Pro Display (Títulos) + Familias de Párrafos -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.cdnfonts.com">
  <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/sf-pro-display">
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;600;700;800;900&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,700;1,9..40,400&family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">
'@

$pages = @('index.html', 'catalog.html', 'quien-soy.html')
$versions = @('v1', 'v2', 'v3')

foreach ($vId in $versions) {
    foreach ($page in $pages) {
        $srcPath = Join-Path $PSScriptRoot "preview\$page"
        $rawHtml = [System.IO.File]::ReadAllText($srcPath, [System.Text.Encoding]::UTF8)

        # 1. Atributo data-version y clase typo
        $rawHtml = $rawHtml -replace '<html lang="es">', "<html lang=`"es`" data-version=`"$vId`">"

        # 2. Clases activas para los botones del conmutador
        $activeV1 = if ($vId -eq 'v1') { ' active' } else { '' }
        $activeV2 = if ($vId -eq 'v2') { ' active' } else { '' }
        $activeV3 = if ($vId -eq 'v3') { ' active' } else { '' }

        $switcherBar = @"
  <!-- Botón Flotante para Restaurar Barra si se Ocultó para Capturas -->
  <button type="button" class="restore-switcher-pill" aria-label="Restaurar barra de selección">
    &bull; MOSTRAR SELECTOR TIPOGRÁFICO
  </button>

  <!-- Barra Curatorial: Selector de Versión Tipográfica -->
  <aside class="typography-switcher-bar" aria-label="Selector de Versión Tipográfica">
    <div class="switcher-inner">
      <div class="switcher-label">
        <span class="switcher-dot"></span>
        <span>CURADURÍA TIPOGRÁFICA // LAPRIEST</span>
      </div>
      <div class="switcher-options">
        <a href="../v1/$page" class="switcher-btn$activeV1">
          <span class="v-tag">VERSIÓN 1 (PRINCIPAL)</span>
          <span class="v-fonts">SF PRO DISPLAY + INTER</span>
        </a>
        <a href="../v2/$page" class="switcher-btn$activeV2">
          <span class="v-tag">VERSIÓN 2 (ALTERNATIVA A)</span>
          <span class="v-fonts">SF PRO DISPLAY + SPACE GROTESK</span>
        </a>
        <a href="../v3/$page" class="switcher-btn$activeV3">
          <span class="v-tag">VERSIÓN 3 (ALTERNATIVA B)</span>
          <span class="v-fonts">SF PRO DISPLAY + DM SANS</span>
        </a>
        <button type="button" class="switcher-toggle-clean" data-toggle-clean title="Oculta esta barra para capturas de pantalla limpias (o presiona tecla C)">
          [ MODO CAPTURA LIMPIA ]
        </button>
      </div>
    </div>
  </aside>
"@

        $rawHtml = $rawHtml -replace '<body>', "<body class=`"typo-$vId`">`r`n$switcherBar"

        # 3. Sustituir bloque de fuentes de Google Fonts
        $regexFonts = '<!-- Fuentes:.*?-->\s*<link rel="preconnect" href="https://fonts\.googleapis\.com">[\s\S]*?display=swap" rel="stylesheet">'
        $rawHtml = [System.Text.RegularExpressions.Regex]::Replace($rawHtml, $regexFonts, $googleFonts)

        $destDir = Join-Path $PSScriptRoot $vId
        if (-not (Test-Path $destDir)) {
            New-Item -ItemType Directory -Path $destDir -Force | Out-Null
        }

        $destFile = Join-Path $destDir $page
        [System.IO.File]::WriteAllText($destFile, $rawHtml, [System.Text.Encoding]::UTF8)
        Write-Output "Archivo generado con éxito: $destFile"
    }
}

