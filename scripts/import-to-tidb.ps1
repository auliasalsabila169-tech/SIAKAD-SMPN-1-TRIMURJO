param(
  [Parameter(Mandatory = $true)][string]$Host,
  [Parameter(Mandatory = $false)][int]$Port = 4000,
  [Parameter(Mandatory = $true)][string]$User,
  [Parameter(Mandatory = $true)][string]$Password,
  [Parameter(Mandatory = $false)][string]$Database = "siakad_smpn1_trimurjo",
  [Parameter(Mandatory = $false)][string]$SqlFile = (Join-Path $PSScriptRoot "..\database\siakad_smpn1_trimurjo_tidb.sql"),
  [Parameter(Mandatory = $false)][string]$CaFile = (Join-Path $PSScriptRoot "..\ca.pem"),
  [Parameter(Mandatory = $false)][string]$MysqlExe = "mysql",
  [switch]$SkipSsl
)

$ErrorActionPreference = "Stop"

if (-not (Test-Path $SqlFile)) {
  throw "SQL file not found: $SqlFile"
}

$mysqlCmd = Get-Command $MysqlExe -ErrorAction SilentlyContinue
if (-not $mysqlCmd) {
  # Common Windows XAMPP location fallback
  $fallback = "C:\xampp\mysql\bin\mysql.exe"
  if (Test-Path $fallback) {
    $MysqlExe = $fallback
  } else {
    throw "mysql client not found. Install MySQL client or pass -MysqlExe <path-to-mysql.exe>."
  }
}

$sslArgs = @()
if (-not $SkipSsl) {
  if (-not (Test-Path $CaFile)) {
    throw "CA file not found: $CaFile. Pass -CaFile <path> or use -SkipSsl (not recommended for TiDB Cloud public endpoints)."
  }
  # TiDB Cloud public endpoints require TLS.
  $sslArgs = @("--ssl-mode=VERIFY_IDENTITY", "--ssl-ca=$CaFile")
}

Write-Host "==> Creating database '$Database' on $Host:$Port (if not exists)..."
$createDbSql = "CREATE DATABASE IF NOT EXISTS ``$Database`` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
& $MysqlExe -h $Host -P $Port -u $User "--password=$Password" @sslArgs -e $createDbSql
if ($LASTEXITCODE -ne 0) { throw "Failed to create/select database. mysql exited with code $LASTEXITCODE" }

Write-Host "==> Importing $SqlFile into '$Database'..."
# Import via stdin so large dumps work reliably.
Get-Content -Raw -Path $SqlFile | & $MysqlExe -h $Host -P $Port -u $User "--password=$Password" @sslArgs $Database
if ($LASTEXITCODE -ne 0) { throw "Import failed. mysql exited with code $LASTEXITCODE" }

Write-Host "==> Done. Database '$Database' has been created/imported on TiDB Cloud endpoint $Host."