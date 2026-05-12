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

if defined CID (
	set "RUNNING="
	for /f %%s in ('docker inspect -f "{{.State.Running}}" %CID% 2^>nul') do set "RUNNING=%%s"

	if /i "%RUNNING%"=="true" (
		echo Web container is already running. Restarting it...
		docker compose restart web
		if errorlevel 1 (
			echo Failed to restart web service.
			set "STATUS=Failed: Could not restart web service."
			set "EXITCODE=1"
			goto :final
		)
		echo Web service restarted successfully.
		set "STATUS=Success: Web service restarted."
		goto :final
	)
)

echo Starting web service...
docker compose up -d web
if errorlevel 1 (
	echo Failed to start web service.
	set "STATUS=Failed: Could not start web service."
	set "EXITCODE=1"
	goto :final
)

echo Web service is running at http://localhost:8000
set "STATUS=Success: Web service is running at http://localhost:8000"

:final
echo.
echo Status: %STATUS%
echo Press any key to close...
pause >nul
exit /b %EXITCODE%
