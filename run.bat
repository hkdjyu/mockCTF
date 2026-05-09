@echo off
setlocal EnableExtensions EnableDelayedExpansion

cd /d "%~dp0"

if "%~1"=="" goto :menu
set "ACTION=%~1"
goto :dispatch

:menu
set "ACTION="
echo.
echo ===============================
echo   mockCTF Docker 控制選單
echo ===============================
echo [1] 啟動 CTF (build + up)
echo [2] 停止 CTF (down)
echo [3] 重啟 CTF
echo [4] 查看狀態 (ps)
echo [5] 查看 logs
echo [6] 停止並刪除映像檔 (down --rmi all)
echo [7] 停止並刪除指定服務映像檔
echo [8] 重啟指定服務
echo [0] 離開
echo.
set /p CHOICE=請輸入選項 (0-8): 

if "%CHOICE%"=="1" set "ACTION=start"
if "%CHOICE%"=="2" set "ACTION=stop"
if "%CHOICE%"=="3" set "ACTION=restart"
if "%CHOICE%"=="4" set "ACTION=status"
if "%CHOICE%"=="5" set "ACTION=logs"
if "%CHOICE%"=="6" set "ACTION=clean"
if "%CHOICE%"=="7" set "ACTION=cleanone"
if "%CHOICE%"=="8" set "ACTION=restartone"
if "%CHOICE%"=="0" set "ACTION=exit"

if not defined ACTION (
  echo 無效選項，請重試。
  goto :menu
)

:dispatch
if /I "%ACTION%"=="start" goto :start
if /I "%ACTION%"=="stop" goto :stop
if /I "%ACTION%"=="restart" goto :restart
if /I "%ACTION%"=="status" goto :status
if /I "%ACTION%"=="logs" goto :logs
if /I "%ACTION%"=="clean" goto :clean
if /I "%ACTION%"=="cleanone" goto :cleanone
if /I "%ACTION%"=="restartone" goto :restartone
if /I "%ACTION%"=="help" goto :help
if /I "%ACTION%"=="exit" goto :eof

echo 未知指令: %ACTION%
pause
goto :menu

:start
echo [INFO] 啟動 CTF 容器...
docker compose up --build -d
pause
goto :menu

:stop
echo [INFO] 停止 CTF 容器...
docker compose down
pause
goto :menu

:restart
echo [INFO] 重啟 CTF 容器...
docker compose down
docker compose up --build -d
pause
goto :menu

:status
echo [INFO] 目前容器狀態:
docker compose ps
pause
goto :menu

:logs
set "SERVICE=%~2"
if "%SERVICE%"=="" (
  set /p SERVICE=輸入服務名稱 (例如 web01，留空查看全部): 
)
if "%SERVICE%"=="" (
  docker compose logs --tail=120
) else (
  set "SERVICE_FOUND="
  for /f "delims=" %%I in ('docker compose config --services 2^>nul') do (
    if /I "%%I"=="%SERVICE%" set "SERVICE_FOUND=1"
  )
  if not defined SERVICE_FOUND (
    echo [ERROR] 找不到服務 %SERVICE%。請確認名稱（例如 web33）。
    pause
    goto :menu
  )
  docker compose logs -f --tail=120 "%SERVICE%"
)
pause
goto :menu

:clean
echo [WARN] 將停止容器並刪除映像檔...
docker compose down --rmi all
pause
goto :menu

:cleanone
set "SERVICE=%~2"
if "%SERVICE%"=="" (
  set /p SERVICE=輸入服務名稱 (例如 web27): 
)
if "%SERVICE%"=="" (
  echo [ERROR] 未提供服務名稱。
  pause
  goto :menu
)
set "SERVICE_FOUND="
for /f "delims=" %%I in ('docker compose config --services 2^>nul') do (
  if /I "%%I"=="%SERVICE%" set "SERVICE_FOUND=1"
)
if not defined SERVICE_FOUND (
  echo [ERROR] 找不到服務 %SERVICE%。請確認名稱（例如 web33）。
  pause
  goto :menu
)

set "CONTAINER_ID="
set "IMAGE_ID="

for /f "delims=" %%I in ('docker compose ps -a -q "%SERVICE%" 2^>nul') do set "CONTAINER_ID=%%I"

if defined CONTAINER_ID (
  for /f "delims=" %%I in ('docker inspect -f "{{.Image}}" !CONTAINER_ID! 2^>nul') do set "IMAGE_ID=%%I"
)

echo [INFO] 停止服務 %SERVICE%...
docker compose stop "%SERVICE%"

echo [INFO] 刪除服務容器 %SERVICE%...
docker compose rm -f "%SERVICE%"

if defined IMAGE_ID (
  echo [INFO] 刪除映像檔 !IMAGE_ID! ...
  docker image rm -f !IMAGE_ID!
) else (
  echo [WARN] 找不到服務 %SERVICE% 對應的映像檔 ID，已跳過刪除映像檔。
)
pause
goto :menu

:restartone
set "SERVICE=%~2"
if "%SERVICE%"=="" (
  set /p SERVICE=輸入服務名稱 (例如 web27): 
)
if "%SERVICE%"=="" (
  echo [ERROR] 未提供服務名稱。
  pause
  goto :menu
)

set "SERVICE_FOUND="
for /f "delims=" %%I in ('docker compose config --services 2^>nul') do (
  if /I "%%I"=="%SERVICE%" set "SERVICE_FOUND=1"
)
if not defined SERVICE_FOUND (
  echo [ERROR] 找不到服務 %SERVICE%。請確認名稱（例如 web33）。
  pause
  goto :menu
)

echo [INFO] 重啟服務 %SERVICE%...
docker compose restart "%SERVICE%"
if errorlevel 1 (
  echo [ERROR] 重啟失敗，請檢查 Docker 是否正在執行。
)
pause
goto :menu

:help
echo 用法:
echo   run.bat start      啟動全部題目
echo   run.bat stop       停止全部題目
echo   run.bat restart    重啟全部題目
echo   run.bat status     查看容器狀態
echo   run.bat logs [svc] 查看 logs (可選服務名，例如 web01)
echo   run.bat clean      停止並刪除映像檔
echo   run.bat cleanone [svc] 停止指定服務並刪除該服務映像檔
echo   run.bat restartone [svc] 重啟指定服務
echo.
echo 不帶參數直接執行可進入互動選單。
pause
goto :menu
