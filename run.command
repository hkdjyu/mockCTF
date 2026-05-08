#!/bin/bash
set -e

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
cd "$SCRIPT_DIR"

show_menu() {
  echo
  echo "==============================="
  echo "  mockCTF Docker 控制選單"
  echo "==============================="
  echo "[1] 啟動 CTF (build + up)"
  echo "[2] 停止 CTF (down)"
  echo "[3] 重啟 CTF"
  echo "[4] 查看狀態 (ps)"
  echo "[5] 查看 logs"
  echo "[6] 停止並刪除映像檔 (down --rmi all)"
  echo "[0] 離開"
  echo
  read -r -p "請輸入選項 (0-6): " choice

  case "$choice" in
    1) action="start" ;;
    2) action="stop" ;;
    3) action="restart" ;;
    4) action="status" ;;
    5) action="logs" ;;
    6) action="clean" ;;
    0) action="exit" ;;
    *)
      echo "無效選項，請重試。"
      show_menu
      return
      ;;
  esac
}

action="${1:-}"
service="${2:-}"

if [[ -z "$action" ]]; then
  show_menu
fi

case "$action" in
  start)
    echo "[INFO] 啟動 CTF 容器..."
    docker compose up --build -d
    ;;
  stop)
    echo "[INFO] 停止 CTF 容器..."
    docker compose down
    ;;
  restart)
    echo "[INFO] 重啟 CTF 容器..."
    docker compose down
    docker compose up --build -d
    ;;
  status)
    echo "[INFO] 目前容器狀態:"
    docker compose ps
    ;;
  logs)
    if [[ -z "$service" ]]; then
      read -r -p "輸入服務名稱 (例如 web01，留空查看全部): " service
    fi
    if [[ -z "$service" ]]; then
      docker compose logs --tail=120
    else
      docker compose logs -f --tail=120 "$service"
    fi
    ;;
  clean)
    echo "[WARN] 將停止容器並刪除映像檔..."
    docker compose down --rmi all
    ;;
  exit)
    exit 0
    ;;
  help|-h|--help)
    echo "用法:"
    echo "  ./run.command start      啟動全部題目"
    echo "  ./run.command stop       停止全部題目"
    echo "  ./run.command restart    重啟全部題目"
    echo "  ./run.command status     查看容器狀態"
    echo "  ./run.command logs web01 查看指定服務 logs"
    echo "  ./run.command clean      停止並刪除映像檔"
    echo
    echo "不帶參數執行可進入互動選單。"
    ;;
  *)
    echo "未知指令: $action"
    echo "執行 ./run.command help 查看用法"
    exit 1
    ;;
esac
