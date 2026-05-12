@echo off
setlocal
set "EXITCODE=0"
set "STATUS=Done."

cd /d "%~dp0"

docker compose version >nul 2>&1
if errorlevel 1 (
	echo Docker Compose is not available. Start Docker Desktop first.
	set "STATUS=Failed: Docker Compose is not available."
	set "EXITCODE=1"
	goto :final
)

set "CID="
for /f %%i in ('docker compose ps -q web 2^>nul') do set "CID=%%i"

if not defined CID (
	echo Web service is not running.
	set "STATUS=Info: Web service is not running."
	goto :final
)

echo Stopping web service...
docker compose stop web
if errorlevel 1 (
	echo Failed to stop web service.
	set "STATUS=Failed: Could not stop web service."
	set "EXITCODE=1"
	goto :final
)

echo Web service stopped.
set "STATUS=Success: Web service stopped."

:final
echo.
echo Status: %STATUS%
echo Press any key to close...
pause >nul
exit /b %EXITCODE%
