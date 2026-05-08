@echo off
setlocal EnableExtensions EnableDelayedExpansion

cd /d "%~dp0"

if "%~1"=="" goto :menu
set "ACTION=%~1"
goto :dispatch

:menu
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
echo [0] 離開
echo.
set /p CHOICE=請輸入選項 (0-6): 

if "%CHOICE%"=="1" set "ACTION=start"
if "%CHOICE%"=="2" set "ACTION=stop"
if "%CHOICE%"=="3" set "ACTION=restart"
if "%CHOICE%"=="4" set "ACTION=status"
if "%CHOICE%"=="5" set "ACTION=logs"
if "%CHOICE%"=="6" set "ACTION=clean"
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
if /I "%ACTION%"=="help" goto :help
if /I "%ACTION%"=="exit" goto :eof

echo 未知指令: %ACTION%
echo.
goto :help

:start
echo [INFO] 啟動 CTF 容器...
docker compose up --build -d
goto :eof

:stop
echo [INFO] 停止 CTF 容器...
docker compose down
goto :eof

:restart
echo [INFO] 重啟 CTF 容器...
docker compose down
docker compose up --build -d
goto :eof

:status
echo [INFO] 目前容器狀態:
docker compose ps
goto :eof

:logs
set "SERVICE=%~2"
if "%SERVICE%"=="" (
  set /p SERVICE=輸入服務名稱 (例如 web01，留空查看全部): 
)
if "%SERVICE%"=="" (
  docker compose logs --tail=120
) else (
  docker compose logs -f --tail=120 %SERVICE%
)
goto :eof

:clean
echo [WARN] 將停止容器並刪除映像檔...
docker compose down --rmi all
goto :eof

:help
echo 用法:
echo   run.bat start      啟動全部題目
echo   run.bat stop       停止全部題目
echo   run.bat restart    重啟全部題目
echo   run.bat status     查看容器狀態
echo   run.bat logs [svc] 查看 logs (可選服務名，例如 web01)
echo   run.bat clean      停止並刪除映像檔
echo.
echo 不帶參數直接執行可進入互動選單。
